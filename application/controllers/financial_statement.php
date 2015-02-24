<?php
class Financial_statement extends CI_Controller{
	public function index(){
		$this->load->library('load_language');
		@$this->session->set_userdata('activeTopMenu_id',5);
		$data['Top_menu'] = $this->db->where('menu_id = 5')->select('menu_name')->get('menus')->row();
		
		//@get Data
		$this->load->model('financial_model');
		$data['arr_fin'] = $this->financial_model->GetFinancial_front($this->session->userdata('lang_id'));
		$data['arr_fin_archive'] = $this->financial_model->GetFinancial_front_archive($data['arr_fin'][(count($data['arr_fin'])-1)]['year'],$this->session->userdata('lang_id'));
		
		//init Template
		$this->template->title = $this->lang->line('Fiancial Statement').' | ThaiOpricalGroup';
		$this->template->content_data = $data;
		$this->template->load_template('financial_statement/financial_statement_form');
	}
}