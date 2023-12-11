<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hd extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
	  if(!cek_menu('tindakan_hd',$this->session->userdata('AKSES')[APP_ID]))
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
		$data['content']="pengaturan/v_hd";
		$data['data_hd']=$this->webapi->post("hd/layanan/data_tindakan_hd",array(),false);
		$this->load->view("page/content",$data);
	  }
	}

	function detail_hd()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_HD')))
		   {
		     $param['KD_HD']=$this->input->post('KD_HD');
		     $data=$this->webapi->post("hd/layanan/detail_tindakan_hd",$param);
		     echo $data;
		   }
		}
	}


	function simpan()
	{
		$msg="";
		$param['KD_HD']=$this->input->post('KD_HD');
		$param['NM_HD']=$this->input->post('NM_HD');
		
		$data=$this->webapi->post("hd/layanan/simpan_tindakan_hd",$param,false);
	
		if($data)
		{
		 if($data->response=='200')
		 {
		 	$msg=$data->data;
		 }
		 else
		 {
		 	$msg="Data tidak dapat disimpan!";
		 }
		}
		else
		{
			$msg="Terjadi kesalahan!";
		}
		echo $msg;
	}

	function hapus()
	{
		$msg="";
		$param['KD_HD']  = $this->input->post('KD_HD');
		$data=$this->webapi->post("hd/layanan/hapus_tindakan_hd",$param,false);
		if($data)
		{
		 if($data->response=='200')
		 {
		 	$msg=$data->msg;
		 }
		 else
		 {
		 	$msg="Data tidak dapat dihapus!";
		 }
		}
		else
		{
			$msg="Terjadi kesalahan!";
		}
		echo $msg;
	}

	function tabel_hd()
	{
		$data['data_hd']=$this->webapi->post("hd/layanan/data_tindakan_hd",array(),false);
		$this->load->view('pengaturan/v_hdt',$data);
	}
}