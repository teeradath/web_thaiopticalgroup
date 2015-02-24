<?php
class Products extends CI_Controller{
	public function index(){
		$this->load->library('load_language');
		@$this->session->set_userdata('activeTopMenu_id',3);
		//init Template
		$this->template->title = $this->lang->line('PRODUCTS').' | ThaiOpricalGroup';
		//$this->template->content_data = $data;
		$this->template->load_template('products_form');
	}
}