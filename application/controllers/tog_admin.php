<?php
class Tog_admin extends CI_Controller{
	public function index(){
		//init Template
		$this->template->title = 'Administrator';
		$this->template->load_templateAdmin('admin/admin_home');
	}
	
	public function logout(){
		//$this->session->sess_destroy();
		$array_items = array("sess_email"=> '',"sess_password"=>'',"sess_roles"=>'',"sess_fullname"=>'');
		$this->session->unset_userdata($array_items);
		redirect("login");
		exit();
	}
	
	//@ User Profile -------------------------------------------
	public function user_profile(){
		$this->load->model('users_model');		
		$data['user_row'] = $this->users_model->GetUesr($this->session->userdata('sess_email'))->row();
		//init Template
		$this->template->title = 'Administrator | Profile';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/user_profile');
	}
	
	//@ Settings -------------------------------------------
	public function settings(){
		if ($this->input->post('save')!=null){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txt_fullname', 'Fullname', 'required');
			$this->form_validation->set_rules('txt_oldpass', 'Old Password', 'callback_check_oldpass');
			$this->form_validation->set_rules('txt_newpass', 'New Password', 'callback_check_required');
			$this->form_validation->set_rules('txt_email', 'Email', 'required|valid_email|callback_check_dup');
				
			if ($this->form_validation->run()){
				$arr = array(
					'user_email'=>$this->input->post('txt_email'),
					'user_pass'=>$this->input->post('txt_newpass')!=""?$this->input->post('txt_newpass'):$this->session->userdata('sess_password'),
					'full_name'=>$this->input->post('txt_fullname'),
					'roles_id'=>$this->input->post('dd_roles')
				);
				$this->db->where("users.user_email = '".$this->session->userdata("sess_email")."'")->update("users",$arr);
				$this->logout();
				exit();
			}
		}
		$this->load->model('users_model');
		$data['user_row'] = $this->users_model->GetUesr($this->session->userdata('sess_email'))->row();
		$data['dd_roles'] = $this->users_model->GetComboRoles();
		//init Template
		$this->template->title = 'Administrator | Settings';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/setting_form');
	}
	
	public function check_oldpass()
	{
		if(trim($this->input->post('txt_oldpass'))!=""){
			$dup = $this->db->where("users.user_pass = '".$this->input->post('txt_oldpass')."'")->get('users')->num_rows();
			if ($dup == 0)
			{
				$this->form_validation->set_message('check_oldpass', 'The %s field is not match');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}else {
			return TRUE;
		}
	}
	
	public function check_required(){
		if(trim($this->input->post('txt_newpass'))!=""){
			if(trim($this->input->post('txt_oldpass'))==""){
				$this->form_validation->set_message('check_required', 'The Old Password field is required');
				return FALSE;
			}else{
				return true;
			}
			
		}else {
			if(trim($this->input->post('txt_oldpass'))!=""){
				$this->form_validation->set_message('check_required', 'The %s field is required');
				return false;
			}
			
		}
	}
	
	public function check_dup(){
		$dup = $this->db->where_not_in("users.user_email",array($this->session->userdata("sess_email")))->where("users.user_email = '".$this->input->post('txt_email')."'")->get('users')->num_rows();
		if ($dup > 0)
		{
			$this->form_validation->set_message('check_dup', 'The %s field is duplicate');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	//------------------------------------------------------------------------------------------------------
	
	//@ Manage Users --------------------------------------------------------------------------------------------------
	public function users($success=""){
		if($this->input->post('search')!=null && $this->input->post('keyword')!=''){
			$this->load->model('users_model');
			$data['users_list'] = $this->users_model->GetUesrSearch($this->input->post('keyword'),'th');
			$data['RecordsPerPage']='none';
		}else {
			// pagination --------------------------------------------
			$total_row = $this->db->join("roles", "roles.roles_id = users.roles_id")->get('users')->num_rows();
			$config["base_url"] = base_url()."tog_admin/users";
			$this->setConfigPagination($config,$total_row);
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			//--------------------------------------------------------
			$this->load->model('users_model');
			$data['users_list'] = $this->users_model->GetUesrList($config["per_page"],$this->uri->segment(3));
			$data['RecordsPerPage']='block';
		}
		$data['success'] = $success=='success'?'block':'none';
		//init Template
		$this->template->title = 'Administrator | Users';
		$this->template->active = 'Users';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/users/users_list');
	}
	
	public function user_add(){
		if($this->input->post('save')!=null){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txt_fullname', 'Fullname', 'required|');
			$this->form_validation->set_rules('txt_email', 'Email', 'required|valid_email|callback_check_email');
			$this->form_validation->set_rules('txt_pass', 'Password', 'required');
			$this->form_validation->set_rules('dd_roles', 'Year', 'required');
			if ($this->form_validation->run()){
				$data_arr = array(
					'user_email'=>$this->input->post('txt_email'),
					'user_pass'=>$this->input->post('txt_pass'),
					'full_name'=>$this->input->post('txt_fullname'),
					'roles_id'=>$this->input->post('dd_roles')
				);
				$this->db->insert('users',$data_arr);
				redirect("tog_admin/users/success");
				exit();
			}
		}
		$this->load->model('users_model');
		$data['dd_roles'] = $this->users_model->GetComboRoles_add();
		//init Template
		$this->template->title = 'Administrator | Create Users';
		$this->template->active = 'Users';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/users/user_add');
	}
	
	public function user_edit($id){
		$this->load->model('users_model');
		if($this->input->post('save')!=null){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txt_fullname', 'Fullname', 'required|');
			$this->form_validation->set_rules('txt_email', 'Email', 'required|valid_email|callback_check_dup2');
			$this->form_validation->set_rules('dd_roles', 'Year', 'required');
			if ($this->form_validation->run()){
				$arr = array(
						'user_email'=>$this->input->post('txt_email'),
						'user_pass'=>$this->input->post('txt_pass')!=""?$this->input->post('txt_pass'):$this->session->userdata('sess_password'),
						'full_name'=>$this->input->post('txt_fullname'),
						'roles_id'=>$this->input->post('dd_roles')
				);
				$this->db->where("users.user_id = '".$id."'")->update("users",$arr);
				redirect("tog_admin/users/success");
				exit();
			}
		}
		
		$data['user_row'] = $this->users_model->GetUesrList_byID($id);
		$data['dd_roles'] = $this->users_model->GetComboRoles_add();
		
		//init Template
		$this->template->title = 'Administrator | Edit User';
		$this->template->active = 'Users';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/users/user_edit');
	}
	
	public function user_delete($id=0){
		if($id != 0){
			$this->db->delete('users','user_id = '.$id);
			redirect("tog_admin/users");
			exit();
		}else{
			redirect("tog_admin/users");
			exit();
		}
	}
	
	public function check_email(){
		$dup = $this->db->where("users.user_email = '".$this->input->post('txt_email')."'")->get('users')->num_rows();
		if ($dup > 0)
		{
			$this->form_validation->set_message('check_email', 'The %s field is duplicate');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	} 
	
	public function check_dup2(){
		$dup = $this->db->where_not_in("users.user_email",array($this->input->post("old_email")))->where("users.user_email = '".$this->input->post('txt_email')."'")->get('users')->num_rows();
		if ($dup > 0)
		{
			$this->form_validation->set_message('check_dup2', 'The %s field is duplicate');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	//------------------------------------------------------------------------------------------------------------------
	
	//@ Manage Menus --------------------------------------------------------------------------------------------------
	public function menus(){
		$this->load->model('menu_model');
		$this->menu_model->getMenu_admin();
		$data["menus"] = $this->menu_model->menus_manage;
		$data["menus_hid"] = $this->menu_model->menus_hid;
		//init Template
		$this->template->title = 'Administrator | Users';
		$this->template->active = 'Menus';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/menus/menu_tree');
	} 
	//------------------------------------------------------------------------------------------------------------------
	
	//@ Manage Article ---------------------------------------------------------------------------------------------------------
	public function article($id){
		//Get Article
		$this->load->model('article_model');
	
		$data['success'] = 'none';
		$num = $this->db->where('menu_id = '.$id)->get('article')->num_rows();
		//Submit Form
		if($this->input->post('save')!=null){
			if($num>0){
				$this->UpdateArticle($this->input->post(),$id);
			}else{
				$this->InsertArticle($this->input->post(),$id);
				$num = $this->db->where('menu_id = '.$id)->get('article')->num_rows();
			}
			$data['success'] = 'block';
		}
		if($num>0){
			$rs = $this->article_model->GetArticleByID($id,'');
		}else{
			$this->load->model('language_model');
			$rs = $this->language_model->GetLangusge();
		}
	
		$data['article_array'] = $rs->result_array();
			
	
		//init Template
		$this->template->title = 'Administrator | Article';
		$this->template->active = 'Article';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/article/article_detail');
	}
	//--------------------------------------------------------------------------------------------------------------------------
	
	//@ Manage News ---------------------------------------------------------------------------------------------------------
	public function news_list($status = ""){
		$this->load->model('news_model');
		if($this->input->post('search')!=null && $this->input->post('keyword')!=''){
			$data['news_list'] = $this->news_model->GetNewsSearch($this->input->post('keyword'),'th')->result_array();
			$data['RecordsPerPage']='none';
		}else{
			// pagination --------------------------------------------
			$total_row = $this->db->join("news_language", "news_language.news_id = news.news_id")->join("language", "news_language.lang_id = language.lang_id")->
						where("language.language = 'th'")->get("news")->num_rows();
			$config["base_url"] = base_url()."tog_admin/news_list";
			$this->setConfigPagination($config,$total_row);
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			//--------------------------------------------------------
			$data['news_list'] = $this->news_model->GetNews_list($config["per_page"],$this->uri->segment(3),'th')->result_array();
			$data['RecordsPerPage']='block';
		}
		$data['success'] = $status=='success'?'block':'none';
		//init Template
		$this->template->title = 'Administrator | News List';
		$this->template->active = 'News';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/news/news_list_form');
	}
	
	public function news_add(){
		$this->lang->load('th','th');
		$this->load->model('language_model');
		$rs = $this->language_model->GetLangusge();
		$data['arr_lang'] = $rs->result_array();
		//Submit Form
		if($this->input->post('save')!=null){
			$this->InsertNews($this->input->post(),$rs);
			redirect("tog_admin/news_list/success");
			exit();
		}		
		//init Template
		$this->template->title = 'Administrator | Create News';
		$this->template->active = 'News';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/news/news_create_form');
	}
	
	public function news_edit($news_id=0){
		$this->load->model('news_model');
		$data['success'] = 'none';
		//Submit Form
		if($this->input->post('save')!=null){
			$this->UpdateNews($this->input->post(),$news_id);
			$data['success'] = 'block';
		}
		//Get News
		$data['arr_news'] = $this->news_model->GetNewsByID($news_id,'')->result_array();
		//init Template
		$this->template->title = 'Administrator | Edit News';
		$this->template->active = 'News';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/news/news_edit_form');
	}
	
	public function news_delete($news_id=0){
		if($news_id != 0){
			$this->db->delete('news','news_id = '.$news_id);
			$this->db->delete('news_language','news_id = '.$news_id);
			redirect("tog_admin/news_list");
			exit();
		}else{
			redirect("tog_admin/news_list");
			exit();
		}
	}
	//--------------------------------------------------------------------------------------------------------------------------
	
	//@ Manage Gallery ---------------------------------------------------------------------------------------------------------
	public function gallery_list($status = ""){
		$this->load->model('gallery_model');
		if($this->input->post('search')!=null && $this->input->post('keyword')!=''){
			$data['gallery_list'] = $this->gallery_model->GetGallerySearch($this->input->post('keyword'),'th')->result_array();
			$data['RecordsPerPage']='none';
		}else{
			// pagination --------------------------------------------
			$total_row = $this->db->join('gallery_language', 'gallery_language.gal_id = gallery.gal_id')->
						join('language', 'language.lang_id = gallery_language.lang_id')->order_by('gallery.gal_date desc')->where("language.language = 'th'")->get('gallery')->num_rows();
			$config["base_url"] = base_url()."tog_admin/gallery_list";
			$this->setConfigPagination($config,$total_row);
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			//--------------------------------------------------------
			$data['gallery_list'] = $this->gallery_model->GetGallery_list($config["per_page"],$this->uri->segment(3),'th')->result_array();
			$data['RecordsPerPage']='block';
		}
		$data['success'] = $status=='success'?'block':'none';
		//init Template
		$this->template->title = 'Administrator | Gallery List';
		$this->template->active = 'Gallery';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/gallery/gallery_list_form');
	}
	
	public function gallery_add(){
		$this->lang->load('th','th');
		$this->load->model('language_model');
		$rs = $this->language_model->GetLangusge();
		$data['arr_lang'] = $rs->result_array();
		//Submit Form
		if($this->input->post('save')!=null){
			$result = $this->InsertGallery($this->input->post(),$rs);
			if($result!=null){
				//echo $result;
				$data['image_error'] = $result;
				$data['status'] = 'error';
				$data['msg_err'] = strip_tags($result);
			}else {
				//redirect("tog_admin/gallery_add_images/id");
				redirect("tog_admin/gallery_list/success");
			exit();
			}
		}
		//init Template
		$this->template->title = 'Administrator | Create Gallery';
		$this->template->active = 'Gallery';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/gallery/gallery_create_form');
	}
	
	public function gallery_edit($gal_id){
		$this->load->model('gallery_model');
		$rss = $this->gallery_model->GetGalleryByID($gal_id,'')->result_array();
		//Submit Form
		if($this->input->post('save')!=null){
			$result = $this->UpdateGallery($this->input->post(),$gal_id,$rss[0]['gal_image_url']);
			if($result!=null){
				$data['image_error'] = $result;
				$data['status'] = 'error';
				$data['msg_err'] = strip_tags($result);
			}else {
				$data['status'] = 'success';
			}
		}
		//Get Gallery
		$data['arr_gallery'] = $this->gallery_model->GetGalleryByID($gal_id,'')->result_array();
		//init Template
		$this->template->title = 'Administrator | Edit Gallery';
		$this->template->active = 'Gallery';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/gallery/gallery_edit_form');
	}
	
	public function gallery_add_images($gal_id){
		$this->load->model('gallery_model');
		$data['arr_gallery'] = $this->gallery_model->GetGalleryByID($gal_id,'')->result_array();
		$data['arr_gallery_img'] = $this->gallery_model->GetGalleryImageID($gal_id)->result_array();
		//init Template
		$this->template->title = 'Administrator | Images Gallery';
		$this->template->active = 'Gallery';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/gallery/gallery_images_form');
	}

	public function gallery_delete($gal_id=0){
		if($gal_id != 0){
			$this->db->delete('gallery','gal_id = '.$gal_id);
			$this->db->delete('gallery_language','gal_id = '.$gal_id);
			$this->db->delete('gallery_images','gal_id = '.$gal_id);
			redirect("tog_admin/gallery_list");
			exit();
		}else{
			redirect("tog_admin/gallery_list");
			exit();
		}
	}
	//--------------------------------------------------------------------------------------------------------------------------
	
	//@ Manage Financial Statement----------------------------------------------------------------------------------------------
	public function financial_list($success=''){
		if($this->input->post('search')!=null && $this->input->post('keyword')!=''){
			$this->load->model('financial_model');
			$data['financial_list'] = $this->financial_model->GetFinancial_Search($this->input->post('keyword'));
			$data['RecordsPerPage']='none';
		}else {
			// pagination --------------------------------------------
			$total_row = $this->db->get('financial')->num_rows();
			$config["base_url"] = base_url()."tog_admin/financial_list";
			$this->setConfigPagination($config,$total_row);
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			//--------------------------------------------------------
			$this->load->model('financial_model');
			$data['financial_list'] = $this->financial_model->GetFinancial_admin($config["per_page"],$this->uri->segment(3));
			$data['RecordsPerPage']='block';
		}
		$data['success'] = $success=='success'?'block':'none';
		//init Template
		$this->template->title = 'Administrator | Financial';
		$this->template->active = 'Financial';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/financial_statement/financial_list');
	}
	
	public function financial_add(){
		if($this->input->post('save')!=null){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('year', 'Year', 'required|numeric|callback_duplicate_check');
			if ($this->form_validation->run()){
					$this->db->insert('financial',array('year'=>$this->input->post('year')));
					redirect("tog_admin/financial_list/success");
					exit();
			}
		}
		//init Template
		$this->template->title = 'Administrator | Create Financial';
		$this->template->active = 'Financial';
		//$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/financial_statement/financial_add');
	}
	
	public function financial_edit($id){
		if($this->input->post('save')!=null){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('year', 'Year', 'required|numeric|callback_duplicate_check');
			if ($this->form_validation->run()){
				$this->db->where('financial_id ='.$id);
				$this->db->update('financial', array('year'=>$this->input->post('year')));
				redirect("tog_admin/financial_list/success");
				exit();
			}
		}
		$data['is_year'] = $this->db->where('financial_id = '.$id)->get('financial')->row();
		//init Template
		$this->template->title = 'Administrator | Edit Financial';
		$this->template->active = 'Financial';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/financial_statement/financial_edit');
	}
	
	public function financial_upload($id){
		
		$this->load->model('language_model');
		$rs = $this->language_model->GetLangusge();
		$data['arr_lang'] = $rs->result_array();
		
		//@Submit Form
		if($this->input->post('save')!=null){
			$this->load->library('form_validation');
			foreach ($rs->result_array() as $r_lang){
				$this->form_validation->set_rules('txtTitle_'.$r_lang['language'], 'Title '.$r_lang['language_text'], 'required');
			}
			if ($this->form_validation->run()){
				$this->load->library("upload");
				foreach ($rs->result_array() as $lang){
					$config['upload_path'] = 'upload/files/Fiancial_Statement_'.$lang['language'].'/';
					$config['allowed_types'] = 'zip|rar|pdf|xls|doc';
					//$config['max_size'] = 1024; //kb
					$config['file_name'] = 'financial_'.$lang['language'].'_'.date('YmdHis');
					$this->upload->initialize($config);
					if($this->upload->do_upload("file_".$lang['language'])){
						$rs_upload = $this->upload->data();
						$up = array(
							'financial_id' => $id,
							'lang_id' => $lang['lang_id'],
							'text' => $this->input->post('txtTitle_'.$lang['language']),
							'url_file' => $config['upload_path'].$rs_upload['orig_name']
						);
						$this->db->insert('financial_upload',$up);
					}else{
						$data['upload_err'] = $this->upload->display_errors();
						//exit();
					}
				}
				if(@$data['upload_err']==''){
					$data['upload_err'] = 'success';
					unset($this->input->post);
					//redirect("tog_admin/financial_upload/".$id);
					//exit();
				}
			}
		}
		
		$this->load->model('financial_model');
		$data['arr_file'] = $this->financial_model->GetFinancial_upload($id);
		$data['year'] = $this->db->where('financial_id = '.$id)->get('financial')->row();
		//init Template
		$this->template->title = 'Administrator | Uploads Financial';
		$this->template->active = 'Financial';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/financial_statement/financial_upload');
	}
	
	public function financial_delete($id=0){
		if($id != 0){
			$this->db->delete('financial','financial_id = '.$id);
			$this->db->delete('financial_upload','financial_id = '.$id);
			redirect("tog_admin/financial_list");
			exit();
		}else{
			redirect("tog_admin/financial_list");
			exit();
		}
	}
	
	public function financial_delete_2($id=0,$id2=0){
		if($id != 0){
			$row = $this->db->where('upload_id = '.$id)->get('financial_upload')->row();
			@unlink($row->url_file);
			$this->db->delete('financial_upload','upload_id = '.$id);
			redirect("tog_admin/financial_upload/".$id2);
			exit();
		}else{
			redirect("tog_admin/financial_list");
			exit();
		}
	}
	
	public function duplicate_check($str)
	{
		$dup = $this->db->where('year = '.$this->input->post('year'))->get('financial')->num_rows();
		if ($dup > 0)
		{
			$this->form_validation->set_message('duplicate_check', 'The %s field is duplicate');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	//--------------------------------------------------------------------------------------------------------------------------

	//@ Manage Annual Report
	public function annual_list($success=''){
		if($this->input->post('search')!=null && $this->input->post('keyword')!=''){
			$this->load->model('annual_model');
			$data['annual_list'] = $this->annual_model->GetAnnual_list_Search($this->input->post('keyword'));
			$data['RecordsPerPage']='none';
		}else {
			// pagination --------------------------------------------
			$total_row = $this->db->where("annual_report.lang_id = 1")->get('annual_report')->num_rows();
			$config["base_url"] = base_url()."tog_admin/annual_list";
			$this->setConfigPagination($config,$total_row);
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			//--------------------------------------------------------
			$this->load->model('annual_model');
			$data['annual_list'] = $this->annual_model->GetAnnual_list($config["per_page"],$this->uri->segment(3),'th');
			$data['RecordsPerPage']='block';
		}
		$data['success'] = $success=='success'?'block':'none';
		//init Template
		$this->template->title = 'Administrator | Annual Report';
		$this->template->active = 'Annual';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/annual_report/annual_list');
	}
	
	public function  annual_add(){
		$this->load->model('language_model');
		$rs = $this->language_model->GetLangusge();
		$data['arr_lang'] = $rs->result_array();
		if($this->input->post('save')!=null){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('num_year', 'Year', 'required|numeric|callback_duplicate_check_annual');
			if ($this->form_validation->run()){
				$re = $this->InsertAnnualReport($this->input->post(),$rs);
				if($re=='success'){
					redirect("tog_admin/annual_list/success");
					exit();
				}else{
					$data["add_error"] = $re;
				}
			}
		}
		//init Template
		$this->template->title = 'Administrator | Create Annual Report';
		$this->template->active = 'Annual';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/annual_report/annual_add');
	}
	
	public function  annual_edit($id=0){
		
		$this->load->model('annual_model');
		if($this->input->post('save')!=null){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('num_year', 'Year', 'required|numeric');
			if ($this->form_validation->run()){
				$re = $this->UpdateAnnualReport($this->input->post(),$id);
				if($re=='success'){
					redirect("tog_admin/annual_list/success");
					exit();
				}else{
					$data["add_error"] = $re;
				}
			}
		}
		
		$data['annual_arr'] = $this->annual_model->GetAnnual_ByID($id);
		
		//init Template
		$this->template->title = 'Administrator | Edit Annual Report';
		$this->template->active = 'Annual';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/annual_report/annual_edit');
	}
	
	public function  annual_delete($id=0){
		if($id != 0){
			$rs = $this->db->where("id = ".$id)->select("url_image, url_file")->get("annual_report")->result_array();
			foreach ($rs as $row){
				@unlink($row['url_image']);
				@unlink($row['url_file']);
			}
			$this->db->delete('annual_report','id = '.$id);
			redirect("tog_admin/annual_list");
			exit();
		}else{
			redirect("tog_admin/annual_list");
			exit();
		}
	}
	
	public function duplicate_check_annual()
	{
		$dup = $this->db->where('annual_report.year = '.$this->input->post('num_year'))->get('annual_report')->num_rows();
		if ($dup > 0)
		{
			$this->form_validation->set_message('duplicate_check_annual', 'The %s field is duplicate');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	//--------------------------------------------------------------------------------------------------------------------------
	
	//@ Manage Form 56-1
	public function form_56_1_list($success=''){
		if($this->input->post('search')!=null && $this->input->post('keyword')!=''){
			$this->load->model('form_56_1_model');
			$data['form56_list'] = $this->form_56_1_model->GetForm56_search($this->input->post('keyword'),'th');
			$data['RecordsPerPage']='none';
		}else {
			// pagination --------------------------------------------
			$total_row = $this->db->where("form_56_1.lang_id = 1")->get("form_56_1")->num_rows();
			$config["base_url"] = base_url()."tog_admin/form_56_1_list";
			$this->setConfigPagination($config,$total_row);
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			//--------------------------------------------------------
			$this->load->model('form_56_1_model');
			$data['form56_list'] = $this->form_56_1_model->GetForm56($config["per_page"],$this->uri->segment(3),'th');
			$data['RecordsPerPage']='block';
		}
		$data['success'] = $success=='success'?'block':'none';
		//init Template
		$this->template->title = 'Administrator | Form 56-1';
		$this->template->active = 'Form 56-1';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/form_56-1/form_56_list');
	}
	
	public function form_56_1_add(){
		$this->load->model('language_model');
		$rs = $this->language_model->GetLangusge();
		$data['arr_lang'] = $rs->result_array();
		if($this->input->post('save')!=null){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('num_year', 'Year', 'required|numeric|callback_duplicate_check_form56');
			if ($this->form_validation->run()){
				$re = $this->InsertForm56($this->input->post(),$rs);
				if($re=='success'){
					redirect("tog_admin/form_56_1_list/success");
					exit();
				}else{
					$data["add_error"] = $re;
				}
			}
		}
		//init Template
		$this->template->title = 'Administrator | Create Form 56-1';
		$this->template->active = 'Form 56-1';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/form_56-1/form_56_1_add');
	}
	
	public function form_56_1_edit($id=0){
		$this->load->model('form_56_1_model');
		if($this->input->post('save')!=null){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('num_year', 'Year', 'required|numeric');
			if ($this->form_validation->run()){
				$re = $this->UpdateForm56($this->input->post(),$id);
				if($re=='success'){
					redirect("tog_admin/form_56_1_list/success");
					exit();
				}else{
					$data["add_error"] = $re;
				}
			}
		}
		
		$data['form56_arr'] = $this->form_56_1_model->GetForm56_ByID($id);
		
		//init Template
		$this->template->title = 'Administrator | Edit Form 56-1';
		$this->template->active = 'Form 56-1';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/form_56-1/form_56_1_edit');
	}
	
	public function form_56_1_delete($id=0){
		if($id != 0){
			$rs = $this->db->where("form_id = ".$id)->select("url_file")->get("form_56_1")->result_array();
			foreach ($rs as $row){
				@unlink($row['url_file']);
			}
			$this->db->delete('form_56_1','form_id = '.$id);
			redirect("tog_admin/form_56_1_list");
			exit();
		}else{
			redirect("tog_admin/form_56_1_list");
			exit();
		}
	}
	
	public function duplicate_check_form56()
	{
		$dup = $this->db->where('form_56_1.form_year = '.$this->input->post('num_year'))->get('form_56_1')->num_rows();
		if ($dup > 0)
		{
			$this->form_validation->set_message('duplicate_check_form56', 'The %s field is duplicate');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	//--------------------------------------------------------------------------------------------------------------------------
	
	//@ Manage Annual General Meeting
	public function meeting_list($success=''){
		if($this->input->post('search')!=null && $this->input->post('keyword')!=''){
			$this->load->model('meeting_model');
			$data['meeting_list'] = $this->meeting_model->GetMeeting_search($this->input->post('keyword'),'th');
			$data['RecordsPerPage']='none';
		}else {
			// pagination --------------------------------------------
			$total_row = $this->db->where("meeting.lang_id = 1")->get("meeting")->num_rows();
			$config["base_url"] = base_url()."tog_admin/meeting_list";
			$this->setConfigPagination($config,$total_row);
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			//--------------------------------------------------------
			$this->load->model('meeting_model');
			$data['meeting_list'] = $this->meeting_model->GetMeeting($config["per_page"],$this->uri->segment(3),'th');
			$data['RecordsPerPage']='block';
		}
		$data['success'] = $success=='success'?'block':'none';
		//init Template
		$this->template->title = 'Administrator | Meeting';
		$this->template->active = 'Meeting';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/meeting/meeting_list');
		
	}
	
	public function meeting_add(){
		$this->load->model('language_model');
		$rs = $this->language_model->GetLangusge();
		$data['arr_lang'] = $rs->result_array();
		if($this->input->post('save')!=null){
			$re = $this->InsertMeeting($this->input->post(),$rs);
			if($re=='success'){
				redirect("tog_admin/meeting_list/success");
				exit();
			}else{
				$data["add_error"] = $re;
			}
			
		}
		//init Template
		$this->template->title = 'Administrator | Create Meeting';
		$this->template->active = 'Meeting';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/meeting/meeting_add');
	}
	
	public function meeting_edit($id=0){
		$this->load->model('meeting_model');
		if($this->input->post('save')!=null){
			$re = $this->UpdateMeeting($this->input->post(),$id);
			if($re=='success'){
				redirect("tog_admin/meeting_list/success");
				exit();
			}else{
				$data["add_error"] = $re;
			}
			
		}
		
		$data['meeting_arr'] = $this->meeting_model->GetMeeting_ByID($id);
		
		//init Template
		$this->template->title = 'Administrator | Edit Meeting';
		$this->template->active = 'Meeting';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/meeting/meeting_edit');
	}
	
	public function meeting_delete($id=0){
		if($id != 0){
			$rs = $this->db->where("meeting_id = ".$id)->select("url_file")->get("meeting")->result_array();
			foreach ($rs as $row){
				@unlink($row['url_file']);
			}
			$this->db->delete('meeting','meeting_id = '.$id);
			redirect("tog_admin/meeting_list");
			exit();
		}else{
			redirect("tog_admin/meeting_list");
			exit();
		}
	}
	//--------------------------------------------------------------------------------------------------------------------------
	
	//@funtion ------------------------------------------------------------
	//Insert Meeting
	public function InsertMeeting($post,$rs_lang){
		date_default_timezone_set('Asia/Bangkok');
		$this->load->library("upload");
		$rr = $this->db->select_max('meeting_id','max_id')->get('meeting')->row();
		$id = $rr->max_id + 1;
		foreach ($rs_lang->result_array() as $row){
			$config['upload_path'] = 'upload/files/Annual_General_Meeting_'.$row['language'].'/';
			$config['allowed_types'] = 'zip|rar|pdf';
			$config['file_name'] = 'Meeting_'.$row['language'].'_'.date('YmdHis');
			$this->upload->initialize($config);
	
			if($this->upload->do_upload("file_".$row['language'])){
				$rs_upload = $this->upload->data();
				$__file = $config['upload_path'].$rs_upload['orig_name'];
	
			}else{
				return  strip_tags($this->upload->display_errors());
				exit();
			}
				
			$datas[] = array(
					'meeting_id'=>$id,
					'lang_id'=>$row['lang_id'],
					'meeting_title'=>$post['title_'.$row['language']],
					'url_file'=>$__file
			);
			
		}
		
		foreach ($datas as $data){
			$set = array(
					'meeting_id'=>$data['meeting_id'],
					'lang_id'=>$data['lang_id'],
					'meeting_title'=>$data['meeting_title'],
					'url_file'=>$data['url_file'],
					'meeting_date' => date('Y-m-d H:i:s'),
			);
			$this->db->insert('meeting',$set);
			$set = array();
		}
		return 'success';
	}
	
	public function UpdateMeeting($post,$id){
		$this->load->model('meeting_model');
		$rs = $this->meeting_model->GetMeeting_ByID($id);
		$this->load->library("upload");
		
		foreach ($rs as $row){
			$__file = $row['url_file'];
			$config['upload_path'] = 'upload/files/Annual_General_Meeting_'.$row['language'].'/';
			$config['allowed_types'] = 'zip|rar|pdf';
			$config['file_name'] = 'Meeting_'.$row['language'].'_'.date('YmdHis');
			$this->upload->initialize($config);
		
			if(@$_FILES["file_".$row['language']]['name']!=''){
				if($this->upload->do_upload("file_".$row['language'])){
					@unlink($row['url_file']);
					$rs2_upload = $this->upload->data();
					$__file = $config['upload_path'].$rs2_upload['orig_name'];
		
				}else{
					return  strip_tags($this->upload->display_errors());
					exit();
				}
			}
		
			$data = array(
					'meeting_title'=>$post['title_'.$row['language']],
					'url_file'=>$__file
			);
			$this->db->where("meeting_id = ".$id." and lang_id = ".$row['lang_id'])->update('meeting',$data);
		}
		return 'success';
	}
	//Insert  Form 56-1
	public function InsertForm56($post,$rs_lang){
		$this->load->library("upload");
		$rr = $this->db->select_max('form_id','max_id')->get('form_56_1')->row();
		$id = $rr->max_id + 1;
		foreach ($rs_lang->result_array() as $row){
			$config['upload_path'] = 'upload/files/Form_56-1_'.$row['language'].'/';
			$config['allowed_types'] = 'zip|rar|pdf';
			$config['file_name'] = 'form_56-1_'.$row['language'].'_'.date('YmdHis');
			$this->upload->initialize($config);
		
			if($this->upload->do_upload("file_".$row['language'])){
				$rs_upload = $this->upload->data();
				$__file = $config['upload_path'].$rs_upload['orig_name'];
		
			}else{
				return  strip_tags($this->upload->display_errors());
				exit();
			}
			
			$datas[] = array(
					'form_id'=>$id,
					'lang_id'=>$row['lang_id'],
					'form_year'=>$post['num_year'],
					'url_file'=>$__file
			);
			
		}
		
		foreach ($datas as $data){
			$set = array(
					'form_id'=>$data['form_id'],
					'lang_id'=>$data['lang_id'],
					'form_year'=>$data['form_year'],
					'url_file'=>$data['url_file']
			);
			$this->db->insert('form_56_1',$set);
			$set = array();
		}
		
		return 'success';
	}
	
	public function UpdateForm56($post,$id){
		$this->load->model('form_56_1_model');
		$rs = $this->form_56_1_model->GetForm56_ByID($id);
		$this->load->library("upload");
		
		foreach ($rs as $row){
			$__file = $row['url_file'];
			$config['upload_path'] = 'upload/files/Form_56-1_'.$row['language'].'/';
			$config['allowed_types'] = 'zip|rar|pdf';
			$config['file_name'] = 'form_56-1_'.$row['language'].'_'.date('YmdHis');
			$this->upload->initialize($config);
				
			if(@$_FILES["file_".$row['language']]['name']!=''){
				if($this->upload->do_upload("file_".$row['language'])){
					@unlink($row['url_file']);
					$rs2_upload = $this->upload->data();
					$__file = $config['upload_path'].$rs2_upload['orig_name'];
		
				}else{
					return  strip_tags($this->upload->display_errors());
					exit();
				}
			}
				
			$data = array(
					'url_file'=>$__file
			);
			$this->db->where("form_id = ".$id." and lang_id = ".$row['lang_id'])->update('form_56_1',$data);
		}
		return 'success';
	}
	//Insert  Annual Report
	public function InsertAnnualReport($post,$rs_lang){
		$this->load->library("upload");
		$rr = $this->db->select_max('id','max_id')->get('annual_report')->row();
		$id = $rr->max_id + 1;
		foreach ($rs_lang->result_array() as $row){
			$config['upload_path'] = 'images/annual_report/'.$row['language'].'/';
			$config['allowed_types'] = 'jpg|png|gif';
			$config['max_height'] = 250; //pixcel
			$config['max_width'] = 174; //pixcel
			$config['file_name'] = 'annual_img_title'.$row['language'].'_'.date('YmdHis');
			$this->upload->initialize($config);
				
			if($this->upload->do_upload("imgTitle_".$row['language'])){
				$rs_upload = $this->upload->data();
				$imgTitle = $config['upload_path'].$rs_upload['orig_name'];
				
			}else{
				return  strip_tags($this->upload->display_errors());
				exit();
			}
			$config = array();
			$config['upload_path'] = 'upload/files/Annual_Report_'.$row['language'].'/';
			$config['allowed_types'] = 'pdf|xls|doc';
			$config['file_name'] = 'annual_'.$row['language'].'_'.date('YmdHis');
			$this->upload->initialize($config);
			
			if($this->upload->do_upload("file_".$row['language'])){
				$rs2_upload = $this->upload->data();
				$__file = $config['upload_path'].$rs2_upload['orig_name'];
			
			}else{
				return  strip_tags($this->upload->display_errors());
				exit();
			}
			$datas[] = array(
				'id'=>$id,
				'lang_id'=>$row['lang_id'],
				'year'=>$post['num_year'],
				'url_image'=>$imgTitle,
				'url_file'=>$__file
			);
			
		}
		
		foreach ($datas as $data){
			$set = array(
					'id'=>$data['id'],
					'lang_id'=>$data['lang_id'],
					'year'=>$data['year'],
					'url_image'=>$data['url_image'],
					'url_file'=>$data['url_file']
			);
			$this->db->insert('annual_report',$set);
			$set = array();
		}
		
		return 'success';
	}
	
	//Update  Annual Report
	public function UpdateAnnualReport($post,$id){
		$this->load->model('annual_model');
		$rs = $this->annual_model->GetAnnual_ByID($id);
		$this->load->library("upload");
		
		foreach ($rs as $row){
			$imgTitle = $row['url_image'];
			$__file = $row['url_file'];
			
			$config['upload_path'] = 'images/annual_report/'.$row['language'].'/';
			$config['allowed_types'] = 'jpg|png|gif';
			$config['max_height'] = 250; //pixcel
			$config['max_width'] = 174; //pixcel
			$config['file_name'] = 'annual_img_title'.$row['language'].'_'.date('YmdHis');
			$this->upload->initialize($config);
			
			if(@$_FILES["imgTitle_".$row['language']]['name']!=''){
				if($this->upload->do_upload("imgTitle_".$row['language'])){
					@unlink($row['url_image']);
					$rs_upload = $this->upload->data();
					$imgTitle = $config['upload_path'].$rs_upload['orig_name'];
				
				}else{
					return  strip_tags($this->upload->display_errors());
					exit();
				}
			}
			
			$config = array();
			$config['upload_path'] = 'upload/files/Annual_Report_'.$row['language'].'/';
			$config['allowed_types'] = 'pdf|xls|doc';
			$config['file_name'] = 'annual_'.$row['language'].'_'.date('YmdHis');
			$this->upload->initialize($config);
			
			if(@$_FILES["file_".$row['language']]['name']!=''){
				if($this->upload->do_upload("file_".$row['language'])){
					@unlink($row['url_file']);
					$rs2_upload = $this->upload->data();
					$__file = $config['upload_path'].$rs2_upload['orig_name'];
						
				}else{
					return  strip_tags($this->upload->display_errors());
					exit();
				}
			}
			
			$data = array(
					'url_image'=>$imgTitle,
					'url_file'=>$__file
			);
			$this->db->where("id = ".$id." and lang_id = ".$row['lang_id'])->update('annual_report',$data);
		}
		return 'success';
	}
	
	//Insert  Article
	public function InsertArticle($post,$id){
		date_default_timezone_set('Asia/Bangkok');
		$article = array(
				'menu_id' => $id,
				'article_date' => date('Y-m-d H:i:s')
		);
		$this->db->insert('article',$article);
		$last_id = $this->db->insert_id();
		
		$this->load->model('language_model');
		$rs_lang = $this->language_model->GetLangusge();
		foreach ($rs_lang->result_array() as $lang){
			$article = array(
				'article_id'=>$last_id,
				'lang_id'=>$lang['lang_id'],
				'article_title'=> $post['txtTitle_'.$lang['language']],
				'article_text'=>$post['area_'.$lang['language']]
			);
			$this->db->insert('article_language',$article);
		}
	}
	
	//Update  Article
	public function UpdateArticle($post,$id){
		$this->load->model('language_model');
		$rs_lang = $this->language_model->GetLangusge();
		$article_id = $this->db->where('menu_id = '.$id)->select('article_id')->get('article')->row();
		foreach ($rs_lang->result_array() as $lang){
			$article = array(
					'article_title'=> $post['txtTitle_'.$lang['language']],
					'article_text'=>$post['area_'.$lang['language']]
			);
			$this->db->where('article_id ='.$article_id->article_id.' and lang_id = '.$lang['lang_id']);
			$this->db->update('article_language', $article);
		}
		
	}
	
	//Insert News
	public function InsertNews($post,$rs_lang){
		date_default_timezone_set('Asia/Bangkok');
		$news = array(
			'news_date' => date('Y-m-d H:i:s'),
			'is_front_page' => @$post['isFrontPage']=='1'?'1':'0'
		);
		$this->db->insert('news',$news);
		$last_id = $this->db->insert_id();
		foreach ($rs_lang->result_array() as $lang){
			$news = array(
				'news_id'=>$last_id,
				'lang_id'=>$lang['lang_id'],
				'news_title'=> $post['txtTitle_'.$lang['language']],
				'news_description'=>$post['txtDesc_'.$lang['language']],
				'news_text'=>$post['area_'.$lang['language']]
			);
			$this->db->insert('news_language',$news);
		}
	}
	
	//Update News
	public function UpdateNews($post,$id){
		$this->load->model('language_model');
		$rs_lang = $this->language_model->GetLangusge();

		$news = array(
				'is_front_page' => @$post['isFrontPage']=='1'?'1':'0'
		);
		$this->db->where('news_id', $id);
		$this->db->update('news', $news);
		
		foreach ($rs_lang->result_array() as $lang){
			$news = array(
					'news_title'=> $post['txtTitle_'.$lang['language']],
					'news_description'=>$post['txtDesc_'.$lang['language']],
					'news_text'=>$post['area_'.$lang['language']]
			);
			$this->db->where('news_id ='.$id.' and lang_id = '.$lang['lang_id']);
			$this->db->update('news_language', $news);
		}
	}
	
	//Insert Gallery
	public function InsertGallery($post,$rs_lang){
		$config['upload_path'] = 'images/gallery/category/';
		$config['allowed_types'] = 'jpg|gif|png';
		$config['max_size'] = 1024; //kb
		$config['max_height'] = 350; //pixcel
		$config['max_width'] = 400; //pixcel
		$config['file_name'] = 'cat_gallery'.date('YmdHis');
		$this->load->library("upload",$config);
		if($this->upload->do_upload("file_image")){
			$rs_upload = $this->upload->data();
			$filename = $config['upload_path'].$rs_upload['orig_name'];
		}else{
			return $this->upload->display_errors();
		}
		$gal = array(
				'gal_date' => date('Y-m-d H:i:s'),
				'gal_image_url' => $filename
		);
		$this->db->insert('gallery',$gal);
		$last_id = $this->db->insert_id();
		foreach ($rs_lang->result_array() as $lang){
			$gal = array(
					'gal_id'=>$last_id,
					'lang_id'=>$lang['lang_id'],
					'gal_category'=> $post['txtCategory_'.$lang['language']],
					'gal_description'=>$post['txtDesc_'.$lang['language']],
					'gal_text'=>$post['area_'.$lang['language']]
			);
			$this->db->insert('gallery_language',$gal);
		}
		
	}
	
	//Update Gallery
	public function UpdateGallery($post,$id,$old_img){
		$filename='';
		if($_FILES["file_image"]["name"]!=null){
			$config['upload_path'] = 'images/gallery/category/';
			$config['allowed_types'] = 'jpg|gif|png';
			$config['max_size'] = 1024; //kb
			$config['max_height'] = 350; //pixcel
			$config['max_width'] = 400; //pixcel
			$config['file_name'] = 'cat_gallery'.date('YmdHis');
			$this->load->library("upload",$config);
			if($this->upload->do_upload("file_image")){
				@unlink($old_img);
				$rs_upload = $this->upload->data();
			$filename = $config['upload_path'].$rs_upload['orig_name'];
			}else{
				return $this->upload->display_errors();
			}
		}
		$this->load->model('language_model');
		$rs_lang = $this->language_model->GetLangusge();
		if($filename!=''){
			$gal = array(
					'gal_image_url' => $filename
			);
			$this->db->where('gal_id', $id);
			$this->db->update('gallery', $gal);
		}
		foreach ($rs_lang->result_array() as $lang){
			$gal = array(
					'gal_category'=> $post['txtCategory_'.$lang['language']],
					'gal_description'=>$post['txtDesc_'.$lang['language']],
					'gal_text'=>$post['area_'.$lang['language']]
			);
			$this->db->where('gal_id ='.$id.' and lang_id = '.$lang['lang_id']);
			$this->db->update('gallery_language', $gal);
		}
		
		
	}
	// Config Pagination Class Bootstrap----------------------------------------------------
	public function setConfigPagination(&$config,$total_row){
		if($this->session->userdata('perpage')==null){
			$this->session->set_userdata('perpage',15);
		}
		else {
			if($this->input->post('dd_perpage')!=null)
				$this->session->set_userdata('perpage',$this->input->post('dd_perpage'));
		}
		$config["per_page"] = $this->session->userdata('perpage');
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