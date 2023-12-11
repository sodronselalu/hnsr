<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Konversi_tanggal {

	function konversi($tanggal)
	{
	 
	    $format = array(
	        'Sun' => 'MINGGU',
	        'Mon' => 'SENIN',
	        'Tue' => 'SELASA',
	        'Wed' => 'RABU',
	        'Thu' => 'KAMIS',
	        'Fri' => 'JUMAT',
	        'Sat' => 'SABTU',
	        'Jan' => 'JANUARI',
	        'Feb' => 'FEBRUARI',
	        'Mar' => 'MARET',
	        'Apr' => 'APRIL',
	        'May' => 'MEI',
	        'Jun' => 'JUNI',
	        'Jul' => 'JULI',
	        'Aug' => 'AGUSTUS',
	        'Sep' => 'SEPTEMBER',
	        'Oct' => 'OKTOBER',
	        'Nov' => 'NOVEMBER',
	        'Dec' => 'DESEMBER',
	        '01' => 'SATU',
	        '02' => 'DUA',
	        '03' => 'TIGA',
	        '04' => 'EMPAT',
	        '05' => 'LIMA',
	        '06' => 'ENAM',
	        '07' => 'TUJUH',
	        '08' => 'DELAPAN',
	        '09' => 'SEMBILAN',
	        '10' => 'SEPULUH',
	        '11' => 'SEBELAS',
	        '12' => 'DUA BELAS',
	        '13' => 'TIGA BELAS',
	        '14' => 'EMPAT BELAS',
	        '15' => 'LIMA BELAS',
	        '16' => 'ENAM BELAS',
	        '17' => 'TUJUH BELAS',
	        '18' => 'DELAPAN BELAS',
	        '19' => 'SEMBILAN BELAS',
	        '20' => 'DUA PULUH',
	        '21' => 'DUA PULUH SATU',
	        '22' => 'DUA PULUH DUA',
	        '23' => 'DUA PULUH TIGA',
	        '24' => 'DUA PULUH EMPAT',
	        '25' => 'DUA PULUH LIMA',
	        '26' => 'DUA PULUH ENAM',
	        '27' => 'DUA PULUH TUJUH',
	        '28' => 'DUA PULUH DELAPAN',
	        '29' => 'DUA PULUH SEMBILAN',
	        '30' => 'TIGA PULUH',
	        '31' => 'TIGA PULUH SATU',
	        '2014' => 'DUA RIBU EMPAT BELAS',
	        '2015' => 'DUA RIBU LIMA BELAS',
	        '2016' => 'DUA RIBU ENAM BELAS',
	        '2017' => 'DUA RIBU TUJUH BELAS',
	        '2018' => 'DUA RIBU DELAPAN BELAS',
	        '2019' => 'DUA RIBU SEMBILAN BELAS',
	        '2020' => 'DUA RIBU DUA PULUH'
	    );
	 
	    return strtr($tanggal, $format);
	}

	function konversi2($tanggal)
	{
	 
	    $format = array(
	        'Sun' => 'MINGGU',
	        'Mon' => 'SENIN',
	        'Tue' => 'SELASA',
	        'Wed' => 'RABU',
	        'Thu' => 'KAMIS',
	        'Fri' => 'JUMAT',
	        'Sat' => 'SABTU',
	        'Jan' => 'Januari',
	        'Feb' => 'Februari',
	        'Mar' => 'Maret',
	        'Apr' => 'April',
	        'May' => 'Mei',
	        'Jun' => 'Juni',
	        'Jul' => 'Juli',
	        'Aug' => 'Agustus',
	        'Sep' => 'September',
	        'Oct' => 'Oktober',
	        'Nov' => 'November',
	        'Dec' => 'Desember',
	    );
	 
	    return strtr($tanggal, $format);
	}
	 
	// Fri, 04 Jun 1993
	//$tanggal = date('D, d M Y', strtotime('06/04/1993'));
	//$tanggal = date('d M Y', strtotime('06/04/1993'));
	 
	// Jumat, 04 Juni 1993
	//echo konversi($tanggal);


}