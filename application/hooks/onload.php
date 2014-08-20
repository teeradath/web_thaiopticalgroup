<?php
class Onload{
	private $CI;
	public  function __construct(){
		$this->CI = & get_instance();
	}
	public function check_login(){
		$controller = $this->CI->router->class;
		$method = $this->CI->router->method;
		
		if($this->CI->session->userdata("sess_email")==null){
			if($controller == "tog_admin"){
				redirect("login","refresh");
				exit();
			}
		}else{
			if($controller == "login"){
				redirect("tog_admin","refresh");
				exit();
			}
		}
		
	}
}