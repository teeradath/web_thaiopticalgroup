<?php
class Home extends CI_Controller {

	public function index()
	{
		//init Language
		if($this->session->userdata('lang_id')==null){
			$this->lang->load('th','th');
			$this->session->set_userdata('lang_id','th');
		}else{
			$this->lang->load($this->session->userdata('lang_id'),$this->session->userdata('lang_id'));
		}

		//@data Get news
		$this->load->model("news_model");
		$rs = $this->news_model->GetNews($this->session->userdata('lang_id'))->result_array();
		$data['arr_news'] = $rs;
		//@data Get Gallery
		$this->load->model("gallery_model");
		$rs = $this->gallery_model->GetGallery($this->session->userdata('lang_id'));
		$data['arr_gallery'] = $rs;
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