<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class QuestionPanel extends CI_Controller
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
					$this->load->view('questionPanel',array('error' => 'No_file.png')); //if user already logined show upload page
				}
			}else{
				redirect('login'); //if user already logined direct user to home page
			}
		}else{
			$this->load->model('file_model');
			$data = $this->file_model->takePostQuestion(1);
			$data_use['files'] = $data->result();
	
			// 把问题的内容传递给前端页面
			$this->load->view('questionPanel',$data_use); 
		}
		$this->load->view('template/footer');
    }

    public function question_upload() {
			$this->load->model('file_model');	
			
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


			$title = $this->input->post('title');
			$category = $this->input->post('category');
			$content = $this->input->post('content');
			$username = $this->session->userdata('username');

			$this->file_model->userPostQuestion($title, $category, $content, $username);


			$data = $this->file_model->takePostQuestion(1);
			
			$data_use['files'] = $data->result();
	
			// 把问题的内容传递给前端页面
			$this->load->view('questionPanel',$data_use); 

            $this->load->view('template/footer');
        
	}



	//定义左侧筛选问题的函数
	public function filterQuestion(){
		
		$this->load->model('file_model');	
			
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


			$category = $this->input->post('category_filter');
		

			$data = $this->file_model->takePostQuestion($category);
			
			$data_use['files'] = $data->result();
	
			// 把问题的内容传递给前端页面
			$this->load->view('questionPanel',$data_use); 

            $this->load->view('template/footer');
	}







	}
