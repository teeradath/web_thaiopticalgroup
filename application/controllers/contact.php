<?php
class Contact extends CI_Controller{
	public function index($suc=''){
		$this->load->library('load_language');
		@$this->session->set_userdata('activeTopMenu_id',6);
		
		$data['success'] ='';
		$data['err'] = '';
		$data['msg'] = '';
		if($this->input->post('send')!=null){
			//@Validation
			$this->load->library('form_validation');
			$this->form_validation->set_rules('fname', 'First Name', 'required');
			$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('message', 'Message', 'required');
			if (!$this->form_validation->run()){
					
			}else {
				$msg = $this->send_email();
				$data['success'] = $msg=='success'?'success':'';
				$data['err'] = substr($msg,0,5)=='Error'?'Error':'';
				$data['msg'] = $msg;
			}
		}
		//init Template
		$this->template->title = $this->lang->line('Contact').' | ThaiOpricalGroup';
		$this->template->content_data = $data;
		$this->template->load_template('contact_form');
	}
	public function send_email(){
		$this->load->library('phpmailer');
		$this->phpmailer->IsSMTP();  // ใช้งาน SMTP		   
		$this->phpmailer->SMTPAuth   = true;   // เปิดการการตรวจสอบการใช้งาน SMTP
		$this->phpmailer->CharSet = "utf-8";
		$this->phpmailer->Host       = "smtp.thaiopticalgroup.com";      // ตั้งค่า mail server ของเรานะครับ ตัวอย่างจะใช้ของ Gmail นะครับ
		$this->phpmailer->Port       = 25;                   //  port ที่ใช้  ถ้าเป็นของ hosting ทั่วไปส่วนใหญ่เป็น 25 นะครับ
		$this->phpmailer->Username   = "teeradath_c@thaiopticalgroup.com";  //  email address
		$this->phpmailer->Password   = "toc1teeradath";            // รหัสผ่าน Gmail
		$this->phpmailer->SetFrom($this->input->post('email'),  $this->input->post('fname').' '.$this->input->post('lname'));  //ผู้ส่ง
		$this->phpmailer->Subject    = "Email From www.thaiopticalgroup.com"; //หัวข้ออีเมล์
		$this->phpmailer->Body      =  $this->input->post('message'); //ส่วนนี้รายละเอียดสามารถส่งเป็นรูปแบบ HTML ได้
		//$this->phpmailer->AddAddress('teeradath_c@thaiopticalgroup.com', 'teeradath_c@thaiopticalgroup.com' ); //อีกเมล์ผู้รับ  สามารถเพิ่มได้มากกว่า 1
		$this->phpmailer->AddAddress('info@thaiopticalgroup.com', 'info@thaiopticalgroup.com' ); //อีกเมล์ผู้รับ  สามารถเพิ่มได้มากกว่า 1
		//$this->phpmailer->AddAddress('ir@thaiopticalgroup.com', 'ir@thaiopticalgroup.com' ); //อีกเมล์ผู้รับ  สามารถเพิ่มได้มากกว่า 1

		if(!$this->phpmailer->Send()) {
			return  "Error: " . $this->phpmailer->ErrorInfo;
		} else {
			return 'success';
		}
	}
	
}