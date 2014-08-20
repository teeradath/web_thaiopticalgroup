<?php
class Tog_admin extends CI_Controller{
	public function index(){
		//init Template
		$this->template->title = 'Administrator';
		//$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/admin_home');
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect("login");
	}
	
	public function news_list(){
		$this->load->model('news_model');
		
		// pagination --------------------------------------------
		if($this->session->userdata('perpage')==null){
			$this->session->set_userdata('perpage',15);
		}
		else {
			if($this->input->post('dd_perpage')!=null)
				$this->session->set_userdata('perpage',$this->input->post('dd_perpage'));
		}
			
		$config["base_url"] = base_url()."tog_admin/news_list";
		$config["per_page"] = $this->session->userdata('perpage');
		$config["total_rows"] = $this->news_model->GetNews()->num_rows();
		$this->setTagPagination($config);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		//--------------------------------------------------------
		$rs = $this->news_model->GetNews_list($config["per_page"],$this->uri->segment(3),'th');
		$data['news_list'] = $rs->result_array();
		//init Template
		$this->template->title = 'Administrator | News';
		$this->template->active = 'News';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/news_list_form');
	}
	
	public function setTagPagination(&$config){
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
	}
}