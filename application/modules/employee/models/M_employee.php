<?php

/**
* Model Employee
*/
class M_employee extends CI_Model
{

	var $table = 'employee';
  var $column_order 	= array(
  								null, 
  								'employeeNIK',
  								'employeeName',
  								'department', 
  								'officeMail' 
  							); 
  var $column_search 	= array(
  								'employeeNIK',
  								'employeeName',
  								'department', 
  								'officeMail' 
  							);
  var $order = array('createdTime' => 'DESC'); // default order 




  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

	/* CRUD DATA */
  public function getData()
  {
    $this->_query();

    if($_POST['length'] != -1)
    {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    
    return $query->result_array();
  }

	public function _query()
  {
    $this->db->select("employeeUUID, employeeNik, employeeName, department, officeMail, createdTime");
    $this->db->from("employee");
    $this->db->where("deleted", config("NOT_DELETED"));

    $i = 0;
 
    foreach ($this->column_search as $item) // loop column 
    {
      if($_POST['search']['value']) // if datatable send POST for search
      {
        if($i===0) // first loop
        {
            $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
            $this->db->like($item, $_POST['search']['value']);
        }
        else
        {
            $this->db->or_like($item, $_POST['search']['value']);
        }

        if(count($this->column_search) - 1 == $i) //last loop
            $this->db->group_end(); //close bracket
      }
      $i++;
    }
     
    if(isset($_POST['order'])) // here order processing
    {
        $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } 
    else if(isset($this->order))
    {
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
    }
  }


  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  public function count_filtered()
  {
    $this->_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function save($post=array(), $usersId=0)
	{
		if (count($post) > 0) 
		{
			//var defined
			$datenow 	= date("Y-m-d H:i:s");

			$data 	= array(
				"employeeNik" 			=> $post['employeeNik'], 
				"employeeName" 			=> $post['employeeName'], 
				"site"							=> $post['site'], 
				"department"				=> $post['department'], 
				"section" 					=> $post['section'], 
				"jobPosition"				=> $post['jobPosition'], 
				"level"							=> $post['level'], 
				"subLevel"					=> $post['subLevel'], 
				"officeMail"				=> $post['officeMail'], 
				"createdBy"					=> $usersId, 
				"createdTime"				=> $datenow, 
			);
		
			$this->db->set("employeeUUID", "UUID()", FALSE); 
			$saved = $this->db->insert("employee", $data);
			
			return $saved;
		}
	}

  public function edit($uuid="")
  {
    $result   = array();
    if ($uuid !="") 
    {
      $this->db->where("employeeUUID", $uuid);
      $this->db->where("deleted", config("NOT_DELETED"));
      $query    = $this->db->get("employee");
      $result   = $query->row_array();
    }

    return $result;
  }

  public function update($post=array(), $usersId=0)
  {
    if (count($post) > 0) 
    {
      //var defined
      $datenow  = date("Y-m-d H:i:s");

      $data 	= array(
				"employeeNik" 			=> $post['employeeNik'], 
				"employeeName" 			=> $post['employeeName'], 
				"site"							=> $post['site'], 
				"department"				=> $post['department'], 
				"section" 					=> $post['section'], 
				"jobPosition"				=> $post['jobPosition'], 
				"level"							=> $post['level'], 
				"subLevel"					=> $post['subLevel'], 
				"officeMail"				=> $post['officeMail'], 
				"modifiedBy"				=> $usersId, 
				"modifiedTime"			=> $datenow, 
			);
      
      $this->db->where("employeeUUID", $post['employeeUUID']);
      $update = $this->db->update("employee", $data);
      
      return $update;
    }
  }

  public function detail($rowData=array())
  {
  	
  	if (count($rowData) > 0) 
  	{
  		$rowData['site'] 				= $this->changeSite($rowData['site']);
  		$rowData['department'] 	= $this->changeDept($rowData['department']);
  		$rowData['createdBy']		= $this->changeBy($rowData['createdBy']);
  		$rowData['modifiedBy']	= ($rowData['modifiedBy'] == null) ? "" : $this->changeBy($rowData['modifiedBy']);
  	}

  	return $rowData;
  }

  public function delete($uuid="")
  {
    if ($uuid != "") 
    {
      $this->db->set("deleted", 1);
      $this->db->where("employeeUUID", $uuid);
      $delete   = $this->db->update("employee");

      return TRUE;
    }

    return FALSE;
  }
	/* END CRUD DATA */

	public function listSite()
	{
		$this->db->from("site");
		$this->db->order_by("siteName", "ASC");
		
		$result = $this->db->get();

		return $result->result_array();
	}

	public function listDept()
	{
		$this->db->from("department");
		$this->db->order_by("departmentName", "ASC");

		$result = $this->db->get();

		return $result->result_array();
	}

	public function changeSite($siteCode="") 
  {
  	$this->db->select("siteName");
  	$this->db->from("site");
  	$this->db->where("siteCode", $siteCode);
  	$query = $this->db->get()->row_array();

  	$result = $siteCode. " - ".$query['siteName'];

  	return $result;
  }

  public function changeDept($departmentCode="") 
  {
  	$this->db->select("departmentName");
  	$this->db->from("department");
  	$this->db->where("departmentCode", $departmentCode);
  	$query = $this->db->get()->row_array();

  	$result = $departmentCode. " - ".$query['departmentName'];

  	return $result;
  }

  public function changeBy($usersId=0)
  {
  	$result = "";
  	if ($usersId != null && $usersId > 0) 
  	{
  		$this->db->select("fullName");
  		$this->db->from("users");
  		$this->db->where("usersId", $usersId);
  		$query = $this->db->get()->row_array();

  		$result = $query['fullName'];
  	}

  	return $result;
  }

	
}