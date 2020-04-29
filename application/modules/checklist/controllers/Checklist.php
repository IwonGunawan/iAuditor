<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 


class Checklist extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      // library and model
      $this->load->model("M_checklist");
      $this->load->helper('global');
      $this->load->helper('config');
      $this->load->library('session');

      // session 
      $this->sess['usersId']    = $this->session->userdata('usersId');
      $this->sess['email']      = $this->session->userdata('email');
      $this->sess['level']      = $this->session->userdata('level');
    }
 
    public function index()
    {
      $data["page"]      = "Checklist";
      $data["content"]   = "checklist/v_index";
      $this->load->view("app_template", $data);
    } 

    public function ajax_list()
    {
      $list = $this->M_checklist->getData();
      
      $data = array();
      $no   = $_POST['start'];
      foreach ($list as $key => $row) 
      {
          $no++;
          $content = array();

          $uuid      = $row['checklistUUID'];


          $content[] = $no;
          $content[] = "<a href='".base_url('checklist/detail/'.$uuid)."'>".$row['questionId']."</a>";
          $content[] = $row['targetVal'];
          $content[] = $row['actualVal'];
          $content[] = $row['note'];

          
          $btn = "
                  <a class='table-action hover-primary' href='".base_url('checklist/edit/'.$uuid)."'><i class='ti-pencil'></i> Edit </a> | 
                  <a class='table-action hover-danger' href='".base_url('checklist/delete/'.$uuid)."' onclick='return confirm(\"DELETE DATA ?\")'><i class='ti-trash'></i> Delete</a>
                ";
          $content[]  = $btn;

          $data[] = $content;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_checklist->count_all(),
                      "recordsFiltered" => $this->M_checklist->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
    }

    public function detail($uuid="") 
    {
      $data["page"]       = "Detail";
      $data["content"]    = "checklist/v_detail";
      $rowData            = $this->M_checklist->edit($uuid);

      if (count($rowData) > 0) 
      {
        $data["data"]       = $this->M_checklist->detail($rowData);
        
        $this->load->view("app_template", $data); 
      }
      else 
      {
        redirect(base_url('checklist'));  
      }
    }

    public function create()
    {
      $data["page"]       = "Create New";
      $data["content"]    = "checklist/v_create";
      
      $this->load->view("app_template", $data);
    }

    public function save()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "checklist";

      if (count($post) > 0) 
      {
        $process  = $this->M_checklist->save($post, $this->sess['usersId']);
        if ($process > 0) 
        {
          $msg      = "Data saved successfully";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function edit($uuid="")
    {
      if ($uuid != "") 
      {
        $data["page"]       = "Edit";
        $data["content"]    = "checklist/v_create";
        $data["data"]       = $this->M_checklist->edit($uuid);

        $this->load->view("app_template", $data);
      }
      else
      {
        $this->session->set_flashdata("msg", "Data not found");
        return redirect(base_url("checklist"));
      }
    }

    public function update()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "checklist";

      if (count($post) > 0) 
      {
        $process  = $this->M_checklist->update($post, $this->sess['usersId']);
        if ($process > 0) 
        {
          $msg      = "Data has been changed";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function delete($uuid="")
    {
      if ($uuid != "") 
      {
        $process = $this->M_checklist->delete($uuid);
        if ($process == TRUE) 
        {
          $msg = "Data deleted";
        }else
        {
          $msg = "Data failed to delete, try again!";
        }
      }
      else
      {
        $msg = "No Data available";
      }

      $this->session->set_flashdata("danger", $msg);
      return redirect(base_url("checklist"));
    }    


 
}