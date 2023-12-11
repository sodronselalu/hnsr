<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_hd extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
	  if(!cek_menu('tagihan_hd',$this->session->userdata('AKSES')[APP_ID]))
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
		$data['content']="tagihan/pasien";
		$data['data_pasien']=$this->webapi->post("farmasi/pasien/data_register_ini",array('IOL'=>'O'),false);
		$this->load->view("page/content",$data);
	  }
	}

	function cari_pasien()
	{
		$msg="";
		$param['TGL_LAYAN']=$this->input->post('TGL_LAYAN');
		$param['NM_PASIEN']=$this->input->post('NM_PASIEN');
		$param['ALAMAT']=$this->input->post('ALAMAT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['IOL']=$this->input->post('KD_JENIS');
		$data['IOL']=$param['IOL'];
		$data['data_pasien']=$this->webapi->post("farmasi/pasien/data_register",$param,false);
		$this->load->view('tagihan/tb_pasien',$data);
	}

	function cari_jenis_pasien()
	{
		$msg="";
		$param['IOL']=$this->input->post('IOL');
		$data['IOL']=$param['IOL'];
		$data['data_pasien']=$this->webapi->post("farmasi/pasien/data_register_ini",$param,false);
		$this->load->view('tagihan/tb_pasien',$data);
	}


	function pilih_pasien()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['IOL']=$this->input->post('IOL');
		$param['NO_URUT_INAP']=$this->input->post('NO_URUT_INAP');
		$data['data_pasien']=$this->webapi->post("farmasi/pasien/detail_register",$param,false);
	
		if($data['data_pasien'])
		{
			if($data['data_pasien']->response=='200')
			{				
				$param['KD_UNIT_ASAL']=$this->session->userdata('KD_UNIT');
				$data['dpjp_pasien']=$this->webapi->post("farmasi/pasien/dpjp_pasien",$param,false);
				$data['data_petugas']=$this->webapi->post("farmasi/master/data_petugas",array(),false);
				$data['data_hd']=$this->webapi->post("hd/layanan/data_hd",$param,false);
				$data['total_hd']=$this->webapi->post("hd/layanan/total_hd",$param,false);
				$data['data_obat_hd']=$this->webapi->post("hd/layanan/pakai_obat_pasien",$param,false);
				$data['data_pakai_layanan']=$this->webapi->post("kasir/kasir_pasien/data_pakai_layanan_hd",$param,false);
				$this->load->view('tagihan/v_tagihan',$data);
			
			}
			else
			{
				echo "PASIEN KODE 404";
			}
		}
		else
		{
			echo "TERJADI KEGAGALAN";
		}
	}

	function detail_petugas()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NIK')))
		   {
		     $param['NIK']=$this->input->post('NIK');
		     $data=$this->webapi->post("farmasi/master/detail_petugas",$param);
		     echo $data;
		   }
		}
	}

	function simpan_layanan()
	{
		$msg="";
		$param['NO_URUT_LAYANAN']=$this->input->post('NO_URUT_LAYANAN');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_LAYANAN']=$this->input->post('KD_LAYANAN');
		$param['KD_KELAS']=$this->input->post('KD_KELAS');
		$param['KD_UNIT']=$this->session->userdata('KD_UNIT');//unit pelayanan hd
		$param['KD_UNIT_INDUK']=$this->session->userdata('KD_UNIT');//unit pelayanan hd
		$param['TGL_LAYANAN']=$this->input->post('TGL_LAYANAN');
		$param['IOL']=$this->input->post('IOL_LAYAN');
		$param['QTY']=$this->input->post('QTY_LAYANAN');
		$param['TARIF']=$this->input->post('TARIF_LAYANAN');
		$param['TOTAL']=$this->input->post('TOTAL_LAYANAN');
		$param['NIK_PELAKSANA']=$this->input->post('NIK_DOKTER');
		$param['NIK_DOKTER']=$this->input->post('NIK_DPJP');
		$param['IS_TAGIH']='F';
		$param['IS_PENJAMIN']='F';
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("kasir/kasir_pasien/simpan_layanan",$param,false);
	
		if($data)
		{
		 if($data->response=='200')
		 {
		 	$msg=$data->data;
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

	function hapus_layanan()
	{
		$msg="";
		$param['NO_URUT_LAYANAN']=$this->input->post('NO_URUT_LAYANAN');
		
		$data=$this->webapi->post("kasir/kasir_pasien/hapus_layanan",$param,false);
	
		if($data)
		{
		 if($data->response=='200')
		 {
		 	$msg=$data->data;
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

	function final_pasien()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['KD_UNIT_ASAL']=$this->session->userdata('KD_UNIT');
		$param['IOL']=$this->input->post('IOL');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		$data=$this->webapi->post("hd/layanan/final_pasien",$param,false);
	
		if($data)
		{
		 if($data->response=='200')
		 {
		 	$msg=$data->data;
		 }
		 else
		 {
		 	$msg="Pasien gagal dipulangkan!";
		 }
		}
		else
		{
			$msg="Terjadi kesalahan!";
		}
		echo $msg;
	}

	function reload_layan()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NO_REG')))
		   {
				$param['NO_REG']=$this->input->post('NO_REG');
				$param['KD_UNIT_ASAL']=$this->session->userdata('KD_UNIT');
				$data['data_pakai_layanan']=$this->webapi->post("kasir/kasir_pasien/data_pakai_layanan_hd",$param,false);
				$this->load->view('cari/cari_pakai_layanan',$data);
			}
		}
	}

	function total_hd()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NO_REG')))
		   {
				$param['NO_REG']=$this->input->post('NO_REG');
				$data=$this->webapi->post("hd/layanan/total_hd",$param);
				echo $data;
			}
		}
	}

	function detail_hd()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('URUT_HD')))
		   {
		     $param['URUT_HD']=$this->input->post('URUT_HD');
		     $data['detail_pakai']=$this->webapi->post("hd/layanan/rincian_pakai_pasien",$param,false);
		     $this->load->view('tagihan/data_pakai_obat_pasien',$data);
		   }
		}
	}

	function detail_pakai_layanan()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NO_URUT_LAYANAN')))
		   {
		     $param['NO_URUT_LAYANAN']=$this->input->post('NO_URUT_LAYANAN');
		     $data=$this->webapi->post("kasir/kasir_pasien/detail_pakai_layanan",$param);
		     echo $data;
		   }
		}
	}

	function data_layanan()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_KELAS')))
		   {
		     $param['KD_KELAS']=$this->input->post('KD_KELAS');
		     $data['data_layanan']=$this->webapi->post("kasir/kasir_pasien/data_layanan_hd",$param,false);
		     $this->load->view('tagihan/data_layanan',$data);
		   }
		}
	}

	function detail_layanan()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_KELAS')) && !is_null($this->input->post('KD_LAYANAN')))
		   {
		     $param['KD_KELAS']=$this->input->post('KD_KELAS');
		     $param['KD_LAYANAN']=$this->input->post('KD_LAYANAN');
		     $data=$this->webapi->post("kasir/kasir_pasien/detail_tarif_layanan",$param);
		     echo $data;
		   }
		}
	}


}