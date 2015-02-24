<?php
class Article extends CI_Controller{
	public function index($txt,$menu_id){
		$this->load->library('load_language');
		//Get Article
		$this->load->model('article_model');
		$data['article_array'] = $this->article_model->GetArticleByID($menu_id,$this->session->userdata('lang_id'))->row();
		
		//Get top menu
		$parent_id = $this->db->where('menu_id = '.$menu_id)->select('parent_id, menu_name')->get('menus')->row();
		$activeTopMenu_id = $this->db->where('menu_id = '.$parent_id->parent_id)->select('menu_id')->get('menus')->row();
		@$this->session->set_userdata('activeTopMenu_id',$activeTopMenu_id->menu_id);
		$data['Top_menu'] = $this->db->where('menu_id = '.$activeTopMenu_id->menu_id)->select('menu_name')->get('menus')->row();
		$data['sub_menu'] = $parent_id;
		//----------------
		//init Template
		$this->template->title = @$data['article_array']->article_title.' | ThaiOpricalGroup';
		$this->template->content_data = $data;
		$this->template->load_template('article/article_detail');
	}
}