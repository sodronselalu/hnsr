<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
	  if(!is_null($this->session->userdata('AKSES')) && array_key_exists(APP_ID, $this->session->userdata('AKSES')))
	  {
		 redirect(base_url('index.php/home'));
	  }
	  else
	  {
		  $data['header']="page/header";
		  $data['navbar']="page/navbar";
		  $data['sidebar']="page/sidebar";
		  $data['js']="page/js";
		  $data['footer']="page/footer";
		  $this->load->view("page/login",$data);
	  }
	}

	function login()
	{
		$msg=danger("Anda tidak memiliki akses ke sistem ".WEB_TITLE);
		if($_POST)
		{
		  if(!is_null($this->input->post('USERNAME')) && !is_null($this->input->post('PASSWORD')))
		  {
			$param['USERNAME']=$this->input->post('USERNAME');
			$param['PASSWORD']=$this->input->post('PASSWORD');
			$result=$this->webapi->post('auth/login',$param,false);
			if($result)
			{ 
              if($result->response=='200')
			  {

			  		$config_session=array(
			  			'KD_USER'=>$result->data->KD_USER,
						'PASSWORD'=>$result->data->PASSWORD,
			  			'NIK'=>$result->data->NIK,
			  			'NAMA'=>$result->data->NAMA,
			  			'KD_PROFESI'=>$result->data->KD_PROFESI,
			  			'KD_SPESIALIS'=>$result->data->KD_SPESIALIS,
			  			'NM_PROFESI'=>$result->data->NM_PROFESI,
			  			'NM_SPESIALIS'=>$result->data->NM_SPESIALIS,
			  			'KD_AKSES'=>$result->data->KD_AKSES,
			  			'AKSES'=>array(APP_ID=>explode(',', $result->data->AKSES)),
			  			'NM_AKSES'=>$result->data->NM_AKSES,
			  			'KD_GUDANG'=>'FHD',
			  			'KD_UNIT'=>'RPSP20',
			  			'KD_RUANG'=>'RPHD',
			  			'NM_GUDANG'=>'Farmasi Hemodialisa',
			  			'KD_RS'=>'0177R005',
			  			'KD_KANTOR'=>'0177R005',
			  			'LAST_LOGIN'=>date_format(date_create($result->data->LAST_LOGIN),'d-m-Y h:i:s')
			  		);

			  		$this->session->set_userdata($config_session);
			  		if($this->session->userdata('KD_USER'))
			  		{
			  			$msg=success("Anda berhasil masuk ".$this->session->userdata('NAMA'));
			  		}
			  		else
			  		{
			  			$msg=warning("Anda keluar dari sistem!");
			  		}
			  }
			  else
			  {
			  	$msg=danger("Anda tidak diijinkan masuk ke sistem!");
			  }
			}
			else
			{
				$msg=danger("Terjadi kegagalan login");
			}
		  }
		}
		$this->session->set_flashdata('msg', $msg);
		redirect(base_url());
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		session_destroy();
		redirect('http://'.$_SERVER['HTTP_HOST'].'/nh');
	}

	function ganti_password()
	{
		if($_POST)
		{
		   $OLD1=sha1($this->input->post('OLD_PASSWORD'));
		   $OLD2=$this->session->userdata('PASSWORD');
		   if($OLD1==$OLD2)
		   {
		   	if(!is_null($this->input->post('OLD_PASSWORD')) && !is_null($this->input->post('NEW_PASSWORD1')) && !is_null($this->input->post(	'NEW_PASSWORD2')))
		   	{
		     	$param['OLD_PASSWORD']=$this->input->post('OLD_PASSWORD');
		     	$param['NEW_PASSWORD1']=$this->input->post('NEW_PASSWORD1');
		     	$param['NEW_PASSWORD2']=$this->input->post('NEW_PASSWORD2');
		     	$param['KD_USER']=$this->session->userdata('KD_USER');
		     	$data=$this->webapi->post("auth/ganti_password",$param);
		     	echo $data;
		   	}
		   }
		   else
		   {
		   	 $data['response']="201";
		   	 $data['data']="Password Lama Salah!";
		   	 echo json_encode($data);
		   }

		}
	}

}