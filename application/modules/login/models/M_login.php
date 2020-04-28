<?php

/**
* Model Login
*/
class M_login extends CI_Model
{

  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

	function check_login($users_email="", $users_pass="")
	{
		$this->db->select($this->_selected());
		$this->db->from("users");
		$this->db->where("email", $users_email);

		$query 	= $this->db->get();
		$result	= $query->row_array();

		return $result;
		
	}

	function _selected()
	{
		$result = array(
					"users.usersId", 
					"users.fullName", 
					"users.password",
					"users.email", 
					"users.level", 
					"users.status", 
					"users.deleted",
		);

		return $result;
	}



	
}