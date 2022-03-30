<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class QuestionPanel extends CI_Controller
{
    public function index()
    {
		if(!$this->session->userdata('logged_in')){
			$this->load->view('template/header2');
		}else{
			$this->load->model('file_model');
			$img_name = $this->file_model->print_img_profile($this->session->userdata('username'));

			$var = array();
			foreach($img_name->result() as $row)
				   {
					 
				   $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
   
				   }
			$data_use['error'] = $var;
			$this->load->view('template/header2',$data_use);
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
				$this->load->view('template/header2');
			}else{
				$this->load->model('file_model');
				$img_name = $this->file_model->print_img_profile($this->session->userdata('username'));
	
				$var = array();
				foreach($img_name->result() as $row)
					   {
						 
					   $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
	   
					   }
				$data_use['error'] = $var;
				$this->load->view('template/header2',$data_use);
			}

			$category = $this->input->post('category_filter');
			$title = $this->input->post('title');
			$category = $this->input->post('category');
			$content = $this->input->post('content');
			$username = $this->session->userdata('username');

			$this->file_model->userPostQuestion($title, $category, $content, $username);

			// 先从cookie里获取分类的信息
			$category = get_cookie('category');


			$data = $this->file_model->takePostQuestion($category);
			
			$data_use['files'] = $data->result();
	
			// 把问题的内容传递给前端页面
			$this->load->view('questionPanel',$data_use); 

            $this->load->view('template/footer');
        
	}



	//定义左侧筛选问题的函数
	public function filterQuestion(){
		
		$this->load->model('file_model');	
			
            if(!$this->session->userdata('logged_in')){
				$this->load->view('template/header2');
			}else{
				$this->load->model('file_model');
				$img_name = $this->file_model->print_img_profile($this->session->userdata('username'));
	
				$var = array();
				foreach($img_name->result() as $row)
					   {
						 
					   $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
	   
					   }
				$data_use['error'] = $var;
				$this->load->view('template/header2',$data_use);
			}


			$category = $this->input->post('category_filter');
			// 设置一个cookie暂时保存分类的值
			set_cookie("category", $category, '3000');
		

			$data = $this->file_model->takePostQuestion($category);
			
			$data_use['files'] = $data->result();
	
			// 把问题的内容传递给前端页面
			$this->load->view('questionPanel',$data_use); 

            $this->load->view('template/footer');
	}


	//定义右侧展示的函数
	public function showQuestion(){
		
		$this->load->model('file_model');	
			
            if(!$this->session->userdata('logged_in')){
				$this->load->view('template/header2');
			}else{
				$this->load->model('file_model');
				$img_name = $this->file_model->print_img_profile($this->session->userdata('username'));
	
				$var = array();
				foreach($img_name->result() as $row)
					   {
						 
					   $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
	   
					   }
				$data_use['error'] = $var;
				$this->load->view('template/header2',$data_use);
			}


			$ID = $this->input->post('queId');

			// 先从cookie里获取分类的信息
			$category = get_cookie('category');

			
			$data = $this->file_model->takePostQuestion($category);

			$data2 = $this->file_model->showQuestion($ID);

			$data3 = $this->file_model->showAnswer($ID);

			$data4 = $this->file_model->showComment();




			$img_name = $this->file_model->print_img_profile($this->session->userdata('username'));
	
			$var = array();
			foreach($img_name->result() as $row)
				   {
					 
				   $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
   
				   }

			$data_use['user_Avater'] = $var;
			$data_use['files'] = $data->result();
			$data_use['files2'] = $data2->result();
			$data_use['files3'] = $data3->result();
			$data_use['files4'] = $data4->result();
	
			// 把问题的内容传递给前端页面
			$this->load->view('questionPanel', $data_use); 

            // $this->load->view('template/footer');
		}


	// 定义发布回复的函数
	
		public function postAnswer(){
		
			$this->load->model('file_model');	
				
				if(!$this->session->userdata('logged_in')){
					$this->load->view('template/header2');
				}else{
					$this->load->model('file_model');
					$img_name = $this->file_model->print_img_profile($this->session->userdata('username'));
		
					$var = array();
					foreach($img_name->result() as $row)
						   {
							 
						   $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
		   
						   }
					$data_use['error'] = $var;
					$this->load->view('template/header2',$data_use);
				}
	
	
				
				$queUseId = $this->input->post('queUseId');
				$answerContent =  $this->input->post('answer_content');
				
	
				// 先从cookie里获取分类的信息
				$category = get_cookie('category');
				
				$this->file_model->userAnswerQuestion($answerContent, $this->session->userdata('username'), $queUseId);
				
				$data = $this->file_model->takePostQuestion($category);
	
				$data2 = $this->file_model->showQuestion($queUseId);

				$data3 = $this->file_model->showAnswer($queUseId);
				$data4 = $this->file_model->showComment();

				$img_name = $this->file_model->print_img_profile($this->session->userdata('username'));
	
			$var = array();
			foreach($img_name->result() as $row)
				   {
					 
				   $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
   
				   }

			$data_use['user_Avater'] = $var;
	
				
				$data_use['files'] = $data->result();
				$data_use['files2'] = $data2->result();
				$data_use['files3'] = $data3->result();
				$data_use['files4'] = $data4->result();
		
				// 把问题的内容传递给前端页面
				$this->load->view('questionPanel', $data_use); 
	
				// $this->load->view('template/footer');
		}
		

		public function rich_Upload(){


						// Allowed origins to upload images
		$accepted_origins = array("http://localhost", "http://107.161.82.130", "http://codexworld.com");

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


		// 定义发布回复评论的函数
		public function commentPost(){
			$this->load->model('file_model');	
				
				if(!$this->session->userdata('logged_in')){
					$this->load->view('template/header2');
				}else{
					$this->load->model('file_model');
					$img_name = $this->file_model->print_img_profile($this->session->userdata('username'));
		
					$var = array();
					foreach($img_name->result() as $row)
						   {
							 
						   $var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
		   
						   }
					$data_use['error'] = $var;
					$this->load->view('template/header2',$data_use);
				}
	
	
				
				$queUseId = $this->input->post('commentQueID');
				$answerContent =  $this->input->post('comment_content');
				$commentAnswerId = $this->input->post('commentAnswerID');
				$comment_reply_id = $this->input->post('comment_reply_id');
				// 先从cookie里获取分类的信息
				$category = get_cookie('category');
				
				//$this->file_model->userAnswerQuestion($answerContent, $this->session->userdata('username'), $queUseId);
				
				$data = $this->file_model->takePostQuestion($category);
	
				$data2 = $this->file_model->showQuestion($queUseId);

				$data3 = $this->file_model->showAnswer($queUseId);
				
				

				$this->file_model->post_comment($answerContent, $queUseId, $commentAnswerId,$comment_reply_id, $this->session->userdata('username') );
				$data4 = $this->file_model->showComment();

				$img_name = $this->file_model->print_img_profile($this->session->userdata('username'));
	
				$var = array();
				foreach($img_name->result() as $row)
					{
						
					$var[] = ''.base_url().'uploads_profile/'.$row->filename.'';
	
					}

				$data_use['user_Avater'] = $var;
	
				
				$data_use['files'] = $data->result();
				$data_use['files2'] = $data2->result();
				$data_use['files3'] = $data3->result();
				$data_use['files4'] = $data4->result();
				
		
				// 把问题的内容传递给前端页面
				$this->load->view('questionPanel', $data_use); 
	
				// $this->load->view('template/footer');

		}


		// 评论提示功能的函数
		function fetch(){
			
			$this->load->model('file_model');	
			$username = $this->input->post('query');
			$comment_data = $this->file_model->showComment();
			$i=0;
			foreach($comment_data->result() as $comment_use){
				
				// 用户的评论被其他人评论了
				if($comment_use->comment_reply_id != $comment_use->comment_id and $comment_use->copy_name == $username){

					$i = $i +1;
					echo'
					<div style="float:left; width:800px; margin-top:15px">
						<div style="float:left; width:70px; height:80px; margin-left:15px">
							<image src="'.base_url().'uploads_profile/'.$comment_use->avaterName.'" class="questionerAvater"></image>
						</div>
						<div style="float:left; width: 700px; height:80px; ">

							<p style = "float:left; font-size:15px; font-weight:bold; width:200px;">
								'.$comment_use->commenter_name.'
								reply your comment
							</p>
							<div style="float:left; width:650px; margin-top:8px;">
								<h5 >
								'.$comment_use->comment_content.'
								</h5>
							</div>


						</div>
					</div>	
					
					';


				}
				
				

			}

			echo '<script>$("#number_use").html('.$i.');</script>';
		
		}





	}
