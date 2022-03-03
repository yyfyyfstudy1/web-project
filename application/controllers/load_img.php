<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class load_img extends CI_Controller
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
                    $data = $this->file_model->print_img($username);
                    $var = array();
                    foreach($data->result() as $row)
                    {
			  	
				    $var[] = ''.$row->filename.'';

			        }
                    $data_use['img_src'] = $var;
                    $data_use['user_name']= $username;
                    $this->load->view('file2',$data_use ); //if user already logined show file2 page
				}
			}else{
				redirect('login'); //if user already logined direct user to home page
			}
		}else{
            $this->load->model('file_model');  					

                    $username = $this->session->userdata('username');
                    $data = $this->file_model->print_img($username);
                    $var = array();
                    foreach($data->result() as $row)
                    {
			  	
				    $var[] = ''.$row->filename.'';

			        }
                    $data_use['img_src'] = $var;
                    $data_use['user_name']= $username;
                    
					//朋友圈发布功能


					$this->load->view('file2',$data_use );

		}
		$this->load->view('template/footer');
    }

	public function update_data(){

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
                    $data = $this->file_model->print_img($username);
                    $var = array();
                    foreach($data->result() as $row)
                    {
			  	
				    $var[] = ''.$row->filename.'';

			        }
                    $data_use['img_src'] = $var;
                    $data_use['user_name']= $username;
                    $this->load->view('file2',$data_use ); //if user already logined show file2 page
				}
			}else{
				redirect('login'); //if user already logined direct user to home page
			}
		}else{

			$this->load->model('file_model');  					

                    $username = $this->session->userdata('username');
                    $data = $this->file_model->print_img($username);
                    $var = array();
                    foreach($data->result() as $row)
                    {
			  	
				    $var[] = ''.$row->filename.'';

			        }
                    $data_use['img_src'] = $var;
                    $data_use['user_name']= $username;
                    
					//朋友圈发布功能
					$photo_name = $this->input->post('type');
					$photo_delete = $this->input->post('type_delete');
					$photo_delete_it = $this->input->post('photo_delete');
					
					if(isset($photo_name)){

						$this->file_model->pic_post($photo_name);
					

					}
					
					// $data_use['photo_name']= $photo_name;
					
					
					if(isset($photo_delete)){

						$this->file_model->pic_delete($photo_delete);
						
					}

					if(isset($photo_delete_it)){

						$this->file_model->pic_delete_it($photo_delete_it);
					}

					$this->load->view('file2',$data_use );
					redirect('load_img');

			}


			$this->load->view('template/footer');


	}



	}
