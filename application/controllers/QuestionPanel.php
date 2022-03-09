<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionPanel extends CI_Controller {

	public function index()
	{		if(!$this->session->userdata('logged_in')){
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
		$this->load->view('questionPanel');
	}


}

