<?php
class Ajax extends CI_Controller{
	public function uploadFile(){
		$n = $_POST['n']*1;
		$data = '';
		$this->load->library("upload");
		$this->load->library('image_lib');
		for( $i=0; $i<=$n; $i++){
			if(@$_FILES["file_image".$i]['name']!=''){
				$config['upload_path'] = 'images/gallery/img/';
				$config['allowed_types'] = 'jpg|gif|png';
				$config['max_height'] = 700; //pixcel
				$config['max_width'] = 1200; //pixcel
				//$config['max_size'] = 1024; //kb
				$config['file_name'] = 'img_gallery'.$i.'_'.date('YmdHis');
								
				$this->upload->initialize($config);
				if($this->upload->do_upload("file_image".$i)){
					$rs_upload = $this->upload->data();
					
					$config2['image_library'] = 'gd2';
					$config2['create_thumb'] = TRUE;
					$config2['source_image']	= $config['upload_path'].$rs_upload['orig_name'];
					$config2['new_image'] = 'images/gallery/img_small/'.$rs_upload['orig_name'];
					$config2['width'] = 150;
					$config2['height'] = 160;
					$this->image_lib->initialize($config2);
					if ( !$this->image_lib->resize())
						$this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));
						
					
					$filename = $config['upload_path'].$rs_upload['orig_name'];
					$filename_thumb = 'images/gallery/img_small/'.$rs_upload['raw_name'].'_thumb'.$rs_upload['file_ext'];
					$data .='@'.$i;
					$img = array(
						'gal_id'=>$_POST['gal_id'],
						'image_url'=>$filename,
						'image_url_thumb'=>$filename_thumb
					);
					$this->db->insert('gallery_images',$img);
				}else{
					$data.= '#%#@'.$i.'@'.$this->upload->display_errors();
					echo $data;
					exit();
				}
			}
		}
		echo $data.'#%#';
		//print_r($_FILES['file_image0']);
	}
	
	public function getImags($gal_id){
		$this->load->model('gallery_model');
		$rs = $this->gallery_model->GetGalleryImageID($gal_id)->result_array();
		$data = '';
		foreach ($rs as $row){
			$data.='<tr>';
			//$data.='<td style="text-align: center;vertical-align: middle;">'.$row['img_id'].'</td>';
			$data.='<td><img alt="" src="'.base_url().$row['image_url'].'" style="max-width: 150px"></td>';
			$data.='<td style="text-align: center;vertical-align: middle;">';
			$data.='<a href="#" style="color:#E05353 " style="font-size:1.1em;" id="btn-del-1" onclick="del('.$row['img_id'].')">';
			$data.='<span class="glyphicon glyphicon-remove"></span>';
			$data.='</a>';
			$data.='</td>';
			$data.='</tr>';			
		}

		echo $data;
	}
	public function delImags($img_id,$gal_id){
		$row = $this->db->where("img_id",$img_id)->get('gallery_images')->row();
		@unlink($row->image_url);
		@unlink($row->image_url_thumb);
		$this->db->delete('gallery_images','img_id = '.$img_id);
		$this->getImags($gal_id);
	}
	
	public function financialEdit($id){
		$result_text='';
		$text = trim($_POST['txtEdit'.$id]);
		$row = $this->db->where('upload_id = '.$id)->get('financial_upload')->row();
		$arr_path = explode('/', $row->url_file);
		$arr_lang = explode('_', $arr_path[3]);
		if(@$_FILES["file".$id]['name']!=''){
			$this->load->library("upload");
			$config['upload_path'] = 'upload/files/Fiancial_Statement_'.$arr_lang[1].'/';
			$config['allowed_types'] = 'zip|rar|pdf|xls|doc';
			$config['file_name'] = 'financial_'.$arr_lang[1].'_'.date('YmdHis');
			$this->upload->initialize($config);
			
			if($this->upload->do_upload("file".$id)){
				@unlink($row->url_file);
				$rs_upload = $this->upload->data();
				$up = array(
						'text' => $text,
						'url_file' => $config['upload_path'].$rs_upload['orig_name']
				);
				$this->db->where('upload_id ='.$id);
				$this->db->update('financial_upload',$up);
			}else{
				$result_text .= '  <font id="errEditFile" color="error">['.strip_tags($this->upload->display_errors()).']</font>';
				//exit();
			}
			
		}else{
			$up = array(
					'text' => $text
			);
			$this->db->where('upload_id ='.$id);
			$this->db->update('financial_upload',$up);
		}
		echo $text.$result_text;
	}
	
	public function disableMenu(){
		foreach ($this->input->post() as $key=>$val){
			if(strpos($key,"hid")!== false){
				$arr[$key] = $val;
			}
		}
		foreach ($arr as $key=>$val){
			$arr_id = explode('_',$key);
			$this->db->where("menu_id = ".$arr_id[1])->update('menus',array('is_disable'=>!(bool)$val));
		}
		//print_r($arr);
	}
	
}