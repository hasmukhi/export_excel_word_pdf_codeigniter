<?php
class AdminModel extends CI_Model
{        
    public function __construct()
    {
        parent::__construct();
    }
    
	function exe_query($query) {
        return $this->db->query($query);
    }
	
	public function fetch_state(){
		$this->db->select("*");
		$this->db->from("state");
		$query=$this->db->get();
		return $query->result_array();
	}
}
