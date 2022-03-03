<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class comment_page extends CI_Controller
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
                    $fname = $this->input->get('name'); 


                    $this->load->model('file_model');
                    $comment_get = $this->file_model->read_comment($fname);
                    if($comment_get->result() != NULL){

                        $var = array();
                        foreach($comment_get->result() as $row)
                        {
                      
                        $var[] = $row->comment;
                        $name[] = $row->username;
                
                        }
                        
                        $data_use['comment']=$var;
                        $data_use['nname']=$name;
        
        
        
                    }
                    //$this->load->view('comment_page',$data_use );


                    $data_use['user_name']= $fname;
            
                    $this->load->view('comment_page',$data_use );
				}
			}else{
				redirect('login'); //if user already logined direct user to home page
			}
		}else{
            $fname = $this->input->get('name'); 
           

            $this->load->model('file_model');

            $comment_get = $this->file_model->read_comment($fname);

            if ($comment_get->result() != NULL)
            {


                $var = array();
                $name = array();
                $id = array();
                foreach($comment_get->result() as $row)
                {
              
                $var[] = $row->comment;
                $name[] = $row->username;
                $id[] = $row->id;
        
                }
                
                $data_use['comment']=$var;
                $data_use['nname']=$name;
                $data_use['id'] = $id;



            
            }


            $data_use['user_name']= $fname;
            //$this->load->view('comment_page',$data_use );


            
    
            $this->load->view('comment_page',$data_use );
    
            


		}
		$this->load->view('template/footer');
    }







    
    
    // public function index()
    // {
	// 	$this->load->view('templates/header');

    //     $fname = $this->input->get('name'); 
    //     $data_use['user_name']= $fname;

    //     $this->load->view('comment_page',$data_use );

	// 	$this->load->view('templates/footer');
    // }



    public function submit_comments()
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
        $photo_name = $this->input->post('name'); 
        $data_use['user_name']= $photo_name;

        $comments = $this->input->post('username');

        $this->load->model('file_model'); //调用数据库
        $username = $this->session->userdata('username');
        $this->file_model->insert_common($photo_name,$comments,$username);


        $comment_get = $this->file_model->read_comment($photo_name);
        $var = array();
        $name=array();
        $id = array();
        foreach($comment_get->result() as $row)
        {
      
        $var[] = $row->comment;
        $name[] = $row->username;
        $id[]= $row ->id;

        }

        $data_use['comment']=$var;
        $data_use['nname']=$name;
        $data_use['id']=$id;
        $this->load->view('comment_page',$data_use );

		$this->load->view('template/footer');

    }


	}
