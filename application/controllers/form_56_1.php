<?php
class Form_56_1 extends CI_Controller{
	public function index(){
		$this->load->library('load_language');
		//@get Site Bar
		@$this->session->set_userdata('activeTopMenu_id',5);
		$data['Top_menu'] = $this->db->where('menu_id = 5')->select('menu_name')->get('menus')->row();
		
		//@ if Search
		if($this->input->post('search')!=null && $this->input->post('keyword')!=''){
			$key = $this->input->post('keyword');
			if(@$this->session->userdata('lang_id')!='th')
				$key = $key+543;
			$this->load->model('Form_56_1_model');
			$data['form56_arr'] = $this->Form_56_1_model->GetForm56_search($key,$this->session->userdata('lang_id'));
			$data['keyword'] = $this->input->post('keyword');
		}else{
			// pagination --------------------------------------------
			$this->setConfigPagination($config);
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			//--------------------------------------------------------
			//@ Set Data 
			$this->load->model('Form_56_1_model');
			$data['form56_arr'] = $this->Form_56_1_model->GetForm56($config["per_page"],$this->uri->segment(2),$this->session->userdata('lang_id'));
		}
		//init Template
		$this->template->title = $this->lang->line('Form 56-1').' | ThaiOpricalGroup';
		$this->template->content_data = $data;
		$this->template->load_template('form_56-1/form_56-1_form');
	}
	
	// Config Pagination Class Bootstrap----------------------------------------------------
	public function setConfigPagination(&$config){
	
		$config["base_url"] = base_url("Form_56-1.html/");
		$config["uri_segment"] = 2;
		$config["per_page"] = 20;
		$total_row = $this->db->join("language", "form_56_1.lang_id = language.lang_id")->where("language.language = '".$this->session->userdata('lang_id')."'")->get("form_56_1")->num_rows();
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