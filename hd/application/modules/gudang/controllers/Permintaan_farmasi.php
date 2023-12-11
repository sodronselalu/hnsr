<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan_farmasi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	} 

	function index()
	{
	  if(!cek_menu('permintaan_farmasi',$this->session->userdata('AKSES')[APP_ID]))
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
		$data['content']="gudang/v_permintaan";
		$data['data_gudang']=$this->webapi->post("farmasi/gudang/data_gudang",array(),false);
		$data['data_satuan']=$this->webapi->post("farmasi/master/data_satuan",array(),false);
		$data['data_petugas']=$this->webapi->post("farmasi/master/data_petugas",array(),false);
		$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		$data['data_minta']=$this->webapi->post("farmasi/stok/data_permintaan",$param,false);
		$data['data_minta_sini']=$this->webapi->post("farmasi/stok/data_permintaan_sini",$param,false);
		$param['KD_FORMULARIUM']='';
		$data['data_obat']=$this->webapi->post("farmasi/formularium/data_stock_obat",$param,false);
		$this->load->view("page/content",$data);
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

	function data_permintaan()
	{
		if($_POST)
		{

			$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
			$data['data_minta']=$this->webapi->post("farmasi/stok/data_permintaan",$param,false);
			$this->load->view('detail_permintaan',$data);
		}
	}

	function data_permintaan_sini()
	{
		if($_POST)
		{

			$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
			$data['data_minta_sini']=$this->webapi->post("farmasi/stok/data_permintaan_sini",$param,false);
			$this->load->view('detail_permintaan_sini',$data);
		}
	}

	function pilih_minta()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('URUT_PERMINTAAN')))
		   {
		     $param['URUT_PERMINTAAN']=$this->input->post('URUT_PERMINTAAN'); 
		     $data=$this->webapi->post("farmasi/stok/detail_permintaan",$param);
		     echo $data;
		   }
		}
	}
	

	function simpan_permintaan()
	{
		$msg='';
		$param['URUT_PERMINTAAN']=$this->input->post('URUT_PERMINTAAN');
		$param['KD_GUDANG_MINTA']=$this->input->post('KD_GUDANG_TUJUAN');
		$param['KD_OBAT']=$this->input->post('KD_OBAT');
		$param['KD_SATUAN']=$this->input->post('KD_SATUAN');
		$param['PJ_PERMINTAAN']=$this->input->post('PJ_PERMINTAAN');
		$param['KETERANGAN']=$this->input->post('KETERANGAN');
		$param['JUMLAH']=$this->input->post('JUMLAH');
		$param['STATUS']='0';
		$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		$param['NIK_NYA']=$this->session->userdata('NIK');//nik update

		$data=$this->webapi->post("farmasi/stok/simpan_permintaan",$param,false);
		
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

    function verif_permintaan()
	{
		$msg='';
		$param['URUT_PERMINTAAN']=$this->input->post('URUT_PERMINTAAN');
		$param['PJ_SETUJUI']=$this->session->userdata('NIK');
		$param['NIK_NYA']=$this->session->userdata('NIK');//nik update
		$data=$this->webapi->post("farmasi/stok/verif_permintaan",$param,false);
		
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

    function hapus_permintaan()
	{
		$msg='';
		
		$param['URUT_PERMINTAAN']=$this->input->post('URUT_PERMINTAAN');
		$data=$this->webapi->post("farmasi/stok/hapus_permintaan",$param,false);
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

	function jml_notif()
    {
    	$jml="0";
    	if($_POST)
		{
		   $param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		   $data['jml_minta']=$this->webapi->post("farmasi/stok/diminta",$param,false);
		   
		   if($data)
		   {
		   	 
		   	 if($data['jml_minta'])
		   	 {
		   	 	$jml=$data['jml_minta']->data->JML;
		   	 }
		   }
		   
		}	
		echo $jml;
    }

    function notif()
	{
		if($_POST)
		{
			
		   $html="";
		   $param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		   
		   $data['detail_minta']=$this->webapi->post("farmasi/stok/data_permintaan_sini",$param,false);
		   if($data)
		   {
		   	 $html='';
		   	 if($data['detail_minta']->response=='200')
		   	 {
		   	 		foreach ($data['detail_minta']->data as $dt) 
		   	 		{
		   	 		$html.='<li>
                      		<a href="'.base_url('index.php/gudang/permintaan_farmasi').'">
                        		<span class="image"><i class="fa fa-bell-o"></i></span>
                      			<span>
                          			<span><b>'.$dt->NM_GUDANG.'</b></span>
                          			<span class="time">'.$dt->TGL_PERMINTAAN.'</span>
                        		</span>
                        		<br>
                          		<span>'.$dt->NM_PJ_PERMINTAAN.'</span>
                        		<span class="message">'.$dt->KETERANGAN.'</span>
                      		</a>
                    		</li>';
		   	 	}
		   	 }
		   }
		   echo $html;
		}
	}
}