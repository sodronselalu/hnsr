<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pakai_bahan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	} 

	function index()
	{
	  if(!cek_menu('pakai_bahan',$this->session->userdata('AKSES')[APP_ID]))
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
		$data['content']="gudang/v_pakai";
		$data['data_petugas']=$this->webapi->post("farmasi/master/data_petugas",array(),false);
		$param['KD_FORMULARIUM']='';
		$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		$data['data_obat']=$this->webapi->post("farmasi/formularium/data_stock_obat",$param,false);
		$data['data_unit']=$this->webapi->post("master/master/data_unit",array(),false);
		$this->load->view("page/content",$data);
	  }
	}

	function baru()
	{
	   if($_POST)
		{
			$kode="";
			$urut="";
			$no="";
			$code="404";
			$msg="Pembuatan kode tidak berhasil";
			$data['kode']=$this->webapi->post("farmasi/stok/kode_pakai",array(),false);
			$data['urut']=$this->webapi->post("farmasi/stok/urut_pakai",array(),false);
			if($data['kode'] && $data['urut'])
			{
				if($data['kode']->response=='200' && $data['urut']->response='200')
				{
					$kode=$data['kode']->data->KODE;
					$urut=$data['urut']->data->URUT;
					$no=nomor('PFAR',$urut);
					$code="200";
					$msg="OKE";
				}
				else
				{
					$kode="";
					$urut="";
					$no="";
					$code="404";
					$msg="Pembuatan kode tidak berhasil";
				}
			}
			else
			{
				$kode="";
				$urut="";
				$no="";
				$code="404";
				$msg="Pembuatan kode tidak berhasil";
			}
			$resp=array('kode'=>$kode,'urut'=>$urut,'no'=>$no,'code'=>$code,'msg'=>$msg);
			echo json_encode($resp);
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

	function stock_obat_focus()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('KD_OBAT')))
			{
				$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
				$param['KD_OBAT']  =$this->input->post('KD_OBAT');
				$data=$this->webapi->post("farmasi/gudang/stock_obat_focus",$param);
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


	function stock_obat()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('KD_OBAT')))
			{
				$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
				$param['KD_OBAT']  =$this->input->post('KD_OBAT');
				$data['data_stock']=$this->webapi->post("farmasi/gudang/stock_obat",$param,false);
				$this->load->view('cari/cari_stok_gudang',$data);
			}
		}
	}


	function tabel_pakai()
	{
		if($_POST)
		{
		   $param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		   $data['data_pakai']=$this->webapi->post("farmasi/stok/data_pakai",$param,false);
		   $this->load->view('cari/cari_pakai',$data);
		}
	}

	function pilih_pakai()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_PAKAI')))
		   {
		     $param['KD_PAKAI']=$this->input->post('KD_PAKAI'); 
		     $data=$this->webapi->post("farmasi/stok/detail_pakai",$param);
		     echo $data;
		   }
		}
	}

	function detail_pakai()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_PAKAI')))
		   {
		     $param['KD_PAKAI']=$this->input->post('KD_PAKAI'); 
		     $data=$this->webapi->post("farmasi/stok/rincian_pakai",$param);
		     echo $data;
		   }
		}
	}

	function detail_stock_pakai()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_PAKAI')))
		   {
		     $param['KD_PAKAI']=$this->input->post('KD_PAKAI');
			 $param['KD_STOCK']=$this->input->post('KD_STOCK');
			 $param['KD_OBAT']=$this->input->post('KD_OBAT');
		     $data=$this->webapi->post("farmasi/stok/detail_stock_pakai",$param);
		     echo $data;
		   }
		}
	}

	function rincian_pakai()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_PAKAI')))
		   {
		     $param['KD_PAKAI']=$this->input->post('KD_PAKAI'); 
		     $data['detail_pakai']=$this->webapi->post("farmasi/stok/rincian_pakai",$param,false);
		     $this->load->view('cari/cari_detail_pakai',$data);
		   }
		}
	}

	function stock_pakai()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_PAKAI')))
		   {
		     $param['KD_PAKAI']=$this->input->post('KD_PAKAI'); 
		     $data['detail_pakai']=$this->webapi->post("farmasi/stok/rincian_pakai",$param,false);
		     $this->load->view('detail_pakai_stock',$data);
		   }
		}
	}	

	function simpan_pakai()
	{
		$msg='';
		$param['KD_UNIT']=$this->session->userdata('KD_UNIT');
		$param['KD_PAKAI']=$this->input->post('KD_PAKAI');
		$param['URUT_NOMOR']=$this->input->post('URUT_NOMOR');
		$param['NO_PAKAI']=$this->input->post('NO_PAKAI');
		$param['IS_POST_AKUN']='F';
		$param['TGL_PAKAI']=$this->input->post('TGL_PAKAI');
		$param['PJ_PAKAI']=$this->input->post('PJ_PAKAI');
		$param['STATUS']="9"; //langsung posting akuntansi
		$param['KETERANGAN']=$this->input->post('KETERANGAN');
		$param['CATATAN']=$this->input->post('CATATAN');
		$param['HARGA_BELI']=$this->input->post('HARGA_BELI');
		$param['KD_DOKUMEN']='0706';
		$param['KD_STOCK']=$this->input->post('KD_STOCK');
		$param['QTY_PAKAI']=$this->input->post('QTY_PAKAI');
		$param['KONDISI']="0"; //DEFAULT BAIK
		$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		$param['NIK_NYA']=$this->session->userdata('NIK');//nik update
		$param['KD_KANTOR']=$this->session->userdata('KD_KANTOR');
		$data=$this->webapi->post("farmasi/stok/simpan_pakai",$param,false);
		
		if($data)
		{
		 	if($data->response=='200')
		 	{
		 		$msg=$data->msg;
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

    function hapus_pakai_stock()
	{
		$msg='';
		
		$param['KD_PAKAI']=$this->input->post('KD_PAKAI');
		$param['KD_STOCK']=$this->input->post('KD_STOCK');
		$data=$this->webapi->post("farmasi/stok/hapus_pakai_stock",$param,false);
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

	
}