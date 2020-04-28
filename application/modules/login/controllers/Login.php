<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 


class Login extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      //library and model
      $this->load->helper('global');
      $this->load->helper("config");
      $this->load->model("M_login");
    }
 
    public function index()
    {
      $this->load->view("v_login");
    } 
    
    public function process()
    {
      // defined variable
      $email    = $this->input->post("email");
      $password = $this->input->post("password");

      $this->checkLogin($email, $password);

    }

    public function checkLogin($users_email="", $users_password="")
    {
      $check = $this->M_login->check_login($users_email, $users_password);
    

      if (count($check) == 0) 
      {
        $status   = "error";
        $msg      = "Please check your email address!";        
      }
      else if (!password_verify($users_password, $check['password'])) 
      {
        $status   = "error";
        $msg      = "Your password is incorrect";
      }
      else if ($check['deleted'] == config("DELETED")) 
      {
        $status   = "error";
        $msg      = "Account has been deleted";
      }
      else if ($check['status'] == config("STATUS_DEACTIVE")) 
      {
        $status   = "error";
        $msg      = "Account deactive, please contact your admin";
      }
      else
      {
        $data_session = array(
            'usersId'       => $check['usersId'],
            'fullName'      => $check['fullName'],
            'email'         => $check['email'], 
            'level'         => $check['level'], 
            'status'        => $check['status'],
        );
        $this->session->set_userdata($data_session);


        redirect(base_url("home"));

      }

      $this->session->set_flashdata($status, $msg);
      redirect(base_url("login"));
    }

    public function logout()
    {
      $array_items = array('usersId', 'fullName', 'email', 'level', 'status');
      $this->session->unset_userdata($array_items);

      $msg = $this->session->flashdata("error");
      if ($msg == "login_no_access") 
      {
        $this->session->set_flashdata("error", "No Access, please login");
      }


      redirect(base_url("login"));
    }

    public function not_found()
    {
      $this->load->view("404");
    }


 
}