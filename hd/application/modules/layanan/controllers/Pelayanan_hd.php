<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pelayanan_hd extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
	  if(!cek_menu('pelayanan_hd',$this->session->userdata('AKSES')[APP_ID]))
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
		$data['content']="layanan/pasien";
		$data['data_unit']=$this->webapi->post("master/master/data_unit_rajal",array(),false);
		$data['data_pasien']=$this->webapi->post("hd/layanan/data_register_ini",array('IOL'=>'O','KD_UNIT'=>'RPSP20'),false);
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
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$data['IOL']=$param['IOL'];
		$data['data_pasien']=$this->webapi->post("hd/layanan/data_register",$param,false);
		$this->load->view('layanan/tb_pasien',$data);
	}

	function cari_unit()
	{
		$IOL=$this->input->post('IOL');
		switch ($IOL) {
			case 'I':
				$data=$this->webapi->post("master/master/data_unit_ranap",array(),false);
				break;
			case 'O':
				$data=$this->webapi->post("master/master/data_unit_rajal",array(),false);
				break;	
		}
		if($data->response=='200')
		{
			echo '<select class="form-control selectpicker" id="KD_UNIT" name="KD_UNIT" onchange="cari()" data-live-search="true">';
			echo '<option value="">Semua Unit</option>';
			foreach ($data->data as $dt) 
			{
				echo "<option value='".$dt->KD_UNIT."' $cek>".$dt->NM_UNIT."</option>";
			}
			echo '</select>';
		}
	}

	function identitas_pasien()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NO_CM')))
			{
				$param['NO_CM']=$this->input->post('NO_CM');
				$data['data_pasien']=$this->webapi->post("layanan/layanan/identitas_pasien",$param,false);
				$data['data_pj']=$this->webapi->post("layanan/layanan/identitas_pj",$param,false);
				$this->load->view('cari/cari_data_pasien',$data);

				//print_r($data);
			}
		}
	}


	function pilih_pasien()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['IOL']=$this->input->post('IOL');
		$param['NO_URUT_INAP']=$this->input->post('NO_URUT_INAP');
		$data['data_pasien']=$this->webapi->post("hd/layanan/detail_register",$param,false);
	
		if($data['data_pasien'])
		{
			if($data['data_pasien']->response=='200')
			{				
				$data['dpjp_pasien']=$this->webapi->post("farmasi/pasien/dpjp_pasien",$param,false);
				$data['data_diagnosa']=$this->webapi->post("hd/layanan/data_diagnosa",$param,false);
				$data['data_tindakan']=$this->webapi->post("hd/layanan/data_tindakan",$param,false);
				$data['data_hd']=$this->webapi->post("hd/layanan/data_hd",$param,false);
				$data['data_petugas']=$this->webapi->post("farmasi/master/data_dokter",array(),false);
				//$data['data_pakai_layanan']=$this->webapi->post("kasir/kasir_pasien/data_pakai_layanan_hd",$param,false);
				$data['data_kelas']=$this->webapi->post("kasir/kasir_pasien/data_kelas",$param,false);
				$data['data_unit']=$this->webapi->post("kasir/kasir_pasien/data_unit",$param,false);
				$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
				$param['KD_FORMULARIUM']='';
				$data['data_obat']=$this->webapi->post("farmasi/formularium/data_stock_obat",$param,false);

 
				/* rahmat */
	
				$data['data_dokter']=$this->webapi->post("farmasi/master/data_dokter",array(),false); 
				$data['data_aturan_pakai']=$this->webapi->post("farmasi/master/data_aturan_pakai",array(),false);
				$data['data_waktu_pakai']=$this->webapi->post("farmasi/master/data_waktu_pakai",array(),false);
				$data['data_cara_pakai']=$this->webapi->post("layanan/layanan/cara_pemberian_obat",array(),false);

				$data['data_resep']=$this->webapi->post("layanan/layanan/data_resep",$param,false); 
				$data['for_resep']=$data;

				$param['KD_KELAS']=$data['data_pasien']->data->KD_KELAS;
				
				$data['data_daftar_lab']=$this->webapi->post("layanan/layanan/data_jual_pasien",$param,false);
				$data['data_periksa_lab']=$this->webapi->post("lab/master/data_periksa_kelas",$param,false);
				$data['for_lab']=$data;


				$data['data_job']=$this->webapi->post("ibs/master/data_job",array(),false);
				$data['data_op']=$this->webapi->post("ibs/master/data_op",array(),false);
				$param['NO_CM']=$data['data_pasien']->data->NO_CM;
				$data['data_plan_op']=$this->webapi->post("layanan/layanan/data_op",$param,false);
				$data['for_op']=$data;

				$ro['KD_UNIT_PENUNJANG']='102';
				$ro['KD_KELAS']=$param['KD_KELAS'];
				$data['data_plan_ro']=$this->webapi->post("layanan/layanan/data_periksa_ro",$param,false);
				$data['data_periksa_ro']=$this->webapi->post("ro/master/data_tarif_kelas",$ro,false);
				$data['for_rad']=$data;

				$usg['KD_UNIT_PENUNJANG']='104';
				$usg['KD_KELAS']=$param['KD_KELAS'];
				$data['data_plan_usg']=$this->webapi->post("layanan/layanan/data_periksa_usg",$param,false);
				$data['data_periksa_usg']=$this->webapi->post("ro/master/data_tarif_kelas",$usg,false);
				$data['for_usg']=$data;
				
				/*rahmat */
				$this->load->view('layanan/v_tindakan',$data);
			
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


	function cari_penyakit()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NM_PENYAKIT')))
		   {
		     $param['NM_PENYAKIT']=$this->input->post('NM_PENYAKIT');
		     $data=$this->webapi->post("master/master/data_nama_penyakit",$param,false);		     
		     if($data)
			 {  
				 if($data->response=='200')
				 {
				 	$i=0;
					 foreach ($data->data as $dt) {
						 $i+=1;
					echo "<div class='suggest' kode='".$dt->KD_PENYAKIT."' nama='".$dt->NM_PENYAKIT."' onclick='terima_penyakit(this)'>".strtoupper($dt->KD_PENYAKIT." : ").$dt->NM_PENYAKIT."</div>";
					 }
				 }
			 }
		   }
		}
	}

	function cari_tindakan()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NM_TINDAKAN')))
		   {
		     $param['NM_TINDAKAN']=$this->input->post('NM_TINDAKAN');
		     $data=$this->webapi->post("master/master/data_nama_tindakan",$param,false);	
		          
		     if($data)
			 {  
				 if($data->response=='200')
				 {
				 	$i=0;
					 foreach ($data->data as $dt) {
						 $i+=1;
					echo "<div class='suggest' kode='".$dt->KD_TINDAKAN."' nama='".$dt->NM_TINDAKAN."' onclick='terima_tindakan(this)'>".strtoupper($dt->KD_TINDAKAN." : ").$dt->NM_TINDAKAN."</div>";
					 }
				 }
			 }
		   }
		}
	}


	function simpan_master_penyakit()
	{
		$param['KD_PENYAKIT']=$this->input->post('KD_PENYAKIT');
		$param['NM_PENYAKIT']=$this->input->post('NM_PENYAKIT');
		$param['NM_PENYAKIT_INA']=$this->input->post('NM_PENYAKIT_INA');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("layanan/layanan/simpan_master_penyakit",$param,false); 
	
		if($data)
		{
		 if($data->response=='200')  
		 {
		 	$msg=$data->data;
		 }
		 else
		 {
		 	$msg="Data gagal disimpan!";
		 }
		}
		else
		{
			$msg="Terjadi kesalahan!";
		}
		echo $msg; 
	}
 


	function data_layanan()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_KELAS')))
		   {
		     $param['KD_KELAS']=$this->input->post('KD_KELAS');
		     $data['data_layanan']=$this->webapi->post("kasir/kasir_pasien/data_layanan_hd",$param,false);
		     $this->load->view('cari/cari_layanan',$data);
		   }
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

	function simpan_diagnosa()
	{
		$msg="";
		$param['NO_URUT_DIAGNOSA']=$this->input->post('NO_URUT_DIAGNOSA');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_JENIS_DIAGNOSA']=$this->input->post('KD_JENIS_DIAGNOSA');
		$param['KD_RUANG']=$this->session->userdata('KD_RUANG');
		$param['KD_UNIT']=$this->session->userdata('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['KD_PENYAKIT']=$this->input->post('KD_PENYAKIT');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("hd/layanan/simpan_diagnosa",$param,false);
	
		if($data)
		{
		 if($data->response=='200')
		 {
		 	$msg=$data->data;
		 }
		 else
		 {
		 	$msg="Data gagal disimpan!";
		 }
		}
		else
		{
			$msg="Terjadi kesalahan!";
		}
		echo $msg;
		
	}

	function hapus_diagnosa()
	{
		$msg="";
		$param['NO_URUT_DIAGNOSA']=$this->input->post('NO_URUT_DIAGNOSA');
		$data=$this->webapi->post("hd/layanan/hapus_diagnosa",$param,false);
	
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

	function reload_diagnosa()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NO_REG')))
		   {
				$param['NO_REG']=$this->input->post('NO_REG');
				$data['data_diagnosa']=$this->webapi->post("hd/layanan/data_diagnosa",$param,false);
				$this->load->view('cari/cari_diagnosa',$data);
			}
		}
	}

	function reload_diagnosa_depan()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NO_REG')))
		   {
				$param['NO_REG']=$this->input->post('NO_REG');
				$data_diagnosa=$this->webapi->post("hd/layanan/data_diagnosa",$param,false);
				if(!is_null($data_diagnosa))
      			{
        			if($data_diagnosa->response=='200')
        			{
          			foreach ($data_diagnosa->data as $dd) 
          			{
            			echo "<p><b>".$dd->KD_PENYAKIT."</b> ".$dd->NM_PENYAKIT."</p>";
          			}
        			}
      			}
			}
		}
	}


	function simpan_tindakan()
	{
		$msg="";
		$param['NO_URUT_TINDAKAN']=$this->input->post('NO_URUT_TINDAKAN');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_RUANG']=$this->session->userdata('KD_RUANG');
		$param['KD_UNIT']=$this->session->userdata('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['KD_TINDAKAN']=$this->input->post('KD_TINDAKAN');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("hd/layanan/simpan_tindakan",$param,false);
	
		if($data)
		{
		 if($data->response=='200')
		 {
		 	$msg=$data->data;
		 }
		 else
		 {
		 	$msg="Data gagal disimpan!";
		 }
		}
		else
		{
			$msg="Terjadi kesalahan!";
		}
		echo $msg;

	}

	function hapus_tindakan()
	{
		$msg="";
		$param['NO_URUT_TINDAKAN']=$this->input->post('NO_URUT_TINDAKAN');
		$data=$this->webapi->post("hd/layanan/hapus_tindakan",$param,false);
	
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

	function reload_tindakan()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NO_REG')))
		   {
				$param['NO_REG']=$this->input->post('NO_REG');
				$data['data_tindakan']=$this->webapi->post("hd/layanan/data_tindakan",$param,false);
				$this->load->view('cari/cari_tindakan',$data);
			}
		}
	}

	function reload_tindakan_depan()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NO_REG')))
		   {
				$param['NO_REG']=$this->input->post('NO_REG');
				$data_tindakan=$this->webapi->post("hd/layanan/data_tindakan",$param,false);
				if(!is_null($data_tindakan))
      			{
        			if($data_tindakan->response=='200')
        			{
          			foreach ($data_tindakan->data as $dd) 
          			{
            			echo "<p><b>".$dd->KD_TINDAKAN."</b> ".$dd->NM_TINDAKAN."</p>";
          			}
        			}
      			}
			}
		}
	}

	function simpan_hd()
	{
		$msg="";
		$param['URUT_HD']=$this->input->post('URUT_HD');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['IOL']=$this->input->post('IOL');
		$param['TGL_HD_AWAL']=$this->input->post('TGL_HD_AWAL');
		$param['TGL_HD_AKHIR']=$this->input->post('TGL_HD_AKHIR');
		$param['IS_CITO']=$this->input->post('IS_CITO');
		if($param['IS_CITO']=='')
		{
			$param['IS_CITO']='F';
		}
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("hd/layanan/simpan_hd",$param,false);
	
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

	function hapus_hd()
	{
		$msg="";
		$param['URUT_HD']=$this->input->post('URUT_HD');
		
		$data=$this->webapi->post("hd/layanan/hapus_hd",$param,false);
	
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
			$msg="Terjadi kesalahan! Pastikan penggunaan obat / bhp telah dihapus.";
		}
		echo $msg;
	}

	function reload_hd()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NO_REG')))
		   {
				$param['NO_REG']=$this->input->post('NO_REG');
				$data['data_hd']=$this->webapi->post("hd/layanan/data_hd",$param,false);
				$this->load->view('layanan/v_tindakant',$data);
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
		     $data=$this->webapi->post("hd/layanan/detail_hd",$param);
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

	function stock_pakai()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('URUT_HD')))
		   {
		     $param['URUT_HD']=$this->input->post('URUT_HD'); 
		     $data['detail_pakai']=$this->webapi->post("hd/layanan/rincian_pakai_pasien",$param,false);
		     $this->load->view('data_pakai_hd',$data);
		   }
		}
	}	

	function cari_stock_obat()
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

	function detail_stock_pakai()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_PAKAI')))
		   {
		     $param['KD_PAKAI']=$this->input->post('KD_PAKAI');
			 $param['KD_STOCK']=$this->input->post('KD_STOCK');
		     $data=$this->webapi->post("hd/layanan/detail_stock_pakai",$param);
		     echo $data;
		   }
		}
	}

	function hapus_pakai_stock()
	{
		$msg='';
		
		$param['KD_PAKAI']=$this->input->post('KD_PAKAI');
		$param['KD_STOCK']=$this->input->post('KD_STOCK');
		
		$data=$this->webapi->post("hd/layanan/hapus_pakai_stock_pasien",$param,false);
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

    function baru_pakai()
	{
	   if($_POST)
		{
			$kode="";
			$urut="";
			$no="";
			$code="404";
			$msg="Pembuatan kode tidak berhasil";
			$data['kode']=$this->webapi->post("hd/layanan/kode_pakai",array(),false);
			$data['urut']=$this->webapi->post("hd/layanan/urut_pakai",array(),false);
			if($data['kode'] && $data['urut'])
			{
				if($data['kode']->response=='200' && $data['urut']->response='200')
				{
					$kode=$data['kode']->data->KODE;
					$urut=$data['urut']->data->URUT;
					$no=nomor('PFP',$urut);
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
			return $resp;
	   }
	}

	function simpan_pakai()
	{
		$msg='';
		$kode=$this->baru_pakai();
		$param['KD_PAKAI']=$kode['kode'];
		$param['URUT_NOMOR']=$kode['urut'];
		$param['NO_PAKAI']=$kode['no'];
		$param['IS_POST_AKUN']='F';
		$param['TGL_PAKAI']=hari_ini();
		$param['PJ_PAKAI']=$this->session->userdata('NIK');
		$param['STATUS']='9';//posting sisan
		$param['KETERANGAN']='';
		$param['KD_DOKUMEN']='0706';
		$param['CATATAN']='';
		$param['URUT_HD']=$this->input->post('URUT_HD');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->session->userdata('KD_UNIT');
		$param['IOL']=$this->input->post('IOL');
		$param['KD_STOCK']=$this->input->post('KD_STOCK');
		$param['QTY_PAKAI']=$this->input->post('QTY_PAKAI');
		$param['HARGA_JUAL']=$this->input->post('HARGA_JUAL');
		$param['KONDISI']='0';//KONDISI BAIK
		$param['KD_GUDANG']=$this->session->userdata('KD_GUDANG');
		$param['NIK_NYA']=$this->session->userdata('NIK');//nik update
		$param['KD_KANTOR']=$this->session->userdata('KD_KANTOR');
		
		$data=$this->webapi->post("hd/layanan/simpan_pakai_pasien_hd",$param,false);
		
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



    /* RESEP */

	function baru_racikan()
	{
	   if($_POST)
		{
			$kode="";
			$code="404";
			$msg="Pembuatan kode tidak berhasil";
			$data['kode']=$this->webapi->post("farmasi/pasien/kode_racik",array(),false);
			
			if($data['kode'])
			{
				if($data['kode']->response=='200')
				{
					$kode=$data['kode']->data->KODE;
					$code="200";
					$msg="OKE";
				}
				else
				{
					$kode="";
					$code="404";
					$msg="Pembuatan kode tidak berhasil";
				}
			}
			else
			{
				$kode="";
				$code="404";
				$msg="Pembuatan kode tidak berhasil";
			}
			$resp=array('kode'=>$kode,'code'=>$code,'msg'=>$msg);
			echo json_encode($resp);
			
	   }
	}

	function baru_resep()
	{
	   if($_POST)
		{
			$kode="";
			$code="404";
			$msg="Pembuatan kode tidak berhasil";
			$data['kode']=$this->webapi->post("layanan/layanan/kode_resep",array(),false);
			
			if($data['kode'])
			{
				if($data['kode']->response=='200')
				{
					$kode=$data['kode']->data->KODE;
					$code="200";
					$msg="OKE";
				}
				else
				{
					$kode="";
					$code="404";
					$msg="Pembuatan kode tidak berhasil";
				}
			}
			else
			{
				$kode="";
				$code="404";
				$msg="Pembuatan kode tidak berhasil";
			}
			$resp=array('kode'=>$kode,'code'=>$code,'msg'=>$msg);
			echo json_encode($resp);
			
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

	function stock_obat()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_OBAT')))
		   {
		     $param['KD_OBAT']=$this->input->post('KD_OBAT'); 
		     $data=$this->webapi->post("layanan/layanan/cek_stok_obat",$param);
		     echo $data;
		   }
		}
	}

	function detail_resep()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('INDEX_RESEP')))
		   {
		     $param['INDEX_RESEP']=$this->input->post('INDEX_RESEP'); 
		     $data=$this->webapi->post("layanan/layanan/detail_resep",$param);
		     echo $data;
		   }
		}
	}

	function detail_resep_obat()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('INDEX_RESEP')))
		   {
		     $param['INDEX_RESEP']=$this->input->post('INDEX_RESEP'); 
		     $param['KD_OBAT']=$this->input->post('KD_OBAT'); 
		     $data=$this->webapi->post("layanan/layanan/detail_obat_resep",$param);
		     echo $data;
		   }
		}
	}

	function simpan_resep()
	{
		$msg="";
		$param['INDEX_RESEP']=$this->input->post('RESEP_INDEX_RESEP');
		$param['TGL_RESEP']=$this->input->post('RESEP_TGL_RESEP');
		$param['NO_REG']=$this->input->post('RESEP_NO_REG');
		$param['KD_UNIT']=$this->input->post('RESEP_KD_UNIT');
		$param['KD_RUANG']=$this->input->post('RESEP_KD_RUANG');
		$param['IOL']=$this->input->post('RESEP_IOL');
		$param['NIK_DOKTER']=$this->input->post('RESEP_NIK_DOKTER');
		$param['STATUS_RESEP']=$this->input->post('RESEP_STATUS_RESEP');
		$param['KD_OBAT']=$this->input->post('RESEP_KD_OBAT');
		$param['JUMLAH']=$this->input->post('RESEP_JUMLAH');
		$param['KD_SATUAN']=$this->input->post('RESEP_KD_SATUAN');
		$param['TGL_AWAL']=$this->input->post('RESEP_TGL_AWAL');
		$param['TGL_AKHIR']=$this->input->post('RESEP_TGL_AKHIR');
		$param['CATATAN']=$this->input->post('RESEP_CATATAN');
		$param['STATUS']='R';
		$param['KD_CARA_PEMBERIAN_OBAT']=$this->input->post('RESEP_KD_CARA_PEMBERIAN_OBAT');
		$param['KD_ATURAN_PAKAI']=$this->input->post('RESEP_KD_ATURAN_PAKAI');
		$param['KD_WAKTU_OBAT']=$this->input->post('RESEP_KD_WAKTU_OBAT');
		$param['DOSIS_PAKAI']=$this->input->post('RESEP_DOSIS_PAKAI');
		$param['NM_DOSIS_PAKAI']=$this->input->post('RESEP_NM_DOSIS_PAKAI');
		$param['STATUS_OBAT']='P';
		$param['KD_GROUP_RACIK']=$this->input->post('RESEP_KD_GROUP_RACIK');
		$param['NM_GROUP_RACIK']=$this->input->post('RESEP_NM_GROUP_RACIK');
		$param['QTY_RACIK']=$this->input->post('RESEP_QTY_RACIK');
		if($param['QTY_RACIK']=='')
		{
			$param['QTY_RACIK']='0';
		}
		$param['IS_RACIK']=$this->input->post('RESEP_IS_RACIK');
		if($param['IS_RACIK']=='')
		{
			$param['IS_RACIK']='F';
		}
		$param['NIK_NYA']=$this->session->userdata('NIK'); 


		$data=$this->webapi->post("layanan/layanan/simpan_detail_resep",$param,false);

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


	function hapus_resep_obat()
	{
		$msg="";
		$param['INDEX_RESEP']=$this->input->post('INDEX_RESEP');
		$param['KD_OBAT']=$this->input->post('KD_OBAT');
		$data=$this->webapi->post("layanan/layanan/hapus_detail_resep",$param,false);
	
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

	function reload_resep()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_resep']=$this->webapi->post("layanan/layanan/data_resep",$param,false); 
		$this->load->view('layanan/tb_resep_pasien',$data); 
	}

	function reload_obat_resep()
	{
		$msg="";
		$param['INDEX_RESEP']=$this->input->post('INDEX_RESEP');
		$data['data_obat_resep']=$this->webapi->post("layanan/layanan/data_obat_resep",$param,false); 
		$this->load->view('layanan/tb_obat_resep_pasien',$data); 
	}
	/* RESEP */

	/* LAB */
	function lihat_hasil_lab()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_JUAL')))
		   {
		     $param['KD_JUAL']=$this->input->post('KD_JUAL'); 
		     $data=$this->webapi->post("lab/daftar/data_hasil",$param);
		     echo $data;
		   } 
		}
	}

	function lihat_hasil_ro()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_JUAL')))
		   {
		     $param['KD_JUAL']=$this->input->post('KD_JUAL');
		     $data=$this->webapi->post("ro/daftar/detail_hasil_rad",$param);
		     echo $data;
		   }
		}
	}

	function cetak_hasil_ro($kode='',$rad='',$kelas=''){
      
      if($kode!='' && $rad!='' && $kelas!='')
      { 
        $param['KD_JUAL'] = $kode;
        $param['KD_RAD'] = $rad;
        $param['KD_KELAS'] = $kelas;
        $data['data_jual']=$this->webapi->post("ro/daftar/detail_jual",$param,false);
        $data['detail_hasil']=$this->webapi->post("ro/daftar/detail_periksa_rad_pasien",$param,false);
        $data['data_rs']=$this->webapi->post('auth/data_rs',array(),false);
        $html=$this->load->view('percetakan/vc_hasil_ro',$data,true);
        $this->cetak_lab($html,'Hasil RO '.$kode,'Hasil RO '.$kode);
      }
    }

//	function cetak_hasil_lab($kode='',$hasil){
//      
//      if($kode!='' && $hasil!='')
//      { 
//        $param['KD_JUAL'] = $kode;
//        $param['KD_HASIL'] = $hasil;
//        $data=$this->webapi->post("lab/daftar/cetak_hasil",$param,false);
//        if($data)
//        {
//            if($data->response=='200')
//            {
//                $html=$data->data->HASIL_HTML.' Tanggal Cetak : '.$data->data->TGL_CETAK;
//                $this->cetak_lab($html,'Hasil lab '.$kode,'Hasil lab '.$kode);
//            }
//        }
//      }
//    }

    function cetak_lab($html,$filename,$laporan_name){
        
        $pdf = new Pdf("P", "mm", 'A4' , true, 'UTF-8', false);
        $pdf->SetTitle($laporan_name);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetTopMargin(10);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);
        $pdf->SetAutoPageBreak(true,10);
        $pdf->SetAuthor('IT RSNH');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetFont('helvetica', 'R', 9);
        $pdf->setFontSubsetting(false);
        $pdf->AddPage();       
        //$pdf->Write(5, $html);
        ob_start();
        $pdf->writeHTML($html, true, false, false, false, '');
        ob_end_clean();
        $pdf->Output($filename.'.pdf', 'I');
       
    }

    function reload_lab()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_daftar_lab']=$this->webapi->post("layanan/layanan/data_jual_pasien",$param,false);
		$this->load->view('layanan/v_labt',$data); 
	}

    function simpan_lab()
	{
		$msg="";
		
		$data['kode_jual']=$this->webapi->post("lab/daftar/kode_jual",array(),false);
		$data['urut_jual']=$this->webapi->post("lab/daftar/urut_jual",array(),false);

		$param['KD_JUAL']=$data['kode_jual']->data->KODE;
		$param['KD_UNIT_PENUNJANG']='101';
		$param['KD_PENUNJANG']='1';
		$param['URUT_NOMOR']=$data['urut_jual']->data->URUT;
		$param['NO_JUAL']=nomor('JLAB',$param['URUT_NOMOR']);
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['KD_RUANG']=$this->input->post('KD_RUANG');
		$param['IOL']=$this->input->post('IOL');
		$param['TGL_JUAL']=hari_ini();//TGL PERMINTAAN
		$param['NIK_DOKTER']=$this->input->post('NIK_DPJP'); //dokter dpjp
		$param['STATUS']='0'; //0 : PROSES; 1 : SELESAI; 2 : DISERAHKAN; 3 : SUDAH DITAGIH; 9 : TELAH LUNAS
		$param['STATUS_PERIKSA']='-';//- : PERMINTAAN 0 : PROSES DAFTAR; 1 : AMBIL SAMPEL; 9 : HASIL SELESAI
		$param['KD_PPK']='';
		$param['TARIF_LUAR']='0';
		$param['IS_CITO']=$this->input->post('IS_CITO');
		if($param['IS_CITO']=='')
		{
			$param['IS_CITO']='F';
		}
		$param['IS_PAKET']='F';
		$param['IS_RUJUK_LUAR']='F';
		$param['TARIF_LUAR']='0';


		$param['KD_KELAS']=$this->input->post('KD_KELAS');


		$param['IS_TAGIH']='F';
		
		$ARR_KD_PERIKSA=$this->input->post('LAB_KD_PERIKSA');
		$ARR_TARIF=$this->input->post('LAB_TARIF');
		$ARR_KETERANGAN=$this->input->post('LAB_KETERANGAN');

		$detail=array();
		
		for ($i=0; $i < count($ARR_KD_PERIKSA); $i++) 
		{ 
			array_push($detail, array(
								'KD_PERIKSA'=>$ARR_KD_PERIKSA[$i],
								'HARGA_JUAL'=>$ARR_TARIF[$i],
								'QTY_JUAL'=>'1',
								'KETERANGAN'=>$ARR_KETERANGAN[$i]
								));
		}
		$param['DETAIL']=$detail;	

		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("layanan/layanan/simpan_pasien_lab",$param,false);
	
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

	function hapus_periksa_lab()
	{
		$msg="";
		$param['KD_JUAL']=$this->input->post('KD_JUAL');
		$param['KD_PERIKSA']=$this->input->post('KD_PERIKSA');
		$param['KD_KELAS']=$this->input->post('KD_KELAS');
		
		$data=$this->webapi->post("lab/daftar/hapus_periksa",$param,false);
	
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
	/* LAB */

	/* OP */


	function simpan_op()
	{
		$msg="";
		
		$param['KD_KELAS']=$this->input->post('KD_KELAS');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['IOL']=$this->input->post('IOL');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['KD_OP']=$this->input->post('KD_OP');
		
		$param['NO_REG_OP']=$this->input->post('NO_REG_OP');
		if($param['NO_REG_OP']=='')
		{
			$kode=$this->webapi->post("kasir/kasir_pasien/kode_admin",array(),false);
			$param['NO_REG_OP']=$kode->data->KODE;
		}

		$param['TGL_DAFTAR']=$this->input->post('TGL_DAFTAR');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['KETERANGAN']=$this->input->post('KETERANGAN');
		$param['STATUS_OP']='0'; //RENCANA
		$param['NIK_NYA']=$this->session->userdata('NIK');
		$param['IS_CITO']=$this->input->post('IS_CITO');
		if($param['IS_CITO']=='')
		{
			$param['IS_CITO']='F';
		}
		$param['NIK_TIM']=$param['NIK_DOKTER'];
		$param['KD_JOB_OP']='1'; //dokter operator
		$param['STATUS']='A';
		
		$data=$this->webapi->post("layanan/layanan/simpan_op",$param,false);
	
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

	function hapus_op()
	{
		$msg="";
		$param['NO_REG_OP']=$this->input->post('NO_REG_OP');
		$data=$this->webapi->post("ibs/operasi/hapus_op",$param,false);
	
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

	function detail_op()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NO_REG_OP')))
		   {
		     $param['NO_REG_OP']=$this->input->post('NO_REG_OP');
		     $data=$this->webapi->post("ibs/operasi/detail_op",$param);
		     echo $data;
		   }
		}
	}

	function data_plan_op()
	{
		if(!is_null($this->input->post('NO_CM')))
		{
			$param['NO_CM']=$this->input->post('NO_CM');
			$data['data_plan_op']=$this->webapi->post("ibs/operasi/data_op",$param,false);
			$this->load->view('layanan/v_opt',$data);
		}
	}
	/* OP */

	/* RO */

	function simpan_ro()
	{
		$msg="";

		$kode_jual=$this->webapi->post("ro/daftar/kode_jual",array(),false);
		$urut_jual=$this->webapi->post("ro/daftar/urut_jual",array(),false);

		$param['KD_JUAL']=$kode_jual->data->KODE;
		$param['KD_UNIT_PENUNJANG']='102';
		$param['KD_PENUNJANG']='2';
		$param['URUT_NOMOR']=$urut_jual->data->URUT;
		$param['NO_JUAL']=nomor('JRO',$urut_jual->data->URUT);
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['KD_RUANG']=$this->input->post('KD_RUANG');
		$param['IOL']=$this->input->post('IOL');
		$param['TGL_JUAL']=hari_ini();//TGL PERMINTAAN
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER'); //dokter dpjp
		$param['STATUS']='0'; //0 : PROSES; 1 : SELESAI; 2 : DISERAHKAN; 3 : SUDAH DITAGIH; 9 : TELAH LUNAS
		$param['STATUS_PERIKSA']='-';//0 : PROSES DAFTAR; 1 : AMBIL SAMPEL; 9 : HASIL SELESAI
		$param['CATATAN']=$this->input->post('CATATAN');
		$param['KD_KELAS']=$this->input->post('KD_KELAS');
		$param['IS_TAGIH']='F';
		$param['IS_CITO']=$this->input->post('IS_CITO');
		if($param['IS_CITO']=='')
		{
			$param['IS_CITO']='F';
		}

		$param['IS_PAKET']='F';
		$param['IS_RUJUK_LUAR']='F';
		$param['TARIF_LUAR']='0';

		$ARR_KD_RAD=$this->input->post('KD_RAD');
		$ARR_TARIF=$this->input->post('TARIF');

		$detail=array();
		
		for ($i=0; $i < count($ARR_KD_RAD); $i++) 
		{ 
			array_push($detail, array(
								'KD_RAD'=>$ARR_KD_RAD[$i],
								'HARGA_JUAL'=>$ARR_TARIF[$i],
								'QTY_JUAL'=>'1'
								));
		}
		$param['DETAIL']=$detail;	
		

		$param['NIK_NYA']=$this->session->userdata('NIK');
		if(count($ARR_KD_RAD)>0)
		{
			$data=$this->webapi->post("layanan/layanan/simpan_pasien_ro",$param,false);
			
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
		else
		{
			echo "Pemeriksaan belum diisi!";
		}
		
	}

	function simpan_usg()
	{
		$msg="";

		$kode_jual=$this->webapi->post("ro/daftar/kode_jual",array(),false);
		$urut_jual=$this->webapi->post("ro/daftar/urut_jual",array(),false);

		$param['KD_JUAL']=$kode_jual->data->KODE;
		$param['KD_UNIT_PENUNJANG']='104';
		$param['KD_PENUNJANG']='2';
		$param['URUT_NOMOR']=$urut_jual->data->URUT;
		$param['NO_JUAL']=nomor('JUSG',$urut_jual->data->URUT);
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['KD_RUANG']=$this->input->post('KD_RUANG');
		$param['IOL']=$this->input->post('IOL');
		$param['TGL_JUAL']=hari_ini();//TGL PERMINTAAN
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER'); //dokter dpjp
		$param['STATUS']='0'; //0 : PROSES; 1 : SELESAI; 2 : DISERAHKAN; 3 : SUDAH DITAGIH; 9 : TELAH LUNAS
		$param['STATUS_PERIKSA']='-';//0 : PROSES DAFTAR; 1 : AMBIL SAMPEL; 9 : HASIL SELESAI
		$param['CATATAN']=$this->input->post('CATATAN');
		$param['KD_KELAS']=$this->input->post('KD_KELAS');
		$param['IS_TAGIH']='F';
		$param['IS_CITO']=$this->input->post('IS_CITO');
		if($param['IS_CITO']=='')
		{
			$param['IS_CITO']='F';
		}

		$param['IS_PAKET']='F';
		$param['IS_RUJUK_LUAR']='F';
		$param['TARIF_LUAR']='0';

		$ARR_KD_RAD=$this->input->post('KD_RAD');
		$ARR_TARIF=$this->input->post('TARIF');

		$detail=array();
		
		for ($i=0; $i < count($ARR_KD_RAD); $i++) 
		{ 
			array_push($detail, array(
								'KD_RAD'=>$ARR_KD_RAD[$i],
								'HARGA_JUAL'=>$ARR_TARIF[$i],
								'QTY_JUAL'=>'1'
								));
		}
		$param['DETAIL']=$detail;	
		

		$param['NIK_NYA']=$this->session->userdata('NIK');
		if(count($ARR_KD_RAD)>0)
		{
			$data=$this->webapi->post("layanan/layanan/simpan_pasien_ro",$param,false);
			
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
		else
		{
			echo "Pemeriksaan belum diisi!";
		}
		
	}

	function hapus_periksa_ro()
	{
		$msg="";
		$param['KD_JUAL']=$this->input->post('KD_JUAL');
		$param['KD_RAD']=$this->input->post('KD_RAD');
		$param['KD_KELAS']=$this->input->post('KD_KELAS');
		
		$data=$this->webapi->post("ro/daftar/hapus_periksa",$param,false);
	
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

	function cari_plan_ro()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NO_REG')))
		   {
				$param['NO_REG']=$this->input->post('NO_REG');
				$data['data_plan_ro']=$this->webapi->post("layanan/layanan/data_periksa_ro",$param,false);
				$this->load->view('layanan/v_radt',$data);
			}
		}
	}


	function cari_plan_usg()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('NO_REG')))
		   {
				$param['NO_REG']=$this->input->post('NO_REG');
				$data['data_plan_usg']=$this->webapi->post("layanan/layanan/data_periksa_usg",$param,false);
				$this->load->view('layanan/v_usgt',$data);
			}
		}
	}
	/* RO + USG */

}
