<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ranap extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		
	  if(!cek_menu('daftar_pasien',$this->session->userdata('AKSES')[APP_ID])) 
	  {
			redirect(base_url());
	  }
	  else
	  {
	  	if($this->session->userdata('PILIH_PASIEN')!='')
	  	{
			$data['header']="page/header";
			$data['navbar']="page/navbar";
			$data['sidebar']="page/rm_sidebar";
			$data['js']="page/js";
			$data['footer']="page/footer";
			$data['content']="ranap/v_ranap";
			$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
			$param['NO_REG']=$data['dt']->NO_REG;
			$param['KD_UNIT']=$data['dt']->KD_UNIT;
			$param['KD_KELAS']=$data['dt']->KD_KELAS;
			$param['NO_CM']=$data['dt']->NO_CM;
			$param['IOL']='I';
			$data['data_dpjp_ri']=$this->webapi->post("emr/emr_ranap/data_dpjp_ri",$param,false);
			$data['data_ppjp_ri']=$this->webapi->post("emr/emr_ranap/data_ppjp_ri",$param,false);
			$data['data_dokter']=$this->webapi->post("emr/emr_rajal/data_dokter",array(),false); 
			$data['data_unit']=$this->webapi->post("emr/emr_ranap/data_unit",array(),false); 
			$data['data_kelas']=$this->webapi->post("emr/emr_ranap/data_kelas",array(),false); 
			$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
			$data['jenis_dpjp']=$this->webapi->post("emr/emr_ranap/data_jenis_dpjp",array(),false);
			$data['data_diagnosa']=$this->webapi->post('emr/emr_rajal/data_diagnosa',$param,false); 
			$data['data_diagnosa_masuk']=$this->webapi->post("emr/emr_rajal/data_diagnosa_masuk",$param,false);  
			$data['data_pakai_layanan']=$this->webapi->post("emr/emr_ranap/data_layanan_pasien",$param,false);
			$data['dokter_anestesi']=$this->webapi->post("emr/emr_rajal/dokter_spesialis",array('KD_SPESIALIS'=>'16'),false);
			$data['dokter_bedah']=$this->webapi->post("emr/emr_rajal/data_dokter",array(),false);
			$data['data_job']=$this->webapi->post("ibs/master/data_job",array(),false);
			$data['data_op']=$this->webapi->post("ibs/master/data_op",array(),false);	
			$data['data_plan_op']=$this->webapi->post("layanan/layanan/data_op",$param,false);

			$data['data_histori_permintaan_lab']=$this->webapi->post("emr/emr_rajal/data_histori_permintaan_lab",$param,false);
			$data['data_permintaan_lab']=$this->webapi->post("emr/emr_rajal/data_permintaan_lab",$param,false);
			$data['data_daftar_lab']=$this->webapi->post("emr/emr_rajal/data_permintaan_periksa_lab",$param,false);
			$data['data_periksa_lab']=$this->webapi->post("lab/master/data_periksa_kelas",$param,false);
			$param['KD_UNIT_PENUNJANG']='101';
			$data['data_rencana_lab']=$this->webapi->post("emr/emr_rajal/detail_rencana_penunjang",$param,false);
			$data['for_lab']=$data;

			$ro['NO_REG']=$param['NO_REG'];
			$ro['KD_UNIT']=$param['KD_UNIT'];
			$ro['KD_UNIT_PENUNJANG']='102';
			$ro['KD_KELAS']=$param['KD_KELAS'];
			$data['data_histori_permintaan_ro']=$this->webapi->post("emr/emr_rajal/data_histori_permintaan_ro",$param,false);
			$data['data_permintaan_ro']=$this->webapi->post("emr/emr_rajal/data_permintaan_ro",$param,false);
			$data['data_plan_ro']=$this->webapi->post("emr/emr_rajal/data_permintaan_periksa_ro",$ro,false);
			$data['data_periksa_ro']=$this->webapi->post("ro/master/data_tarif_kelas",$ro,false);
			$data['data_rencana_ro']=$this->webapi->post("emr/emr_rajal/detail_rencana_penunjang",$ro,false);
			$data['for_rad']=$data;

			$usg['NO_REG']=$param['NO_REG'];
			$usg['KD_UNIT']=$param['KD_UNIT'];
			$usg['KD_UNIT_PENUNJANG']='104';
			$usg['KD_KELAS']=$param['KD_KELAS'];
			$data['data_histori_permintaan_usg']=$this->webapi->post("emr/emr_rajal/data_histori_permintaan_usg",$param,false);
			$data['data_permintaan_usg']=$this->webapi->post("emr/emr_rajal/data_permintaan_usg",$param,false);
			$data['data_plan_usg']=$this->webapi->post("emr/emr_rajal/data_permintaan_periksa_usg",$usg,false);
			$data['data_periksa_usg']=$this->webapi->post("ro/master/data_tarif_kelas",$usg,false);
			$data['data_rencana_usg']=$this->webapi->post("emr/emr_rajal/detail_rencana_penunjang",$usg,false);
			$data['for_usg']=$data;

			$data['data_jenis']=$this->webapi->post("gizi/master/data_jenis",array(),false);
			$data['data_konsistensi']=$this->webapi->post("gizi/master/data_konsistensi",array(),false);
			$data['data_waktu_diet']=$this->webapi->post("gizi/master/data_waktu_diet",array(),false);
			$data['data_pesan_diet']=$this->webapi->post("gizi/layanan/data_pesan_pasien",$param,false);
			//$data['data_petugas_diet']=$this->webapi->post("farmasi/master/data_petugas",array(),false);
			$data['for_diet']=$data;


			$this->load->view("page/rm_content",$data);
		}
		else
		{
			redirect(base_url());
		}
	  }
	}

	function simpan_dpjp()
	{
		$msg="";
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['KD_JENIS_DPJP']=$this->input->post('KD_JENIS_DPJP');  
		$param['NO_URUT_INAP']=$this->input->post('NO_URUT_INAP');     
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_dpjp",$param,false);  
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


	function simpan_ppjp()
	{
		$msg="";
		$param['NIK_PERAWAT']=$this->input->post('NIK_PERAWAT');
		$param['NO_URUT_INAP']=$this->input->post('NO_URUT_INAP');     
		$param['NIK_NYA']=$this->session->userdata('NIK');
		$data=$this->webapi->post("emr/emr_ranap/simpan_ppjp",$param,false);  
      	//print_r($param);
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


	function reload_dpjp()  
	{
		$param['NO_REG']=$this->input->post('NO_REG');  
		$data['data_dpjp_ri']=$this->webapi->post("emr/emr_ranap/data_dpjp_ri",$param,false);   
		$this->load->view('cari/cari_dpjp',$data);
		
	}

	function reload_dpjp_depan()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NO_REG')))
			{
				$param['NO_REG']=$this->input->post('NO_REG');  
				$data_dpjp_ri=$this->webapi->post("emr/emr_ranap/data_dpjp_ri",$param,false);
				if(!is_null($data_dpjp_ri))
				{
					if($data_dpjp_ri->response=='200')
					{
						foreach ($data_dpjp_ri->data as $dd) 
						{
							echo "<div><b class='blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".strtoupper($dd->NAMA)."</b></div>";
						}
					}
				}
			}
		}
	}

	function reload_pilih_dpjp()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NO_REG')))
			{
				$param['NO_REG']=$this->input->post('NO_REG');  
				$data_dpjp_ri=$this->webapi->post("emr/emr_ranap/data_dpjp_ri",$param,false);
				if(!is_null($data_dpjp_ri))
				{
					echo '<select class="form-control selectpicker" id="NIK_DOKTER_DPJP" name="NIK_DOKTER_DPJP" data-live-search="true">';
					if($data_dpjp_ri->response=='200')
					{
						foreach ($data_dpjp_ri->data as $dd) 
						{
							echo '<option value="'.$dd->NIK_DOKTER.'">'.$dd->NAMA.'</option>';
						}
					}
					echo '</select>';
				}
			}
		}
	}

	function rm_rajal()
	{
		if(!cek_menu('rm_rajal',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_rm_rajal";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$this->load->view("page/rm_content",$data);
			}
		}
	}


	function set_dpjp()
	{
		$param['NO_REG']=$this->input->post('NO_REG');  
		$dpjp=$this->webapi->post("emr/emr_ranap/data_dpjp_ri",$param,false);
		$pasien['ARR_DPJP']=(array)$dpjp;
		$this->session->set_userdata($pasien);
	}


	function reload_ppjp()  
	{
		$param['NO_REG']=$this->input->post('NO_REG');  
		$data['data_ppjp_ri']=$this->webapi->post("emr/emr_ranap/data_ppjp_ri",$param,false);   
		$this->load->view('cari/cari_ppjp',$data);
		
	}

	function reload_ppjp_depan()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NO_REG')))
			{
				$param['NO_REG']=$this->input->post('NO_REG');  
				$data_ppjp_ri=$this->webapi->post("emr/emr_ranap/data_ppjp_ri",$param,false);
				if(!is_null($data_ppjp_ri))
				{
					if($data_ppjp_ri->response=='200')
					{
						foreach ($data_ppjp_ri->data as $dp) 
						{
							echo "<div><b class='blue'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".strtoupper($dp->NAMA)."</b></div>";
						}
					}
				}
			}
		}
	}


	function hapus_dpjp()
	{
		$msg="";
		$param['NO_URUT_INAP']=$this->input->post('NO_URUT_INAP');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_dpjp",$param,false);
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

	function hapus_ppjp()
	{
		$msg="";
		$param['NO_URUT_INAP']=$this->input->post('NO_URUT_INAP');
		$param['NIK_PERAWAT']=$this->input->post('NIK_PERAWAT');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_ppjp",$param,false);

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
				 else
				 {
				 	echo "0";
				 }
			 }

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
				$data_diagnosa=$this->webapi->post("emr/emr_rajal/data_diagnosa",$param,false);
				if(!is_null($data_diagnosa))
				{
					if($data_diagnosa->response=='200')
					{
						$tmp_d="";
						$d_no=0;
						foreach ($data_diagnosa->data as $dd) 
						{
							
                                 $d_no+=1;
                                 echo "<button type='button' class='btn btn-xs btn-round btn-danger' value='".$dd->NO_URUT_DIAGNOSA."' onclick='hapus_diagnosa(this.value)'><span class='fa fa-trash'></span></button>&emsp;<b>".$dd->KD_PENYAKIT."</b> ".$dd->NM_PENYAKIT."<br><br>";
						}
				

                    }
                   
				}
			}
		}
	}

	function simpan_diagnosa()
	{
		$msg="";
		$param['NO_URUT_DIAGNOSA']=$this->input->post('NO_URUT_DIAGNOSA');  
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_JENIS_DIAGNOSA']=$this->input->post('KD_JENIS_DIAGNOSA');
		$param['KD_RUANG']=$this->input->post('KD_RUANG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['KD_PENYAKIT']=$this->input->post('KD_PENYAKIT');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_rajal/simpan_diagnosa",$param); 
		echo $data;
		
	}

	function hapus_diagnosa()
	{
		$msg="";
		$param['NO_URUT_DIAGNOSA']=$this->input->post('NO_URUT_DIAGNOSA');
		$data=$this->webapi->post("emr/emr_rajal/hapus_diagnosa",$param,false);

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

	function simpan_layanan()
	{
		$msg="";
		$param['NO_URUT_LAYANAN']=$this->input->post('NO_URUT_LAYANAN');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_LAYANAN']=$this->input->post('KD_LAYANAN');
		$param['KD_KELAS']=$this->input->post('KD_KELAS');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['KD_UNIT_INDUK']=$this->input->post('KD_UNIT_INDUK');
		$param['TGL_LAYANAN']=$this->input->post('TGL_LAYANAN');
		$param['IOL']=$this->input->post('IOL_LAYAN');
		$param['QTY']=$this->input->post('QTY_LAYANAN');
		$param['TARIF']=$this->input->post('TARIF_LAYANAN');
		$param['TOTAL']=$this->input->post('TOTAL_LAYANAN');
		$param['NIK_PELAKSANA']=$this->input->post('NIK_DOKTER3');
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


	function reload_layan()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NO_REG')))
			{
				$param['NO_REG']=$this->input->post('NO_REG');
				$param['IOL']=$this->input->post('IOL_LAYAN');
				$param['KD_UNIT']=$this->input->post('KD_UNIT');
				$data['data_pakai_layanan']=$this->webapi->post("emr/emr_ranap/data_layanan_pasien",$param,false);
				$this->load->view('tagihan/v_tagihant',$data);
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
				$param['IOL']=$this->input->post('IOL_LAYAN'); 
				$data['data_layanan']=$this->webapi->post("kasir/kasir_pasien/data_layanan_unit",$param,false);
				$this->load->view('tagihan/entri_layanan',$data);
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

	function reload_histori_penunjang()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['LIMIT']=$this->input->post('LIMIT');

		$TGL=explode(' - ',$this->input->post('TGL'));
		$param['TGL_AWAL']=$TGL[0];
		$param['TGL_AKHIR']=$TGL[1];

		$data_histori_permintaan_lab=$this->webapi->post("emr/emr_rajal/data_histori_permintaan_lab",$param,false);
		$data_histori_permintaan_ro=$this->webapi->post("emr/emr_rajal/data_histori_permintaan_ro",$param,false);
		$data_histori_permintaan_usg=$this->webapi->post("emr/emr_rajal/data_histori_permintaan_usg",$param,false);


		echo '<h4><b>Histori Pemeriksaan Laboratorium</b></h4>';
		echo '<div id="data_histori_lab_depan">';
        if(!is_null($data_histori_permintaan_lab))
        {
          if($data_histori_permintaan_lab->response=='200')
          {
            foreach ($data_histori_permintaan_lab->data as $dhislab) 
            {   
              echo "&emsp;&emsp;<b>".$dhislab->TGL_INPUT."</b> <b class='green'>".$dhislab->URAIAN_PERIKSA."</b> ";
              if($dhislab->STATUS_PERIKSA=='9')
              {
                echo '<button type="button" class="btn btn-round btn-success" title="Lihat hasil?" value="'.$dhislab->KD_JUAL.'" onclick="lihat_hasil_lab_depan(this.value)"><i class="fa fa-file-archive-o"></i></button>';
                echo "<div id='data_hasil_depan".$dhislab->KD_JUAL."'></div>";  
              }
              else
              {
                echo "<br>&emsp;&emsp;<b class='blue'>Hasil dalam proses</b>";
              }
            }
          }
        }
                        
        echo '</div>';
        echo '<br>';
        echo '<h4><b>Histori Pemeriksaan Radiologi</b></h4>';
        echo '<div id="data_histori_ro_depan">';
                            
        if(!is_null($data_histori_permintaan_ro))
        {
          if($data_histori_permintaan_ro->response=='200')
          {
            foreach ($data_histori_permintaan_ro->data as $dhisro) 
            {
              echo "&emsp;&emsp;<b>".$dhisro->TGL_INPUT."</b> <b class='green'>".$dhisro->URAIAN_PERIKSA."</b> ";
              if($dhisro->STATUS_PERIKSA=='9')
              {
                  echo '<button type="button" class="btn btn-round btn-success" title="Lihat hasil?" value="'.$dhisro->KD_JUAL.'" onclick="lihat_hasil_rad_depan(this.value)"><i class="fa fa-file-archive-o"></i></button>';
                  echo '<table>';
                    echo '<tr><td>';
                      echo "<div id='data_hasil_ro_depan".$dhisro->KD_JUAL."'></div>";
                    echo '</td>';
                    echo '<td>';
                      echo "<div id='lis_foto_ro_depan".$dhisro->KD_JUAL."'></div>";
                    echo '</td>';
                  echo '</tr>';
                  echo '</table>';      
               }
               else
               {
                 echo "<br>&emsp;&emsp;<b class='blue'>Hasil dalam proses</b><br>";
               }
             }
           }
         }
                             
         echo '</div>';
         echo '<br>';
         echo '<h4><b>Histori Pemeriksaan USG Spesialis</b></h4>';
         echo '<div id="data_histori_usg_depan">';                     
         if(!is_null($data_histori_permintaan_usg))
         {
           if($data_histori_permintaan_usg->response=='200')
           {
             foreach ($data_histori_permintaan_usg->data as $dhisus) 
             {
               echo "&emsp;&emsp;<b>".$dhisus->TGL_INPUT."</b> <b class='green'>".$dhisus->URAIAN_PERIKSA."</b> ";
               if($dhisus->STATUS_PERIKSA=='9')
               {
                   echo '<button type="button" class="btn btn-round btn-success" title="Lihat hasil?" value="'.$dhisus->KD_JUAL.'" onclick="lihat_hasil_usg_depan(this.value)"><i class="fa fa-file-archive-o"></i></button>';
                   echo '<table>';
                     echo '<tr><td>';
                       echo "<div id='data_hasil_usg_depan".$dhisus->KD_JUAL."'></div>";
                     echo '</td>';
                     echo '<td>';
                       echo "<div id='lis_foto_usg_depan".$dhisus->KD_JUAL."'></div>";
                     echo '</td>';
                   echo '</tr>';
                   echo '</table>';
                                        
                                        
               }
               else
               {
                 echo "<br>&emsp;&emsp;<b class='blue'>Hasil dalam proses</b><br>";
               }
             }
           }
         }
                           
        echo '</div>';
      
	}

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

	function cetak_hasil_lab($kode='',$hasil){

		if($kode!='' && $hasil!='')
		{ 
			$param['KD_JUAL'] = $kode;
			$param['KD_HASIL'] = $hasil;
			$data=$this->webapi->post("lab/daftar/cetak_hasil",$param,false);
			if($data)
			{
				if($data->response=='200')
				{
					$html=$data->data->HASIL_HTML.' Tanggal Cetak : '.$data->data->TGL_CETAK;
					$this->cetak_lab($html,'Hasil lab '.$kode,'Hasil lab '.$kode,$kode);
				}
			}
		}
	}

	function qrcode_style()
    {
        $style = array(
            'border' => true,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 100, // width of a single module in points
            'module_height' => 40 // height of a single module in points
        );
    }

	function cetak_lab($html,$filename,$laporan_name,$kode)
	{
        
        $pdf = new Pdf("P", "mm", 'A4' , true, 'UTF-8', false);
        $pdf->SetTitle($laporan_name);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetTopMargin(0);
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
        $path=asset_url('asset/img/penunjang.jpg');
        $img='<img src="'.$path.'">';
        $html=$img.$html;
        $pdf->writeHTML($html, true, false, false, false, '');
        $url='https://rsnurhidayah.com/find.php?id='.$kode;
        $pdf->write2DBarcode($url, 'QRCODE,Q', 170, 67, 20, 20, $this->qrcode_style(), 'N');
        $pdf->Text(171, 88, 'Scan Disini');
        ob_end_clean();
        $pdf->Output($filename.'.pdf', 'I');
       
    }

	function reload_lab()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_daftar_lab']=$this->webapi->post("emr/emr_rajal/data_permintaan_periksa_lab",$param,false);
		$this->load->view('ranap/penunjang/v_labt',$data); 
	}

	function reload_lab_depan()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$data=$this->webapi->post("emr/emr_rajal/data_permintaan_lab",$param,false);
		if(!is_null($data))
		{
			if($data->response=='200')
			{
	
				foreach ($data->data as $dlab) 
				{
					
						$lab_kritis="";
                        if($dlab->STATUS_KRITIS=='K')
                        {
                          $lab_kritis='<b class="red blink_me">KRITIS</b>';
                        }
						echo "&emsp;&emsp;".$lab_kritis." <b>".$dlab->TGL_INPUT."</b> <b class='green'>".$dlab->URAIAN_PERIKSA."</b> ";
                        if($dlab->STATUS_PERIKSA=='9')
                        {
                            echo '<button type="button" class="btn btn-round btn-success" title="Lihat hasil?" value="'.$dlab->KD_JUAL.'" onclick="lihat_hasil_lab_depan(this.value)"><i class="fa fa-file-archive-o"></i></button>';
                            echo "<div id='data_hasil_depan".$dlab->KD_JUAL."'></div>";  
                        }
                        else
                        {
                         	echo "<br>&emsp;&emsp;<b class='blue'>Hasil dalam proses</b><br>";
                        }
                      	
					
				}
			}
		}
		
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
		$param['CATATAN']=$this->input->post('CATATAN');
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
		if(is_array($ARR_KD_PERIKSA))
		{
			for ($i=0; $i < count($ARR_KD_PERIKSA); $i++) 
			{ 
				array_push($detail, array(
					'KD_PERIKSA'=>$ARR_KD_PERIKSA[$i],
					'HARGA_JUAL'=>$ARR_TARIF[$i],
					'QTY_JUAL'=>'1',
					'KETERANGAN'=>$ARR_KETERANGAN[$i]
				));
			}
		}
		$param['DETAIL']=$detail;	

		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_rajal/simpan_pasien_lab",$param,false);

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
		$ARR_KETERANGAN=$this->input->post('RO_KETERANGAN');

		$detail=array();
		if(is_array($ARR_KD_RAD))
		{
			for ($i=0; $i < count($ARR_KD_RAD); $i++) 
			{ 
				array_push($detail, array(
					'KD_RAD'=>$ARR_KD_RAD[$i],
					'HARGA_JUAL'=>$ARR_TARIF[$i],
					'QTY_JUAL'=>'1',
					'KETERANGAN'=>$ARR_KETERANGAN[$i],
				));
			}
		}
		$param['DETAIL']=$detail;	
		

		$param['NIK_NYA']=$this->session->userdata('NIK');
		if(count($ARR_KD_RAD)>0)
		{
			$data=$this->webapi->post("emr/emr_rajal/simpan_pasien_ro",$param,false);
			
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
				$data['data_plan_ro']=$this->webapi->post("emr/emr_rajal/data_permintaan_periksa_ro",$param,false);
				$this->load->view('ranap/penunjang/v_radt',$data);
			}
		}
	}


	function reload_ro_depan()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$data=$this->webapi->post("emr/emr_rajal/data_permintaan_ro",$param,false);
		if(!is_null($data))
		{
			if($data->response=='200')
			{
	
				foreach ($data->data as $dro) 
				{
					
					$ro_kritis="";
                    if($dro->STATUS_KRITIS=='K')
                    {
                      $ro_kritis='<b class="red blink_me">KRITIS</b>';
                    }
					echo "&emsp;&emsp;".$ro_kritis." <b>".$dro->TGL_INPUT."</b> <b class='green'>".$dro->URAIAN_PERIKSA."</b> ";
					if($dro->STATUS_PERIKSA=='9')
                    {
                        echo '<button type="button" class="btn btn-round btn-success" title="Lihat hasil?" value="'.$dro->KD_JUAL.'" onclick="lihat_hasil_rad_depan(	this.value)"><i class="fa fa-file-archive-o"></i></button>';
                        echo "<div id='data_hasil_ro_depan".$dro->KD_JUAL."'></div>";
                    }
                    else
                    {
                    	echo "<br>&emsp;&emsp;<b class='blue'>Hasil dalam proses</b><br>";
                    }
				}
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

	function display_hasil($no)
	{
		
		     $param['NO_FILE']=$no;
		     
		     $data=$this->webapi->post("ro/daftar/detail_foto_rad_pasien",$param,false);
		     if($data)
		     {
		     	if($data->response=='200')
		     	{
						// Read image path, convert to base64 encoding
						$imageData = base64_encode(file_get_contents($data->data->LINK));
						$imgdata = base64_decode($imageData);
						$f = finfo_open();
						$mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
						$src = 'data: '.$mime_type.';base64,'.$imageData;
						echo '<img src="' . $src . '">';
		     	}
		     	else
		     	{
		     		echo "Data belum diupload.";
		     	}
		     }
	
	}

	function data_upload_rad_pasien()
	{
		if($_POST)
		{
		   if(!is_null($this->input->post('KD_JUAL')) && !is_null($this->input->post('KD_RAD')) && !is_null($this->input->post('KD_KELAS')))
		   {
		     $param['KD_JUAL']=$this->input->post('KD_JUAL');
		     $param['KD_RAD']=$this->input->post('KD_RAD');
		     $param['KD_KELAS']=$this->input->post('KD_KELAS');
		     
		     $data=$this->webapi->post("ro/daftar/data_upload_rad_pasien",$param);
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
			$this->cetak_ro($html,'Hasil RO '.$kode,'Hasil RO '.$kode,$kode);
			
		}
	}

	function cetak_ro($html,$filename,$laporan_name,$kode){
        
        $pdf = new Pdf("P", "mm", 'A4' , true, 'UTF-8', false);
        $pdf->SetTitle($laporan_name);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetTopMargin(0);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);
        $pdf->SetAutoPageBreak(true,10);
        $pdf->SetAuthor('IT RSNH');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetFont('helvetica', 'R', 10);
        $pdf->AddPage();       
        //$pdf->Write(5, $html);
        ob_start();
        $html="<br><br><br><br><br><br><br><br><br><br><br><br><br><br>".$html;
        $pdf->Image(asset_url('asset/img/penunjang.jpg'),0,0, 210, 0, 'JPG', '', 'T', false, 100, 'C', false, false, 0, true, false, false);
        $pdf->writeHTML($html, true, false, false, false, '');
        ob_end_clean();
        $pdf->Output($filename.'.pdf', 'I');
       
    }

    function reload_usg_depan()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$data=$this->webapi->post("emr/emr_rajal/data_permintaan_usg",$param,false);
		if(!is_null($data))
		{
			if($data->response=='200')
			{
	
				foreach ($data->data as $dro) 
				{
					
					$usg_kritis="";
                    if($dro->STATUS_KRITIS=='K')
                    {
                      $usg_kritis='<b class="red blink_me">KRITIS</b>';
                    }
					echo "&emsp;&emsp;".$usg_kritis." <b>".$dro->TGL_INPUT."</b> <b class='green'>".$dro->URAIAN_PERIKSA."</b> ";
					if($dro->STATUS_PERIKSA=='9')
                    {
                        echo '<button type="button" class="btn btn-round btn-success" title="Lihat hasil?" value="'.$dro->KD_JUAL.'" onclick="lihat_hasil_usg_depan(	this.value)"><i class="fa fa-file-archive-o"></i></button>';
                        echo "<div id='data_hasil_usg_depan".$dro->KD_JUAL."'></div>";
                    }
                    else
                    {
                    	echo "<br>&emsp;&emsp;<b class='blue'>Hasil dalam proses</b><br>";
                    }
				}
			}
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
		$ARR_KETERANGAN=$this->input->post('USG_KETERANGAN');

		$detail=array();
		if(is_array($ARR_KD_RAD))
		{
			for ($i=0; $i < count($ARR_KD_RAD); $i++) 
			{ 
				array_push($detail, array(
					'KD_RAD'=>$ARR_KD_RAD[$i],
					'HARGA_JUAL'=>$ARR_TARIF[$i],
					'QTY_JUAL'=>'1',
					'KETERANGAN'=>$ARR_KETERANGAN[$i],
				));
			}
		}
		$param['DETAIL']=$detail;	
		

		$param['NIK_NYA']=$this->session->userdata('NIK');
		if(count($ARR_KD_RAD)>0)
		{
			$data=$this->webapi->post("emr/emr_rajal/simpan_pasien_ro",$param,false);
			
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

	

	function cari_plan_usg()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NO_REG')))
			{
				$param['NO_REG']=$this->input->post('NO_REG');
				$data['data_plan_usg']=$this->webapi->post("emr/emr_rajal/data_permintaan_periksa_usg",$param,false);
				$this->load->view('ranap/penunjang/v_usgt',$data);
			}
		}
	}

	/* DIET */

	function baru_diet()
	{
		if($_POST)
		{
			$kode="";
			
			$code="404";
			$msg="Pembuatan kode tidak berhasil";
			$data['kode']=$this->webapi->post("gizi/layanan/kode_pesan",array(),false);
			
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

	function data_pesan()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('KD_PESAN_DIET')))
			{
				$param['KD_PESAN_DIET']=$this->input->post('KD_PESAN_DIET');
				$data['data_pesan']=$this->webapi->post("gizi/layanan/data_pesan_diet",$param,false);
				$this->load->view('cari/cari_pesan_diet',$data);
			}
		}
	}


	function simpan_pesan()
	{
		$msg="";
		$param['KD_PESAN_DIET']=$this->input->post('KD_PESAN_DIET');
		$param['TGL_PESAN']=$this->input->post('TGL_PESAN');
		$param['NIK_PESAN']=$this->session->userdata('NIK');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['KD_KELAS']=$this->input->post('KD_KELAS');
		$param['IOL']=$this->input->post('IOL');
		$param['IS_RISIKO']=$this->input->post('IS_RISIKO');
		if($param['IS_RISIKO']=='')
		{
			$param['IS_RISIKO']='F';	
		}
		$param['KETERANGAN']='';//$this->input->post('KETERANGAN');
		$param['IS_LAMA']=$this->input->post('IS_LAMA');
		if($param['IS_LAMA']=='')
		{
			$param['IS_LAMA']='F';	
		}

		$param['IS_VERIF']='F';	
		$param['NO_REG_OP']=$this->input->post('AMBIL_REG_OP');
		$param['IS_OP']=$this->input->post('IS_OP');
		if($param['IS_OP']=='')
		{
			$param['IS_OP']='F';	
		}
		$param['TGL_LAYAN']=hari_ini();
		$param['NIK_NYA']=$this->session->userdata('NIK');


		$ARR_WAKTU=$this->input->post('KD_WAKTU_DIET');
		$ARR_JENIS=$this->input->post('KD_JENIS_DIET');
		$ARR_KONSISTENSI=$this->input->post('KD_KONSISTENSI');

		$detail=array();
		if(is_array($ARR_WAKTU))
		{
			for ($i=0; $i < count($ARR_WAKTU); $i++) 
			{ 
				array_push($detail, array(
					'KD_WAKTU_DIET'=>$ARR_WAKTU[$i],
					'KD_JENIS_DIET'=>$ARR_JENIS[$i],
					'KD_KONSISTENSI'=>$ARR_KONSISTENSI[$i],
					'KETERANGAN'=>''
				));
			}
		}
		$param['DETAIL']=$detail;	
		
		$data=$this->webapi->post("gizi/layanan/simpan_pesan",$param,false);
		
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

	function hapus_pesan()
	{
		$msg="";
		$param['KD_PESAN_DIET']=$this->input->post('KD_PESAN_DIET');
		$param['KD_WAKTU_DIET']=$this->input->post('KD_WAKTU_DIET');
		$data=$this->webapi->post("gizi/layanan/hapus_pesan",$param,false);

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

	function reload_pesan()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NO_REG')))
			{
				$param['NO_REG']=$this->input->post('NO_REG');
				$data['data_pesan_diet']=$this->webapi->post("gizi/layanan/data_pesan_pasien",$param,false);
				$this->load->view('diet/v_diett',$data);
			}
		}
	}

	function detail_pesan_diet()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('KD_PESAN_DIET')))
			{
				$param['KD_PESAN_DIET']=$this->input->post('KD_PESAN_DIET');
				$data=$this->webapi->post("gizi/layanan/detail_pesan_diet",$param);
				echo $data;
			}
		}
	}

	function cari_plan_op()
	{
		if(!is_null($this->input->post('NO_CM')))
		{
			$param['NO_CM']=$this->input->post('NO_CM');
			$data=$this->webapi->post("ibs/operasi/data_op",$param,false);
			if($data)
			{
				if($data->response=='200')
				{

					foreach ($data->data as $ddop) 
					{
						echo "<option value='".$ddop->NO_REG_OP."'>Operasi ".$ddop->NM_OP." Daftar ".$ddop->TGL_DAFTAR_F.". Dokter ".$ddop->NM_DOKTER."</option>";
					}
				}
			}
		}
	}

	/* DIET END */


	function orientasi_pasien_baru()
	{
		if(!cek_menu('orientasi_pasien_baru',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_orientasi";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
				$data['detail_orientasi']=$this->webapi->post("emr/emr_ranap/detail_orientasi",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function simpan_orientasi()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['TGL_ORIENTASI']=$this->input->post('TGL_ORIENTASI');
		$param['IS_HAK_DAN_KEWAJIBAN']=$this->input->post('IS_HAK_DAN_KEWAJIBAN');
		if($param['IS_HAK_DAN_KEWAJIBAN']=='')
		{
			$param['IS_HAK_DAN_KEWAJIBAN']='T';
		}
		$param['IS_PRIVASI']=$this->input->post('IS_PRIVASI');
		if($param['IS_PRIVASI']=='')
		{
			$param['IS_PRIVASI']='T';
		}
		$param['IS_NAMA_NOMOR_RUANG']=$this->input->post('IS_NAMA_NOMOR_RUANG');
		if($param['IS_NAMA_NOMOR_RUANG']=='')
		{
			$param['IS_NAMA_NOMOR_RUANG']='T';
		}
		$param['IS_DOKTER_JAGA']=$this->input->post('IS_DOKTER_JAGA');
		if($param['IS_DOKTER_JAGA']=='')
		{
			$param['IS_DOKTER_JAGA']='T';
		}
		$param['DOKTER_JAGA']=$this->input->post('DOKTER_JAGA');
		$param['IS_PERAWAT_JAGA']=$this->input->post('IS_PERAWAT_JAGA');
		if($param['IS_PERAWAT_JAGA']=='')
		{
			$param['IS_PERAWAT_JAGA']='T';
		}
		$param['PERAWAT_JAGA']=$this->input->post('PERAWAT_JAGA');
		$param['IS_DOKTER_DPJP']=$this->input->post('IS_DOKTER_DPJP');
		if($param['IS_DOKTER_DPJP']=='')
		{
			$param['IS_DOKTER_DPJP']='T';
		}
		$param['DR_KONSULEN']=$this->input->post('DR_KONSULEN');
		$param['JENIS_DPJP']=$this->input->post('JENIS_DPJP');
		$param['NM_DPJP']=$this->input->post('NM_DPJP');
		$param['IS_RUANG_PERAWAT']=$this->input->post('IS_RUANG_PERAWAT');
		if($param['IS_RUANG_PERAWAT']=='')
		{
			$param['IS_RUANG_PERAWAT']='T';
		}
		$param['IS_BEL_PASIEN']=$this->input->post('IS_BEL_PASIEN');
		if($param['IS_BEL_PASIEN']=='')
		{
			$param['IS_BEL_PASIEN']='T';
		}
		$param['IS_FASILITAS_RUANG']=$this->input->post('IS_FASILITAS_RUANG');
		if($param['IS_FASILITAS_RUANG']=='')
		{
			$param['IS_FASILITAS_RUANG']='T';
		}
		$param['IS_SIARAN_TV']=$this->input->post('IS_SIARAN_TV');
		if($param['IS_SIARAN_TV']=='')
		{
			$param['IS_SIARAN_TV']='T';
		}
		$param['IS_PERATURAN_KUNJUNG']=$this->input->post('IS_PERATURAN_KUNJUNG');
		if($param['IS_PERATURAN_KUNJUNG']=='')
		{
			$param['IS_PERATURAN_KUNJUNG']='T';
		}
		$param['IS_CARA_MENYAMPAIKAN_PESAN']=$this->input->post('IS_CARA_MENYAMPAIKAN_PESAN');
		if($param['IS_CARA_MENYAMPAIKAN_PESAN']=='')
		{
			$param['IS_CARA_MENYAMPAIKAN_PESAN']='T';
		}
		$param['IS_CARA_BAB_BAK']=$this->input->post('IS_CARA_BAB_BAK');
		if($param['IS_CARA_BAB_BAK']=='')
		{
			$param['IS_CARA_BAB_BAK']='T';
		}
		$param['IS_MENAWARKAN_BANTUAN_MANDI']=$this->input->post('IS_MENAWARKAN_BANTUAN_MANDI');
		if($param['IS_MENAWARKAN_BANTUAN_MANDI']=='')
		{
			$param['IS_MENAWARKAN_BANTUAN_MANDI']='T';
		}
		$param['JENIS_BANTUAN_MANDI']=$this->input->post('JENIS_BANTUAN_MANDI');
		$param['IS_KEBUTUHAN_IBADAH']=$this->input->post('IS_KEBUTUHAN_IBADAH');
		if($param['IS_KEBUTUHAN_IBADAH']=='')
		{
			$param['IS_KEBUTUHAN_IBADAH']='T';
		}
		$param['IS_JILBAB_PUTRI']=$this->input->post('IS_JILBAB_PUTRI');
		if($param['IS_JILBAB_PUTRI']=='')
		{
			$param['IS_JILBAB_PUTRI']='T';
		}
		$param['IS_CELMEK_MENYUSUI']=$this->input->post('IS_CELMEK_MENYUSUI');
		if($param['IS_CELMEK_MENYUSUI']=='')
		{
			$param['IS_CELMEK_MENYUSUI']='T';
		}
		$param['IS_CELANA_ANTI_MALU']=$this->input->post('IS_CELANA_ANTI_MALU');
		if($param['IS_CELANA_ANTI_MALU']=='')
		{
			$param['IS_CELANA_ANTI_MALU']='T';
		}
		$param['IS_FASILITAS_RS']=$this->input->post('IS_FASILITAS_RS');
		if($param['IS_FASILITAS_RS']=='')
		{
			$param['IS_FASILITAS_RS']='T';
		}
		$param['IS_MUKA_TIDAK_KENA_AIR']=$this->input->post('IS_MUKA_TIDAK_KENA_AIR');
		if($param['IS_MUKA_TIDAK_KENA_AIR']=='')
		{
			$param['IS_MUKA_TIDAK_KENA_AIR']='T';
		}
		$param['IS_GERAK_TIDAK_KENA_AIR']=$this->input->post('IS_GERAK_TIDAK_KENA_AIR');
		if($param['IS_GERAK_TIDAK_KENA_AIR']=='')
		{
			$param['IS_GERAK_TIDAK_KENA_AIR']='T';
		}
		$param['IS_SHOLAT_BERDIRI']=$this->input->post('IS_SHOLAT_BERDIRI');
		if($param['IS_SHOLAT_BERDIRI']=='')
		{
			$param['IS_SHOLAT_BERDIRI']='T';
		}
		$param['IS_SHOLAT_DUDUK']=$this->input->post('IS_SHOLAT_DUDUK');
		if($param['IS_SHOLAT_DUDUK']=='')
		{
			$param['IS_SHOLAT_DUDUK']='T';
		}
		$param['IS_SHOLAT_BERBARING']=$this->input->post('IS_SHOLAT_BERBARING');
		if($param['IS_SHOLAT_BERBARING']=='')
		{
			$param['IS_SHOLAT_BERBARING']='T';
		}
		$param['IS_SHOLAT_ISYARAT']=$this->input->post('IS_SHOLAT_ISYARAT');
		if($param['IS_SHOLAT_ISYARAT']=='')
		{
			$param['IS_SHOLAT_ISYARAT']='T';
		}
		$param['IS_PENGENALAN_CUTI_TANGAN']=$this->input->post('IS_PENGENALAN_CUTI_TANGAN');
		if($param['IS_PENGENALAN_CUTI_TANGAN']=='')
		{
			$param['IS_PENGENALAN_CUTI_TANGAN']='T';
		}
		$param['IS_PENAWARAN_TAS_MANDI']=$this->input->post('IS_PENAWARAN_TAS_MANDI');
		if($param['IS_PENAWARAN_TAS_MANDI']=='')
		{
			$param['IS_PENAWARAN_TAS_MANDI']='T';
		}
		$param['IS_BPJS_TAS_MANDI']=$this->input->post('IS_BPJS_TAS_MANDI');
		if($param['IS_BPJS_TAS_MANDI']=='')
		{
			$param['IS_BPJS_TAS_MANDI']='T';
		}
		$param['IS_UMUM_TAS_MANDI']=$this->input->post('IS_UMUM_TAS_MANDI');
		if($param['IS_UMUM_TAS_MANDI']=='')
		{
			$param['IS_UMUM_TAS_MANDI']='T';
		}
		$param['IS_INFO_SAAT_BENCANA']=$this->input->post('IS_INFO_SAAT_BENCANA');
		if($param['IS_INFO_SAAT_BENCANA']=='')
		{
			$param['IS_INFO_SAAT_BENCANA']='T';
		}
		$param['INFO_BENCANA']=$this->input->post('INFO_BENCANA');
		$param['NM_ORIENTASI']=$this->input->post('NM_ORIENTASI');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['NIK_NYA']=$this->session->userdata('NIK'); 
		$data=$this->webapi->post("emr/emr_ranap/simpan_orientasi",$param,false);

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

	function permintaan_obat()
	{
	  	if(!cek_menu('permintaan_obat',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_permintaan_obat";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_obat']=$this->webapi->post("farmasi/formularium/data_stock_obat",array('KD_FORMULARIUM'=>'','KD_GUDANG'=>'GF'),false);
				$data['data_aturan_pakai']=$this->webapi->post("farmasi/master/data_aturan_pakai",array(),false);
				$data['data_waktu_pakai']=$this->webapi->post("farmasi/master/data_waktu_pakai",array(),false);
				$data['data_cara_pakai']=$this->webapi->post("emr/emr_rajal/cara_pemberian_obat",array(),false);
				$data['data_apoteker']=$this->webapi->post("emr/emr_ranap/data_apoteker",array(),false);
				$data['data_rekon_obat_awal']=$this->webapi->post("emr/emr_ranap/data_rekon_obat_awal",$param,false); 

				$data['data_obat_pasien']=$this->webapi->post("emr/emr_ranap/data_obat_pasien",$param,false); 
				$data['data_terima_obat_pasien']=$this->webapi->post("emr/emr_ranap/data_terima_obat_pasien",$param,false); 

				$data['data_resep']=$this->webapi->post("emr/emr_rajal/data_resep",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function cari_histori_obat()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NO_CM')))
			{
				$param['NO_CM']=$this->input->post('NO_CM'); 
				$param['TGL_AWAL']=$this->input->post('TGL_AWAL'); 
				$param['TGL_AKHIR']=$this->input->post('TGL_AKHIR'); 
				$data['data_histori_obat']=$this->webapi->post("emr/emr_rajal/data_histori_resep_farmasi",$param,false);
				$this->load->view('ranap/resep/data_histori_obat',$data);
			}
		}
	}

	function copy_obat_farmasi()
	{
		$msg="";
		$param['KD_JUAL']=$this->input->post('KD_JUAL');
		$param['INDEX_RESEP']=$this->input->post('INDEX_RESEP');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['KD_RUANG']=$this->input->post('KD_RUANG');
		$param['IOL']=$this->input->post('IOL');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['STATUS_RESEP']='D';
		$param['IS_RACIK']=$this->input->post('IS_RACIK');
		$param['NIK_NYA']=$this->session->userdata('NIK'); 
		$data=$this->webapi->post("emr/emr_rajal/copy_obat_farmasi",$param);
		echo $data;
		 
	}

	function baru_resep()
	{
		if($_POST)
		{
			$kode="";
			$code="404";
			$msg="Pembuatan kode tidak berhasil";
			$data['kode']=$this->webapi->post("emr/emr_rajal/kode_resep",array(),false);
			
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

	function hapus_resep_obat_racik()
	{
		$msg="";
		$param['INDEX_RESEP']=$this->input->post('INDEX_RESEP');
		$param['KD_GROUP_RACIK']=$this->input->post('KD_GROUP_RACIK');
		$data=$this->webapi->post("emr/emr_rajal/hapus_detail_resep_racikan",$param,false);

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
		$data=$this->webapi->post("emr/emr_rajal/hapus_detail_resep",$param,false);

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

	function detail_resep_obat_racik()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('INDEX_RESEP')))
			{
				$param['INDEX_RESEP']=$this->input->post('INDEX_RESEP'); 
				$param['KD_GROUP_RACIK']=$this->input->post('KD_GROUP_RACIK'); 
				$data=$this->webapi->post("emr/emr_rajal/detail_obat_resep_racikan",$param);
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
				$data=$this->webapi->post("emr/emr_rajal/detail_resep",$param);
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
				$data=$this->webapi->post("emr/emr_rajal/detail_obat_resep",$param);
				echo $data;
			}
		}
	}


	function reload_obat_resep()
	{
		$msg="";
		$param['INDEX_RESEP']=$this->input->post('INDEX_RESEP');
		$data['data_obat_resep']=$this->webapi->post("emr/emr_rajal/data_obat_resep",$param,false); 
		$this->load->view('ranap/resep/tb_obat_resep_pasien',$data); 
	}

	function reload_obat_resep_racikan()
	{
		$msg="";
		$param['INDEX_RESEP']=$this->input->post('INDEX_RESEP');
		$data['data_obat_resep']=$this->webapi->post("emr/emr_rajal/data_obat_resep_racikan",$param,false); 
		$this->load->view('ranap/resep/tb_obat_resep_racik_pasien',$data); 
	}

	function reload_resep()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_resep']=$this->webapi->post("emr/emr_rajal/data_resep",$param,false); 
		$this->load->view('ranap/resep/tb_resep_pasien',$data); 
	}

	function simpan_resep()
	{
		$msg="";
		
		//$param['TGL_RESEP']=$this->input->post('RESEP_TGL_RESEP');
		$param['INDEX_RESEP']=$this->input->post('RESEP_INDEX_RESEP');
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
		$param['STATUS']='0';
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
		$param['NIK_NYA']=$this->session->userdata('NIK'); 


		$data=$this->webapi->post("emr/emr_rajal/simpan_detail_resep",$param,false);

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

	function simpan_resep_copy()
	{
		$msg="";
		$param['INDEX_RESEP_COPY']=$this->input->post('INDEX_RESEP_COPY');
		$param['INDEX_RESEP']=$this->input->post('INDEX_RESEP');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['KD_RUANG']=$this->input->post('KD_RUANG');
		$param['IOL']=$this->input->post('IOL');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['STATUS_RESEP']='D';
		$param['IS_RACIK']=$this->input->post('IS_RACIK');
		$param['NIK_NYA']=$this->session->userdata('NIK'); 
		$data=$this->webapi->post("emr/emr_rajal/simpan_copy_histori_resep",$param,false);

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

	function histori_resep_pasien()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NO_CM')) && !is_null($this->input->post('KD_UNIT')) && !is_null($this->input->post('IS_RACIK')))
			{
				$param['NO_CM']=$this->input->post('NO_CM');
				$param['IS_RACIK']=$this->input->post('IS_RACIK'); 
				$param['KD_UNIT']=$this->input->post('KD_UNIT'); 
				$param['TGL_AWAL']=$this->input->post('TGL_AWAL'); 
				$param['TGL_AKHIR']=$this->input->post('TGL_AKHIR'); 
				$data['data_his_resep']=$this->webapi->post("emr/emr_rajal/histori_resep_pasien",$param,false);
				$this->load->view('ranap/resep/tb_his_resep_pasien',$data);
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
				$data=$this->webapi->post("emr/emr_rajal/cek_stok_obat",$param);
				echo $data;
			}
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

	function cari_nama_obat()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NAMA_OBAT')))
			{
				$param['NAMA_OBAT']=$this->input->post('NAMA_OBAT');
				$param['KD_GUDANG']='GF';
				$data=$this->webapi->post("emr/emr_rajal/data_nama_obat",$param,false);	
				if($data)
				{  
					if($data->response=='200')
					{
						$i=0;
						$stok="";
						foreach ($data->data as $dt) 
						{
							if($dt->SISA=='0')
							{
								$stok='<i class="red">stok habis</i>';
							} 
							else
							{
								$stok='<i class="green">stok '.$dt->SISA.'</i>';
							}   
							$i+=1;
							echo "<div class='suggest' kode='".$dt->KD_OBAT."' nama='".$dt->NAMA_OBAT."' onclick='terima_nama_obat(this)'>".$dt->NAMA_OBAT." - ".$dt->NM_FORMULARIUM." ".$stok.", <b>Harga : ".rupiah($dt->HARGA_JUAL)."</b></div>";
						}
					}
					else
					{
						echo "0";
					}

				}
			}
		}
	}

	function cari_nama_obat_rekon()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NAMA_OBAT')))
			{
				$param['NAMA_OBAT']=$this->input->post('NAMA_OBAT');
				$param['KD_GUDANG']='GF';
				$data=$this->webapi->post("emr/emr_rajal/data_nama_obat",$param,false);	
				if($data)
				{  
					if($data->response=='200')
					{
						$i=0;
						$stok="";
						foreach ($data->data as $dt) 
						{
							if($dt->SISA=='0')
							{
								$stok='<i class="red">stok habis</i>';
							} 
							else
							{
								$stok='<i class="green">stok '.$dt->SISA.'</i>';
							}   
							$i+=1;
							echo "<div class='suggest' kode='".$dt->KD_OBAT."' nama='".$dt->NAMA_OBAT."' onclick='terima_nama_obat_rekon(this)'>".$dt->NAMA_OBAT." - ".$dt->NM_FORMULARIUM." ".$stok.", <b>Harga : ".rupiah($dt->HARGA_JUAL)."</b></div>";
						}
					}
					else
					{
						echo "0";
					}

				}
			}
		}
	}

	function final_resep()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('INDEX_RESEP')))
			{
				$param['INDEX_RESEP']=$this->input->post('INDEX_RESEP'); 
				$param['STATUS']=$this->input->post('STATUS'); 
				$data=$this->webapi->post("emr/emr_rajal/final_resep",$param);
				echo $data;
			}
		}
	}


	function data_rekon_obat_awal()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_rekon_obat_awal']=$this->webapi->post("emr/emr_ranap/data_rekon_obat_awal",$param,false); 
		$this->load->view('ranap/resep/tb_rekon_awal',$data); 
	}

	function detail_rekon_obat_awal()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NO_URUT_REKON_OBAT')))
			{
				$param['NO_URUT_REKON_OBAT']=$this->input->post('NO_URUT_REKON_OBAT'); 
				$data=$this->webapi->post("emr/emr_ranap/detail_rekon_obat_awal",$param);
				echo $data;
			}
		}
	}

	function simpan_rekon_obat_awal()
	{
		$msg="";
		$param['NO_URUT_REKON_OBAT']=$this->input->post('NO_URUT_REKON_OBAT');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_APOTEKER']=$this->input->post('NIK_APOTEKER');
		$param['TELAAH']=$this->input->post('TELAAH');
		$param['NAMA_OBAT']=$this->input->post('NAMA_OBAT');
		$param['SIGNA']=$this->input->post('SIGNA');
		$param['JUMLAH']=$this->input->post('JUMLAH');
		$param['STATUS_LANJUT']=$this->input->post('STATUS_LANJUT');
		$param['SIGNA_MENJADI']=$this->input->post('SIGNA_MENJADI');
		$param['NIK_NYA']=$this->session->userdata('NIK'); 
		$data=$this->webapi->post("emr/emr_ranap/simpan_rekon_obat_awal",$param,false);

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

	function hapus_rekon_obat_awal()
	{
		$msg="";
		$param['NO_URUT_REKON_OBAT']=$this->input->post('NO_URUT_REKON_OBAT');
		$data=$this->webapi->post("emr/emr_ranap/hapus_rekon_obat_awal",$param,false);

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

	function reload_obat_pasien()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_obat_pasien']=$this->webapi->post("emr/emr_ranap/data_obat_pasien",$param,false); 
		$this->load->view('ranap/resep/tb_obat_pasien',$data); 
	}

	function reload_terima_obat_pasien()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_terima_obat_pasien']=$this->webapi->post("emr/emr_ranap/data_terima_obat_pasien",$param,false); 
		$this->load->view('ranap/resep/tb_terima_obat',$data); 
	}

	function terima_obat_pasien()
	{
		$msg="";
		$param['KD_JUAL']=$this->input->post('KD_JUAL');
		$param['KD_OBAT']=$this->input->post('KD_OBAT');
		$param['NIK_NYA']=$this->session->userdata('NIK'); 
		$data=$this->webapi->post("emr/emr_ranap/verifikasi_terima_obat",$param,false);

		if($data)
		{
			if($data->response=='200')
			{
				$msg=$data->data;
			}
			else
			{
				$msg="Data tidak dapat diverifikasi!";
			}
		}
		else
		{
			$msg="Terjadi kesalahan!";
		}
		echo $msg;  
		
	}

	function terima_obat_pasien_all()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['NIK_NYA']=$this->session->userdata('NIK'); 
		$data=$this->webapi->post("emr/emr_ranap/verifikasi_terima_obat_all",$param,false);

		if($data)
		{
			if($data->response=='200')
			{
				$msg=$data->data;
			}
			else
			{
				$msg="Data tidak dapat diverifikasi!";
			}
		}
		else
		{
			$msg="Terjadi kesalahan!";
		}
		echo $msg;  
		
	}

	function update_retur_obat_pasien()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_OBAT']=$this->input->post('KD_OBAT');
		$param['RETUR']=$this->input->post('RETUR');
		$param['NIK_NYA']=$this->session->userdata('NIK'); 
		$data=$this->webapi->post("emr/emr_ranap/update_retur_obat_pasien",$param,false);

		if($data)
		{
			if($data->response=='200')
			{
				$msg=$data->data;
			}
			else
			{
				$msg="Data tidak dapat diverifikasi!";
			}
		}
		else
		{
			$msg="Terjadi kesalahan!";
		}
		echo $msg;  
		
	}


	function asesmen_awal_medis()
	{
		if(!cek_menu('asesmen_awal_medis',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_asesmen_awal_medis";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
				$data['detail_asesmen']=$this->webapi->post("emr/emr_ranap/detail_asesmen_medis_awal_ranap",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function simpan_asesmen_medis_awal_ranap()
	{
		$msg="";
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['TGL_ASESMEN']=$this->input->post('TGL_ASESMEN');
		$param['JENIS_RUJUKAN']=$this->input->post('JENIS_RUJUKAN');
		$param['URAIAN_RUJUKAN']=$this->input->post('URAIAN_RUJUKAN');
		$param['DIAGNOSA_RUJUKAN']=$this->input->post('DIAGNOSA_RUJUKAN');
		$param['SUMBER_DATA']=$this->input->post('SUMBER_DATA');
		$param['IS_ALERGI']=$this->input->post('IS_ALERGI');
		if($param['IS_ALERGI']=='')
		{
			$param['IS_ALERGI']='T';
		}
		$param['ALERGI']=$this->input->post('ALERGI');
		$param['RIWAYAT_PENYAKIT_SEKARANG']=$this->input->post('RIWAYAT_PENYAKIT_SEKARANG');
		$param['RIWAYAT_KEHAMILAN']=$this->input->post('RIWAYAT_KEHAMILAN');
		$param['RIWAYAT_MENSTRUASI']=$this->input->post('RIWAYAT_MENSTRUASI');
		$param['RIWAYAT_PERSALINAN']=$this->input->post('RIWAYAT_PERSALINAN');
		$param['RIWAYAT_POST_NATAL']=$this->input->post('RIWAYAT_POST_NATAL');
		$param['RIWAYAT_IMUNISASI']=$this->input->post('RIWAYAT_IMUNISASI');
		$param['RIWAYAT_TUMBUH_KEMBANG']=$this->input->post('RIWAYAT_TUMBUH_KEMBANG');
		$param['RIWAYAT_PENYAKIT_DULU']=$this->input->post('RIWAYAT_PENYAKIT_DULU');
		$param['RIWAYAT_PENYAKIT_KELUARGA']=$this->input->post('RIWAYAT_PENYAKIT_KELUARGA');
		$param['OBAT_MASIH_KONSUMSI']=$this->input->post('OBAT_MASIH_KONSUMSI');
		$param['RIWAYAT_KEMOTERAPI']=$this->input->post('RIWAYAT_KEMOTERAPI');
		$param['IS_RISIKO_KEKERASAN']=$this->input->post('IS_RISIKO_KEKERASAN');
		if($param['IS_RISIKO_KEKERASAN']=='')
		{
			$param['IS_RISIKO_KEKERASAN']='T';
		}
		$param['GANGGUAN_EMOSIONAL_TAMPAK']=$this->input->post('GANGGUAN_EMOSIONAL_TAMPAK');
		$param['IS_PSIKO_PASIEN_NORMAL']=$this->input->post('IS_PSIKO_PASIEN_NORMAL');
		if($param['IS_PSIKO_PASIEN_NORMAL']=='')
		{
			$param['IS_PSIKO_PASIEN_NORMAL']='T';
		}
		$param['IS_TAKUT_MATI']=$this->input->post('IS_TAKUT_MATI');
		if($param['IS_TAKUT_MATI']=='')
		{
			$param['IS_TAKUT_MATI']='T';
		}
		$param['IS_TAKUT_OPERASI']=$this->input->post('IS_TAKUT_OPERASI');
		if($param['IS_TAKUT_OPERASI']=='')
		{
			$param['IS_TAKUT_OPERASI']='T';
		}
		$param['IS_KECEMASAN']=$this->input->post('IS_KECEMASAN');
		if($param['IS_KECEMASAN']=='')
		{
			$param['IS_KECEMASAN']='T';
		}
		$param['IS_KESURUPAN']=$this->input->post('IS_KESURUPAN');
		if($param['IS_KESURUPAN']=='')
		{
			$param['IS_KESURUPAN']='T';
		}
		$param['IS_PUTUS_ASA']=$this->input->post('IS_PUTUS_ASA');
		if($param['IS_PUTUS_ASA']=='')
		{
			$param['IS_PUTUS_ASA']='T';
		}
		$param['IS_TBC']=$this->input->post('IS_TBC');
		if($param['IS_TBC']=='')
		{
			$param['IS_TBC']='T';
		}
		$param['IS_RISIKO_BUNUH_DIRI']=$this->input->post('IS_RISIKO_BUNUH_DIRI');
		if($param['IS_RISIKO_BUNUH_DIRI']=='')
		{
			$param['IS_RISIKO_BUNUH_DIRI']='T';
		}
		$param['IS_PSIKO_KELUARGA_NORMAL']=$this->input->post('IS_PSIKO_KELUARGA_NORMAL');
		if($param['IS_PSIKO_KELUARGA_NORMAL']=='')
		{
			$param['IS_PSIKO_KELUARGA_NORMAL']='T';
		}
		$param['IS_PSIKO_KELUARGA_TAK_KOPERATIF']=$this->input->post('IS_PSIKO_KELUARGA_TAK_KOPERATIF');
		if($param['IS_PSIKO_KELUARGA_TAK_KOPERATIF']=='')
		{
			$param['IS_PSIKO_KELUARGA_TAK_KOPERATIF']='T';
		}
		$param['IS_PSIKO_KELUARGA_KESURUPAN']=$this->input->post('IS_PSIKO_KELUARGA_KESURUPAN');
		if($param['IS_PSIKO_KELUARGA_KESURUPAN']=='')
		{
			$param['IS_PSIKO_KELUARGA_KESURUPAN']='T';
		}
		$param['SOSIAL_EKONOMI']=$this->input->post('SOSIAL_EKONOMI');
		$param['SPIRITUAL']=$this->input->post('SPIRITUAL');
		$param['THOHAROH']=$this->input->post('THOHAROH');
		$param['SHOLAT']=$this->input->post('SHOLAT');
		$param['ASESMEN_TAMBAHAN']=$this->input->post('ASESMEN_TAMBAHAN');
		$param['KEADAAN_UMUM']=$this->input->post('KEADAAN_UMUM');
		$param['TINGKAT_KESADARAN']=$this->input->post('TINGKAT_KESADARAN');
		$param['TD_SIS']=$this->input->post('TD_SIS');
		$param['TD_DIA']=$this->input->post('TD_DIA');
		$param['PERNAFASAN']=$this->input->post('PERNAFASAN');
		$param['NADI']=$this->input->post('NADI');
		$param['TINGGI_BADAN']=$this->input->post('TINGGI_BADAN');
		$param['SUHU']=$this->input->post('SUHU');
		$param['SPO2']=$this->input->post('SPO2');
		$param['BERAT_BADAN']=$this->input->post('BERAT_BADAN');
		$param['GDS']=$this->input->post('GDS');
		$param['GCS_E']=$this->input->post('GCS_E');
		$param['GCS_M']=$this->input->post('GCS_M');
		$param['GCS_V']=$this->input->post('GCS_V');
		$param['GCS_SCORE']=$this->input->post('GCS_SCORE');
		$param['KESADARAN']=$this->input->post('KESADARAN');
		$param['SKALA_NYERI']=$this->input->post('SKALA_NYERI');
		$param['SKRINING_NYERI']=$this->input->post('SKRINING_NYERI');
		$param['LOKASI_NYERI']=$this->input->post('LOKASI_NYERI');
		$param['DURASI_NYERI']=$this->input->post('DURASI_NYERI');
		$param['FREKUENSI_NYERI']=$this->input->post('FREKUENSI_NYERI');
		$param['NYERI_HILANG_BILA']=$this->input->post('NYERI_HILANG_BILA');
		$param['NM_NYERI_HILANG_BILA']=$this->input->post('NM_NYERI_HILANG_BILA');
		$param['KEPALA']=$this->input->post('KEPALA');
		$param['MATA']=$this->input->post('MATA');
		$param['TELINGA']=$this->input->post('TELINGA');
		$param['HIDUNG']=$this->input->post('HIDUNG');
		$param['RAMBUT']=$this->input->post('RAMBUT');
		$param['BIBIR']=$this->input->post('BIBIR');
		$param['GIGI']=$this->input->post('GIGI');
		$param['LIDAH']=$this->input->post('LIDAH');
		$param['LANGIT_LANGIT']=$this->input->post('LANGIT_LANGIT');
		$param['LEHER']=$this->input->post('LEHER');
		$param['TENGGOROKAN']=$this->input->post('TENGGOROKAN');
		$param['TONSIL']=$this->input->post('TONSIL');
		$param['DADA']=$this->input->post('DADA');
		$param['PAYUDARA']=$this->input->post('PAYUDARA');
		$param['PUNGGUNG']=$this->input->post('PUNGGUNG');
		$param['PERUT']=$this->input->post('PERUT');
		$param['GENITAL']=$this->input->post('GENITAL');
		$param['ANUS']=$this->input->post('ANUS');
		$param['LENGAN_ATAS']=$this->input->post('LENGAN_ATAS');
		$param['LENGAN_BAWAH']=$this->input->post('LENGAN_BAWAH');
		$param['JARI_TANGAN']=$this->input->post('JARI_TANGAN');
		$param['KUKU_TANGAN']=$this->input->post('KUKU_TANGAN');
		$param['PERSENDIAN_TANGAN']=$this->input->post('PERSENDIAN_TANGAN');
		$param['TUNGKAI_ATAS']=$this->input->post('TUNGKAI_ATAS');
		$param['TUNGKAI_BAWAH']=$this->input->post('TUNGKAI_BAWAH');
		$param['JARI_KAKI']=$this->input->post('JARI_KAKI');
		$param['KUKU_KAKI']=$this->input->post('KUKU_KAKI');
		$param['PERSENDIAN_KAKI']=$this->input->post('PERSENDIAN_KAKI');
		$param['IS_FOTO_ANATOMI']=$this->input->post('IS_FOTO_ANATOMI');
		if($param['IS_FOTO_ANATOMI']=='T') //T /F 
		{
			$param['FOTO_ANATOMI']=$this->input->post('FOTO_ANATOMI');
		}
		else
		{
			$param['FOTO_ANATOMI']='';
		}
		$param['STATUS_LOKALIS']=$this->input->post('STATUS_LOKALIS');
		$param['IS_TANDA_BEDAH']=$this->input->post('IS_TANDA_BEDAH');
		if($param['IS_TANDA_BEDAH']=='')
		{
			$param['IS_TANDA_BEDAH']='T';
		}
		$param['REGIO']=$this->input->post('REGIO');
		$param['PEMERIKSAAN_OBSTETRI']=$this->input->post('PEMERIKSAAN_OBSTETRI');
		$param['PEMERIKSAAN_GINEKOLOGI']=$this->input->post('PEMERIKSAAN_GINEKOLOGI');
		$param['PEMERIKSAAN_PENUNJANG']=$this->input->post('PEMERIKSAAN_PENUNJANG');
		$param['DIAGNOSA']=$this->input->post('DIAGNOSA');
		$param['RENCANA_PENGOBATAN']=$this->input->post('RENCANA_PENGOBATAN');
		$param['TERAPI_GIZI']=$this->input->post('TERAPI_GIZI');
		$param['PESAN_DIET']=$this->input->post('PESAN_DIET');
		$param['KEBUTUHAN_KOLABORATIF']=$this->input->post('KEBUTUHAN_KOLABORATIF');
		$param['SUMBER_EDU']=$this->input->post('SUMBER_EDU');
		$param['NM_EDU']=$this->input->post('NM_EDU');
		$param['HAMBATAN_KOMUNIKASI']=$this->input->post('HAMBATAN_KOMUNIKASI');
		$param['DIET_DIRUMAH']=$this->input->post('DIET_DIRUMAH');
		$param['PENYERAHAN_LEAFLET']=$this->input->post('PENYERAHAN_LEAFLET');
		$param['MOTIVASI_TAWAKAL']=$this->input->post('MOTIVASI_TAWAKAL');
		$param['EDU_PSIKOSPIRITUAL']=$this->input->post('EDU_PSIKOSPIRITUAL');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		 
		$data=$this->webapi->post("emr/emr_ranap/simpan_asesmen_medis_awal_ranap",$param,false);

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


	function serah_terima_pasien()
	{
		if(!cek_menu('serah_terima_pasien',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_serah_terima_pasien";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_ruang_kosong']=$this->webapi->post('emr/emr_ranap/data_ruang_kosong',array(),false);
				$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
				$data['detail_serah_terima_pasien']=$this->webapi->post('emr/emr_ranap/detail_serah_terima_pasien',$param,false);
				if($data['detail_serah_terima_pasien'])
				{
					if($data['detail_serah_terima_pasien']->response=='200')
					{
						$param['NO_SERAH_TERIMA']=$data['detail_serah_terima_pasien']->data->NO_SERAH_TERIMA;
						$data['data_alkes_pindah_ruang']=$this->webapi->post('emr/emr_ranap/data_alkes_pindah_ruang',$param,false);
						$data['data_obat_pindah_ruang']=$this->webapi->post('emr/emr_ranap/data_obat_pindah_ruang',$param,false);
					}
					else
					{
						$data['data_alkes_pindah_ruang']=null;
						$data['data_obat_pindah_ruang']=null;
					}
				}
				else
				{
					$data['data_alkes_pindah_ruang']=null;
					$data['data_obat_pindah_ruang']=null;
				}
				$data['detail_asesmen']=$this->webapi->post("emr/emr_ranap/detail_asesmen_medis_awal_ranap",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function simpan_serah_terima_pasien()
	{
		$param['NO_SERAH_TERIMA']=$this->input->post('NO_SERAH_TERIMA');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['IOL']=$this->input->post('IOL');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['TGL_PINDAH']=$this->input->post('TGL_PINDAH');
		$param['KD_RUANG_ASAL']=$this->input->post('KD_RUANG_ASAL');
		$param['KD_RUANG_TUJU']=$this->input->post('KD_RUANG_TUJU');
		$param['ALASAN_RANAP']=$this->input->post('ALASAN_RANAP');
		$param['IS_ALERGI']=$this->input->post('IS_ALERGI');
		if($param['IS_ALERGI']=='')
		{
			$param['IS_ALERGI']='T';
		}
		$param['ALERGI']=$this->input->post('ALERGI');
		$param['PERKIRAAN_LAMA_RAWAT']=$this->input->post('PERKIRAAN_LAMA_RAWAT');
		$param['KEWASPADAAN']=$this->input->post('KEWASPADAAN');
		$param['ALASAN_PINDAH']=$this->input->post('ALASAN_PINDAH');
		$param['KEADAAN_UMUM']=$this->input->post('KEADAAN_UMUM');
		$param['GCS_E']=$this->input->post('GCS_E');
		$param['GCS_M']=$this->input->post('GCS_M');
		$param['GCS_V']=$this->input->post('GCS_V');
		$param['GCS_SCORE']=$this->input->post('GCS_SCORE');
		$param['KESADARAN']=$this->input->post('KESADARAN');
		$param['TD_SIS']=$this->input->post('TD_SIS');
		$param['TD_DIA']=$this->input->post('TD_DIA');
		$param['NADI']=$this->input->post('NADI');
		$param['PERNAFASAN']=$this->input->post('PERNAFASAN');
		$param['SB']=$this->input->post('SB');
		$param['SKALA_NYERI']=$this->input->post('SKALA_NYERI');
		$param['DIAGNOSA_MEDIS']=$this->input->post('DIAGNOSA_MEDIS');
		$param['TINDAKAN_MEDIS']=$this->input->post('TINDAKAN_MEDIS');
		$param['DIAGNOSA_KEPERAWATAN']=$this->input->post('DIAGNOSA_KEPERAWATAN');
		$param['HASIL_PEMERIKSAAN']=$this->input->post('HASIL_PEMERIKSAAN');
		$param['DOKUMEN_DISERTAKAN']=$this->input->post('DOKUMEN_DISERTAKAN');
		$param['REKOMENDASI']=$this->input->post('REKOMENDASI');
		$param['TGL_TERIMA']=$this->input->post('TGL_TERIMA');
		$param['NIK_KIRIM']=$this->input->post('NIK_KIRIM');
		$param['NIK_TERIMA']=$this->input->post('NIK_TERIMA');
		$param['NIK_NYA']=$this->session->userdata('NIK');

		$detail_alkes=array();
		$ARR_NAMA_ALKES=$this->input->post('NAMA_ALKES');
		$ARR_TGL_MULAI_PASANG=$this->input->post('TGL_MULAI_PASANG');

		$hitung_alkes=$this->input->post('NAMA_ALKES');
		if(is_array($hitung_alkes))
		{
			for ($i=0; $i < count($hitung_alkes); $i++) 
			{ 
				if($ARR_NAMA_ALKES[$i]!='')
				{
		  			array_push($detail_alkes, 
		  							array(
									   	'NAMA_ALKES'=>$ARR_NAMA_ALKES[$i],
									   	'TGL_MULAI_PASANG'=>$ARR_TGL_MULAI_PASANG[$i],
									   	'KETERANGAN'=>'',
									 	)
		  				);	
		  		}
			}
		}

		$param['DETAIL_ALKES']=$detail_alkes;	

		$detail_obat=array();
		$ARR_NAMA_OBAT=$this->input->post('NAMA_OBAT');
		$ARR_DOSIS=$this->input->post('DOSIS');
		$ARR_CARA_PEMBERIAN=$this->input->post('CARA_PEMBERIAN');
		$ARR_JADWAL_PEMBERIAN=$this->input->post('JADWAL_PEMBERIAN');
		$ARR_JUMLAH=$this->input->post('JUMLAH');

		$hitung_obat=$this->input->post('NAMA_OBAT');
		if(is_array($hitung_obat))
		{
			for ($i=0; $i < count($hitung_obat); $i++) 
			{ 
		  		if($ARR_NAMA_OBAT[$i]!='')
				{		
		  			array_push($detail_obat, 
		  							array(
										'NAMA_OBAT'=>$ARR_NAMA_OBAT[$i],
										'DOSIS'=>$ARR_DOSIS[$i],
										'CARA_PEMBERIAN'=>$ARR_CARA_PEMBERIAN[$i],
										'JADWAL_PEMBERIAN'=>$ARR_JADWAL_PEMBERIAN[$i],
										'JUMLAH'=>$ARR_JUMLAH[$i]
									 	)
		  				);	
		  		}
			}
		}

		$param['DETAIL_OBAT']=$detail_obat;
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_serah_terima_pasien",$param,false);
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











	function cppt_ranap()
	{
		if(!cek_menu('cppt_ranap',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_cppt_ranap";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['detail_asesmen']=$this->webapi->post("emr/emr_ranap/detail_asesmen_medis_awal_ranap",$param,false);
				$data['data_cppt_ranap']=$this->webapi->post("emr/emr_ranap/data_cppt_ranap",$param,false);
				$data['data_sbar']=$this->webapi->post("emr/emr_ranap/data_sbar",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function reload_cppt_ranap()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_cppt_ranap']=$this->webapi->post("emr/emr_ranap/data_cppt_ranap",$param,false);
		$this->load->view('ranap/v_cppt_ranapt',$data);
	}

	function detail_cppt_ranap()
	{
		$param['NO_CPPT_RANAP']=$this->input->post('NO_CPPT_RANAP');
		$data=$this->webapi->post("emr/emr_ranap/detail_cppt_ranap",$param);
		echo $data;
	}


	function simpan_cppt_ranap()
	{
		$param['NO_CPPT_RANAP']=$this->input->post('NO_CPPT_RANAP');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['TGL_CPPT']=$this->input->post('TGL_CPPT');
		$param['KD_PROFESI']=map_profesi($this->session->userdata('KD_PROFESI'));
		$param['NIK_PROFESI']=$this->session->userdata('NIK');
		$param['SUBYEKTIF']=$this->input->post('SUBYEKTIF');
		$param['OBYEKTIF']=$this->input->post('OBYEKTIF');
		$param['ASESMEN']=$this->input->post('ASESMEN');
		$param['PLAN']=$this->input->post('PLAN');
		$param['INSTRUKSI']=$this->input->post('INSTRUKSI');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		$data=$this->webapi->post("emr/emr_ranap/simpan_cppt_ranap",$param,false);

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

	function hapus_cppt_ranap()
	{
		$param['NO_CPPT_RANAP']=$this->input->post('NO_CPPT_RANAP');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_cppt_ranap",$param,false);

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

	function verif_cppt_ranap()
	{
		$param['NO_CPPT_RANAP']=$this->input->post('NO_CPPT_RANAP');
		$param['IS_VERIF_DPJP']=$this->input->post('IS_VERIF_DPJP');
		$data=$this->webapi->post("emr/emr_ranap/verif_cppt_ranap",$param,false);

		if($data)
		{
			if($data->response=='200')
			{
				$msg=$data->data;
			}
			else
			{
				$msg="Data tidak dapat diverifikasi!";
			}
		}
		else
		{
			$msg="Terjadi kesalahan!";
		}
		echo $msg;  
		
	}

	function reload_sbar()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_sbar']=$this->webapi->post("emr/emr_ranap/data_sbar",$param,false);
		$this->load->view('ranap/v_sbart',$data);
	}

	function detail_sbar()
	{
		$param['NO_SBAR']=$this->input->post('NO_SBAR');
		$data=$this->webapi->post("emr/emr_ranap/detail_sbar",$param);
		echo $data;
	}


	function simpan_sbar()
	{
		$param['NO_SBAR']=$this->input->post('NO_SBAR');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['TGL_SBAR']=$this->input->post('TGL_SBAR');
		$param['KD_PROFESI']=map_profesi($this->session->userdata('KD_PROFESI'));
		$param['NIK_PROFESI']=$this->session->userdata('NIK');
		$param['SITUASI']=$this->input->post('SITUASI');
		$param['BACKGROUND']=$this->input->post('BACKGROUND');
		$param['ASESMEN']=$this->input->post('ASESMEN');
		$param['REKOMENDASI']=$this->input->post('REKOMENDASI');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		$data=$this->webapi->post("emr/emr_ranap/simpan_sbar",$param,false);

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

	function hapus_sbar()
	{
		$param['NO_SBAR']=$this->input->post('NO_SBAR');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_sbar",$param,false);

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

	function rencana_tatalaksana()
	{
		if(!cek_menu('rencana_tatalaksana',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_rencana_tatalaksana";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_tatalaksana']=$this->webapi->post("emr/emr_ranap/data_tatalaksana",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function reload_tatalaksana()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_tatalaksana']=$this->webapi->post("emr/emr_ranap/data_tatalaksana",$param,false);
		$this->load->view('ranap/v_rencana_tatalaksanat',$data);
	}

	function detail_tatalaksana()
	{
		$param['NO_TATALAKSANA']=$this->input->post('NO_TATALAKSANA');
		$data=$this->webapi->post("emr/emr_ranap/detail_tatalaksana",$param);
		echo $data;
	}


	function simpan_tatalaksana()
	{
		$param['NO_TATALAKSANA']=$this->input->post('NO_TATALAKSANA');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['TGL_TATALAKSANA']=$this->input->post('TGL_TATALAKSANA');
		$param['KD_PROFESI']=map_profesi($this->session->userdata('KD_PROFESI'));
		$param['NIK_PROFESI']=$this->session->userdata('NIK');
		$param['MASALAH']=$this->input->post('MASALAH');
		$param['KEBUTUHAN']=$this->input->post('KEBUTUHAN');
		$param['RENCANA']=$this->input->post('RENCANA');
		$param['IS_TERATASI']=$this->input->post('IS_TERATASI');
		$param['TGL_TERATASI']=$this->input->post('TGL_TERATASI');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_tatalaksana",$param,false);
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

	function hapus_tatalaksana()
	{
		$param['NO_TATALAKSANA']=$this->input->post('NO_TATALAKSANA');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_tatalaksana",$param,false);

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







	function tanda_vital()
	{
		if(!cek_menu('tanda_vital',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_tanda_vital";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
				$data['detail_asesmen']=$this->webapi->post("emr/emr_ranap/detail_asesmen_medis_awal_ranap",$param,false);
				$data['data_tanda_vital']=$this->webapi->post("emr/emr_ranap/data_tanda_vital",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function reload_tanda_vital()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_tanda_vital']=$this->webapi->post("emr/emr_ranap/data_tanda_vital",$param,false);
		$this->load->view('ranap/v_tanda_vitalt',$data);
	}

	function detail_tanda_vital()
	{
		$param['NO_TANDA_VITAL']=$this->input->post('NO_TANDA_VITAL');
		$data=$this->webapi->post("emr/emr_ranap/detail_tanda_vital",$param);
		echo $data;
	}


	function simpan_tanda_vital()
	{
		$param['NO_TANDA_VITAL']=$this->input->post('NO_TANDA_VITAL');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['TGL_TANDA_VITAL']=$this->input->post('TGL_TANDA_VITAL');
		$param['TD_SIS']=$this->input->post('TD_SIS');
		$param['TD_DIA']=$this->input->post('TD_DIA');
		$param['NADI']=$this->input->post('NADI');
		$param['SUHU']=$this->input->post('SUHU');
		$param['PERNAFASAN']=$this->input->post('PERNAFASAN');
		$param['SKALA_NYERI']=$this->input->post('SKALA_NYERI');
		$param['RESIKO_JATUH']=$this->input->post('RESIKO_JATUH');
		$param['BERAT_BADAN']=$this->input->post('BERAT_BADAN');
		$param['TINGGI_BADAN']=$this->input->post('TINGGI_BADAN');
		$param['GCS_E']=$this->input->post('GCS_E');
		$param['GCS_M']=$this->input->post('GCS_M');
		$param['GCS_V']=$this->input->post('GCS_V');
		$param['GCS_SCORE']=$this->input->post('GCS_SCORE');
		$param['PUPIL']=$this->input->post('PUPIL');
		$param['SATURASI_O2']=$this->input->post('SATURASI_O2');
		$param['SUPLEMEN_O2']=$this->input->post('SUPLEMEN_O2');
		$param['GDS']=$this->input->post('GDS');
		$param['URIN_OUTPUT']=$this->input->post('URIN_OUTPUT');
		$param['KESADARAN']=$this->input->post('KESADARAN');
		$param['NYERI']=$this->input->post('NYERI');
		$param['DISCHARGE_LOCHIA']=$this->input->post('DISCHARGE_LOCHIA');
		$param['PROTEINURIA_HARI']=$this->input->post('PROTEINURIA_HARI');
		$param['KEADAAN_UMUM']=$this->input->post('KEADAAN_UMUM');
		$param['KARDIO_VASKULAR']=$this->input->post('KARDIO_VASKULAR');
		$param['RESPIRASI']=$this->input->post('RESPIRASI');
		$param['NM_LAIN']=$this->input->post('NM_LAIN');
		$param['NILAI_LAIN']=$this->input->post('NILAI_LAIN');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['JADWAL_SHOLAT']=$this->input->post('JADWAL_SHOLAT');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_tanda_vital",$param,false);
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

	function hapus_tanda_vital()
	{
		$param['NO_TANDA_VITAL']=$this->input->post('NO_TANDA_VITAL');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_tanda_vital",$param,false);

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




	function grafik_vital()
	{
		if(!cek_menu('grafik_vital',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_grafik_vital";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$this->load->view("page/rm_content",$data);
			}
		}
	}


	function data_grafik()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NO_REG')))
			{
				$param['NO_REG']=$this->input->post('NO_REG');
				$data=$this->webapi->post("emr/emr_ranap/data_grafik",$param,false);
	
				if($data)
				{
					$detail["SUHU"]=array();
					$detail["NADI"]=array();
					$detail["TD"]=array();
					$detail["RESPIRASI"]=array();
					$detail["NYERI"]=array();
					$detail["JATUH"]=array();
					if($data->response=='200')
					{
						foreach ($data->data as $dt) 
						{
							if($dt->SUHU!='')
							{
								array_push($detail["SUHU"], array("WAKTU"=>'Hari:'.$dt->HARI_RAWAT.',Jam:'.$dt->JAM_KE,"VALUE"=>$dt->SUHU));
							};
							if($dt->NADI!='')
							{
								array_push($detail["NADI"], array("WAKTU"=>'Hari:'.$dt->HARI_RAWAT.',Jam:'.$dt->JAM_KE,"VALUE"=>$dt->NADI));
							};
							if($dt->TD_DIA!='')
							{
								array_push($detail["TD"], array("WAKTU"=>'Hari:'.$dt->HARI_RAWAT.',Jam:'.$dt->JAM_KE,"ATAS"=>$dt->TD_SIS,"BAWAH"=>$dt->TD_DIA));
							};
							if($dt->PERNAFASAN!='')
							{
								array_push($detail["RESPIRASI"], array("WAKTU"=>'Hari:'.$dt->HARI_RAWAT.',Jam:'.$dt->JAM_KE,"VALUE"=>$dt->PERNAFASAN));
							};
							if($dt->SKALA_NYERI!='')
							{
								array_push($detail["NYERI"], array("WAKTU"=>'Hari:'.$dt->HARI_RAWAT.',Jam:'.$dt->JAM_KE,"VALUE"=>$dt->SKALA_NYERI));
							};
							if($dt->RESIKO_JATUH!='')
							{
								array_push($detail["JATUH"], array("WAKTU"=>'Hari:'.$dt->HARI_RAWAT.',Jam:'.$dt->JAM_KE,"VALUE"=>$dt->RESIKO_JATUH));
							}
						}
						echo json_encode($detail);
					}

				}
			}
		}
	}


	function ews_dewasa()
	{
		if(!cek_menu('ews_dewasa',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_ews_dewasa";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_ews']=$this->webapi->post("emr/emr_ranap/data_ews",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function ews_pediatri()
	{
		if(!cek_menu('ews_pediatri',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_ews_pediatri";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_ews']=$this->webapi->post("emr/emr_ranap/data_ews",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function ews_obstetri()
	{
		if(!cek_menu('ews_obstetri',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_ews_obstetri";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_ews']=$this->webapi->post("emr/emr_ranap/data_ews",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function verifikasi_ews()
	{
		$param['NO_TANDA_VITAL']=$this->input->post('NO_TANDA_VITAL');
		$param['KD_STATUS_EWS']=$this->input->post('KD_STATUS_EWS');
		$param['NM_STATUS_EWS']=$this->input->post('NM_STATUS_EWS');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		$data=$this->webapi->post("emr/emr_ranap/verifikasi_ews",$param,false);
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


	function pemberian_obat_tindakan()
	{
		if(!cek_menu('pemberian_obat_tindakan',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_pemberian_obat_tindakan";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_obat_pasien']=$this->webapi->post("emr/emr_ranap/data_obat_pasien",$param,false); 
				$data['data_beri_obat']=$this->webapi->post("emr/emr_ranap/data_beri_obat",$param,false);
				$data['data_beri_diet']=$this->webapi->post("emr/emr_ranap/data_beri_diet",$param,false);
				$data['data_tindakan_ppi']=$this->webapi->post("emr/emr_ranap/data_tindakan_ppi",array(),false);
				$data['data_op']=$this->webapi->post("ibs/master/data_op",array(),false);	
				$data['data_beri_tindakan']=$this->webapi->post("emr/emr_ranap/data_beri_tindakan",$param,false);
				$data['data_beri_bhp']=$this->webapi->post("emr/emr_ranap/data_beri_bhp",$param,false);
				$data['data_beri_tindakan_mati']=$this->webapi->post("emr/emr_ranap/data_beri_tindakan_mati",$param,false);
				$data['data_beri_talqin']=$this->webapi->post("emr/emr_ranap/data_beri_talqin",$param,false);

				$data['data_pemeriksaan_lab']=$this->webapi->post("emr/emr_ranap/data_pemeriksaan_lab",$param,false);
				$data['data_pemeriksaan_rad']=$this->webapi->post("emr/emr_ranap/data_pemeriksaan_rad",$param,false);
				$data['data_pemeriksaan_usg']=$this->webapi->post("emr/emr_ranap/data_pemeriksaan_usg",$param,false);

				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function reload_beri_obat()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_beri_obat']=$this->webapi->post("emr/emr_ranap/data_beri_obat",$param,false);
		$this->load->view('ranap/v_beri_obatt',$data);
	}

	function detail_beri_obat()
	{
		$param['NO_URUT_BERI_OBAT']=$this->input->post('NO_URUT_BERI_OBAT');
		$data=$this->webapi->post("emr/emr_ranap/detail_beri_obat",$param);
		echo $data;
	}


	function simpan_beri_obat()
	{
		$param['NO_URUT_BERI_OBAT']=$this->input->post('NO_URUT_BERI_OBAT');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NIK_PETUGAS']=$this->session->userdata('NIK');
		$param['TGL_BERI_OBAT']=$this->input->post('TGL_BERI_OBAT');
		$param['IS_ANTIBIOTIK']=$this->input->post('IS_ANTIBIOTIK');
		if($param['IS_ANTIBIOTIK']=='')
		{
			$param['IS_ANTIBIOTIK']='T';
		}
		$param['KD_OBAT']=$this->input->post('KD_OBAT');
		$param['DOSIS']=$this->input->post('DOSIS');
		$param['KATEGORI_OBAT']=$this->input->post('KATEGORI_OBAT');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_beri_obat",$param,false);
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

	function hapus_beri_obat()
	{
		$param['NO_URUT_BERI_OBAT']=$this->input->post('NO_URUT_BERI_OBAT');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_beri_obat",$param,false);

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

	function simpan_monitoring_obat()
	{
		$param['NO_URUT_BERI_OBAT']=$this->input->post('NO_URUT_BERI_OBAT');
		$param['TGL_MONITORING']=$this->input->post('TGL_MONITORING');
		$param['STATUS_MONITORING']=$this->input->post('STATUS_MONITORING');
		$param['KET_MONITORING']=$this->input->post('KET_MONITORING');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_monitoring_obat",$param,false);
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


	function reload_beri_diet()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_beri_diet']=$this->webapi->post("emr/emr_ranap/data_beri_diet",$param,false);
		$this->load->view('ranap/v_beri_diett',$data);
	}

	function detail_beri_diet()
	{
		$param['NO_URUT_BERI_DIET']=$this->input->post('NO_URUT_BERI_DIET');
		$data=$this->webapi->post("emr/emr_ranap/detail_beri_diet",$param);
		echo $data;
	}


	function simpan_beri_diet()
	{
		$param['NO_URUT_BERI_DIET']=$this->input->post('NO_URUT_BERI_DIET');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->session->userdata('NIK');
		$param['TGL_BERI_DIET']=$this->input->post('TGL_BERI_DIET');
		$param['DIET']=$this->input->post('DIET');
		$param['PORSI']=$this->input->post('PORSI');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_beri_diet",$param,false);
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

	function hapus_beri_diet()
	{
		$param['NO_URUT_BERI_DIET']=$this->input->post('NO_URUT_BERI_DIET');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_beri_diet",$param,false);

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

	function reload_beri_tindakan()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_beri_tindakan']=$this->webapi->post("emr/emr_ranap/data_beri_tindakan",$param,false);
		$this->load->view('ranap/v_beri_tindakant',$data);
	}

	function detail_beri_tindakan()
	{
		$param['NO_URUT_BERI_TINDAKAN']=$this->input->post('NO_URUT_BERI_TINDAKAN');
		$data=$this->webapi->post("emr/emr_ranap/detail_beri_tindakan",$param);
		echo $data;
	}


	function simpan_beri_tindakan()
	{
		$param['NO_URUT_BERI_TINDAKAN']=$this->input->post('NO_URUT_BERI_TINDAKAN');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NIK_PETUGAS']=$this->session->userdata('NIK');
		$param['TGL_BERI_TINDAKAN']=$this->input->post('TGL_BERI_TINDAKAN');
		$param['KD_TINDAKAN_PPI']=$this->input->post('KD_TINDAKAN_PPI');
		$param['TINDAKAN']=$this->input->post('TINDAKAN');
		$param['KD_OP']=$this->input->post('KD_OP');
		$param['SESUAI_JENIS_KELAMIN']=$this->input->post('SESUAI_JENIS_KELAMIN');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_beri_tindakan",$param,false);
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

	function hapus_beri_tindakan()
	{
		$param['NO_URUT_BERI_TINDAKAN']=$this->input->post('NO_URUT_BERI_TINDAKAN');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_beri_tindakan",$param,false);

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

	function reload_beri_bhp()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_beri_bhp']=$this->webapi->post("emr/emr_ranap/data_beri_bhp",$param,false);
		$this->load->view('ranap/v_beri_bhpt',$data);
	}

	function detail_beri_bhp()
	{
		$param['NO_URUT_BERI_BHP']=$this->input->post('NO_URUT_BERI_BHP');
		$data=$this->webapi->post("emr/emr_ranap/detail_beri_bhp",$param);
		echo $data;
	}


	function simpan_beri_bhp()
	{
		$param['NO_URUT_BERI_BHP']=$this->input->post('NO_URUT_BERI_BHP');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->session->userdata('NIK');
		$param['TGL_BERI_BHP']=$this->input->post('TGL_BERI_BHP');
		$param['NM_BHP']=$this->input->post('NM_BHP');
		$param['SATUAN']=$this->input->post('SATUAN');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_beri_bhp",$param,false);
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

	function hapus_beri_bhp()
	{
		$param['NO_URUT_BERI_BHP']=$this->input->post('NO_URUT_BERI_BHP');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_beri_bhp",$param,false);

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

	function reload_beri_tindakan_mati()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_beri_tindakan_mati']=$this->webapi->post("emr/emr_ranap/data_beri_tindakan_mati",$param,false);
		$this->load->view('ranap/v_beri_tindakan_matit',$data);
	}

	function detail_beri_tindakan_mati()
	{
		$param['NO_URUT_BERI_TINDAKAN_MATI']=$this->input->post('NO_URUT_BERI_TINDAKAN_MATI');
		$data=$this->webapi->post("emr/emr_ranap/detail_beri_tindakan_mati",$param);
		echo $data;
	}


	function simpan_beri_tindakan_mati()
	{
		$param['NO_URUT_BERI_TINDAKAN_MATI']=$this->input->post('NO_URUT_BERI_TINDAKAN_MATI');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->session->userdata('NIK');
		$param['TGL_BERI_TINDAKAN_MATI']=$this->input->post('TGL_BERI_TINDAKAN_MATI');
		$param['DONASI_ORGAN']=$this->input->post('DONASI_ORGAN');
		$param['RS_PENERIMA_DONASI']=$this->input->post('RS_PENERIMA_DONASI');
		$param['IS_DNR']=$this->input->post('IS_DNR');
		if($param['IS_DNR']=='')
		{
			$param['IS_DNR']='T';
		}
		$param['IS_RJP']=$this->input->post('IS_RJP');
		if($param['IS_RJP']=='')
		{
			$param['IS_RJP']='T';
		}
		$param['IS_EKG']=$this->input->post('IS_EKG');
		if($param['IS_EKG']=='')
		{
			$param['IS_EKG']='T';
		}
		$param['IS_DC_SHOCK']=$this->input->post('IS_DC_SHOCK');
		if($param['IS_DC_SHOCK']=='')
		{
			$param['IS_DC_SHOCK']='T';
		}
		$param['IS_PENDAMPINGAN']=$this->input->post('IS_PENDAMPINGAN');
		if($param['IS_PENDAMPINGAN']=='')
		{
			$param['IS_PENDAMPINGAN']='T';
		}
		$param['IS_SKRTL_KIT']=$this->input->post('IS_SKRTL_KIT');
		if($param['IS_SKRTL_KIT']=='')
		{
			$param['IS_SKRTL_KIT']='T';
		}
		$param['IS_KOMA_KIT']=$this->input->post('IS_KOMA_KIT');
		if($param['IS_KOMA_KIT']=='')
		{
			$param['IS_KOMA_KIT']='T';
		}
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_beri_tindakan_mati",$param,false);
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

	function hapus_beri_tindakan_mati()
	{
		$param['NO_URUT_BERI_TINDAKAN_MATI']=$this->input->post('NO_URUT_BERI_TINDAKAN_MATI');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_beri_tindakan_mati",$param,false);

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

	function reload_beri_talqin()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_beri_talqin']=$this->webapi->post("emr/emr_ranap/data_beri_talqin",$param,false);
		$this->load->view('ranap/v_beri_talqint',$data);
	}

	function detail_beri_talqin()
	{
		$param['NO_URUT_TALQIN']=$this->input->post('NO_URUT_TALQIN');
		$data=$this->webapi->post("emr/emr_ranap/detail_beri_talqin",$param);
		echo $data;
	}


	function simpan_beri_talqin()
	{
		$param['NO_URUT_TALQIN']=$this->input->post('NO_URUT_TALQIN');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->session->userdata('NIK');
		$param['TGL_BERI_TALQIN']=$this->input->post('TGL_BERI_TALQIN');
		$param['IS_RESPON']=$this->input->post('IS_RESPON');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_beri_talqin",$param,false);
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

	function hapus_beri_talqin()
	{
		$param['NO_URUT_TALQIN']=$this->input->post('NO_URUT_TALQIN');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_beri_talqin",$param,false);

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


	function risiko_jatuh_dewasa()
	{
		if(!cek_menu('risiko_jatuh_dewasa',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_risiko_jatuh_dewasa";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_risiko_jatuh_dewasa']=$this->webapi->post("emr/emr_ranap/data_risiko_jatuh_dewasa",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function reload_risiko_jatuh_dewasa()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_risiko_jatuh_dewasa']=$this->webapi->post("emr/emr_ranap/data_risiko_jatuh_dewasa",$param,false);
		$this->load->view('ranap/v_risiko_jatuh_dewasat',$data);
	}

	function detail_risiko_jatuh_dewasa()
	{
		$param['NO_URUT_RISIKO']=$this->input->post('NO_URUT_RISIKO');
		$data=$this->webapi->post("emr/emr_ranap/detail_risiko_jatuh_dewasa",$param);
		echo $data;
	}


	function simpan_risiko_jatuh_dewasa()
	{
		$param['NO_URUT_RISIKO']=$this->input->post('NO_URUT_RISIKO');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->session->userdata('NIK');
		$param['TGL_RISIKO']=$this->input->post('TGL_RISIKO');
		$param['RIWAYAT_JATUH']=$this->input->post('RIWAYAT_JATUH');
		$param['DIAG_SEKUNDER']=$this->input->post('DIAG_SEKUNDER');
		$param['BANTUAN_AMBULASI']=$this->input->post('BANTUAN_AMBULASI');
		$param['AKSES_INTRAVENA']=$this->input->post('AKSES_INTRAVENA');
		$param['GAYA_BERJALAN']=$this->input->post('GAYA_BERJALAN');
		$param['STATUS_MENTAL']=$this->input->post('STATUS_MENTAL');
		$param['SKOR_RISIKO']=$this->input->post('SKOR_RISIKO');
		$param['KESIMPULAN']=$this->input->post('KESIMPULAN');
		$ARR_INTERVENSI=$this->input->post('INTERVENSI');
		if(!is_null($ARR_INTERVENSI))
		{
			$param['INTERVENSI']=implode(',', $ARR_INTERVENSI);
		}
		else
		{
			$param['INTERVENSI']='';
		}
		$param['CATATAN']=$this->input->post('CATATAN');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_risiko_jatuh_dewasa",$param,false);
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

	function hapus_risiko_jatuh_dewasa()
	{
		$param['NO_URUT_RISIKO']=$this->input->post('NO_URUT_RISIKO');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_risiko_jatuh_dewasa",$param,false);

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



	function risiko_jatuh_pediatri()
	{
		if(!cek_menu('risiko_jatuh_pediatri',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_risiko_jatuh_pediatri";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_risiko_jatuh_pediatri']=$this->webapi->post("emr/emr_ranap/data_risiko_jatuh_pediatri",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function reload_risiko_jatuh_pediatri()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_risiko_jatuh_pediatri']=$this->webapi->post("emr/emr_ranap/data_risiko_jatuh_pediatri",$param,false);
		$this->load->view('ranap/v_risiko_jatuh_pediatrit',$data);
	}

	function detail_risiko_jatuh_pediatri()
	{
		$param['NO_URUT_RISIKO']=$this->input->post('NO_URUT_RISIKO');
		$data=$this->webapi->post("emr/emr_ranap/detail_risiko_jatuh_pediatri",$param);
		echo $data;
	}


	function simpan_risiko_jatuh_pediatri()
	{
		$param['NO_URUT_RISIKO']=$this->input->post('NO_URUT_RISIKO');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->session->userdata('NIK');
		$param['TGL_RISIKO']=$this->input->post('TGL_RISIKO');
		$param['USIA']=$this->input->post('USIA');
		$param['JENIS_KELAMIN']=$this->input->post('JENIS_KELAMIN');
		$param['DIAGNOSIS']=$this->input->post('DIAGNOSIS');
		$param['GANGGUAN_KOGNITIF']=$this->input->post('GANGGUAN_KOGNITIF');
		$param['FAKTOR_LINGKUNGAN']=$this->input->post('FAKTOR_LINGKUNGAN');
		$param['PENGARUH_BEDAH']=$this->input->post('PENGARUH_BEDAH');
		$param['PENGGUNAAN_OBAT']=$this->input->post('PENGGUNAAN_OBAT');
		$param['TOTAL_SKOR']=$this->input->post('TOTAL_SKOR');
		$param['KESIMPULAN']=$this->input->post('KESIMPULAN');
		$ARR_INTERVENSI=$this->input->post('INTERVENSI');
		if(!is_null($ARR_INTERVENSI))
		{
			$param['INTERVENSI']=implode(',', $ARR_INTERVENSI);
		}
		else
		{
			$param['INTERVENSI']='';
		}
		$param['CATATAN']=$this->input->post('CATATAN');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_risiko_jatuh_pediatri",$param,false);
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

	function hapus_risiko_jatuh_pediatri()
	{
		$param['NO_URUT_RISIKO']=$this->input->post('NO_URUT_RISIKO');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_risiko_jatuh_pediatri",$param,false);

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

	function risiko_jatuh_geriatri()
	{
		if(!cek_menu('risiko_jatuh_geriatri',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_risiko_jatuh_geriatri";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_risiko_jatuh_geriatri']=$this->webapi->post("emr/emr_ranap/data_risiko_jatuh_geriatri",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function reload_risiko_jatuh_geriatri()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_risiko_jatuh_geriatri']=$this->webapi->post("emr/emr_ranap/data_risiko_jatuh_geriatri",$param,false);
		$this->load->view('ranap/v_risiko_jatuh_geriatrit',$data);
	}

	function detail_risiko_jatuh_geriatri()
	{
		$param['NO_URUT_RISIKO']=$this->input->post('NO_URUT_RISIKO');
		$data=$this->webapi->post("emr/emr_ranap/detail_risiko_jatuh_geriatri",$param);
		echo $data;
	}


	function simpan_risiko_jatuh_geriatri()
	{
		$param['NO_URUT_RISIKO']=$this->input->post('NO_URUT_RISIKO');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->session->userdata('NIK');
		$param['TGL_RISIKO']=$this->input->post('TGL_RISIKO');
		$param['RIWAYAT_JATUH']=$this->input->post('RIWAYAT_JATUH');
		$param['IS_KARENA_JATUH']=$this->input->post('IS_KARENA_JATUH');
		if($param['IS_KARENA_JATUH']=='')
		{
			$param['IS_KARENA_JATUH']='T';
		}
		$param['IS_2_BULAN_JATUH']=$this->input->post('IS_2_BULAN_JATUH');
		if($param['IS_2_BULAN_JATUH']=='')
		{
			$param['IS_2_BULAN_JATUH']='T';
		}
		$param['STATUS_MENTAL']=$this->input->post('STATUS_MENTAL');
		$param['IS_DELIRIUM']=$this->input->post('IS_DELIRIUM');
		if($param['IS_DELIRIUM']=='')
		{
			$param['IS_DELIRIUM']='T';
		}
		$param['IS_DISORIENTASI']=$this->input->post('IS_DISORIENTASI');
		if($param['IS_DISORIENTASI']=='')
		{
			$param['IS_DISORIENTASI']='T';
		}
		$param['IS_AGITASI']=$this->input->post('IS_AGITASI');
		if($param['IS_AGITASI']=='')
		{
			$param['IS_AGITASI']='T';
		}
		$param['PENGLIHATAN']=$this->input->post('PENGLIHATAN');
		$param['IS_KACAMATA']=$this->input->post('IS_KACAMATA');
		if($param['IS_KACAMATA']=='')
		{
			$param['IS_KACAMATA']='T';
		}
		$param['IS_BURAM']=$this->input->post('IS_BURAM');
		if($param['IS_BURAM']=='')
		{
			$param['IS_BURAM']='T';
		}
		$param['IS_KATARAK']=$this->input->post('IS_KATARAK');
		if($param['IS_KATARAK']=='')
		{
			$param['IS_KATARAK']='T';
		}
		$param['KEBIASAAN_BERKEMIH']=$this->input->post('KEBIASAAN_BERKEMIH');
		$param['IS_PERUBAHAN_PRILAKU']=$this->input->post('IS_PERUBAHAN_PRILAKU');
		if($param['IS_PERUBAHAN_PRILAKU']=='')
		{
			$param['IS_PERUBAHAN_PRILAKU']='T';
		}
		$param['TRANSFER']=$this->input->post('TRANSFER');
		$param['MOBILITAS']=$this->input->post('MOBILITAS');
		$param['SKOR_TRANSFER_MOBILITAS']=$this->input->post('SKOR_TRANSFER_MOBILITAS');
		$param['TOTAL_SKOR']=$this->input->post('TOTAL_SKOR');
		$param['KESIMPULAN']=$this->input->post('KESIMPULAN');
		$ARR_INTERVENSI=$this->input->post('INTERVENSI');
		if(!is_null($ARR_INTERVENSI))
		{
			$param['INTERVENSI']=implode(',', $ARR_INTERVENSI);
		}
		else
		{
			$param['INTERVENSI']='';
		}
		$param['CATATAN']=$this->input->post('CATATAN');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_risiko_jatuh_geriatri",$param,false);
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

	function hapus_risiko_jatuh_geriatri()
	{
		$param['NO_URUT_RISIKO']=$this->input->post('NO_URUT_RISIKO');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_risiko_jatuh_geriatri",$param,false);

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

	function asesmen_keperawatan_dewasa()
	{
		if(!cek_menu('asesmen_keperawatan_dewasa',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_asesmen_keperawatan_dewasa";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_pj']=$this->webapi->post("emr/emr_ranap/data_pj",$param,false);
				$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
				$data['riwayat_kehamilan_persalinan']=$this->webapi->post("emr/emr_rajal/riwayat_kehamilan_persalinan",$param,false);
				$data['detail_asesmen_perawat_ranap']=$this->webapi->post("emr/emr_ranap/detail_asesmen_perawat_ranap",$param,false);
				$data['data_skrining_nyeri']=$this->webapi->post("emr/emr_ranap/data_pengkajian_nyeri",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function asesmen_keperawatan_pediatri()
	{
		if(!cek_menu('asesmen_keperawatan_pediatri',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_asesmen_keperawatan_pediatri";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
				$data['data_pj']=$this->webapi->post("emr/emr_ranap/data_pj",$param,false);
				$data['riwayat_kehamilan_persalinan']=$this->webapi->post("emr/emr_rajal/riwayat_kehamilan_persalinan",$param,false);
				$data['detail_asesmen_perawat_ranap']=$this->webapi->post("emr/emr_ranap/detail_asesmen_perawat_ranap",$param,false);
				$data['data_skrining_nyeri']=$this->webapi->post("emr/emr_ranap/data_pengkajian_nyeri",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function asesmen_keperawatan_obstetri()
	{
		if(!cek_menu('asesmen_keperawatan_obstetri',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_asesmen_keperawatan_obstetri";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
				$data['data_pj']=$this->webapi->post("emr/emr_ranap/data_pj",$param,false);
				$data['riwayat_kehamilan_persalinan']=$this->webapi->post("emr/emr_rajal/riwayat_kehamilan_persalinan",$param,false);
				$data['detail_asesmen_perawat_ranap']=$this->webapi->post("emr/emr_ranap/detail_asesmen_perawat_ranap",$param,false);
				$data['data_skrining_nyeri']=$this->webapi->post("emr/emr_ranap/data_pengkajian_nyeri",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}


	function simpan_asesmen_perawat_ranap()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['TGL_MASUK']=$this->input->post('TGL_MASUK');
		$param['TGL_ASESMEN']=$this->input->post('TGL_ASESMEN');
		$param['PENYELESAIAN_KAJIAN']=$this->input->post('PENYELESAIAN_KAJIAN');
		$param['CARA_MASUK']=$this->input->post('CARA_MASUK');
		$param['SUMBER_DATA']=$this->input->post('SUMBER_DATA');
		$param['NM_PJ']=$this->input->post('NM_PJ');
		$param['UMUR_PJ']=$this->input->post('UMUR_PJ');
		$param['ALAMAT_PJ']=$this->input->post('ALAMAT_PJ');
		$param['ID_PJ']=$this->input->post('ID_PJ');
		$param['HP_PJ']=$this->input->post('HP_PJ');
		$param['AGAMA_PJ']=$this->input->post('AGAMA_PJ');
		$param['KELUHAN_UTAMA']=$this->input->post('KELUHAN_UTAMA');
		$param['RIWAYAT_PENYAKIT_SEKARANG']=$this->input->post('RIWAYAT_PENYAKIT_SEKARANG');
		$param['RIWAYAT_PENYAKIT_DULU']=$this->input->post('RIWAYAT_PENYAKIT_DULU');
		$param['RIWAYAT_PENYAKIT_KELUARGA']=$this->input->post('RIWAYAT_PENYAKIT_KELUARGA');
		$param['IS_ALERGI']=$this->input->post('IS_ALERGI');
		if($param['IS_ALERGI']=='')
		{
			$param['IS_ALERGI']='T';
		}
		$param['ALERGI']=$this->input->post('ALERGI');
		$param['RIWAYAT_TRANFUSI_DARAH']=$this->input->post('RIWAYAT_TRANFUSI_DARAH');
		$param['IS_ROKOK']=$this->input->post('IS_ROKOK');
		if($param['IS_ROKOK']=='')
		{
			$param['IS_ROKOK']='T';
		}
		$param['JUMLAH_ROKOK']=$this->input->post('JUMLAH_ROKOK');
		$param['ROKOK_SEJAK']=$this->input->post('ROKOK_SEJAK');
		$param['IS_ALKOHOL']=$this->input->post('IS_ALKOHOL');
		if($param['IS_ALKOHOL']=='')
		{
			$param['IS_ALKOHOL']='T';
		}
		$param['JUMLAH_ALKOHOL']=$this->input->post('JUMLAH_ALKOHOL');
		$param['ALKOHOL_SEJAK']=$this->input->post('ALKOHOL_SEJAK');
		$param['RIWAYAT_PENGOBATAN_DIRUMAH']=$this->input->post('RIWAYAT_PENGOBATAN_DIRUMAH');
		$param['RIWAYAT_KEKERASAN']=$this->input->post('RIWAYAT_KEKERASAN');
		$param['RIWAYAT_KEMOTERAPI']=$this->input->post('RIWAYAT_KEMOTERAPI');
		$param['RIWAYAT_PRENATAL']=$this->input->post('RIWAYAT_PRENATAL');
		$param['RIWAYAT_PERSALINAN']=$this->input->post('RIWAYAT_PERSALINAN');
		$param['RIWAYAT_POST_NATAL']=$this->input->post('RIWAYAT_POST_NATAL');
		$param['RIWAYAT_IMUNISASI']=$this->input->post('RIWAYAT_IMUNISASI');
		$param['RIWAYAT_TUMBUH_KEMBANG']=$this->input->post('RIWAYAT_TUMBUH_KEMBANG');
		$param['G']=$this->input->post('G');
		$param['P']=$this->input->post('P');
		$param['AB']=$this->input->post('AB');
		$param['AH']=$this->input->post('AH');
		$param['AM']=$this->input->post('AM');
		$param['RIWAYAT_GYNEKOLOGI']=$this->input->post('RIWAYAT_GYNEKOLOGI');
		$param['DIAGNOSA_MEDIS']=$this->input->post('DIAGNOSA_MEDIS');
		$param['TD_SIS']=$this->input->post('TD_SIS');
		$param['TD_DIA']=$this->input->post('TD_DIA');
		$param['PERNAFASAN']=$this->input->post('PERNAFASAN');
		$param['NADI']=$this->input->post('NADI');
		$param['TINGGI_BADAN']=$this->input->post('TINGGI_BADAN');
		$param['SUHU']=$this->input->post('SUHU');
		$param['SPO2']=$this->input->post('SPO2');
		$param['BERAT_BADAN']=$this->input->post('BERAT_BADAN');
		$param['GDS']=$this->input->post('GDS');
		$param['GCS_E']=$this->input->post('GCS_E');
		$param['GCS_M']=$this->input->post('GCS_M');
		$param['GCS_V']=$this->input->post('GCS_V');
		$param['GCS_SCORE']=$this->input->post('GCS_SCORE');
		$param['KESADARAN']=$this->input->post('KESADARAN');
		$param['SKALA_NYERI']=$this->input->post('SKALA_NYERI');
		$param['IS_PENDARAHAN_HAMIL_MUDA']=$this->input->post('IS_PENDARAHAN_HAMIL_MUDA');
		if($param['IS_PENDARAHAN_HAMIL_MUDA']=='')
		{
			$param['IS_PENDARAHAN_HAMIL_MUDA']='T';
		}
		$param['IS_PENDARAHAN_HAMIL_TUA']=$this->input->post('IS_PENDARAHAN_HAMIL_TUA');
		if($param['IS_PENDARAHAN_HAMIL_TUA']=='')
		{
			$param['IS_PENDARAHAN_HAMIL_TUA']='T';
		}
		$param['IS_OEDEMA_KAKI']=$this->input->post('IS_OEDEMA_KAKI');
		if($param['IS_OEDEMA_KAKI']=='')
		{
			$param['IS_OEDEMA_KAKI']='T';
		}
		$param['IS_OEDEMA_TANGAN']=$this->input->post('IS_OEDEMA_TANGAN');
		if($param['IS_OEDEMA_TANGAN']=='')
		{
			$param['IS_OEDEMA_TANGAN']='T';
		}
		$param['IS_OEDEMA_WAJAH']=$this->input->post('IS_OEDEMA_WAJAH');
		if($param['IS_OEDEMA_WAJAH']=='')
		{
			$param['IS_OEDEMA_WAJAH']='T';
		}
		$param['IS_PUSING_PUSING']=$this->input->post('IS_PUSING_PUSING');
		if($param['IS_PUSING_PUSING']=='')
		{
			$param['IS_PUSING_PUSING']='T';
		}
		$param['IS_KEJANG_HAMIL']=$this->input->post('IS_KEJANG_HAMIL');
		if($param['IS_KEJANG_HAMIL']=='')
		{
			$param['IS_KEJANG_HAMIL']='T';
		}
		$param['IS_DEMAM_TINGGI']=$this->input->post('IS_DEMAM_TINGGI');
		if($param['IS_DEMAM_TINGGI']=='')
		{
			$param['IS_DEMAM_TINGGI']='T';
		}
		$param['IS_KETUBAN_PECAH_DINI']=$this->input->post('IS_KETUBAN_PECAH_DINI');
		if($param['IS_KETUBAN_PECAH_DINI']=='')
		{
			$param['IS_KETUBAN_PECAH_DINI']='T';
		}
		$param['IS_HIPERTENSI_GRAVI']=$this->input->post('IS_HIPERTENSI_GRAVI');
		if($param['IS_HIPERTENSI_GRAVI']=='')
		{
			$param['IS_HIPERTENSI_GRAVI']='T';
		}
		$param['OBAT_JAMU']=$this->input->post('OBAT_JAMU');
		$param['KEPALA']=$this->input->post('KEPALA');
		$param['RAMBUT']=$this->input->post('RAMBUT');
		$param['WAJAH']=$this->input->post('WAJAH');
		$param['MATA']=$this->input->post('MATA');
		$param['TELINGA']=$this->input->post('TELINGA');
		$param['HIDUNG']=$this->input->post('HIDUNG');
		$param['MULUT']=$this->input->post('MULUT');
		$param['GIGI']=$this->input->post('GIGI');
		$param['LIDAH']=$this->input->post('LIDAH');
		$param['TENGGOROKAN']=$this->input->post('TENGGOROKAN');
		$param['LEHER']=$this->input->post('LEHER');
		$param['DADA']=$this->input->post('DADA');
		$param['RESPIRASI']=$this->input->post('RESPIRASI');
		$param['JANTUNG']=$this->input->post('JANTUNG');
		$param['INTEGUMEN']=$this->input->post('INTEGUMEN');
		$param['ABDOMEN']=$this->input->post('ABDOMEN');
		$param['EKSTREMITAS']=$this->input->post('EKSTREMITAS');
		$param['GENITALIA']=$this->input->post('GENITALIA');
		$param['TGL_FUNGSIONAL_MASUK']=$this->input->post('TGL_FUNGSIONAL_MASUK');
		$param['TGL_FUNGSIONAL_KELUAR']=$this->input->post('TGL_FUNGSIONAL_KELUAR');
		$param['RANGSANG_DEFEKSI_M']=$this->input->post('RANGSANG_DEFEKSI_M');
		$param['RANGSANG_DEFEKSI_K']=$this->input->post('RANGSANG_DEFEKSI_K');
		$param['RANGSANG_BERKEMIH_M']=$this->input->post('RANGSANG_BERKEMIH_M');
		$param['RANGSANG_BERKEMIH_K']=$this->input->post('RANGSANG_BERKEMIH_K');
		$param['BERSIHKAN_DIRI_M']=$this->input->post('BERSIHKAN_DIRI_M');
		$param['BERSIHKAN_DIRI_K']=$this->input->post('BERSIHKAN_DIRI_K');
		$param['PAKAI_JAMBAN_M']=$this->input->post('PAKAI_JAMBAN_M');
		$param['PAKAI_JAMBAN_K']=$this->input->post('PAKAI_JAMBAN_K');
		$param['MAMPU_MAKAN_M']=$this->input->post('MAMPU_MAKAN_M');
		$param['MAMPU_MAKAN_K']=$this->input->post('MAMPU_MAKAN_K');
		$param['BERUBAH_POSISI_M']=$this->input->post('BERUBAH_POSISI_M');
		$param['BERUBAH_POSISI_K']=$this->input->post('BERUBAH_POSISI_K');
		$param['BERJALAN_M']=$this->input->post('BERJALAN_M');
		$param['BERJALAN_K']=$this->input->post('BERJALAN_K');
		$param['PAKAI_BAJU_M']=$this->input->post('PAKAI_BAJU_M');
		$param['PAKAI_BAJU_K']=$this->input->post('PAKAI_BAJU_K');
		$param['NAIK_TURUN_TANGGA_M']=$this->input->post('NAIK_TURUN_TANGGA_M');
		$param['NAIK_TURUN_TANGGA_K']=$this->input->post('NAIK_TURUN_TANGGA_K');
		$param['MANDI_M']=$this->input->post('MANDI_M');
		$param['MANDI_K']=$this->input->post('MANDI_K');
		$param['SKOR_M']=$this->input->post('SKOR_M');
		$param['SKOR_K']=$this->input->post('SKOR_K');
		$param['KESIMPULAN_FUNGSIONAL']=$this->input->post('KESIMPULAN_FUNGSIONAL');
		$param['ALAT_BANTU']=$this->input->post('ALAT_BANTU');
		$param['CACAT_TUBUH']=$this->input->post('CACAT_TUBUH');
		$param['PERLU_DIRESTRAIN']=$this->input->post('PERLU_DIRESTRAIN');
		$param['STATUS_MENTAL']=$this->input->post('STATUS_MENTAL');
		$param['NM_STATUS_MENTAL']=$this->input->post('NM_STATUS_MENTAL');
		$param['DISORIENTASI']=$this->input->post('DISORIENTASI');
		$param['IS_KEJANG']=$this->input->post('IS_KEJANG');
		if($param['IS_KEJANG']=='')
		{
			$param['IS_KEJANG']='T';
		}
		$param['TIPE_KEJANG']=$this->input->post('TIPE_KEJANG');
		$param['PENGLIHATAN']=$this->input->post('PENGLIHATAN');
		$param['PENDENGARAN']=$this->input->post('PENDENGARAN');
		$param['JENIS_NUTRISI']=$this->input->post('JENIS_NUTRISI');
		$param['TAMPAK_KURUS_A']=$this->input->post('TAMPAK_KURUS_A');
		$param['BB_KURUS_A']=$this->input->post('BB_KURUS_A');
		$param['TB_KURUS_A']=$this->input->post('TB_KURUS_A');
		$param['TURUN_BB_A']=$this->input->post('TURUN_BB_A');
		$param['KONDISI_TERTENTU_A']=$this->input->post('KONDISI_TERTENTU_A');
		$param['RISIKO_MALNUTRISI_A']=$this->input->post('RISIKO_MALNUTRISI_A');
		$param['PENYAKIT_MALNUTRISI_A']=$this->input->post('PENYAKIT_MALNUTRISI_A');
		$param['SKOR_NUTRISI_A']=$this->input->post('SKOR_NUTRISI_A');
		$param['KESIMPULAN_A']=$this->input->post('KESIMPULAN_A');
		$param['TURUN_BB_D']=$this->input->post('TURUN_BB_D');
		$param['ASUPAN_KURANG_D']=$this->input->post('ASUPAN_KURANG_D');
		$param['SKOR_NUTRISI_D']=$this->input->post('SKOR_NUTRISI_D');
		$param['TURUN_BB_K']=$this->input->post('TURUN_BB_K');
		$param['ASUPAN_KURANG_K']=$this->input->post('ASUPAN_KURANG_K');
		$param['SKOR_NUTRISI_K']=$this->input->post('SKOR_NUTRISI_K');
		$param['IS_MULTI_DIAGNOSIS']=$this->input->post('IS_MULTI_DIAGNOSIS');
		if($param['IS_MULTI_DIAGNOSIS']=='')
		{
			$param['IS_MULTI_DIAGNOSIS']='T';
		}
		$param['MULTI_DIAGNOSIS']=$this->input->post('MULTI_DIAGNOSIS');
		$param['IS_RUJUK_GIZI']=$this->input->post('IS_RUJUK_GIZI');
		if($param['IS_RUJUK_GIZI']=='')
		{
			$param['IS_RUJUK_GIZI']='T';
		}
		$param['BAB']=$this->input->post('BAB');
		$param['BAK']=$this->input->post('BAK');
		$param['IS_HAMIL']=$this->input->post('IS_HAMIL');
		if($param['IS_HAMIL']=='')
		{
			$param['IS_HAMIL']='T';
		}
		$param['TGL_HPL']=$this->input->post('TGL_HPL');
		$param['TGL_HPHT']=$this->input->post('TGL_HPHT');
		$param['MASALAH_PROSTAT']=$this->input->post('MASALAH_PROSTAT');
		$param['PENGGUNAAN_KONTRASEPSI']=$this->input->post('PENGGUNAAN_KONTRASEPSI');
		$param['KELAINAN_REPRODUKSI']=$this->input->post('KELAINAN_REPRODUKSI');
		$param['IS_NYERI']=$this->input->post('IS_NYERI');
		if($param['IS_NYERI']=='')
		{
			$param['IS_NYERI']='T';
		}
		$param['PENGARUH_NYERI']=$this->input->post('PENGARUH_NYERI');
		$param['IS_MENERIMA_PENDIDIKAN']=$this->input->post('IS_MENERIMA_PENDIDIKAN');
		if($param['IS_MENERIMA_PENDIDIKAN']=='')
		{
			$param['IS_MENERIMA_PENDIDIKAN']='T';
		}
		$param['BICARA']=$this->input->post('BICARA');
		$param['BAHASA']=$this->input->post('BAHASA');
		$param['HABATAN_KOMUNIKASI']=$this->input->post('HABATAN_KOMUNIKASI');
		$param['PENDIDIKAN']=$this->input->post('PENDIDIKAN');
		$param['KEBUTUHAN_PEMBELAJARAN']=$this->input->post('KEBUTUHAN_PEMBELAJARAN');
		$param['IDENTIFIKASI_KEPERCAYAAN_PASIEN']=$this->input->post('IDENTIFIKASI_KEPERCAYAAN_PASIEN');
		$param['PEKERJAAN']=$this->input->post('PEKERJAAN');
		$param['TINGGAL_BERSAMA']=$this->input->post('TINGGAL_BERSAMA');
		$param['IS_BUTUH_PENDAMPINGAN']=$this->input->post('IS_BUTUH_PENDAMPINGAN');
		if($param['IS_BUTUH_PENDAMPINGAN']=='')
		{
			$param['IS_BUTUH_PENDAMPINGAN']='T';
		}
		$param['CARE_GIVER']=$this->input->post('CARE_GIVER');
		$param['THOHAROH']=$this->input->post('THOHAROH');
		$param['SHOLAT']=$this->input->post('SHOLAT');
		$param['ASESMEN_TAMBAHAN']=$this->input->post('ASESMEN_TAMBAHAN');
		$param['GANGGUAN_SPIRITUAL']=$this->input->post('GANGGUAN_SPIRITUAL');
		$param['PENDAMPINGAN_BINROH']=$this->input->post('PENDAMPINGAN_BINROH');
		$param['IS_TERLAYANI_BINROH']=$this->input->post('IS_TERLAYANI_BINROH');
		if($param['IS_TERLAYANI_BINROH']=='')
		{
			$param['IS_TERLAYANI_BINROH']='T';
		}
		$param['NM_BINROH']=$this->input->post('NM_BINROH');
		$param['ALASAN_BINROH']=$this->input->post('ALASAN_BINROH');
		$param['MASALAH_KEPERAWATAN']=$this->input->post('MASALAH_KEPERAWATAN');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['NIK_NYA']=$this->session->userdata('NIK');

		$detail_nyeri=array();
		
		$ARR_LOKASI_NYERI=$this->input->post('LOKASI_NYERI');
		$ARR_INTENSITAS_NYERI=$this->input->post('INTENSITAS_NYERI');
		$ARR_DURASI_NYERI=$this->input->post('DURASI_NYERI');
		$ARR_PENCETUS_NYERI=$this->input->post('PENCETUS_NYERI');
		$ARR_KUALITAS_NYERI=$this->input->post('KUALITAS_NYERI');
		$ARR_POLA_NYERI=$this->input->post('POLA_NYERI');
		$ARR_KETERANGAN_NYERI=$this->input->post('KETERANGAN_NYERI');

		$hitung_nyeri=$this->input->post('LOKASI_NYERI');
		if(is_array($hitung_nyeri))
		{
			for ($i=0; $i < count($hitung_nyeri); $i++) 
			{ 
				if($ARR_LOKASI_NYERI[$i]!='')
				{
		  			array_push($detail_nyeri, 
		  							array(
										'LOKASI_NYERI'=>$ARR_LOKASI_NYERI[$i],
										'INTENSITAS_NYERI'=>$ARR_INTENSITAS_NYERI[$i],
										'DURASI_NYERI'=>$ARR_DURASI_NYERI[$i],
										'PENCETUS_NYERI'=>$ARR_PENCETUS_NYERI[$i],
										'KUALITAS_NYERI'=>$ARR_KUALITAS_NYERI[$i],
										'POLA_NYERI'=>$ARR_POLA_NYERI[$i],
										'KETERANGAN_NYERI'=>$ARR_KETERANGAN_NYERI[$i],
									 	)
		  				);	
		  		}
			}
		}

		$param['DETAIL_NYERI']=$detail_nyeri;

		
		$data=$this->webapi->post("emr/emr_ranap/simpan_asesmen_perawat_ranap",$param,false);
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


	function detail_riwayat_persalinan()
	{
		
		if($_POST)
		{
			if(!is_null($this->input->post('NO_URUT')))
			{
				$param['NO_URUT']=$this->input->post('NO_URUT'); 
				$data=$this->webapi->post("emr/emr_rajal/detail_riwayat_kehamilan_persalinan",$param);
				echo $data;
			}
		}
	}


	function simpan_riwayat_persalinan()
	{
		$param['NO_URUT']=$this->input->post('NO_URUT');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_BIDAN']=$this->session->userdata('NIK');
		$param['TAHUN']=$this->input->post('TAHUN');
		$param['UMUR_KEHAMILAN']=$this->input->post('UMUR_KEHAMILAN');
		$param['PERSALINAN']=$this->input->post('PERSALINAN');
		$param['OLEH']=$this->input->post('OLEH');
		$param['JK']=$this->input->post('JK');
		$param['BB']=$this->input->post('BB');
		$param['H_M']=$this->input->post('H_M');
		$param['HPP']=$this->input->post('HPP');
		$param['PEB']=$this->input->post('PEB');
		$param['FEBRIS']=$this->input->post('FEBRIS');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_rajal/simpan_riwayat_hamil_bidan_darurat",$param,false); 

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

	function hapus_riwayat_persalinan()
	{
		$msg="";
		$param['NO_URUT']=$this->input->post('NO_URUT');
		$data=$this->webapi->post("emr/emr_rajal/hapus_riwayat_persalinan",$param,false);

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

	function reload_riwayat_persalinan()
	{
		if($_POST)
		{
			if(!is_null($this->input->post('NO_CM')))
			{
				$param['NO_CM']=$this->input->post('NO_CM');
				$data['riwayat_kehamilan_persalinan']=$this->webapi->post("emr/emr_rajal/riwayat_kehamilan_persalinan",$param,false);
				$this->load->view('ranap/kebidanan/tb_riwayat_kehamilan',$data);
			}
		}
	}

	function discharge_planning()
	{
		if(!cek_menu('discharge_planning',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_discharge_planning";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
				$data['detail_discharge_planning']=$this->webapi->post("emr/emr_ranap/detail_discharge_planning",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function simpan_discharge_planning()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['TGL_DISCHARGE']=$this->input->post('TGL_DISCHARGE');
		$param['IS_USIA_65_TAHUN']=$this->input->post('IS_USIA_65_TAHUN');
		if($param['IS_USIA_65_TAHUN']=='')
		{
			$param['IS_USIA_65_TAHUN']='T';
		}
		$param['IS_PERCOBAAN_BUNUH_DIRI']=$this->input->post('IS_PERCOBAAN_BUNUH_DIRI');
		if($param['IS_PERCOBAAN_BUNUH_DIRI']=='')
		{
			$param['IS_PERCOBAAN_BUNUH_DIRI']='T';
		}
		$param['IS_KORBAN_KRIMINAL']=$this->input->post('IS_KORBAN_KRIMINAL');
		if($param['IS_KORBAN_KRIMINAL']=='')
		{
			$param['IS_KORBAN_KRIMINAL']='T';
		}
		$param['IS_KETERBATASAN_MOBILITAS']=$this->input->post('IS_KETERBATASAN_MOBILITAS');
		if($param['IS_KETERBATASAN_MOBILITAS']=='')
		{
			$param['IS_KETERBATASAN_MOBILITAS']='T';
		}
		$param['IS_PENGOBATAN_LANJUTAN']=$this->input->post('IS_PENGOBATAN_LANJUTAN');
		if($param['IS_PENGOBATAN_LANJUTAN']=='')
		{
			$param['IS_PENGOBATAN_LANJUTAN']='T';
		}
		$param['IS_BANTUAN_IBADAH']=$this->input->post('IS_BANTUAN_IBADAH');
		if($param['IS_BANTUAN_IBADAH']=='')
		{
			$param['IS_BANTUAN_IBADAH']='T';
		}
		$param['IS_GANGGUAN_SPIRITUAL']=$this->input->post('IS_GANGGUAN_SPIRITUAL');
		if($param['IS_GANGGUAN_SPIRITUAL']=='')
		{
			$param['IS_GANGGUAN_SPIRITUAL']='T';
		}
		$param['PASIEN_TINGGAL_DENGAN']=$this->input->post('PASIEN_TINGGAL_DENGAN');
		$param['LETAK_KAMAR']=$this->input->post('LETAK_KAMAR');
		$param['PENERANGAN']=$this->input->post('PENERANGAN');
		$param['JARAK_KAMAR_MANDI']=$this->input->post('JARAK_KAMAR_MANDI');
		$param['JENIS_WC']=$this->input->post('JENIS_WC');
		$param['PEMENUHAN_KEBUTUHAN']=$this->input->post('PEMENUHAN_KEBUTUHAN');
		$param['BANTUAN_PEMENUHAN_KEBUTUHAN']=$this->input->post('BANTUAN_PEMENUHAN_KEBUTUHAN');
		$param['ALAT_BANTU_KHUSUS']=$this->input->post('ALAT_BANTU_KHUSUS');
		$param['PROGAM_DIET']=$this->input->post('PROGAM_DIET');
		$param['RUJUK_KOMUNITAS_LAIN']=$this->input->post('RUJUK_KOMUNITAS_LAIN');
		$param['PERLU_HOMECARE']=$this->input->post('PERLU_HOMECARE');
		$param['NM_HUB']=$this->input->post('NM_HUB');
		$param['HP_HUB']=$this->input->post('HP_HUB');
		$param['HUBUNGAN']=$this->input->post('HUBUNGAN');
		$param['TGL_SELESAI_KAJIAN']=$this->input->post('TGL_SELESAI_KAJIAN');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		$data=$this->webapi->post("emr/emr_ranap/simpan_discharge_planning",$param,false);
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

	function discharge_planning_detail()
	{
		if(!cek_menu('discharge_planning_2',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_detail_discharge_planning";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
				$data['detail_dp']=$this->webapi->post("emr/emr_ranap/detail_dp",$param,false);
				$data['data_pendidikan_kesehatan']=$this->webapi->post("emr/emr_ranap/data_pendidikan_kesehatan",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function simpan_detail_dp()
	{

		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['TGL_DETAIL_DISCHARGE']=$this->input->post('TGL_DETAIL_DISCHARGE');
		$param['TRANSPORTASI_PULANG']=$this->input->post('TRANSPORTASI_PULANG');
		$param['PENDAMPING_DIRUMAH']=$this->input->post('PENDAMPING_DIRUMAH');
		$param['DIET_KHUSUS']=$this->input->post('DIET_KHUSUS');
		$param['PERALATAN_MEDIS']=$this->input->post('PERALATAN_MEDIS');
		$param['ALAT_BANTU']=$this->input->post('ALAT_BANTU');
		$param['PETUGAS_DIRUMAH']=$this->input->post('PETUGAS_DIRUMAH');
		$param['RS_MENGHUBUNGI']=$this->input->post('RS_MENGHUBUNGI');
		$param['IS_RUJUK_KOMUNITAS']=$this->input->post('IS_RUJUK_KOMUNITAS');
		if($param['IS_RUJUK_KOMUNITAS']=='')
		{
			$param['IS_RUJUK_KOMUNITAS']='T';
		}
		$param['RUJUK_KOMUNITAS']=$this->input->post('RUJUK_KOMUNITAS');
		$param['PIHAK_PASIEN']=$this->input->post('PIHAK_PASIEN');

		$detail_pendidikan=array();
		$ARR_NIK_PPA=$this->input->post('NIK_PPA');
		$ARR_TGL_PENDIDIKAN=$this->input->post('TGL_PENDIDIKAN');
		$ARR_PENDIDIKAN_KESEHATAN=$this->input->post('PENDIDIKAN_KESEHATAN');

		$hitung_pendidikan=$this->input->post('NIK_PPA');
		if(is_array($hitung_pendidikan))
		{
			for ($i=0; $i < count($hitung_pendidikan); $i++) 
			{ 
				if($ARR_NIK_PPA[$i]!='')
				{
		  			array_push($detail_pendidikan, 
		  							array(
									   	'NIK_PPA'=>$ARR_NIK_PPA[$i],
									   	'TGL_PENDIDIKAN'=>$ARR_TGL_PENDIDIKAN[$i],
									   	'PENDIDIKAN_KESEHATAN'=>$ARR_PENDIDIKAN_KESEHATAN[$i],
									 	)
		  				);	
		  		}
			}
		}

		$param['DETAIL_PENDIDIKAN']=$detail_pendidikan;


		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_detail_dp",$param,false);
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


	function asuhan_keperawatan()
	{
		if(!cek_menu('asuhan_keperawatan',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_asuhan_keperawatan";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
				$data['data_asuhan']=$this->webapi->post("emr/emr_ranap/data_rencana_asuhan",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function reload_rencana_asuhan()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_asuhan']=$this->webapi->post("emr/emr_ranap/data_rencana_asuhan",$param,false);
		$this->load->view('ranap/v_asuhan_keperawatant',$data);
	}

	function detail_rencana_asuhan()
	{
		$param['URUT_ASUHAN']=$this->input->post('URUT_ASUHAN');
		$data=$this->webapi->post("emr/emr_ranap/detail_rencana_asuhan",$param);
		echo $data;
	}


	function simpan_rencana_asuhan()
	{
		$param['URUT_ASUHAN']=$this->input->post('URUT_ASUHAN');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['TGL_ASUHAN']=$this->input->post('TGL_ASUHAN');
		$param['DIAGNOSA']=$this->input->post('DIAGNOSA');
		$param['HUB_DIAGNOSA']=$this->input->post('HUB_DIAGNOSA');
		$param['NOC']=$this->input->post('NOC');
		$param['NIC']=$this->input->post('NIC');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		$data=$this->webapi->post("emr/emr_ranap/simpan_rencana_asuhan",$param,false);
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

	function hapus_rencana_asuhan()
	{
		$param['URUT_ASUHAN']=$this->input->post('URUT_ASUHAN');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_rencana_asuhan",$param,false);

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

	function rekon_obat()
	{
		if(!cek_menu('rekon_obat',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_rekon_obat";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_apoteker']=$this->webapi->post("emr/emr_ranap/data_apoteker",array(),false);
				$data['data_ruang_all']=$this->webapi->post("emr/emr_ranap/data_ruang_all",array(),false);
				$data['detail_rekonsiliasi_obat']=$this->webapi->post("emr/emr_ranap/detail_rekonsiliasi_obat",$param,false);
				$data['data_obat_admisi']=$this->webapi->post("emr/emr_ranap/data_rekonsiliasi_obat_admisi",$param,false);
				$data['data_obat_transfer']=$this->webapi->post("emr/emr_ranap/data_rekonsiliasi_obat_transfer",$param,false);
				$data['data_obat_discharge']=$this->webapi->post("emr/emr_ranap/data_rekonsiliasi_obat_discharge",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function simpan_rekonsiliasi_obat()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['TGL_REKONSILIASI']=$this->input->post('TGL_REKONSILIASI');
		$param['RIWAYAT_MASUK_RS']=$this->input->post('RIWAYAT_MASUK_RS');
		$param['BERAT_BADAN']=$this->input->post('BERAT_BADAN');
		$param['TINGGI_BADAN']=$this->input->post('TINGGI_BADAN');
		$param['MEROKOK']=$this->input->post('MEROKOK');
		$param['KOPI']=$this->input->post('KOPI');
		$param['TEH']=$this->input->post('TEH');
		$param['ALERGI']=$this->input->post('ALERGI');
		$param['RIWAYAT_PENYAKIT_DULU']=$this->input->post('RIWAYAT_PENYAKIT_DULU');
		$param['RIWAYAT_PENYAKIT_SEKARANG']=$this->input->post('RIWAYAT_PENYAKIT_SEKARANG');
		$param['RIWAYAT_PENGGUNAAN_OBAT']=$this->input->post('RIWAYAT_PENGGUNAAN_OBAT');
		$param['DIAGNOSIS']=$this->input->post('DIAGNOSIS');
		$param['IS_OBAT_ADMISI']=$this->input->post('IS_OBAT_ADMISI');
		$param['NIK_NYA']=$this->session->userdata('NIK');

		$detail_admisi=array();

		$ARR_NAMA_OBAT_ADMISI=$this->input->post('NAMA_OBAT_ADMISI');
		$ARR_JUMLAH_ADMISI=$this->input->post('JUMLAH_ADMISI');
		$ARR_ATURAN_PAKAI_ADMISI=$this->input->post('ATURAN_PAKAI_ADMISI');
		$ARR_STATUS_LANJUT_ADMISI=$this->input->post('STATUS_LANJUT_ADMISI');
		$ARR_KETERANGAN_ADMISI=$this->input->post('KETERANGAN_ADMISI');

		$hitung_admisi=$this->input->post('NAMA_OBAT_ADMISI');
		if(is_array($hitung_admisi))
		{
			for ($i=0; $i < count($hitung_admisi); $i++) 
			{ 
				if($ARR_NAMA_OBAT_ADMISI[$i]!='')
				{
		  			array_push($detail_admisi, 
		  							array(
										'NO_REG'=>$param['NO_REG'],
										'URUT_OBAT'=>$i+1,
										'NAMA_OBAT'=>$ARR_NAMA_OBAT_ADMISI[$i],
										'JUMLAH'=>$ARR_JUMLAH_ADMISI[$i],
										'ATURAN_PAKAI'=>$ARR_ATURAN_PAKAI_ADMISI[$i],
										'STATUS_LANJUT'=>$ARR_STATUS_LANJUT_ADMISI[$i],
										'KETERANGAN'=>$ARR_KETERANGAN_ADMISI[$i],
										'NIK_PETUGAS'=>$param['NIK_PETUGAS'],
									 	)
		  				);	
		  		}
			}
		}

		$param['DETAIL_ADMISI']=$detail_admisi;


		$detail_transfer=array();
		$param['RUANG_ASAL']=$this->input->post('RUANG_ASAL');
		$param['RUANG_TUJU']=$this->input->post('RUANG_TUJU');
		$param['TGL_TRANSFER']=$this->input->post('TGL_TRANSFER');

		$ARR_NAMA_OBAT_TRANSFER=$this->input->post('NAMA_OBAT_TRANSFER');
		$ARR_JUMLAH_TRANSFER=$this->input->post('JUMLAH_TRANSFER');
		$ARR_ATURAN_PAKAI_TRANSFER=$this->input->post('ATURAN_PAKAI_TRANSFER');
		$ARR_STATUS_LANJUT_TRANSFER=$this->input->post('STATUS_LANJUT_TRANSFER');
		$ARR_KETERANGAN_TRANSFER=$this->input->post('KETERANGAN_TRANSFER');

		$hitung_transfer=$this->input->post('NAMA_OBAT_TRANSFER');
		if(is_array($hitung_transfer))
		{
			for ($i=0; $i < count($hitung_transfer); $i++) 
			{ 
				if($ARR_NAMA_OBAT_TRANSFER[$i]!='')
				{
		  			array_push($detail_transfer, 
		  							array(
										'NO_REG'=>$param['NO_REG'],
										'URUT_OBAT'=>$i+1,
										'RUANG_ASAL'=>$param['RUANG_ASAL'],
										'RUANG_TUJU'=>$param['RUANG_TUJU'],
										'TGL_TRANSFER'=>$param['TGL_TRANSFER'],
										'NAMA_OBAT'=>$ARR_NAMA_OBAT_TRANSFER[$i],
										'JUMLAH'=>$ARR_JUMLAH_TRANSFER[$i],
										'ATURAN_PAKAI'=>$ARR_ATURAN_PAKAI_TRANSFER[$i],
										'STATUS_LANJUT'=>$ARR_STATUS_LANJUT_TRANSFER[$i],
										'KETERANGAN'=>$ARR_KETERANGAN_TRANSFER[$i],
										'NIK_PETUGAS'=>$param['NIK_PETUGAS'],
									 	)
		  				);	
		  		}
			}
		}

		$param['DETAIL_TRANSFER']=$detail_transfer;


		$detail_discharge=array();
		$param['RUANG']=$this->input->post('RUANG');
		$param['TGL_DISCHARGE']=$this->input->post('TGL_DISCHARGE');

		$ARR_NAMA_OBAT_DISCHARGE=$this->input->post('NAMA_OBAT_DISCHARGE');
		$ARR_JUMLAH_DISCHARGE=$this->input->post('JUMLAH_DISCHARGE');
		$ARR_ATURAN_PAKAI_DISCHARGE=$this->input->post('ATURAN_PAKAI_DISCHARGE');
		$ARR_STATUS_LANJUT_DISCHARGE=$this->input->post('STATUS_LANJUT_DISCHARGE');
		$ARR_KETERANGAN_DISCHARGE=$this->input->post('KETERANGAN_DISCHARGE');

		$hitung_discharge=$this->input->post('NAMA_OBAT_DISCHARGE');
		if(is_array($hitung_discharge))
		{
			for ($i=0; $i < count($hitung_discharge); $i++) 
			{ 
				if($ARR_NAMA_OBAT_DISCHARGE[$i]!='')
				{
		  			array_push($detail_discharge, 
		  							array(
										'NO_REG'=>$param['NO_REG'],
										'URUT_OBAT'=>$i+1,
										'RUANG'=>$param['RUANG'],
										'TGL_DISCHARGE'=>$param['TGL_DISCHARGE'],
										'NAMA_OBAT'=>$ARR_NAMA_OBAT_DISCHARGE[$i],
										'JUMLAH'=>$ARR_JUMLAH_DISCHARGE[$i],
										'ATURAN_PAKAI'=>$ARR_ATURAN_PAKAI_DISCHARGE[$i],
										'STATUS_LANJUT'=>$ARR_STATUS_LANJUT_DISCHARGE[$i],
										'KETERANGAN'=>$ARR_KETERANGAN_DISCHARGE[$i],
										'NIK_PETUGAS'=>$param['NIK_PETUGAS'],
									 	)
		  				);	
		  		}
			}
		}

		$param['DETAIL_DISCHARGE']=$detail_discharge;

		$data=$this->webapi->post("emr/emr_ranap/simpan_rekonsiliasi_obat",$param,false);
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

	function kebutuhan_pendidikan()
	{
		if(!cek_menu('kebutuhan_pendidikan',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_kebutuhan_pendidikan";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_petugas']=$this->webapi->post("emr/emr_rajal/data_petugas_aktif",array(),false);
				$data['detail_kebutuhan']=$this->webapi->post("emr/emr_ranap/detail_kebutuhan_pendidikan",$param,false);
				$data['data_pemberian']=$this->webapi->post("emr/emr_ranap/data_pemberian_pendidikan",$param,false);   
				$this->load->view("page/rm_content",$data);
			}
		}
	}


	function simpan_kebutuhan_pendidikan()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['TGL_KEBUTUHAN']=$this->input->post('TGL_KEBUTUHAN');
		$param['IS_MENERIMA']=$this->input->post('IS_MENERIMA');
		$param['PENERIMA_PENDIDIKAN']=$this->input->post('PENERIMA_PENDIDIKAN');
		$param['HAMBATAN_EMOSIONAL']=$this->input->post('HAMBATAN_EMOSIONAL');
		$param['KEMAMPUAN_MEMBACA']=$this->input->post('KEMAMPUAN_MEMBACA');
		$param['TINGKAT_PENDIDIKAN']=$this->input->post('TINGKAT_PENDIDIKAN');
		$param['BAHASA']=$this->input->post('BAHASA');
		$param['KETERBATASAN_FISIK']=$this->input->post('KETERBATASAN_FISIK');
		$param['KEBUTUHAN_PENDIDIKAN']=$this->input->post('KEBUTUHAN_PENDIDIKAN');
		$param['MATERI_PENDIDIKAN_KELUARGA']=$this->input->post('MATERI_PENDIDIKAN_KELUARGA');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		$data=$this->webapi->post("emr/emr_ranap/simpan_kebutuhan_pendidikan",$param,false);
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

	function reload_pemberian_pendidikan()  
	{
		$param['NO_REG']=$this->input->post('NO_REG');  
		$data['data_pemberian']=$this->webapi->post("emr/emr_ranap/data_pemberian_pendidikan",$param,false);   
		$this->load->view('ranap/v_pemberian_pendidikant',$data);
		
	}

	function detail_pemberian_pendidikan()  
	{
		$param['URUT_PENDIDIKAN']=$this->input->post('URUT_PENDIDIKAN');  
		$data=$this->webapi->post("emr/emr_ranap/detail_pemberian_pendidikan",$param);   
		echo $data;
		
	}

	function simpan_pemberian_pendidikan()
	{
		$param['URUT_PENDIDIKAN']=$this->input->post('URUT_PENDIDIKAN');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['TGL_PENDIDIKAN']=$this->input->post('TGL_PENDIDIKAN');
		$param['INDIKASI_KEBUTUHAN']=$this->input->post('INDIKASI_KEBUTUHAN');
		$param['PENYAKIT_KRONIS']=$this->input->post('PENYAKIT_KRONIS');
		$param['PENYAKIT_KOMPLEK']=$this->input->post('PENYAKIT_KOMPLEK');
		$param['PENERIMA_PENDIDIKAN']=$this->input->post('PENERIMA_PENDIDIKAN');
		$param['METODE_RENCANA_PENDIDIKAN']=$this->input->post('METODE_RENCANA_PENDIDIKAN');
		$param['JENIS_PENDIDIKAN']=$this->input->post('JENIS_PENDIDIKAN');
		$param['MATERI_PENDIDIKAN']=$this->input->post('MATERI_PENDIDIKAN');
		$param['NIK_PEMBERI_PENDIDIKAN']=$this->input->post('NIK_PEMBERI_PENDIDIKAN');
		$param['NM_PENERIMA_PENDIDIKAN']=$this->input->post('NM_PENERIMA_PENDIDIKAN');
		$param['EVALUASI_RESPON']=$this->input->post('EVALUASI_RESPON');
		$param['WAKTU_PEMBERIAN_PENDIDIKAN']=$this->input->post('WAKTU_PEMBERIAN_PENDIDIKAN');
		$param['JALAN_PENDIDIKAN']=$this->input->post('JALAN_PENDIDIKAN');
		$param['KEBUTUHAN_KESEHATAN']=$this->input->post('KEBUTUHAN_KESEHATAN');
		$param['RUJUK_KOMUNITAS']=$this->input->post('RUJUK_KOMUNITAS');
		$param['PELATIHAN_TINDAKAN']=$this->input->post('PELATIHAN_TINDAKAN');
		$param['PRINSIP_KOMUNIKASI']=$this->input->post('PRINSIP_KOMUNIKASI');
		$param['FIQIH_PASIEN']=$this->input->post('FIQIH_PASIEN');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_pemberian_pendidikan",$param,false);
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

	function hapus_pemberian_pendidikan()
	{
		$param['URUT_PENDIDIKAN']=$this->input->post('URUT_PENDIDIKAN');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_pemberian_pendidikan",$param,false);
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

	function surve_infeksi()
	{
		if(!cek_menu('surve_infeksi',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_surve_infeksi";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['data_tindakan_ppi']=$this->webapi->post("emr/emr_ranap/data_tindakan_ppi",array(),false);
				$data['data_diagnosa_masuk']=$this->webapi->post("emr/emr_rajal/data_diagnosa_masuk",$param,false);  
				$data['data_op']=$this->webapi->post("ibs/master/data_op",array(),false);	
				$data['data_obat_pasien']=$this->webapi->post("emr/emr_ranap/data_obat_pasien",$param,false); 
				$data['data_petugas']=$this->webapi->post("emr/emr_rajal/data_petugas_aktif",array(),false);
				$data['detail_survei_ppi']=$this->webapi->post("emr/emr_ranap/detail_survei_ppi",$param,false); 
				$data['data_survei_tindakan']=$this->webapi->post("emr/emr_ranap/data_survei_tindakan",$param,false);
				$data['data_survei_infeksi']=$this->webapi->post("emr/emr_ranap/data_survei_infeksi",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function reload_survei_tindakan()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_survei_tindakan']=$this->webapi->post("emr/emr_ranap/data_survei_tindakan",$param,false);
		$this->load->view('ranap/v_data_survei_tindakant',$data);
	}

	function detail_survei_tindakan()
	{
		$param['URUT_TINDAKAN']=$this->input->post('URUT_TINDAKAN');
		$data=$this->webapi->post("emr/emr_ranap/detail_survei_tindakan",$param);
		echo $data;
	}

	function simpan_survei_tindakan()
	{
		$param['URUT_TINDAKAN']=$this->input->post('URUT_TINDAKAN');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['TGL_SURVEI']=$this->input->post('TGL_SURVEI');
		$param['DIAGNOSA_MASUK']=$this->input->post('DIAGNOSA_MASUK');
		$param['HARI_KE']=$this->input->post('HARI_KE');
		$param['KD_TINDAKAN_PPI']=$this->input->post('KD_TINDAKAN_PPI');
		$param['KD_OP']=$this->input->post('KD_OP');
		$param['KD_OBAT']=$this->input->post('KD_OBAT');
		$param['DOSIS']=$this->input->post('DOSIS');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		//$data=$this->webapi->post("emr/emr_ranap/simpan_survei_tindakan",$param,false);
		$data=$this->webapi->post("emr/emr_ranap/simpan_survei_ppi",$param,false);
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

	function hapus_survei_tindakan()
	{
		$param['URUT_TINDAKAN']=$this->input->post('URUT_TINDAKAN');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_survei_tindakan",$param,false);
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

	function reload_survei_infeksi()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data['data_survei_infeksi']=$this->webapi->post("emr/emr_ranap/data_survei_infeksi",$param,false);
		$this->load->view('ranap/v_data_survei_infeksit',$data);
	}

	function detail_survei_infeksi()
	{
		$param['URUT_INFEKSI']=$this->input->post('URUT_INFEKSI');
		$data=$this->webapi->post("emr/emr_ranap/detail_survei_infeksi",$param);
		echo $data;
	}

	function simpan_survei_infeksi()
	{
		$param['URUT_INFEKSI']=$this->input->post('URUT_INFEKSI');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['HARI_KE']=$this->input->post('HARI_KE');
		$param['IS_GRADE_1']=$this->input->post('IS_GRADE_1');
		if($param['IS_GRADE_1']=='')
		{
			$param['IS_GRADE_1']='T';
		}
		$param['IS_GRADE_2']=$this->input->post('IS_GRADE_2');
		if($param['IS_GRADE_2']=='')
		{
			$param['IS_GRADE_2']='T';
		}
		$param['IS_GRADE_3']=$this->input->post('IS_GRADE_3');
		if($param['IS_GRADE_3']=='')
		{
			$param['IS_GRADE_3']='T';
		}
		$param['IS_GRADE_4']=$this->input->post('IS_GRADE_4');
		if($param['IS_GRADE_4']=='')
		{
			$param['IS_GRADE_4']='T';
		}
		$param['IS_GRADE_5']=$this->input->post('IS_GRADE_5');
		if($param['IS_GRADE_5']=='')
		{
			$param['IS_GRADE_5']='T';
		}
		$param['IS_DEMAM_38_ISK']=$this->input->post('IS_DEMAM_38_ISK');
		if($param['IS_DEMAM_38_ISK']=='')
		{
			$param['IS_DEMAM_38_ISK']='T';
		}
		$param['IS_INKONTINENSIA']=$this->input->post('IS_INKONTINENSIA');
		if($param['IS_INKONTINENSIA']=='')
		{
			$param['IS_INKONTINENSIA']='T';
		}
		$param['IS_DISURIA']=$this->input->post('IS_DISURIA');
		if($param['IS_DISURIA']=='')
		{
			$param['IS_DISURIA']='T';
		}
		$param['IS_NYERI_SUPRAPUBIK']=$this->input->post('IS_NYERI_SUPRAPUBIK');
		if($param['IS_NYERI_SUPRAPUBIK']=='')
		{
			$param['IS_NYERI_SUPRAPUBIK']='T';
		}
		$param['IS_DRAINASE_PURULENT']=$this->input->post('IS_DRAINASE_PURULENT');
		if($param['IS_DRAINASE_PURULENT']=='')
		{
			$param['IS_DRAINASE_PURULENT']='T';
		}
		$param['IS_TERABA_HANGAT']=$this->input->post('IS_TERABA_HANGAT');
		if($param['IS_TERABA_HANGAT']=='')
		{
			$param['IS_TERABA_HANGAT']='T';
		}
		$param['IS_NYERI']=$this->input->post('IS_NYERI');
		if($param['IS_NYERI']=='')
		{
			$param['IS_NYERI']='T';
		}
		$param['IS_KEMERAHAN']=$this->input->post('IS_KEMERAHAN');
		if($param['IS_KEMERAHAN']=='')
		{
			$param['IS_KEMERAHAN']='T';
		}
		$param['IS_BENGKAK']=$this->input->post('IS_BENGKAK');
		if($param['IS_BENGKAK']=='')
		{
			$param['IS_BENGKAK']='T';
		}
		$param['IS_TERDAPAT_ABSES']=$this->input->post('IS_TERDAPAT_ABSES');
		if($param['IS_TERDAPAT_ABSES']=='')
		{
			$param['IS_TERDAPAT_ABSES']='T';
		}
		$param['IS_DEMAM_38_IADP']=$this->input->post('IS_DEMAM_38_IADP');
		if($param['IS_DEMAM_38_IADP']=='')
		{
			$param['IS_DEMAM_38_IADP']='T';
		}
		$param['IS_MENGIGIL']=$this->input->post('IS_MENGIGIL');
		if($param['IS_MENGIGIL']=='')
		{
			$param['IS_MENGIGIL']='T';
		}
		$param['IS_HIPOTENSI']=$this->input->post('IS_HIPOTENSI');
		if($param['IS_HIPOTENSI']=='')
		{
			$param['IS_HIPOTENSI']='T';
		}
		$param['IS_KULTUR_DARAH']=$this->input->post('IS_KULTUR_DARAH');
		if($param['IS_KULTUR_DARAH']=='')
		{
			$param['IS_KULTUR_DARAH']='T';
		}
		$param['STATUS_DARAH']=$this->input->post('STATUS_DARAH');
		$param['IS_DARAH']=$this->input->post('IS_DARAH');
		if($param['IS_DARAH']=='')
		{
			$param['IS_DARAH']='T';
		}
		$param['STATUS_URIN']=$this->input->post('STATUS_URIN');
		$param['IS_URIN']=$this->input->post('IS_URIN');
		if($param['IS_URIN']=='')
		{
			$param['IS_URIN']='T';
		}
		$param['STATUS_SPUTUM']=$this->input->post('STATUS_SPUTUM');
		$param['IS_SPUTUM']=$this->input->post('IS_SPUTUM');
		if($param['IS_SPUTUM']=='')
		{
			$param['IS_SPUTUM']='T';
		}
		$param['STATUS_PUS']=$this->input->post('STATUS_PUS');
		$param['IS_PUS']=$this->input->post('IS_PUS');
		if($param['IS_PUS']=='')
		{
			$param['IS_PUS']='T';
		}
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_survei_infeksi",$param,false);
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

	function hapus_survei_infeksi()
	{
		$param['URUT_INFEKSI']=$this->input->post('URUT_INFEKSI');
		
		$data=$this->webapi->post("emr/emr_ranap/hapus_survei_infeksi",$param,false);
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

	function resume_keperawatan()
	{
		if(!cek_menu('resume_keperawatan',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_resume_keperawatan";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['unit_jadwal']=$this->webapi->post("emr/emr_ranap/data_unit_jadwal",array(),false);
				$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
				$data['detail_resume_perawat']=$this->webapi->post("emr/emr_ranap/detail_resume_perawat",$param,false);
				$data['detail_asesmen_perawat_ranap']=$this->webapi->post("emr/emr_ranap/detail_asesmen_perawat_ranap",$param,false);
				$data['data_rencana_kontrol']=$this->webapi->post("emr/emr_ranap/data_rencana_kontrol",$param,false);
				$data['data_minta_rujuk_keluar']=$this->webapi->post("emr/emr_rajal/data_permintaan_rujuk_keluar",$param,false);
				$data['data_diagnosa']=$this->webapi->post('emr/emr_rajal/data_diagnosa',$param,false); 
				$data['data_unit_luar']=$this->webapi->post("layanan/layanan/data_unit_luar",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function cari_jadwal_dokter()
	{
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['TGL_PERIKSA']=$this->input->post('TGL_PERIKSA');
		$data_jadwal=$this->webapi->post("emr/emr_ranap/cari_jadwal_dokter",$param,false);
		if($data_jadwal)
		{
			echo ' <select class="form-control input-sm selectpicker" id="NIK_DOKTER_KONTROL" name="NIK_DOKTER" data-live-search="true">';
			if($data_jadwal->response=='200')
			{
				
				foreach ($data_jadwal->data as $dt) 
				{
					echo '<option value="'.$dt->NIK_DOKTER.'">'.$dt->NAMA.'</option>';
				}
				
			}
			else
			{
				echo '<option value="">--</option>';
			}
			echo '</select>';
		}
	}

	function simpan_resume_perawat()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['TGL_RESUME']=$this->input->post('TGL_RESUME');
		$param['KEADAAN_UMUM']=$this->input->post('KEADAAN_UMUM');
		$param['TD_SIS']=$this->input->post('TD_SIS');
		$param['TD_DIA']=$this->input->post('TD_DIA');
		$param['PERNAFASAN']=$this->input->post('PERNAFASAN');
		$param['NADI']=$this->input->post('NADI');
		$param['SUHU']=$this->input->post('SUHU');
		$param['DIET_NUTRISI']=$this->input->post('DIET_NUTRISI');
		$param['BAB']=$this->input->post('BAB');
		$param['BAK']=$this->input->post('BAK');
		$param['KONTRAKSI_UTERUS']=$this->input->post('KONTRAKSI_UTERUS');
		$param['VULVA']=$this->input->post('VULVA');
		$param['LOKHEA']=$this->input->post('LOKHEA');
		$param['KEADAAN_LUKA']=$this->input->post('KEADAAN_LUKA');
		$param['MOBILISASI']=$this->input->post('MOBILISASI');
		$param['ALAT_BANTU']=$this->input->post('ALAT_BANTU');
		$param['EDUKASI_WAJIB']=$this->input->post('EDUKASI_WAJIB');
		$param['EDUKASI_TAMBAHAN']=$this->input->post('EDUKASI_TAMBAHAN');
		$param['MASALAH_KEPERAWATAN']=$this->input->post('MASALAH_KEPERAWATAN');
		$param['TINDAKAN_KEPERAWATAN']=$this->input->post('TINDAKAN_KEPERAWATAN');
		$param['ANJURAN_PERAWATAN']=$this->input->post('ANJURAN_PERAWATAN');
		$param['DOKUMEN_DIBAWA_PULANG']=$this->input->post('DOKUMEN_DIBAWA_PULANG');
		$param['IS_AMBULAN_EMERGENCY']=$this->input->post('IS_AMBULAN_EMERGENCY');
		$param['IS_AMBULAN_OPERASIONAL']=$this->input->post('IS_AMBULAN_OPERASIONAL');
		$param['IS_MANDIRI']=$this->input->post('IS_MANDIRI');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_resume_perawat",$param,false);
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

	function reload_rencana_kontrol()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data=$this->webapi->post("emr/emr_ranap/data_rencana_kontrol",$param,false);
		if($data)
		{
			if($data->response=='200')
			{
				foreach ($data->data as $dk) 
				{
					echo '<h5 class="blue"><button type="button" class="btn btn-danger btn-xs" value="'.$dk->URUT_RENCANA_KONTROL.'" onclick="hapus_rencana_kontrol(this.value)"> <span class="fa fa-trash"></span></button> <b>'.$dk->TGL_RENCANA_KONTROL_F.' '.$dk->NM_DOKTER.'</b></h5>';
				}
			}
		}
	}

	function reload_rencana_kontrol_bpjs()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$data=$this->webapi->post("emr/emr_ranap/data_rencana_kontrol",$param,false);
		if($data)
		{
			if($data->response=='200')
			{
				foreach ($data->data as $dk) 
				{
					echo '<h5 class="blue"><button type="button" class="btn btn-danger btn-xs" no="'.$dk->URUT_RENCANA_KONTROL.'" skdp="'.$dk->NO_SKDP.'" sep="'.$dk->NO_SEP.'" onclick="hapus_rencana_kontrol(this)"> <span class="fa fa-trash"></span></button> <b>'.$dk->TGL_RENCANA_KONTROL_F.' '.$dk->NM_DOKTER.'</b>';

                        if($dk->NO_SEP!='' && $dk->NO_SKDP=='')
                        {
                          echo ' <button type="button" class="btn btn-primary btn-xs" value="'.$dk->URUT_RENCANA_KONTROL.'" onclick="buat_skdp(this.value)"> <span class="fa fa-send"></span> BUAT SKDP BPJS</button>';
                        };

                        if($dk->NO_SKDP!='')
                        {
                          echo ' <button type="button" class="btn btn-default btn-xs" value="'.$dk->NO_SKDP.'" onclick="cetak_skdp(this.value)"> <span class="fa fa-print"></span> CETAK SKDP BPJS</button>';
                        }
                        echo '</h5>';
				}
			}
		}
	}

	function simpan_rencana_kontrol()
	{
		$param['URUT_RENCANA_KONTROL']=$this->input->post('URUT_RENCANA_KONTROL');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['TGL_RENCANA_KONTROL']=$this->input->post('TGL_RENCANA_KONTROL');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_rencana_kontrol",$param,false);
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

	function hapus_rencana_kontrol()
	{
		$param['URUT_RENCANA_KONTROL']=$this->input->post('URUT_RENCANA_KONTROL');
		$param['NO_SKDP']=$this->input->post('NO_SKDP');
		$param['NO_SEP']=$this->input->post('NO_SEP');
		$data=$this->webapi->post("emr/emr_ranap/hapus_rencana_kontrol",$param,false);
		if($data)
		{
			if($data->response=='200')
			{
				if($param['NO_SKDP']!='')
				{
					$this->hapus_skdp($param['NO_SKDP'],$param['NO_SEP']);
				}
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

	function ringkasan_masuk_keluar()
	{
		if(!cek_menu('ringkasan_masuk_keluar',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_ringkasan_masuk_keluar";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				$data['detail_ringkasan']=$this->webapi->post('emr/emr_ranap/detail_ringkasan_masuk_keluar',$param,false);
				$data['data_pj']=$this->webapi->post('emr/emr_ranap/data_pj',$param,false); 
				$data['pasien_masuk']=$this->webapi->post('emr/emr_ranap/pasien_masuk_ranap',$param,false); 
				$data['data_diagnosa']=$this->webapi->post('emr/emr_rajal/data_diagnosa',$param,false); 
				$data['data_diagnosa_masuk']=$this->webapi->post("emr/emr_rajal/data_diagnosa_masuk",$param,false); 
				$data['data_status_pulang']=$this->webapi->post("emr/emr_rajal/data_status_pulang",array(),false); 
				$data['data_perawat']=$this->webapi->post("emr/emr_rajal/data_perawat_aktif",array(),false);
				$data['data_rencana_kontrol']=$this->webapi->post("emr/emr_ranap/data_rencana_kontrol",$param,false);
				$this->load->view("page/rm_content",$data);
			}
		}
	}

	function simpan_ringkasan_masuk_keluar()
	{
		$param['NO_URUT_INAP']=$this->input->post('NO_URUT_INAP');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->input->post('NIK_PETUGAS');
		$param['TGL_RINGKASAN']=$this->input->post('TGL_RINGKASAN');
		$param['NM_PASIEN']=$this->input->post('NM_PASIEN');
		$param['TGL_LAHIR']=$this->input->post('TGL_LAHIR');
		$param['PENDIDIKAN']=$this->input->post('PENDIDIKAN');
		$param['PEKERJAAN']=$this->input->post('PEKERJAAN');
		$param['ALAMAT']=$this->input->post('ALAMAT');
		$param['STATUS_KAWIN']=$this->input->post('STATUS_KAWIN');
		$param['AGAMA']=$this->input->post('AGAMA');
		$param['JENIS_KELAMIN']=$this->input->post('JENIS_KELAMIN');
		$param['ASAL_PASIEN']=$this->input->post('ASAL_PASIEN');
		$param['DIKIRIM_OLEH']=$this->input->post('DIKIRIM_OLEH');
		$param['NM_PENGIRIM']=$this->input->post('NM_PENGIRIM');
		$param['TGL_MASUK']=$this->input->post('TGL_MASUK');
		$param['TGL_KELUAR']=$this->input->post('TGL_KELUAR');
		$param['LAMA_RAWAT']=$this->input->post('LAMA_RAWAT');
		$param['NM_PJ']=$this->input->post('NM_PJ');
		$param['ALAMAT_PJ']=$this->input->post('ALAMAT_PJ');
		$param['HP_PJ']=$this->input->post('HP_PJ');
		$param['HUB_PJ']=$this->input->post('HUB_PJ');
		$param['KD_PENYAKIT_AWAL']=$this->input->post('KD_PENYAKIT_AWAL');
		$param['NM_PENYAKIT_AWAL']=$this->input->post('NM_PENYAKIT_AWAL');
		$param['KD_PENYAKIT_AKHIR']=$this->input->post('KD_PENYAKIT_AKHIR');
		$param['NM_PENYAKIT_AKHIR']=$this->input->post('NM_PENYAKIT_AKHIR');
		$param['KD_PENYAKIT_UTAMA']=$this->input->post('KD_PENYAKIT_UTAMA');
		$param['NM_PENYAKIT_UTAMA']=$this->input->post('NM_PENYAKIT_UTAMA');
		$param['KD_PENYAKIT_KOMPLIKASI']=$this->input->post('KD_PENYAKIT_KOMPLIKASI');
		$param['NM_PENYAKIT_KOMPLIKASI']=$this->input->post('NM_PENYAKIT_KOMPLIKASI');
		$param['PENYEBAB_CEDERA_KERACUNAN']=$this->input->post('PENYEBAB_CEDERA_KERACUNAN');
		$param['NM_OPERASI']=$this->input->post('NM_OPERASI');
		$param['GOL_OPERASI']=$this->input->post('GOL_OPERASI');
		$param['JENIS_ANESTESI']=$this->input->post('JENIS_ANESTESI');
		$param['TANGGAL_OP']=$this->input->post('TANGGAL_OP');
		$param['KODE_OP']=$this->input->post('KODE_OP');
		$param['INFEKSI_NOSOKOMIAL']=$this->input->post('INFEKSI_NOSOKOMIAL');
		$param['PENYEBAB_INFEKSI']=$this->input->post('PENYEBAB_INFEKSI');
		$param['IMUNISASI_PERNAH']=$this->input->post('IMUNISASI_PERNAH');
		$param['RADIOTERAPI']=$this->input->post('RADIOTERAPI');
		$param['IMUNISASI_DIRAWAT']=$this->input->post('IMUNISASI_DIRAWAT');
		$param['TRANSFUSI_DARAH']=$this->input->post('TRANSFUSI_DARAH');
		$param['KEADAAN_KELUAR']=$this->input->post('KEADAAN_KELUAR');
		$param['KD_STATUS_PULANG']=$this->input->post('KD_STATUS_PULANG');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_ringkasan_masuk_keluar",$param,false);
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

	function ringkasan_pulang()
	{
		if(!cek_menu('ringkasan_pulang',$this->session->userdata('AKSES')[APP_ID])) 
	  	{
			redirect(base_url());
	  	}
	  	else
	  	{
	  		if($this->session->userdata('PILIH_PASIEN')!='')
	  		{
				$data['header']="page/header";
				$data['navbar']="page/navbar";
				$data['sidebar']="page/rm_sidebar";
				$data['js']="page/js";
				$data['footer']="page/footer";
				$data['content']="ranap/v_ringkasan_pulang";
				$data['dt']=(object) $this->session->userdata('PILIH_PASIEN');
				$param['NO_REG']=$data['dt']->NO_REG;
				$param['KD_UNIT']=$data['dt']->KD_UNIT;
				$param['KD_KELAS']=$data['dt']->KD_KELAS;
				$param['NO_CM']=$data['dt']->NO_CM;
				$param['IOL']='I';
				
				$data['unit_jadwal']=$this->webapi->post("emr/emr_ranap/data_unit_jadwal",array(),false);
				$data['detail_ringkasan_pulang']=$this->webapi->post("emr/emr_ranap/detail_ringkasan_pulang",$param,false);
				$data['data_rencana_kontrol']=$this->webapi->post("emr/emr_ranap/data_rencana_kontrol",$param,false);
				$data['data_diagnosa']=$this->webapi->post('emr/emr_rajal/data_diagnosa',$param,false); 
				$data['data_diagnosa_masuk']=$this->webapi->post("emr/emr_rajal/data_diagnosa_masuk",$param,false);  
				$data['data_status_pulang']=$this->webapi->post("emr/emr_rajal/data_status_pulang",array(),false); 
				$data['pasien_masuk']=$this->webapi->post('emr/emr_ranap/pasien_masuk_ranap',$param,false); 
				$this->load->view("page/rm_content",$data);
			}
		}
	}


	function simpan_ringkasan_pulang()
	{
		$param['NO_URUT_INAP']=$this->input->post('NO_URUT_INAP');
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['NO_CM']=$this->input->post('NO_CM');
		$param['NIK_PETUGAS']=$this->input->post('NIK_DOKTER');
		$param['TGL_RINGKASAN']=$this->input->post('TGL_RINGKASAN');
		$param['TGL_MASUK']=$this->input->post('TGL_MASUK');
		$param['TGL_KELUAR']=$this->input->post('TGL_KELUAR');
		$param['LAMA_RAWAT']=$this->input->post('LAMA_RAWAT');
		$param['NM_PENERIMA_EDU']=$this->input->post('NM_PENERIMA_EDU');
		$param['DIAGNOSA_MASUK']=$this->input->post('DIAGNOSA_MASUK');
		$param['INDIKASI_MASUK_RS']=$this->input->post('INDIKASI_MASUK_RS');
		$param['DIAGNOSA_KELUAR']=$this->input->post('DIAGNOSA_KELUAR');
		$param['RIWAYAT_PERJALANAN_PENYAKIT']=$this->input->post('RIWAYAT_PERJALANAN_PENYAKIT');
		$param['PEMERIKSAAN_FISIK']=$this->input->post('PEMERIKSAAN_FISIK');
		$param['PEMERIKSAAN_PENUNJANG']=$this->input->post('PEMERIKSAAN_PENUNJANG');
		$param['TINDAKAN_SELAMA_DIRS']=$this->input->post('TINDAKAN_SELAMA_DIRS');
		$param['TERAPI_SELAMA_DIRS']=$this->input->post('TERAPI_SELAMA_DIRS');
		$param['INSTRUKSI_TINDAK_LANJUT']=$this->input->post('INSTRUKSI_TINDAK_LANJUT');
		$param['KONDISI_PULANG']=$this->input->post('KONDISI_PULANG');
		$param['STATUS_KELUAR']=$this->input->post('STATUS_KELUAR');
		$param['KD_STATUS_PULANG']=$this->input->post('KD_STATUS_PULANG');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		
		$data=$this->webapi->post("emr/emr_ranap/simpan_ringkasan_pulang",$param,false);
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


	function simpan_skdp()
	{
		$msg="";
		$param['URUT_RENCANA_KONTROL']=$this->input->post('URUT_RENCANA_KONTROL');
		$data_skdp=$this->webapi->post("emr/emr_ranap/data_kelengkapan_skdp",$param,false);
		if($data_skdp)
		{
			if($data_skdp->response=='200')
			{
				$dskdp=$data_skdp->data;
				$param['NO_SKDP']='';
				$param['NO_REG']=$dskdp->NO_REG;
				$param['KD_UNIT']=$dskdp->KD_UNIT;
				$param['NIK_DOKTER']=$dskdp->NIK_DOKTER;
				$param['TGL_SKDP']=$dskdp->TGL_SKDP;//YYYY-MM-DD
				$param['NO_SEP']=$dskdp->NO_SEP;
				if($param['NO_SEP']=='')
				{
					$param['IS_BPJS']='F';
				}
				else
				{
					$param['IS_BPJS']='T';
				}
				$param['KD_POLI']=$dskdp->KD_UNIT_BPJS;
				$param['KD_DOKTER']=$dskdp->ID_BPJS;
				$param['DIAGNOSA']=$dskdp->DIAGNOSA;
				$param['ALASAN']='MASIH HARUS KONTROL DI POLI SPESIALIS';
				$param['RENCANA']='PENGOBATAN LANJUTAN';
				$param['IS_DM']='T';
				$param['IS_HT']='T';
				$param['IS_STROKE']='T';
				$param['IS_EPILEPSI']='T';
				$param['IS_ASMA']='T';
				$param['IS_PPOK']='T';
				$param['IS_JANTUNG']='T';
				$param['IS_SKIZ']='T';
				$param['IS_SLE']='T';
				$param['KRONIS_LAIN']='';
				$param['USER']='Ranap';
				$param['NM_DOKTER']="";
				$param['NM_POLI']="";
			
				if($param['NO_SEP']!='')
				{
					if($param['NO_SKDP']=='')
					{
						$json=array('request'=>array(
											"noSEP"=>$param['NO_SEP'],
											"kodeDokter"=>$param['KD_DOKTER'],
											"poliKontrol"=>$param['KD_POLI'],
											"tglRencanaKontrol"=>$param['TGL_SKDP'],
											"user"=>$param['USER']
												));
						$parambpjs['DATA']=json_encode($json);

						$insertSKDP=$this->webapi->post_bpjs('sep/sep/insertSKDP',$parambpjs);
			
						$skdp=json_decode($insertSKDP,false);
						
					}
					else
					{
						
						$json=array('request'=>array(
											"noSuratKontrol"=>$param['NO_SKDP'],
											"noSEP"=>$param['NO_SEP'],
											"kodeDokter"=>$param['KD_DOKTER'],
											"poliKontrol"=>$param['KD_POLI'],
											"tglRencanaKontrol"=>$param['TGL_SKDP'],
											"user"=>$param['USER']
												));
						$parambpjs['DATA']=json_encode($json);
						$insertSKDP=$this->webapi->post_bpjs('sep/sep/updateSKDP',$parambpjs);
			
						$skdp=json_decode($insertSKDP,false);
					}
		
					if($skdp)
					{
						if($skdp->metaData->code=='200')
						{
							$param['NO_SKDP']=$skdp->response->noSuratKontrol;
							$param['NM_DOKTER']=$skdp->response->namaDokter;					
						}
						
					}
					
					//apapun yg terjadi simpan skdp bpjs			
					$this->webapi->post("emr/emr_rajal/simpan_skdp",$param,false);
	 				echo $insertSKDP;
				}
				else
				{
					
					$arr_response=array('metaData'=>array('code'=>'201','message'=>'SKDP Gagal disimpan!'),'response'=>array('noSuratKontrol'=>''	));
					$param['NO_SKDP']=$param['NO_REG'].$param['KD_UNIT'].'-UM';
					$param['NM_DOKTER']='';
					$data=$this->webapi->post("emr/emr_rajal/simpan_skdp",$param,false);
					if($data)
					{
						if($data->response=='200')
						{
							$arr_response=array('metaData'=>array('code'=>'200','message'=>'SKDP berhasil disimpan.'),'response'=>array('		noSuratKontrol'=>$param['NO_SKDP']));
						}
					}
					echo json_encode($arr_response);
					
				}
				

			}
			else
			{
				$arr_response=array('metaData'=>array('code'=>'201','message'=>'Data rencana kontrol tidak ditemukan!'),'response'=>array('	noSuratKontrol'=>''));
				echo json_encode($arr_response);
			}
		}
		else
		{
			$arr_response=array('metaData'=>array('code'=>'201','message'=>'Data rencana kontrol tidak ditemukan!'),'response'=>array('	noSuratKontrol'=>''));
			echo json_encode($arr_response);
		}

		//echo json_encode($param);
	}

	function hapus_skdp($skdp,$sep)
	{
		$param['NO_SKDP']=$skdp;
		$param['NO_SEP']=$sep;
		if($param['NO_SKDP']!='')
		{
			if($param['NO_SEP']!='')
			{
				$json=array('request'=>array(
									't_suratkontrol'=>array(
										'noSuratKontrol'=>$param['NO_SKDP'],
										'user'=>$this->session->userdata('NAMA'))
									));
				$parambpjs['DATA']=json_encode($json);
				$delSKDP=$this->webapi->post_bpjs('sep/sep/deleteSKDP',$parambpjs);
				$this->webapi->post("emr/emr_rajal/hapus_skdp",$param,false);
				//echo $delSKDP;
			}
			else
			{
				$arr_response=array('metaData'=>array('code'=>'201','message'=>'SKDP Gagal dihapus!'),'response'=>array('noSuratKontrol'=>''));
				$data=$this->webapi->post("emr/emr_rajal/hapus_skdp",$param,false);
				if($data)
				{
					if($data->response=='200')
					{
						$arr_response=array('metaData'=>array('code'=>'200','message'=>'SKDP berhasil dihapus'),'response'=>array('noSuratKontrol'=>$param['NO_SKDP']));
					}
				}
				//echo json_encode($arr_response);
			}
		}
	}


	function simpan_permintaan_rujuk()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$param['NIK_DOKTER']=$this->input->post('NIK_DOKTER');
		$param['TGL_RENCANA']=$this->input->post('TGL_RENCANA');
		$param['DIAGNOSA']=$this->input->post('DIAGNOSA');
		$param['PELAYANAN']=$this->input->post('PELAYANAN');
		$param['KD_JENIS_RUJUK']=$this->input->post('KD_JENIS_RUJUK');
		$param['FASKES']=$this->input->post('FASKES');
		$param['POLI']=$this->input->post('POLI');
		$param['CATATAN']=$this->input->post('CATATAN');
		$param['NIK_NYA']=$this->session->userdata('NIK');
		$data=$this->webapi->post('emr/emr_rajal/simpan_permintaan_rujuk_keluar',$param);
		echo $data;
	}

	function hapus_permintaan_rujuk()
	{
		$param['NO_REG']=$this->input->post('NO_REG');
		$param['KD_UNIT']=$this->input->post('KD_UNIT');
		$data=$this->webapi->post('emr/emr_rajal/hapus_permintaan_rujuk_keluar',$param);
		echo $data;
	}

}