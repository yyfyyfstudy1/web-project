<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class file_common extends CI_Controller
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



                    $this->load->model('file_model');  
			
                    $username = $this->session->userdata('username');
                    $data = $this->file_model->print_common_img2();
                    $var = array();
                    foreach($data->result() as $row)
                    {
			  	
				    $var[] = $row->filename;

			        }
                    $data_use['img_src'] = $var;
                    $data_use['user_name']= $username;

                    $this->load->view('file_common',$data_use ); //if user already logined show upload page

				}
			}else{
				redirect('login'); //if user already logined direct user to home page
			}
		}else{
            $this->load->model('file_model');  

			
                    $username = $this->session->userdata('username');
                    $data = $this->file_model->print_common_img2();

					$data_use['files'] = $data->result();

                    $data_use['user_name']= $username;

                    $this->load->view('file_common',$data_use );


		}
		$this->load->view('template/footer');
    }

		// 定义筛选文章种类的方法
		public function filterData()
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
	
	
	
						$this->load->model('file_model');  
				
						$username = $this->session->userdata('username');
						$data = $this->file_model->print_common_img();
						$var = array();
						foreach($data->result() as $row)
						{
					  
						$var[] = $row->filename;
	
						}
						$data_use['img_src'] = $var;
						$data_use['user_name']= $username;
	
						$this->load->view('file_common',$data_use ); //if user already logined show upload page
	
					}
				}else{
					redirect('login'); //if user already logined direct user to home page
				}
			}else{
				$this->load->model('file_model');  
						if($this->input->post('category')=='recommend'){
							$data = $this->file_model->print_common_img2();
						}else{
							$data = $this->file_model->print_common_img($this->input->post('category'));
						}
						
						$username = $this->session->userdata('username');
						
	
						$data_use['files'] = $data->result();
	
						$data_use['user_name']= $username;
	
						$this->load->view('file_common',$data_use );
	
	
			}
			$this->load->view('template/footer');







		}



	}
