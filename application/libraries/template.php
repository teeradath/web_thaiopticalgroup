<?php
class Template {
	public $ci;
	public $content_data = array('valiable'=>null);
	public $title = "";
	public $active = "";
	
	public function __construct(){
		$this->ci = & get_instance();
		//$this->ci->load->driver('cache', array('adapter' => 'file'));
	}
	
	public function load_template($view = ''){
		$this->ci->db->cache_on();
		$this->ci->load->model("menu_model");
		/*if($this->ci->cache->get('cache_item_menu')==""){
			$strmenu = $this->ci->menu_model->GetMenu();
			$this->ci->cache->save('cache_item_menu', $strmenu ,300);
		}
		$data['str_menu'] = $this->ci->cache->get('cache_item_menu');*/
		$strmenu = $this->ci->menu_model->GetMenu();
		$data['str_menu'] = $strmenu;
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