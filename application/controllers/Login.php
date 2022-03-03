<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
	public function index()
	{
		$data['error']= "";
		$this->load->helper('form');
		$this->load->helper('url');
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
					$user_data = array(
						'username' => $username,
						'logged_in' => true 	//create session variable
					);
					$this->session->set_userdata($user_data); //set user status to login in session
					
					

					$this->load->model('file_model');
                    $img_name = $this->file_model->print_img_profile($this->session->userdata('username'));

                    $var = array();
                    foreach($img_name->result() as $row)
                        {
                          
                        $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
        
                        }
                    
                    $data_use['error'] = $var;
					$data_use['name']= $username;
        
                    $this->load->view('welcome_message', $data_use);








					//$this->load->view('welcome_message',$error); //if user already logined show main page
				}
			}else{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{
		
			$username = $this->session->userdata('username');

			// $this->load->model('file_model');  
			// $data = $this->file_model->print_img_profile($username);



			// $error['aaa'] = $username;
			// $error['bbb'] = 'test';
			
			// $this->load->view('welcome_message',$error); //if user already logined show main page

				$this->load->model('file_model');
                $img_name = $this->file_model->print_img_profile($this->session->userdata('username'));

                 $var = array();
                 foreach($img_name->result() as $row)
                        {
                          
                        $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
        
                        }
                    
                $data_use['error'] = $var;
				$data_use['name']= $username;
        
                 $this->load->view('welcome_message', $data_use);

		}
		$this->load->view('template/footer');
	}
	public function check_login()
	{
		$this->load->model('user_model');		//load user model
		$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or passwrod!! </div> ";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$username = $this->input->post('username'); //getting username from login form
		$password = $this->input->post('password'); //getting password from login form
		$remember = $this->input->post('remember'); //getting remember checkbox from login form
		if(!$this->session->userdata('logged_in')){	//Check if user already login
			if ( $this->user_model->login($username, $password) )//check username and password
			{
				$user_data = array(
					'username' => $username,
					'logged_in' => true 	//create session variable
				);
				if($remember) { // if remember me is activated create cookie
					set_cookie("username", $username, '300'); //set cookie username
					set_cookie("password", $password, '300'); //set cookie password
					set_cookie("remember", $remember, '300'); //set cookie remember
				}	
				$this->session->set_userdata($user_data); //set user status to login in session
				redirect('login'); // direct user home page
			}else
			{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{
			{
				redirect('login'); //if user already logined direct user to home page
			}
		$this->load->view('template/footer');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('logged_in'); //delete login status
		redirect('login'); // redirect user back to login
	}


}
?>
