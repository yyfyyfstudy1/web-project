<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wechat extends CI_Controller {

 function index()
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
   
    $this->load->view('wechat');

    $this->load->view('template/footer');

 }

 function fetch()
 {
  $output = '';
  $query = '';
  
  
  $this->load->model('ajaxsearch_model');
  $this->load->model('file_model');
  
  $data2 = $this->ajaxsearch_model->wchat_record();
  $username = $this->session->userdata('username');

  $pic_name = $this->file_model->print_img_profile($username);
  foreach($pic_name->result() as $row )
  {

    $profile  = $row->filename;
  }


  $output .= '<ul style="list-style: none;">';
  foreach($data2->result() as $row)
  {
    if($row->username == $username){

      $output .= '
      
      <li>
      <div style="float: right;">

      <img src="'.base_url().'uploads_profile/'. $profile.'" width="50" height="50"> 
      
      </div>

      <div style="float: right; margin-right: 20px; margin-top: 20px;">
      <h4 style="color: rgb(255, 0, 0);" > '. $row->record . ' :</h4>

      </div>


      
      </li><br><br><br><br><br>
    
    ';



    }else{


      $pic_other = $this->file_model->print_img_profile($row->username);
      foreach($pic_other->result() as $row2 )
        {

          $profile_other  = $row2->filename;
        }

      


      $output .= '
   
      <li> 

      <div style="float: left;">
      
      <img src="'.base_url().'uploads_profile/'. $profile_other.'" width="50" height="50">

      </div>

      <div style="float: left; margin-left: 20px; margin-top: 20px;">
      
          <h4> : '. $row->record.'</h4> 

      </div>
      
      </li><br><br><br><br><br>
    
    ';



    }
   


  }
  $output .= '</ul>';
  echo $output;

}

public function insert_record()
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
    $this->load->model('ajaxsearch_model');
  if($this->input->post('user_record'))
  {
   $query = $this->input->post('user_record');
  }
//$data = $this->ajaxsearch_model->fetch_data($query);
    $username = $this->session->userdata('username');

    $date = date("Y/m/d");
  if ($query != NULL){
  $this->ajaxsearch_model->insert_wechat_record($username, $query, $date);
  

  }


  $this->load->view('wechat');

  $this->load->view('template/footer');


}


}
