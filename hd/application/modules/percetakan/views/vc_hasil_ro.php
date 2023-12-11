<?php 
 if($data_jual->response=='200')
  $tg=$data_jual->data;
 { ?>

<table >
  <tr>
    <td align="center" colspan="2"><b><h1><?php echo $data_rs->data->NM_RS; ?></h1></b></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><b><?php echo $data_rs->data->ALAMAT.' '.$data_rs->data->KD_POS; ?></b></td>
  </tr>
</table>
<br>
<table style="border:1px solid black;">
  <tr>
    <td>
      <table>
        <tr>
          <td width="100px"><b>No Reg</b></td>
          <td width="10px">:</td>
          <td><b><?php echo $tg->NO_REG; ?></b></td>
        </tr>
        <tr>
          <td width="100px"><b>No CM</b></td>
          <td width="10px">:</td>
          <td><b><?php echo $tg->NO_CM; ?></b></td>
        </tr>
        <tr>
          <td width="100px"><b>Nama</b></td>
          <td width="10px">:</td>
          <td><b><?php echo $tg->NM_PASIEN; ?></b></td>
        </tr>
        <tr>
          <td width="100px"><b>Alamat</b></td>
          <td width="10px">:</td>
          <td width="150px"><b><?php echo $tg->ALAMAT; ?></b></td>
        </tr>
        
      </table>
    </td>
    <td>
      <table>
        <tr>
          <td width="100px"><b>Dokter</b></td>
          <td width="10px">:</td>
          <td width="150px"><b><?php echo $tg->NM_DOKTER; ?></b></td>
        </tr>
        <tr>
          <td width="100px"><b>Asuransi</b></td>
          <td width="10px">:</td>
          <td width="150px"><b><?php echo $tg->NM_ASURANSI; ?></b></td>
        </tr>
        <tr>
          <td width="100px"><b>Jenis Pasien</b></td>
          <td width="10px">:</td>
          <td width="150px"><b><?php echo iol($tg->IOL); ?></b></td>
        </tr>
        <tr>
          <td width="100px"><b>Asal</b></td>
          <td width="10px">:</td>
          <td width="150px"><b><?php echo $tg->NM_UNIT; ?></b></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
 <?php
 if($detail_hasil->response=='200')
 {
    echo $detail_hasil->data->HASIL_HTML;
 }
      
}