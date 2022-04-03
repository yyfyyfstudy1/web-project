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
			//如果用户是通过点击消息盒子调用函数，就更新评论阅读状态
			if($this->input->post('commentId')){
				$this->file_model->updateread($this->input->post('commentId'));
			};
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

				$email_template='';
				
	
				// 先从cookie里获取分类的信息
				$category = get_cookie('category');
				
				$this->file_model->userAnswerQuestion($answerContent, $this->session->userdata('username'), $queUseId);
				
				$data = $this->file_model->takePostQuestion($category);
	
				$data2 = $this->file_model->showQuestion($queUseId);

				$data3 = $this->file_model->showAnswer($queUseId);
  				
					//定义发布邮件提醒提问者的功能
					foreach($data3->result() as $data3_use){
						
						 $data_sets =  $this->file_model->takeUserInfo($data3_use ->userName);
						if( $data3_use->answerUserName != $data3_use ->userName){
						 foreach($data_sets->result() as $data_set){
							//  echo $data_set->Email;
							$emailContent='<h2><span><em><strong>Hi&nbsp;'.$data3_use ->userName.'</strong></em></span></h2>
							<h2><span style="color: #3598db;"><strong>Your question has been answerd&nbsp;</strong></span></h2>
							<div><em>'.$answerContent.'</em></div>
							<div>&nbsp;</div>
							<div><hr /></div>
							<div><em>Learner Team</em></div>
							<div>&nbsp;</div>
							<div><em>'.$data3_use ->answerPubTime.'</em></div>';

							$subject = '"There have someone answer your Quetion"';

							//调用邮件发送类
							$this->file_model->sendEmail($data_set->Email, $subject, $emailContent);



						 }
						}
						 break;
	
					}


				


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


		// 定义发布评论的函数
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
				
				

				$user_info_data = $this->file_model->post_comment($answerContent, $queUseId, $commentAnswerId,$comment_reply_id, $this->session->userdata('username') );

	
					
					$info_querys = $user_info_data->result();

					foreach($info_querys as $info_query){

						//判断此条评论是回复其他评论的
					if($info_query->comment_id != $info_query->comment_reply_id){
						
						//判断不是回复自己
						if($info_query->commenter_name != $info_query->copy_name){
							//获取到被评论人的邮箱
					
							//发送邮件提示被评论者
							$this->file_model->sendEmail($info_query->Email,  'There have someone comment you',  $info_query->comment_content);




						}



					}else{
						// 如果此条评论是直接评论answer的
						
						
						if($info_query->commenter_name != $info_query->answerUserName){
						$data_sets =  $this->file_model->takeUserInfo($info_query->answerUserName);
						foreach($data_sets->result() as $data_set){

							// echo $data_set->Email; 
							$this->file_model->sendEmail( $data_set->Email,  'someone comment your answer',  $info_query->comment_content);





						}

					}

					}

						

					}

			
				

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
				if($comment_use->comment_reply_id != $comment_use->comment_id and $comment_use->copy_name == $username and $comment_use->readed != 'yes' and $comment_use->commenter_name != $comment_use->copy_name){

					$i = $i +1;
					echo'
					<form action="'.base_url().'QuestionPanel/showQuestion" method="post" id="submitableimag'.$comment_use->comment_id.'">
					
					<div id="test'.$comment_use->comment_id.'" style="float:left; width:800px; margin-top:15px">
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
					<input  name="queId" type="hidden" value='.$comment_use->comment_que_id.'>
					<input  name="commentId" type="hidden" value='.$comment_use->comment_id.'>

					</form>
					
				
					
					
					';


					

				}
				// 回复的评论
				// 如果replyId和commentId相等说明这条评论写在回复下方，通过与发送过来的username比对，筛选出复合的评论
				if($comment_use->comment_reply_id == $comment_use->comment_id and $comment_use->answerUserName == $username and $comment_use->readed != 'yes'){
					$i = $i +1;
					echo'
					<form action="'.base_url().'QuestionPanel/showQuestion" method="post" id="submitableimag'.$comment_use->comment_id.'">
					
					<div id="test'.$comment_use->comment_id.'" style="float:left; width:800px; margin-top:15px">
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
					<input  name="queId" type="hidden" value='.$comment_use->comment_que_id.'>
					<input  name="commentId" type="hidden" value='.$comment_use->comment_id.'>

					</form>					
					';


				}
				
				echo'
				<script>
				$("#test'.$comment_use->comment_id.'").click(function(){
					
					$("#submitableimag"+'.$comment_use->comment_id.').submit();


				});
				</script>
				';

			}

			echo '<script>
			
				$("#number_use").html('.$i.');

		
			</script>';
		
		}




		// public function qq(){
		// 	$this->load->library('email');
		// 	$config['protocol'] = 'smtp';
		// 	$config['smtp_host'] = 'ssl://smtp.qq.com';
		// 	$config['smtp_user'] = '294006654@qq.com';
		// 	$config['smtp_pass'] = "mtfmbqvtpjhlbgje";//填写腾讯邮箱开启POP3/SMTP服务时的授权码，即核对密码正确
		// 	$config['smtp_port'] = 465;
		// 	$config['charset'] = 'utf-8';
		// 	$config['smtp_timeout'] = 30;
		// 	$config['mailtype'] = 'text';
		// 	$config['wordwrap'] = TRUE;
		// 	$config['crlf'] = PHP_EOL;
		// 	$config['newline'] = PHP_EOL;
	  
	  
		// 	$this->email->initialize($config);
		// 	$this->email->from('294006654@qq.com', '虞奕凡');
		// 	$this->email->to('2451785950@qq.com');
		// 	$this->email->cc('XXXXXXXX@qq.com');
		// 	$this->email->bcc('XXXXXXXX@qq.com');   
		// 	$this->email->subject('XXXXXXXX');
		// 	$this->email->message('XXXXXXXXXXXXXXXXXX！');
		// 	//echo $this->email->print_debugger();
		// 	//return $this->email->send();
		// 	if($this->email->send()){
		// 			echo 'yes';
		// 			}else{
		// 			echo $this->email->print_debugger();
		// 			}
		// 		}




	}
