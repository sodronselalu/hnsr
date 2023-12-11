<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_gudang extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	} 

	function index()
	{
	  if(!cek_menu('data_stock',$this->session->userdata('AKSES')[APP_ID]))
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
		$data['content']="gudang/v_stock_gudang";
		$data['data_gudang']=$this->webapi->post("farmasi/gudang/data_gudang",array(),false);
		$this->load->view("page/content",$data);
	  }
	}

	function detail_data()
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



	function cari_stock()
	{
		
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_STOCK')))
		   {
		     $param['KD_STOCK']=$this->input->post('KD_STOCK'); 
		     $data=$this->webapi->post("farmasi/gudang/cari_stock",$param);
		     echo $data;
		   }
		}
	}

	function stock_obat()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('KD_OBAT')) && !is_null($this->input->post('KD_GUDANG')))
			{
				$param['KD_GUDANG']=$this->input->post('KD_GUDANG');
				$param['KD_OBAT']  =$this->input->post('KD_OBAT');
				$data['data_stock']=$this->webapi->post("farmasi/gudang/stock_obat",$param,false);
				$this->load->view('cari/cari_stok_gudang_live',$data);
			}
		}
	}

	function stock_gudang()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('KD_GUDANG')))
			{
				$param['KD_GUDANG']=$this->input->post('KD_GUDANG');
				$data['data_stock']=$this->webapi->post("farmasi/gudang/stock_gudang",$param,false);
				$this->load->view('cari/cari_stok_gudang_live',$data);
			}
		}
	}

	function cari_obat()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('KD_GUDANG')))
			{
				$param['KD_GUDANG']=$this->input->post('KD_GUDANG');
				$param['KD_FORMULARIUM']='';
				$data['data_obat']=$this->webapi->post("farmasi/formularium/data_stock_obat",$param,false);
				$this->load->view('cari/cari_obat',$data);
			}
		}
	}
	
}