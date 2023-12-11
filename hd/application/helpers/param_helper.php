<?php

function asset_url($url="")
{
   return "http://".$_SERVER['HTTP_HOST'].'/nh/lib/'.$url;
}

function obat_cukup($jual,$resep)
{
  if($jual==$resep)
  {
    return "<b class='green'>Terpenuhi</b>";
  }
  else
  {
    return "<b class='red'>Belum Terpenuhi</b>";
  }
}

function is_posting($kode)
{
  if($kode=='0')
  {
    return 'Data belum diterima sebagai stok!';
  }
  else if($kode=='1')
  {
    return 'Data telah diterima sebagai stok!';
  }
  else if($kode=='9')
  {
    return 'Data telah disimpan ke stok';
  }
  else
  {
    return 'Data tidak valid. Catat kode Pembelian ini dan laporkan ke petugas IT';
  }
}

function is_tagih($kode)
{
  if($kode=='T')
  {
    return "<div class='green'>Tertagih</div>";
  }
  else
  {
    return "<div class='red'>Belum Tertagih</div>";
  }
}

function status_pakai($kode)
{
  switch ($kode) {
    case '0':
      return "Proses";
      break;
    case '1':
      return "FIX";
      break;
    case '9':
      return "FINAL";
      break;
    default:
      return "Tidak diketahui!";
      break;
  }
}

function kondisi_pakai($kode)
{
  switch ($kode) {
    case '0':
      return "BAIK";
      break;
    case '1':
      return "RUSAK";
      break;
    case '2':
      return "EXP";
      break;
    case '3':
      return "LAINNYA";
      break;
    default:
      return "Tidak diketahui!";
      break;
  }
}

function icon_gender($kode)
{
  if($kode=='L')
  {
    return "man.png";
  }
  else
  {
    return "woman.png";
  }
}

function status_periksa($kode)
{
  switch ($kode) {
    case '0':
        return "Belum diverifikasi";
      break;
    case '1':
        return "Menunggu dilayani";
      break;
    case '2':
        return "Sedang dilayani";
      break;
    case '3':
        return "Sudah keluar";
      break;
    case '4':
        return "Dihapus";
      break;
    default:
      return "Unknown";
      break;
  }
}

function iol($kode)
{
  switch ($kode) {
    case 'O':
       return "Rawat Jalan";
      break;
    case 'I':
       return "Rawat Inap";
      break;
    case 'L':
       return "Non Pasien";
      break;
    
    default:
       return "Unknown";
      break;
  }
}


function no_tagih_iol($kode)
{
  switch ($kode) {
    case 'O':
       return "LAN";
      break;
    case 'I':
       return "NAP";
      break;
    case 'L':
       return "NON";
      break;
    
    default:
       return "PAS";
      break;
  }
}

function status_mutasi($kode)
{
  switch ($kode) {
    case '0':
      return "Mutasi belum selesai.";
      break;
    case '1':
      return "Mutasi telah dikirim.";
      break;
    case '9':
      return "Mutasi telah diterima.";
      break;
    default:
      return "Tidak diketahui!";
      break;
  }
}

//0 : PROSES; 1 : SELESAI; 2 : DISERAHKAN; 3 : SUDAH DITAGIH; 9 : TELAH LUNAS
function status_jual($kode)
{
  switch ($kode) {
    case '0':
      return "PROSES";
      break;
    case '1':
      return "SELESAI";
      break;
    case '2':
      return "DISERAHKAN";
      break;
    case '3':
      return "SUDAH DITAGIH";
      break;
    case '9':
      return "TELAH LUNAS";
      break;
    default:
      return "Tidak diketahui!";
      break;
  }
}

//0 : PROSES; 1 : SELESAI; 2 : SUDAH DITAGIH; 9 : TELAH LUNAS
function status_retur($kode)
{
  switch ($kode) {
    case '0':
      return "PROSES";
      break;
    case '1':
      return "SELESAI";
      break;
    case '2':
      return "SUDAH DITAGIH";
      break;
    case '9':
      return "TELAH LUNAS";
      break;
    default:
      return "Tidak diketahui!";
      break;
  }
}


function jenis_jual($kode)
{
  switch ($kode) {
    case 'D':
       return "Pasien RS";
      break;
    case 'L':
       return "Pasien Luar";
      break;
    
    default:
       return "Unknown";
      break;
  }
}

function format_request($data=array())
{
  return json_encode(array("code"=>APP_ID,"data"=>$data));
}

function response($data,$code,$msg)
{
  echo json_encode(array('response'=>$code,'msg'=>$msg,'data'=>$data));
}

function digit($jml,$posisi)
{
  return str_pad($posisi, $jml,'0',STR_PAD_LEFT);
}

function nomor($suffix,$urut)
{
  $depan=digit(6,$urut); 
  return $depan.'/'.$suffix.'/'.bulan_ini().'/'.tahun_ini();
}

function date_last_month()
{
  $first = date("d/m/Y", strtotime("first day of last month"));
  $last = date("d/m/Y", strtotime("last day of last month"));
  return array("TGL_AWAL"=>$first,"TGL_AKHIR"=>$last);
}

function date_of_month()
{
  $first = date("d/m/Y", strtotime("first day of this month"));
  $last = date("d/m/Y", strtotime("last day of this month"));
  return array("TGL_AWAL"=>$first,"TGL_AKHIR"=>$last);
}

function rupiah($angka)
{
  //return strrev(implode('.',str_split(strrev(strval($angka)),3)));
  return number_format($angka,0,',','.');
}

function format_date($dt)
{
  return date_format(date_create($dt),'d/m/Y');
}

function hari_ini()
{
	return date_format(date_create('now'),'d/m/Y');
}

function bulan_ini()
{
  return date_format(date_create('now'),'m');
}

function tahun_ini()
{
  return date_format(date_create('now'),'Y');
}

function success($msg)
{
	$div='<div class="alert alert-success alert-dismissible">'.
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.
               '<h4><i class="icon fa fa-check"></i> Success !</h4>'.$msg.
          '</div>';
	return $div;
}

function info($msg)
{
	$div='<div class="alert alert-info alert-dismissible">'.
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.
               '<h4><i class="icon fa fa-check"></i> Information !</h4>'.$msg.
          '</div>';
	return $div;
}

function warning($msg)
{
	$div='<div class="alert alert-warning alert-dismissible">'.
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.
               '<h4><i class="icon fa fa-check"></i> Warnings !</h4>'.$msg.
          '</div>';
	return $div;
}

function danger($msg)
{
	$div='<div class="alert alert-danger alert-dismissible">'.
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.
               '<h4><i class="icon fa fa-check"></i> Error !</h4>'.$msg.
          '</div>';
	return $div;
}

function cek_menu($var,$arr=array())
{
  if(in_array($var, $arr))
  {
    return true;
  }
  else
  {
    return false;
  }
}


function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }
 
  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return ucfirst($hasil);
  }