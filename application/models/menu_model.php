<?php
class Menu_model extends CI_Model{
	public $menus="";
	public $active="";
	public $menus_manage="";
	public $menus_hid="";
	public function __construct() {
        parent::__construct();
    }
    //@Menu in Front end
    public function GetMenu(){
    	$this->db->cache_on();
    	$rs = $this->db->where("parent_id = 0 and is_disable = 0")->order_by("ordering asc")->get("menus");
    	foreach ($rs->result_array() as $row){
    		$n = $this->db->where('parent_id = '.$row['menu_id'])->get("menus")->num_rows();
    		$this->menus .= "<li ".$this->getClassDropdown($n,$row).">";
    		$this->menus .= anchor($this->getMenuUrl($row,''),$this->lang->line($row["menu_name"]).$this->getClassCaret($n),$this->getClassDropdownToggle($n));
    		$this->ParentMenus($row['menu_id']);
    		$this->menus .= "</li>";
    	}
    	return $this->menus;
    }
      
	public function ParentMenus($id=0){
		$this->db->cache_on();
		$result = $this->db->where("parent_id = ".$id." and is_disable = 0")->order_by("ordering asc")->get("menus");
			if($result->num_rows()!=0){
				$this->menus .= "<ul class='dropdown-menu'>";
				foreach ($result->result_array() as $row){
					$arr1 = explode('-',$this->uri->segment(1));
					$arr2 = explode('.',$arr1[count($arr1)-1]);
					$submenu = $arr2[0];
					$active = $row["menu_id"]==$submenu?"class='active'":"";
					if($active==""){
						$iii = $this->db->where("menu_url = '".strtolower($this->uri->segment(1))."'")->select('menu_id')->get('menus')->row();
						$active = $row["menu_id"]==@$iii->menu_id?"class='active'":"";
					}
					$this->menus .= "<li ".$active." >";
					$this->menus .= anchor($this->getMenuUrl($row,''),$this->lang->line($row["menu_name"]));
					$this->ParentMenus($row['menu_id']);
					$this->menus .= "</li>";
				}
				$this->menus .= "</ul>";
			}
	}
	//@Menu Article in Admin
	public function GetMenuIsArticle(){
		$this->lang->load('th','th');
		$article = "";
		$this->db->cache_on();
		$rs = $this->db->where("is_article = 1 and is_disable = 0")->order_by("menu_id asc")->get("menus")->result_array();
		foreach ($rs as $row){
			$active = $row['menu_id']==$this->uri->segment(3)?'class="active"':'';
			$article .= "<li class='nav nav-second-level'>";
			$article .= anchor($this->getMenuUrl($row,'admin'),$this->lang->line($row["menu_name"]),$active);
			$article .= "</li>";
		}
		return $article;
	}
	
	/*Set Class css And Href Url------------------------------------------------------------*/
	public function getMenuUrl($row,$site){
		if($site=='admin'){
			return ($row['menu_url']!=""&&$row['is_article']==0?$row['menu_url']:'tog_admin/article/'.$row['menu_id']);
		}
		else {
			//@ friendly Url
			$this->load->library('url_friendly');
			$url='Article-'.$this->url_friendly->friendly(($this->lang->line($row["menu_name"])!=''?$this->lang->line($row["menu_name"]):'notfound')).'-'.$row['menu_id'].'.html';
			return ($row['menu_url']!=""&&$row['is_article']==0?$row['menu_url']:$url);
		}
	}
	
	public function getClassCaret($n){
		return ($n>0?"<b class='caret'></b>":"");
	}
	
	public function getClassDropdown($n,$row){
		$class="";
		$control = $this->router->fetch_class();
		if($n>0)
			$class = "dropdown";
		if($row['menu_id']==$this->session->userdata('activeTopMenu_id'))
			$class.=" active";
				
		return 'class="'.$class.'"';
	}
	
	public function getClassDropdownToggle($n){
		return ($n>0?'class="dropdown-toggle" data-toggle="dropdown"':'');
	}
	/*--------------------------------------------------------------------------*/
	
	
	//@ Manage Menus Admin ................................................................
	public function getMenu_admin($id = 0,$n = 0,$chkk = -1){
		$this->db->cache_on();
		$rs = $this->db->where("parent_id = ".$id)->order_by("ordering asc")->get("menus");
		if($rs->num_rows()!=0){
			$this->menus_manage .= '<ol '.($n==0?'class="tree-menus"':'').' id="ol_'.$id.'">';
			foreach ($rs->result_array() as $row){
				$rs22 = $this->db->where("parent_id = ".$row['menu_id'])->order_by("ordering asc")->get("menus")->num_rows();
				if($n==0) 
					$chkk = (int)(!(bool)$row['is_disable']);
				
				if($rs22==0){
					if($chkk==0)
						$chk = 0;
					else 
						$chk = (int)(!(bool)$row['is_disable']);
				}
				else {
					$chk = 0;
				}
				$this->menus_hid .= '<input type="hidden" name="'.('hid_').$row['menu_id'].'"  id="'.('hid_').$row['menu_id'].'" value="'.(int)(!(bool)$row['is_disable']).'" />';
				$this->menus_manage .= '<li data-name="'.('chk_').$row['menu_id'].'" id="'.('id_').$row['menu_id'].'" data-value="'.$row['menu_id'].'" data-checked="'.$chk.'" >';
				$this->menus_manage .= $row["menu_name"];
				$this->getMenu_admin($row['menu_id'], $n +1,$chkk);
				$this->menus_manage .= "</li>";
			}
			$this->menus_manage .= '</ol>';
		}
		$this->db->where('menu_id = 23')->update('menus',array('menu_url'=>''));
	}

	//-------------------------------------------------------------------------------------
	
	
}