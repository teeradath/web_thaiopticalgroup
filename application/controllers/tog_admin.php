<?php
class Tog_admin extends CI_Controller{
	public function index(){
		//init Template
		$this->template->title = 'Administrator';
		//$this->template->content_data = $data;
		$this->template->load_templateAdmin();
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect("login");
	}
}