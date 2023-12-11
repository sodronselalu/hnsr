<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_kunjungan_hd extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
	  if(!cek_menu('daftar_kunjungan_hd',$this->session->userdata('AKSES')[APP_ID]))
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
		$data['content']="layanan/v_daftar_hd";
		$this->load->view("page/content",$data);
	  }
	}

	function cari_hd()
	{
		$param['TGL_AWAL']=$this->input->post('TGL_AWAL');
		$param['TGL_AKHIR']=$this->input->post('TGL_AKHIR');
		$data['data_hd']=$this->webapi->post("hd/layanan/kunjungan_hd",$param,false);
		$this->load->view('layanan/v_daftar_hdt',$data);
	}

	function detail_hd()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('URUT_HD')))
		   {
		     $param['URUT_HD']=$this->input->post('URUT_HD');
		     $param['NO_REG']=$this->input->post('NO_REG');
		     $param['KD_UNIT_ASAL']=$this->session->userdata('KD_UNIT');
		     $data['detail_pakai']=$this->webapi->post("hd/layanan/rincian_pakai_pasien",$param,false);
		     $data['data_pakai_layanan']=$this->webapi->post("kasir/kasir_pasien/data_pakai_layanan_hd",$param,false);
		     $this->load->view('layanan/data_pakai_obat_pasien',$data);
		   }
		}
	}
}