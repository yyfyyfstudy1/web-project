<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignUp extends CI_Controller {
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

        
        $this->load->view('signUp');
		$this->load->view('template/footer');
	}


	public function user_sign_up(){
		$this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation', 'email'));
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('User_model');
		 //set validation rules
		 $this->form_validation->set_rules('emailAddress', 'Email', 'required|valid_email|is_unique[users.email]');
		 $this->form_validation->set_rules('username', 'Username', array('required', 'min_length[5]'));
		 $this->form_validation->set_rules('password', 'Password', 'required');
		 $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
		

		$data['error']= "";

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

		if ($this->form_validation->run() == FALSE)
        {
            // fails
            $this->load->view('signUp');
        }else{

			//如果格式验证成功的话

			$emailAddress = $this->input->post('emailAddress');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->User_model->userRegister($emailAddress, $username, $password);
			
			$this->User_model->sendEmail($this->input->post('emailAddress'));

			$data_use['error'] ='<h1 style="text-align:central">You have been registered. Please vertify your Email !!!!</h1>';
			$this->load->view('registerMessage' , $data_use);
			

			

		}
	
		

		$this->load->view('template/footer');

	}



	function verify($hash=NULL)
    {
        if ($this->user_model->verifyEmailID($hash))
        {	
			$this->load->view('template/header');
			$data_use['error'] ='<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>';
			$this->load->view('registerMessage' , $data_use);
        }
        else
        {
			$this->load->view('template/header');
			$data_use['error'] = '<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>';
			$this->load->view('registerMessage' , $data_use);
        }
    }

}
?>
