<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload extends CI_Controller
{
    public function index()
    {
		if(!$this->session->userdata('logged_in')){
			$this->load->view('template/header');
		}else{
			$this->load->model('file_model');
			$img_name = $this->file_model->print_img_profile($this->session->userdata('username'));

			$var = array();
			foreach($img_name->result() as $row)
				   {
					 
				   $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
   
				   }
			$data_use['error'] = $var;
			$this->load->view('template/header',$data_use);
		} 
    	if (!$this->session->userdata('logged_in'))//check if user already login
		{	
			if (get_cookie('remember')) { // check if user activate the "remember me" feature  
				$username = get_cookie('username'); //get the username from cookie
				$password = get_cookie('password'); //get the username from cookie
				if ( $this->user_model->login($username, $password) )//check username and password correct
				{
					$user_data = array('username' => $username,'logged_in' => true );
					$this->session->set_userdata($user_data); //set user status to login in session
					$this->load->view('file',array('error' => 'No_file.png')); //if user already logined show upload page
				}
			}else{
				redirect('login'); //if user already logined direct user to home page
			}
		}else{
			$this->load->view('file',array('error' => 'No_file.png')); //if user already logined show login page
		}
		$this->load->view('template/footer');
    }
    public function do_upload() {
		$this->load->model('file_model');
        $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|mp4|mkv|png';
		$config['max_size'] = 20000;
		$config['max_width'] = 3024;
		$config['max_height'] = 5768;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile')) {
            if(!$this->session->userdata('logged_in')){
				$this->load->view('template/header');
			}else{
				$this->load->model('file_model');
				$img_name = $this->file_model->print_img_profile($this->session->userdata('username'));
	
				$var = array();
				foreach($img_name->result() as $row)
					   {
						 
					   $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
	   
					   }
				$data_use['error'] = $var;
				$this->load->view('template/header',$data_use);
			}
            $data = array('error' => $this->upload->display_errors());
            $this->load->view('file', $data);
            $this->load->view('template/footer');
        } else {
			$title = $this->input->post('title');
			$category = $this->input->post('category');
			$content = $this->input->post('content');
			$status = $this->input->post('status');
			
			$this->file_model->upload($this->upload->data('file_name'), $this->upload->data('full_path'),$this->session->userdata('username'), $title, $content, $status, $category);
            if(!$this->session->userdata('logged_in')){
				$this->load->view('template/header');
			}else{
				$this->load->model('file_model');
				$img_name = $this->file_model->print_img_profile($this->session->userdata('username'));
	
				$var = array();
				foreach($img_name->result() as $row)
					   {
						 
					   $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
	   
					   }
				$data_use['error'] = $var;
				$this->load->view('template/header',$data_use);
			}
			$links = $this->upload->data('file_name');
            $this->load->view('file', array('error' =>$links));
            $this->load->view('template/footer');
        }
	}

	//富文本插入本地图片的函数
	public function rich_Upload(){

				// Allowed origins to upload images
		$accepted_origins = array("http://localhost", "https://infs3202-f3b94c2a.uqcloud.net", "http://codexworld.com");

		// Images upload path
		$imageFolder = "uploads/";

		reset($_FILES);
		$temp = current($_FILES);
		if(is_uploaded_file($temp['tmp_name'])){
			if(isset($_SERVER['HTTP_ORIGIN'])){
				// Same-origin requests won't set an origin. If the origin is set, it must be valid.
				if(in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)){
					header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
				}else{
					header("HTTP/1.1 403 Origin Denied");
					return;
				}
			}
		
			// Sanitize input
			if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])){
				header("HTTP/1.1 400 Invalid file name.");
				return;
			}
		
			// Verify extension
			if(!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))){
				header("HTTP/1.1 400 Invalid extension.");
				return;
			}
		
			// Accept upload if there was no origin, or if it is an accepted origin
			$filetowrite = $imageFolder . $temp['name'];
			move_uploaded_file($temp['tmp_name'], $filetowrite);
		
			// Respond to the successful upload with JSON.
			echo json_encode(array('location' => 'http://localhost/infs3202/'.$filetowrite));
		} else {
			// Notify editor that the upload failed
			header("HTTP/1.1 500 Server Error");
		}

			}







	}
