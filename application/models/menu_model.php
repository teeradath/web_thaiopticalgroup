<?php
class Menu_model extends CI_Model{
	public $menus="";
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
    		$this->menus .= anchor($this->getMenuUrl($row),$this->lang->line($row["menu_name"]).$this->getClassCaret($n),$this->getClassDropdownToggle($n));
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
					$this->menus .= "<li>";
					$this->menus .= anchor('#',$this->lang->line($row["menu_name"]));
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
		$rs = $this->db->where("is_article = 1 and is_disable = 0")->order_by("ordering asc")->get("menus")->result_array();
		foreach ($rs as $row){
			$n = $this->db->where('parent_id = '.$row['menu_id'])->get("menus")->num_rows();
			$article .= "<li class='nav nav-second-level'>";
			$article .= anchor($this->getMenuUrl($row),$this->lang->line($row["menu_name"]));
			$article .= "</li>";
		}
		return $article;
	}
	
	/*Set Class css And Href Url------------------------------------------------------------*/
	public function getMenuUrl($row){
		return ($row['menu_url']!=""&&$row['is_article']==0?$row['menu_url']:'#');
	}
	
	public function getClassCaret($n){
		return ($n>0?"<b class='caret'></b>":"");
	}
	
	public function getClassDropdown($n,$row){
		$class="";
		if($n>0)
			$class = "dropdown";
		if($row['menu_url']=='home')
			$class.=" active";
				
		return 'class="'.$class.'"';
	}
	
	public function getClassDropdownToggle($n){
		return ($n>0?'class="dropdown-toggle" data-toggle="dropdown"':'');
	}
	/*--------------------------------------------------------------------------*/
}