<?php 
class Home extends CI_Controller {
	public function index()
	{
		//@Init Session Language
		$this->load->library('load_language');
		//@ friendly Url
		$this->load->library('url_friendly');
		//@Get News data
		$this->load->model("news_model");
		$data['arr_news'] = $this->news_model->GetNews($this->session->userdata('lang_id'))->result_array();
		//@Get Gallery data
		$this->load->model("gallery_model");
		$data['arr_gallery'] = $this->gallery_model->GetGallery($this->session->userdata('lang_id'))->result_array();
		//------------------------------------		
		//init Template
		$this->template->title = 'ThaiOpricalGroup';
		$this->template->content_data = $data;
		$this->template->load_template('home/home');
	}
	
	public function change_lang($lang){
		$this->session->set_userdata('lang_id',$lang);
		redirect(base_url(),"refresh");
		exit();
	}
}