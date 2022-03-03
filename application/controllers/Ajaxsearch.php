<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxsearch extends CI_Controller {

 function index()
 {
    // $this->load->view('templates/header'); 
    $this->load->view('ajaxsearch');

    $this->load->view('template/footer');

 }

 function fetch()
 {
  $output = '';
  $query = '';
  $yyf = 'http://localhost/ci/';
  
  $this->load->model('ajaxsearch_model');
  if($this->input->post('query'))
  {
   $query = $this->input->post('query');
  }
  $data = $this->ajaxsearch_model->fetch_data($query);
  $output .= '
  <div class="table-responsive">
     <table class="table table-bordered table-striped">
      <tr>
       <th>照片ID</th>
       <th>作品名称</th>
       <th>上传者姓名</th>
       <th>照片展示</th>
      </tr>
  ';
  if($data->num_rows() > 0)
  {
   foreach($data->result() as $row)
   {

    if ($row->post == 'yes'){

    
    $output .= '
      <tr>

       <td><h3>'.$row->id.'</h3></td>
       <td><h3>'.$row->filename.'</h3></td>
       <td><h3>'.$row->username.'</h3></td>
       <td><img src= "http://localhost/infs3202/uploads/'.$row->filename.'" width="300" height="200"></td>
      </tr>
     
    ';
    
    }



   }
  }
  else
  {
   $output .= '<tr>
       <td colspan="4"><img src = "http://localhost/infs3202/uploads/无结果.png"></td>
       
      </tr>';
  }
  $output .= '</table>';
  echo $output;
 }
 
}