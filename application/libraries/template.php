<?php
class Template {
	public $ci;
	public $content_data = array('valiable'=>null);
	public $title = "";
	public $active = "";
	
	public function __construct(){
		$this->ci = & get_instance();
	}
	
	public function load_template($view = ''){
		$this->ci->db->cache_on();
		$this->ci->load->model("menu_model");
		$data['str_menu'] = $this->ci->menu_model->GetMenu();
		$data['content_view'] = $view; // View name
		$data['content_data'] = $this->content_data; // Data Valiable
		$data['title'] = $this->title;
		$this->ci->load->view("template/default",$data);
	}
	
	public function load_templateAdmin($view = ''){
		$this->ci->db->cache_on();
		$this->ci->load->model("menu_model");
		$data['article_menu'] = $this->ci->menu_model->GetMenuIsArticle();
		$data['content_view'] = $view; // View name
		$data['content_data'] = $this->content_data; // Data Valiable
		$data['title'] = $this->title;
		$data['active'] = $this->active;
		$this->ci->load->view("template/default_admin",$data);
	}
	
}