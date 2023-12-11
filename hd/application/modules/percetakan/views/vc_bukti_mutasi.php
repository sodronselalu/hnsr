<?php 
 if($data_mutasi->response=='200')
 { ?>
<style type="text/css">
    h5{
        font-weight: normal;
    };

</style>

<table>
  <tr>
    <td align="center" colspan="2"><b><?php echo $data_rs->data->NM_RS; ?></b></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><b><?php echo $data_rs->data->ALAMAT.' '.$data_rs->data->KD_POS; ?></b></td>
  </tr>
  <tr>
    <br>
    <td align="center" colspan="2"><b>BUKTI PENGIRIMAN OBAT</b></td>
  </tr>
  <tr>
    <br>
    <br>
    <td align="left" style="font-size: 8px;"><?php echo 'Nomor : '.$data_mutasi->data->NO_MUTASI; ?><br></td>
    <td align="left" style="font-size: 8px;"><?php echo 'Gudang : '.$data_mutasi->data->NM_GUDANG_ASAL; ?><br></td>
  </tr>
  <tr>
    <td align="left" style="font-size: 8px;"><?php echo 'Tanggal : '.$data_mutasi->data->TGL_MUTASI; ?><br></td>
    <td align="left" style="font-size: 8px;"><?php echo 'Tujuan : '.$data_mutasi->data->NM_GUDANG_TUJUAN; ?><br></td>
  </tr>
</table>
<br>
<table cellpadding="0.5px" style="border:0.5px solid black;">

  <tr>
    <th align="center" width="20px" style="border:0.5px solid black;">No.</th>
    <th align="center" width="170px" style="border:0.5px solid black;">Nama</th>
    <th align="center" width="50px" style="border:0.5px solid black;">Qty</th>
    <th align="center" width="50px" style="border:0.5px solid black;">Vol</th>
    <th align="center" width="60px" style="border:0.5px solid black;">Harga Beli</th>
    <th align="center" width="60px" style="border:0.5px solid black;">Exp.</th>
    <th align="center" width="70px" style="border:0.5px solid black;">Kode Produksi</th>
    <th align="center" width="60px" style="border:0.5px solid black;">Pabrik</th>
  </tr>

 <?php
$sumQTY = 0;
$vol= 0;
$i = 1;
 
    foreach ($detail_mutasi->data as $dt) 
    {
      
         echo '<tr>';
         echo '<td align="center" width="20px" style="border:0.5px solid black;">';
         echo $i;
         echo '</td>';
         echo '<td align="left" width="170px" style="border:0.5px solid black;">';
         echo $dt->NAMA_OBAT;
         echo '</td>';
         echo '<td align="center" width="50px" style="border:0.5px solid black;">';
         echo $dt->NILAI_QTY.' '.$dt->NM_SATUAN_QTY;
         $sumQTY+=$dt->NILAI_QTY;
         echo '</td>';
         echo '<td align="center" width="50px" style="border:0.5px solid black;">';
         echo $dt->NILAI_VOLUME_SATUAN.' '.$dt->NM_SATUAN_VOLUME;
         $vol+=$dt->NILAI_VOLUME_SATUAN;
         echo '</td>';
         echo '<td align="right" width="60px" style="border:0.5px solid black;">';
         echo rupiah($dt->HARGA_BELI);
         echo '</td>';
         echo '<td align="center" width="60px" style="border:0.5px solid black;">';
         echo $dt->EXPIRED_DATE;
         echo '</td>';
         echo '<td align="center" width="70px" style="border:0.5px solid black;">';
         echo $dt->KODE_PRODUKSI;
         echo '</td>';
         echo '<td align="center" width="60px" style="border:0.5px solid black;">';
         echo $dt->NAMA_PABRIK;
         echo '</td>';
         $i = $i+1;
         echo "<br>";
      echo '</tr>';
    }
    
        echo '<tr>';
           echo '<td align="right" colspan="2" style="border: 0.5px solid black; font-size: 8px;">';
           
           echo '</td>';
           echo '<td align="center" style="border: 0.5px solid black; font-size: 8px;">';
           echo '<b>'.rupiah($sumQTY).'</b>';
           echo '</td>';
           echo '<td align="center" style="border: 0.5px solid black; font-size: 8px;">';
           echo '<b>'.rupiah($vol).'</b>';
           echo '</td>';
           echo '<td align="right" style="border: 0.5px solid black; font-size: 8px;">';
           echo '<b>'.rupiah($data_mutasi->data->TOT_NILAI_MUTASI).'</b>';
           echo '</td>';
        echo '</tr>';
      
 ?>
</table>
<?php
echo '<br>';
echo '<br>';
echo '<br>';
echo '<div>';
   echo '<div align="right">';
   echo '<table nobr="true">';
       echo '<tr><td width="550px"></td><td width="150px" align="center">Yogyakarta</td></tr>';
      echo '<tr><td align="center" width="200px">Penanggung Jawab<br></td><td width="150px"></td><td width="150px" align="center">Pimpinan</td></tr>';
      echo '<br>';
      echo '<br>';
      echo '<br>';
      echo '<br>';
      echo '<tr><td align="center" width="200px">'.$data_mutasi->data->NM_PETUGAS_PJ.'</td><td width="150px"></td><td width="150px" align="center">'.$data_mutasi->data->NM_PIMPINAN.'</td></tr>';
      echo '</table>';
   echo '</div>';
echo '</div>';
}