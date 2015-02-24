<?php
class Meeting_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function GetMeeting($perPage,$numberPage,$lang){
		return $this->db->limit($perPage,$numberPage)->join('language', 'language.lang_id = meeting.lang_id')->
		order_by('meeting.meeting_date desc')->where("language.language = '".$lang."'")->get('meeting')->result_array();
	}
	
	public function GetMeeting_search($keyword,$lang){
		return $this->db->join('language', 'language.lang_id = meeting.lang_id')->
		order_by('meeting.meeting_date desc')->where("language.language = '".$lang."' and meeting.meeting_title like '%".$keyword."%'")->get('meeting')->result_array();
	}
	
	public function GetMeeting_ByID($id){
		return $this->db->join('language', 'language.lang_id = meeting.lang_id')->where("meeting.meeting_id = ".$id)->get('meeting')->result_array();
	}
}