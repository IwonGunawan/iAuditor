<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 


class Login extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      // is_login();

      //library and model
      $this->load->helper('global');
      $this->load->helper("config");
      $this->load->model("M_login");
    }
 
    public function index()
    {
      $this->load->view("v_login");
    } 
    
    public function submit() 
    {
      redirect('home');
    }


 
}