<?php 
class Home extends CI_Controller {
	public function index()
	{
		$this->session->set_userdata('activeTopMenu_id','1');
		//Cache
		$this->load->driver('cache', array('adapter' => 'file'));
		//@Init Session Language
		$this->load->library('load_language');
		//@ friendly Url
		$this->load->library('url_friendly');
		//@Get News data
		if($this->cache->get('arr_news')==""){
			$this->load->model("news_model");
			$this->cache->save('arr_news', $this->news_model->GetNews($this->session->userdata('lang_id'))->result_array() ,300);
		}
		$data['arr_news'] = $this->cache->get('arr_news');
		//@Get Gallery data
		if($this->cache->get('arr_gallery')==""){
			$this->load->model("gallery_model");
			$this->cache->save('arr_gallery', $this->gallery_model->GetGallery($this->session->userdata('lang_id'))->result_array() ,300);
		}
		
		$data['arr_gallery'] = $this->cache->get('arr_gallery');
		//------------------------------------		
		//init Template
		$this->template->title = 'ThaiOpricalGroup';
		$this->template->content_data = $data;
		$this->template->load_template('home/home');
	}
	
	public function change_lang($lang,$uri){
		$this->session->set_userdata('lang_id',$lang);
		$this->load->driver('cache', array('adapter' => 'file'));
		$this->cache->clean();
		redirect(base_url().$uri);
		exit();
	}
}