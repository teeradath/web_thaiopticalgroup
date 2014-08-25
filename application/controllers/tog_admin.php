<?php
class Tog_admin extends CI_Controller{
	public function index(){
		//init Template
		$this->template->title = 'Administrator';
		$this->template->load_templateAdmin('admin/admin_home');
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect("login");
		exit();
	}
	
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
	
	//Delete News
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
		//init Template
		$this->template->title = 'Administrator | Images Gallery';
		$this->template->active = 'Gallery';
		$this->template->content_data = $data;
		$this->template->load_templateAdmin('admin/gallery/gallery_images_form');
	}
	//Delete Gallery
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
	
	//@funtion ------------------------------------------------------------
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