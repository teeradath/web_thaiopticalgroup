<?php
class Login extends CI_Controller{
	public function index(){
		if($this->input->post("login") != null){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			
			if (!$this->form_validation->run()){
				$this->load->view('admin/login_form');
			}
			else{
				$this->load->model('users_model');
				$rs = $this->users_model->Check_login($this->input->post("email"),$this->input->post("password"));
				if($rs->num_rows()>0){
					$row = $rs->row();
					$sess = array("sess_email"=> $row->user_email,"sess_password"=>$row->user_pass,"sess_roles"=>$row->roles_id,"sess_fullname"=>$row->full_name);
					$this->session->set_userdata($sess);
					redirect("tog_admin");
					exit();
				}else{
					$data['error_val']='Email or Password is incorrect.';
					$this->load->view("admin/login_form",$data);
				}
			}
		}else{
			$this->load->view("admin/login_form");
		}
		
	}
}