<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgetPassword extends CI_Controller {
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

        $this->load->view('forgetPassword');
	
		$this->load->view('template/footer');
	}

    public function CheckUserInfo(){

        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation', 'email'));
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('User_model');

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

        $email = $this->input->post('emailAddress');
        $username = $this->input->post('username');
        $userHave =  $this->User_model->chekUsernameEmail($email, $username);
		$password = $this->User_model->takeOldPassword($username);
        if($userHave){
            $this->User_model->sendChangeEmail($email, $password);
            $data_use['error'] ='<h1 style="text-align:central">A Email have send. Please change your password in this Email</h1>';
			$this->load->view('registerMessage' , $data_use);
        }else{
			$data_use['error'] ='<h1 style="text-align:central">Email or username does not exist</h1>';
            $this->load->view('forgetPassword', $data_use);
        }

		$this->load->view('template/footer');


    }

    // 用户点击链接
    function verify($hash=NULL, $hash2=NULL)
    {   
		
		$this->load->view('template/header');
        $this->load->model('User_model');

		//先判断邮件是否过期
		 // 获取时间差 
		 date_default_timezone_set("Asia/Shanghai");
		 $startdate= $this->User_model->takeUpdateTime( $hash ,$hash2);
		 $enddate=date('Y-m-d H:i:s');
		 $date=floor((strtotime($enddate)-strtotime($startdate))/86400);
		 $hour=floor((strtotime($enddate)-strtotime($startdate))%86400/3600);
		 $minute=floor((strtotime($enddate)-strtotime($startdate))%86400/60);
		 if($hour<1){
			 // 如果没有过期
			if ($this->user_model->verifyEmailID($hash, $hash2))
			{	
				
				$data_use['error'] ='<div class="alert alert-success text-center">Your Email Address is successfully verified! please change your password</div>';
				//把hash值发到前端表单
				$data_use['hash']= $hash;
				$data_use['hash2']= $hash2;

				$this->load->view('changePassword' , $data_use);
			}
			else
			{

				$data_use['error'] = '<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>';
				$this->load->view('registerMessage' , $data_use);
			}

		}else{
		$data_use['error'] ='<div class="alert alert-danger text-center">TimeOut, please try again</div>';
			
		$this->load->view('registerMessage' , $data_use);
	 }
    }

    //修改密码
    function chanePassword(){
		$this->load->view('template/header');
        $this->load->model('User_model');

        $hash = $this ->input->post('hash');
		$hash2 = $this ->input->post('hash2');
        $password = $this ->input->post('password');


	
			if($this->User_model->updateUserPassword($hash,$hash2, $password)){

				$data_use['error'] ='<div class="alert alert-success text-center">Your Password have successed changed</div>';
				
				$this->load->view('registerMessage' , $data_use);
	
			}else{
				$data_use['error'] ='<div class="alert alert-danger text-center">Please try later</div>';
				
				$this->load->view('registerMessage' , $data_use);
			}
			

			


    }

}
?>
