<?php
class Annual_report extends CI_Controller{
	public function index($year=0){
		$this->load->library('load_language');
		//@get Site Bar
		@$this->session->set_userdata('activeTopMenu_id',5);
		$data['Top_menu'] = $this->db->where('menu_id = 5')->select('menu_name')->get('menus')->row();
		//@Get data
		$this->load->model('annual_model');
		$rs = $this->annual_model->GetAnnual($year,$this->session->userdata('lang_id'));
		$data['arr_report'] = $rs;
		$data['older_id'] = $this->annual_model->GetOlder($rs[(count($rs)-1)]['year'],$this->session->userdata('lang_id'))->row();
		$data['newer_id'] = $this->annual_model->GetNewer($rs[(0)]['year'],$this->session->userdata('lang_id'));
		
		//init Template
		$this->template->title = $this->lang->line('Fiancial Statement').' | ThaiOpricalGroup';
		$this->template->content_data = $data;
		$this->template->load_template('annual_report/Annual_report_form');
	}
}