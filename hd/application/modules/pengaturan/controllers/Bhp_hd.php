<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bhp_hd extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
	  if(!cek_menu('bhp_hd',$this->session->userdata('AKSES')[APP_ID]))
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
		$data['content']="pengaturan/v_bhp_hd";
		$data['data_hd']=$this->webapi->post("hd/layanan/data_tindakan_hd",array(),false);
		$data['data_satuan']=$this->webapi->post("farmasi/master/data_satuan",array(),false);
		$param['KD_FORMULARIUM']='';
		$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		$data['data_obat']=$this->webapi->post("farmasi/formularium/data_stock_obat",$param,false);
		$data['data_bhp_hd']=null;
		$this->load->view("page/content",$data);
	  }
	}

	function detail_obat()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_OBAT')))
		   {
		     $param['KD_OBAT']=$this->input->post('KD_OBAT'); 
		     $data=$this->webapi->post("farmasi/formularium/detail_obat",$param);
		     echo $data;
		   }
		}
	}

	function detail_bhp_hd()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_HD')) && !is_null($this->input->post('KD_OBAT')))
		   {
		   	 $param['KD_HD']=$this->input->post('KD_HD');
		     $param['KD_OBAT']=$this->input->post('KD_OBAT'); 
		     $data=$this->webapi->post("hd/layanan/detail_bhp_hd",$param);
		     echo $data;
		   }
		}
	}

	function simpan()
	{
		$msg="";
		$param['KD_HD']=$this->input->post('KD_HD');
		$param['KD_OBAT']=$this->input->post('KD_OBAT'); 
		$param['JUMLAH']=$this->input->post('JUMLAH');
		$param['KD_SATUAN']=$this->input->post('KD_SATUAN');
		
		$data=$this->webapi->post("hd/layanan/simpan_bhp_hd",$param,false);
	
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
		$param['KD_OBAT']=$this->input->post('KD_OBAT'); 
		$data=$this->webapi->post("hd/layanan/hapus_bhp_hd",$param,false);
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
		$param['KD_HD']  = $this->input->post('KD_HD');
		$data['data_bhp_hd']=$this->webapi->post("hd/layanan/data_bhp_hd",$param,false);
		$this->load->view('pengaturan/v_bhp_hdt',$data);
	}
}