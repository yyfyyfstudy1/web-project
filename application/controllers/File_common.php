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
					$data_use['if_likes'] = 1;

                    $this->load->view('file_common',$data_use );


		}
		$this->load->view('template/footer');
    }

	// ?????????????????????????????????
	public function filterData()
		{
			
				$this->load->model('file_model');  
						if($this->input->post('category')=='recommend'){
							$data = $this->file_model->print_common_img2();
						}else{
							$data = $this->file_model->print_common_img($this->input->post('category'));
						}
						
						$username = $this->session->userdata('username');
						
	
						$files = $data->result();
	
						 /**
         * ??????????????????????????????
        * addtime 2020???8???10??? 09:45:20
        * @param [type] $string ?????????
        * @return void
        */
        function StringExtractionText($string)
        {
        if($string){
            // ????????????????????? HTML ?????????????????????
            // ?????????????????????:<,>,&??????????????????(<,>,???????????????,&????????????),??????????????????
            $html_string = htmlspecialchars_decode($string);
            // ???????????????
            $content = str_replace(" ", " ", $html_string);
            // ????????????????????? HTML ??????
            $contents = strip_tags($content);
            // ?????????????????????
            $num = 100;
            // ?????????????????????????????????????????????????????????????????????
            return mb_strlen($contents,'utf-8') > $num ? mb_substr($contents, 0, $num, "utf-8").'...' : mb_substr($contents, 0, $num, "utf-8");
        }else{
            return false;
        }
        }


    foreach($files as $file){

        $query = array(
            'id' => '7876',
            'name' => $file->filename // ??????????????????????????????
        );
        $url = ''.base_url().'comment_page?' . http_build_query($query); // ????????????????????????url??????????????????
        
        $content_use = StringExtractionText($file->content);

        echo '
        
			
			
		<div class="big-container" >
		<a href="'.$url.'">
			<div class="title">
			<p>
			<font size="3">
			<b>
			'.$file->title.'
			<b>
			</font>
			</p>
		
			</div>
	
			<div class="left-img">
				<img src = "'.base_url().'uploads/'. $file->filename.'" width="137px" height="100px">
			
			</div>
		</a>
			<div class="right-container">
				<div class="content">
					<font size="2" color="gray">
						'.$content_use.'
					
					</font>

				</div>
				
				<div class="likes">
					
						
					<image src="'.base_url().'assets/img/???.png" width="30px" height="30px" style="float:left" class="rateButton" onclick="likeAjax('.$file->id.')"></image>
			
					<p style="margin-left: 7px; float:left; margin-top:5px">'.$file->user_likes.'<p>
					

				<form action="'.base_url().'File_common/userLikes" method="post" name="LikeForm" >
					<input  name="dislikes" type="hidden" value='.$file->id.'>
					<image src="'.base_url().'assets/img/???.png" width="25px" height="25px" style="margin-left: 40px;margin-top:5px; float:left" id="submitableimag"></image>
					<p style="margin-left: 7px; float:left; margin-top:5px">'.$file->dislikes.'<p>
				
					<p style="margin-left: 27px; float:left; margin-top:5px">'.$file->username.'<p>
				</form>
				</div>
			
			</div>
			
		</div>
		
          
        
        ';
        
    }

		}

		//?????????????????????
		public function userLikes(){

		
				$this->load->model('file_model');  
					
					$username = $this->session->userdata('username');
						
						if($this->input->post('Ilikes')){

							$likes_id = $this->input->post('Ilikes');

							// ??????????????????????????????????????????

							//???????????????
							if($this->file_model->if_likes($username, $likes_id)){

								echo '???????????????????????????????????????';


							}else{
								//?????????????????????
								$this->file_model->insert_llike($username, $likes_id);
								$this->file_model->likes_add($likes_id);

							}
								

						}
					

		}

	}
