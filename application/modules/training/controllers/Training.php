<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 


class Training extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      // library and model
      $this->load->model("M_training");
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
      $data["page"]      = "Training";
      $data["content"]   = "training/v_index";
      $this->load->view("app_template", $data);
    } 

    public function ajax_list()
    {
      $list = $this->M_training->getData();
      
      $data = array();
      $no   = $_POST['start'];
      foreach ($list as $key => $row) 
      {
          $no++;
          $content = array();

          $uuid      = $row['trainingUUID'];


          $content[] = $no;
          $content[] = "<a href='".base_url('training/detail/'.$uuid)."'>".$row['trainingName']."</a>";
          $content[] = $row['trainingContent'];

          
          $btn = "
                  <a class='table-action hover-primary' href='".base_url('training/edit/'.$uuid)."'><i class='ti-pencil'></i> Edit </a> | 
                  <a class='table-action hover-danger' href='".base_url('training/delete/'.$uuid)."' onclick='return confirm(\"DELETE DATA ?\")'><i class='ti-trash'></i> Delete</a>
                ";
          $content[]  = $btn;

          $data[] = $content;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_training->count_all(),
                      "recordsFiltered" => $this->M_training->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
    }

    public function detail($uuid="") 
    {
      $data["page"]       = "Detail";
      $data["content"]    = "training/v_detail";
      $rowData            = $this->M_training->edit($uuid);

      if (count($rowData) > 0) 
      {
        $data["data"]       = $rowData; // temporary, change with original flow
        
        $this->load->view("app_template", $data); 
      }
      else 
      {
        redirect(base_url('training'));  
      }
    }

    public function create()
    {
      $data["page"]       = "Create New";
      $data["content"]    = "training/v_create";
      
      $this->load->view("app_template", $data);
    }

    public function save()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "training";

      if (count($post) > 0) 
      {
        $process  = $this->M_training->save($post, $this->sess['usersId']);
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
        $data["content"]    = "training/v_create";
        $data["data"]       = $this->M_training->edit($uuid);

        $this->load->view("app_template", $data);
      }
      else
      {
        $this->session->set_flashdata("msg", "Data not found");
        return redirect(base_url("training"));
      }
    }

    public function update()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "training";

      if (count($post) > 0) 
      {
        $process  = $this->M_training->update($post, $this->sess['usersId']);
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
        $process = $this->M_training->delete($uuid);
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
      return redirect(base_url("training"));
    }    


 
}