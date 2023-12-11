<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Percetakan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('Pdf');
	}

	function index()
	{
	  redirect(base_url());//TIDAK BOLEH PANGGIL KE SINI
	}

	function cetak_bukti_mutasi($kode=''){
      
      if($kode!='')
      { 
        $param['KD_MUTASI'] = $kode;//$this->input->post('KD_MUTASI');
        $data['data_mutasi']=$this->webapi->post("farmasi/gudang/detail_mutasi",$param,false);
        $data['detail_mutasi']=$this->webapi->post("farmasi/gudang/group_rincian_mutasi",$param,false);
        $data['data_rs']=$this->webapi->post('auth/data_rs',array(),false);
        //$this->load->view('percetakan/vc_bukti_mutasi',$data);
        
        $html=$this->load->view('vc_bukti_mutasi',$data,true);
        $this->bukti_mutasi($html,'Bukti pengiriman mutasi','Bukti Pengiriman Mutasi');
      }
    }

    function cetak_label_obat($kd_jual='',$kd_obat='')
    {
        $param['KD_JUAL']=$kd_jual;
        $param['KD_OBAT']=$kd_obat;
        $data['data_rs']=$this->webapi->post('auth/data_rs',array(),false);
        $data['data_obat']=$this->webapi->post('farmasi/pasien/cetak_label_obat',$param,false);
        //$this->load->view('percetakan/vc_label_obat',$data);
        $html=$this->load->view('percetakan/vc_label_obat',$data,true);
        $this->label($html,'Label obat','Label obat');
        //print_r($data);
    }

    function cetak_label_obat_non($kd_jual='',$kd_obat='')
    {
        $param['KD_JUAL']=$kd_jual;
        $param['KD_OBAT']=$kd_obat;
        $data['data_rs']=$this->webapi->post('auth/data_rs',array(),false);
        $data['data_obat']=$this->webapi->post('farmasi/pasien/cetak_label_obat_non',$param,false);
        //$this->load->view('percetakan/vc_label_obat_non',$data);
        $html=$this->load->view('percetakan/vc_label_obat_non',$data,true);
        $this->label($html,'Label obat','Label obat');
    }

    function cetak_farmasi($kd_jual='')
    {
        $param['KD_JUAL']=$kd_jual;
        $data['data_jual']=$this->webapi->post('farmasi/pasien/detail_jual_farmasi',$param,false);
        $data['data_obat']=$this->webapi->post('farmasi/pasien/data_jual_obat',$param,false);
        $data['data_rs']=$this->webapi->post('auth/data_rs',array(),false);
        //$this->load->view('percetakan/vc_jual_obat',$data);
        $html=$this->load->view('percetakan/vc_jual_obat',$data,true);
        $this->jual_obat($html,'Penjualan obat','Penjualan obat');
    }

    function cetak_farmasi_non($kd_jual='')
    {
        $param['KD_JUAL']=$kd_jual;
        $data['data_jual']=$this->webapi->post('farmasi/pasien/detail_jual_farmasi_non',$param,false);
        $data['data_obat']=$this->webapi->post('farmasi/pasien/data_jual_obat',$param,false);
        $data['data_rs']=$this->webapi->post('auth/data_rs',array(),false);
        //$this->load->view('percetakan/vc_jual_obat_non',$data);
        $html=$this->load->view('percetakan/vc_jual_obat_non',$data,true);
        $this->jual_obat($html,'Penjualan obat luar','Penjualan obat luar');
    } 

    function jual_obat($html,$filename,$laporan_name){
        
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle($laporan_name);
        $pdf->SetHeaderMargin(50);
        $pdf->SetTopMargin(5);
        $pdf->SetLeftMargin(5);
        $pdf->SetRightMargin(5);
        $pdf->setFooterMargin(5);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('IT RSNH');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetFont('helvetica', 'R', 8);
        $pdf->setFontSubsetting(false);
        $pdf->AddPage('L', array(150,120), false, false);    
        //$pdf->Write(5, $html);
        ob_start();
        $pdf->writeHTML($html, true, false, false, false, '');
        ob_end_clean();
        $pdf->Output($filename.'.pdf', 'I');
       
    }  

    function bukti_mutasi($html,$filename,$laporan_name){
        
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle($laporan_name);
        $pdf->SetHeaderMargin(50);
        $pdf->SetTopMargin(10);
        $pdf->setFooterMargin(20);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('IT RSNH');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetFont('helvetica', 'R', 8);
        $pdf->setFontSubsetting(false);
        $pdf->AddPage('L', array(210,210), false, false);    
        //$pdf->Write(5, $html);
        ob_start();
        $pdf->writeHTML($html, true, false, false, false, '');
        ob_end_clean();
        $pdf->Output($filename.'.pdf', 'I');
       
    }

    function label($html,$filename,$laporan_name){
        
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf = new Pdf("P", "mm",  array(40,60) , true, 'UTF-8', false);
        $pdf->SetTitle($laporan_name);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetTopMargin(1);
        $pdf->SetLeftMargin(1);
        $pdf->SetRightMargin(1);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('IT RSNH');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetFont('helvetica', 'R', 7);
        $pdf->setFontSubsetting(false);
        $pdf->AddPage('P', array(40,60), false, false);       
        //$pdf->Write(5, $html);
        ob_start();
        $pdf->writeHTML($html, true, false, false, false, '');
        ob_end_clean();
        $pdf->Output($filename.'.pdf', 'I');
       
    }

	
	
}