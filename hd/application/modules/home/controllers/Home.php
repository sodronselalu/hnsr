<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		
	  if(!array_key_exists(APP_ID, $this->session->userdata('AKSES')))
	  {
		 redirect(base_url());
	  }
	  else
	  {
		$data['header']="page/header";
		$data['navbar']="page/navbar";
		$data['sidebar']="page/sidebar";
		$data['js']="page/js";
		$data['footer']="page/footer";
		$data['content']="home/v_home";
		$this->load->view("page/content",$data);
	  }
	}

}