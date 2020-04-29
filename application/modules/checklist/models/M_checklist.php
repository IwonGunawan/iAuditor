<?php

/**
* Model Checklist
*/
class M_checklist extends CI_Model
{

	var $table = 'checklist';
  var $column_order 	= array(
  								null, 
  								'question',
  								'targetVal',
  								'actualVal', 
  								'note' 
  							); 
  var $column_search 	= array(
  								'question',
                  'targetVal',
                  'actualVal', 
                  'note' 
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
    $this->db->select("checklistUUID, questionId, targetVal, actualVal, note, createdTime");
    $this->db->from("checklist");
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
				"sectionId" 			=> $post['sectionId'], 
				"inspectionId" 		=> $post['inspectionId'], 
				"questionId"      => $post['questionId'], 
				// "question"				=> $post['question'], 
				"targetVal" 			=> $post['targetVal'], 
				"actualVal"				=> $post['actualVal'], 
				"note"						=> $post['note'], 
				"createdBy"				=> $usersId, 
				"createdTime"			=> $datenow, 
			);
		
			$this->db->set("checklistUUID", "UUID()", FALSE); 
			$saved = $this->db->insert("checklist", $data);
			
			return $saved;
		}
	}

  public function edit($uuid="")
  {
    $result   = array();
    if ($uuid !="") 
    {
      $this->db->where("checklistUUID", $uuid);
      $this->db->where("deleted", config("NOT_DELETED"));
      $query    = $this->db->get("checklist");
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
				"sectionId"         => $post['sectionId'], 
        "inspectionId"      => $post['inspectionId'], 
        "questionId"        => $post['questionId'], 
        "question"          => $post['question'], 
        "targetVal"         => $post['targetVal'], 
        "actualVal"         => $post['actualVal'], 
        "note"              => $post['note'], 
				"modifiedBy"				=> $usersId, 
				"modifiedTime"			=> $datenow, 
			);
      
      $this->db->where("checklistUUID", $post['checklistUUID']);
      $update = $this->db->update("checklist", $data);
      
      return $update;
    }
  }

  public function detail($rowData=array())
  {
  	
  	if (count($rowData) > 0) 
  	{
  		$rowData['createdBy']		= $this->changeBy($rowData['createdBy']);
  		$rowData['modifiedBy']	= ($rowData['modifiedBy'] == null) ? "" : $this->changeBy($rowData['modifiedBy']);
  	}

  	return $rowData;
  }

  public function delete($uuid="")
  {
    if ($uuid != "") 
    {
      $this->db->set("deleted", config("DELETED"));
      $this->db->where("checklistUUID", $uuid);
      $delete   = $this->db->update("checklist");

      return TRUE;
    }

    return FALSE;
  }
	/* END CRUD DATA */

	/* OTHER FUNCTION */ 
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