<?php
class News extends CI_Controller{
	public function index(){
		$this->load->library('load_language');
		//@ friendly Url
		$this->load->library('url_friendly');
		//@ if Search
		if($this->input->post('search')!=null && $this->input->post('keyword')!=''){
			$this->load->model('news_model');
			$data['arr_new'] = $this->news_model->GetNewsSearch($this->input->post('keyword'),$this->session->userdata('lang_id'))->result_array();
			$data['keyword']=  $this->input->post('keyword');
		}else{
			// pagination --------------------------------------------
			$this->setConfigPagination($config);
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			//--------------------------------------------------------
			//Get News List
			$this->load->model('news_model');
			$data['arr_new'] = $this->news_model->GetNews_list($config["per_page"],$this->uri->segment(3),$this->session->userdata('lang_id'))->result_array();
		}
		//init Template
		$this->template->title = $this->lang->line('News Update').' | ThaiOpricalGroup';
		$this->template->content_data = $data;
		$this->template->load_template('news/news_all');
	}
	
	public function text_news($news_title,$news_id){
		$this->load->library('load_language');
		//@ friendly Url
		$this->load->library('url_friendly');
		//Get News 
		$this->load->model('news_model');
		$row = $this->news_model->GetNewsByID($news_id,$this->session->userdata('lang_id'))->row();
		$data['row_news'] = $row;
		$data['older_id'] = $this->news_model->GetNewsOlder($row->news_date,$this->session->userdata('lang_id'))->row();
		$data['newer_id'] = $this->news_model->GetNewsNewer($row->news_date,$this->session->userdata('lang_id'))->row();
		//@insert News View
		$view = $this->db->where('news_id = '.$news_id)->select('news_view')->get('news')->row();
		$this->db->update('news',array('news_view'=> $view->news_view+1),'news_id = '.$news_id);
		//init Template

		$this->template->title = $news_title.' | ThaiOpricalGroup';
		$this->template->content_data = $data;
		$this->template->load_template('news/news_detail');
		
	}
	
	// Config Pagination Class Bootstrap----------------------------------------------------
	public function setConfigPagination(&$config){
	
		$config["base_url"] = base_url()."News/index";
		$config["per_page"] = 20;
		$total_row = $this->db->join("news_language", "news_language.news_id = news.news_id")->join("language", "news_language.lang_id = language.lang_id")->where("language.language = '".$this->session->userdata('lang_id')."'")->get("news")->num_rows();
		$config["total_rows"] = $total_row;
		
		$config['full_tag_open'] = '<ul class="pagination" style="margin: 0">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
	
	}
	//------------------------------------------------------------------
}