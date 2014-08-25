<?php
class load_language{
	public function __construct(){
		$ci = & get_instance();
		//@Init Session Language
		if($ci->session->userdata('lang_id')==null)
			$ci->session->set_userdata('lang_id','th');
		$ci->lang->load($ci->session->userdata('lang_id'),$ci->session->userdata('lang_id'));
	}
}