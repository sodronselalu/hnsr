<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Terima_mutasi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	} 

	function index()
	{
	  if(!cek_menu('penerimaan_mutasi',$this->session->userdata('AKSES')[APP_ID]))
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
		$data['content']="gudang/v_terima_mutasi";
		$data['KD_MUTASI']="";
		$data['data_petugas']=$this->webapi->post("farmasi/master/data_petugas",array(),false);
		$data['data_gudang']=$this->webapi->post("farmasi/gudang/data_gudang",array(),false);
		$this->load->view("page/content",$data);
	  }
	}

	function lihat($KD_MUTASI)
	{
	  if(!cek_menu('penerimaan_mutasi',$this->session->userdata('AKSES')[APP_ID]))
	  {
		 redirect(base_url());
	  }
	  else
	  {
		
		if($KD_MUTASI != '')
		{
		     $data['KD_MUTASI']=$KD_MUTASI;
		     $data['header']="page/header";
			 $data['navbar']="page/navbar";
			 $data['sidebar']="page/sidebar";
			 $data['js']="page/js";
			 $data['footer']="page/footer";
			 $data['content']="gudang/v_terima_mutasi";
			 $data['data_petugas']=$this->webapi->post("farmasi/master/data_petugas",array(),false);
			 $data['data_gudang']=$this->webapi->post("farmasi/gudang/data_gudang",array(),false);
			 $this->load->view("page/content",$data);
		}
		else
		{
			redirect(base_url());
		}
	  	
	  }
	}

	function tabel_mutasi()
	{
		if($_POST)
		{
		   $param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		   $data['data_mutasi']=$this->webapi->post("farmasi/gudang/data_mutasi_tujuan",array('KD_GUDANG'=>$this->session->userdata('KD_GUDANG')),false);
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
		     $data=$this->webapi->post("farmasi/gudang/group_rincian_mutasi",$param);
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
		     $data['detail_mutasi']=$this->webapi->post("farmasi/gudang/rincian_mutasi",$param,false);
		     $this->load->view('cari/cari_detail_mutasi',$data);
		   }
		}
	}	

	function terima_mutasi()
	{
		$msg='';
		
		$param['KD_MUTASI']=$this->input->post('KD_MUTASI');
		$param['TGL_TERIMA']=$this->input->post('TGL_TERIMA');
		$param['PENERIMA']=$this->input->post('PENERIMA');
		$param['NIK_NYA']=$this->session->userdata('NIK');//nik update
		$param['KETERANGAN_TERIMA']=$this->input->post('KETERANGAN_TERIMA');
		
		$data=$this->webapi->post("farmasi/gudang/terima_mutasi",$param,false);
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

    function jml_notif()
    {
    	$jml="0";
    	if($_POST)
		{
		   $param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		   $data['jml_mutasi']=$this->webapi->post("farmasi/gudang/termutasi",array('KD_GUDANG'=>$this->session->userdata('KD_GUDANG')),false);
		   
		   if($data)
		   {
		   	 
		   	 if($data['jml_mutasi'])
		   	 {
		   	 	$jml=$data['jml_mutasi']->data->JML;
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
		   
		   $data['detail_mutasi']=$this->webapi->post("farmasi/gudang/detail_termutasi",array('KD_GUDANG'=>$this->session->userdata('KD_GUDANG')),false);
		   if($data)
		   {
		   	 $html='';
		   	 if($data['detail_mutasi']->response=='200')
		   	 {
		   	 		foreach ($data['detail_mutasi']->data as $dt) 
		   	 		{
		   	 		$html.='<li>
                      		<a href="'.base_url('index.php/gudang/terima_mutasi/lihat/'.$dt->KD_MUTASI).'">
                        		<span class="image"><i class="fa fa-shopping-cart"></i></span>
                      			<span>
                          			<span><b>'.$dt->NM_GUDANG_ASAL.'</b></span>
                          			<span class="time">'.$dt->TGL_MUTASI.'</span>
                        		</span>
                        		<br>
                          		<span>'.$dt->NM_PETUGAS_PJ.'</span>
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