<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	} 

	function index()
	{
	  if(!cek_menu('mutasi',$this->session->userdata('AKSES')[APP_ID]))
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
		$data['content']="gudang/v_mutasi";
		$data['data_petugas']=$this->webapi->post("farmasi/master/data_petugas",array(),false);
		$data['data_gudang']=$this->webapi->post("farmasi/gudang/data_gudang",array(),false);
		$param['KD_FORMULARIUM']='';
		$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		$data['data_obat']=$this->webapi->post("farmasi/formularium/data_stock_obat",$param,false);
		$this->load->view("page/content",$data);
	  }
	}

	function baru()
	{
	   if($_POST)
		{
			$kode_mutasi="";
			$urut="";
			$no_mutasi="";
			$code="404";
			$msg="Pembuatan kode mutasi tidak berhasil";
			$data['kode_mutasi']=$this->webapi->post("farmasi/gudang/kode_mutasi",array(),false);
			$data['urut_mutasi']=$this->webapi->post("farmasi/gudang/urut_mutasi",array(),false);
			if($data['kode_mutasi'] && $data['urut_mutasi'])
			{
				if($data['kode_mutasi']->response=='200' && $data['urut_mutasi']->response='200')
				{
					$kode_mutasi=$data['kode_mutasi']->data->KODE;
					$urut=$data['urut_mutasi']->data->URUT;
					$no_mutasi=nomor('MF',$urut);
					$code="200";
					$msg="OKE";
				}
				else
				{
					$kode_mutasi="";
					$urut="";
					$no_mutasi="";
					$code="404";
					$msg="Pembuatan kode mutasi tidak berhasil";
				}
			}
			else
			{
				$kode_mutasi="";
				$urut="";
				$no_mutasi="";
				$code="404";
				$msg="Pembuatan kode mutasi tidak berhasil";
			}
			$resp=array('kode_mutasi'=>$kode_mutasi,'urut'=>$urut,'no_mutasi'=>$no_mutasi,'code'=>$code,'msg'=>$msg);
			echo json_encode($resp);
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
			if(!is_null($this->input->post('KD_OBAT')))
			{
				$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
				$param['KD_OBAT']  =$this->input->post('KD_OBAT');
				$data['data_stock']=$this->webapi->post("farmasi/gudang/stock_obat",$param,false);
				$this->load->view('cari/cari_stok_gudang',$data);
			}
		}
	}


	function tabel_mutasi()
	{
		if($_POST)
		{
		   $param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		   $data['data_mutasi']=$this->webapi->post("farmasi/gudang/data_mutasi",$param,false);
		   $this->load->view('cari/cari_mutasi',$data);
		}
	}

	function pilih_mutasi()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_MUTASI')))
		   {
		     $param['KD_MUTASI']=$this->input->post('KD_MUTASI'); 
		     $data=$this->webapi->post("farmasi/gudang/detail_mutasi",$param);
		     echo $data;
		   }
		}
	}

	function detail_mutasi()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_MUTASI')))
		   {
		     $param['KD_MUTASI']=$this->input->post('KD_MUTASI'); 
		     $data=$this->webapi->post("farmasi/gudang/rincian_mutasi",$param);
		     echo $data;
		   }
		}
	}

	function rincian_mutasi()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_MUTASI')))
		   {
		     $param['KD_MUTASI']=$this->input->post('KD_MUTASI'); 
		     $data['detail_mutasi']=$this->webapi->post("farmasi/gudang/group_rincian_mutasi",$param,false);
		     $this->load->view('cari/cari_detail_mutasi',$data);
		   }
		}
	}	

	function kirim_mutasi()
	{
		$msg='';
		
		$param['KD_MUTASI']=$this->input->post('KD_MUTASI');
		$param['KD_GUDANG_ASAL']=$this->session->userdata('KD_GUDANG');
		$param['KD_GUDANG_TUJUAN']=$this->input->post('KD_GUDANG_TUJUAN');
		$param['URUT_NOMOR']=$this->input->post('URUT_NOMOR');
		$param['NO_MUTASI']=$this->input->post('NO_MUTASI');
		$param['TGL_MUTASI']=$this->input->post('TGL_MUTASI');
		$param['PENANGGUNG_JAWAB']=$this->input->post('PENANGGUNG_JAWAB');
		$param['KETERANGAN']=$this->input->post('KETERANGAN');
		$param['CATATAN']=$this->input->post('CATATAN');
		$param['TOT_NILAI_MUTASI']=$this->input->post('ALL_SUB_TOTAL');
		$param['STATUS_MUTASI']='1';
		$param['NIK_NYA']=$this->session->userdata('NIK');//nik update
		
		$detail=array();
		
		
		$ARR_KD_STOCK=$this->input->post('KD_STOCK');

		$hitung=count($this->input->post('KD_STOCK'));
		for ($i=0; $i < $hitung; $i++) { 
		  array_push($detail, 
		  			  array(
							'KD_STOCK'=>$ARR_KD_STOCK[$i],
							)
		  			);	
		}

		$param['DETAIL']=$detail;	
		
		$data=$this->webapi->post("farmasi/gudang/kirim_mutasi",$param,false);
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


	
}