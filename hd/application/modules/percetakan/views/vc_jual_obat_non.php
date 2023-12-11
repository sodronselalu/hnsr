<?php 
 if($data_jual->response=='200')
 { 
   $tg=$data_jual->data;
  ?>
<table>
  <tr>
    <td align="center" colspan="2"><h2><?php echo $data_rs->data->NM_RS; ?></h2><br></td>
  </tr>
  <tr>
    <td>
      <table cellpadding="0.5px">
        <tr>
          <td align="left" width="30px">No Jual</td>
          <td align="left" width="80px">: <?php echo $tg->NO_JUAL; ?></td>
        </tr>
        <tr>
          <td align="left" width="30px">No</td>
          <td align="left" width="80px">: <?php echo $tg->KD_PASIEN; ?></td>
        </tr>
        <tr>
          <td align="left" width="30px">NIK</td>
          <td align="left" width="80px">: <?php echo $tg->NIK_NON_PASIEN; ?></td>
        </tr>
      </table>
    </td>
    <td>
      <table cellpadding="0.5px">
        <tr>
          <td align="left" width="40px">Nama</td>
          <td align="left" width="170px">: <?php echo $tg->NM_PASIEN; ?></td>
        </tr>
        <tr>
          <td align="left" width="40px">Alamat</td>
          <td align="left" width="170px">: <?php echo $tg->ALAMAT; ?></td>
        </tr>
        <tr>
          <td align="left" width="40px">Hp/ Telp</td>
          <td align="left" width="170px">: <?php echo $tg->HP.'  '.$tg->TELP; ?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<br>
<table cellpadding="1px" style="border:0.25px solid black;" align="center">
  <tr>
    <td align="center" width="255px" style="border:0.5px solid black;">Nama Obat</td>
    <td align="center" width="60px" style="border:0.5px solid black;">Qty</td>
    <td align="center" width="80px" style="border:0.5px solid black;">Total</td>
  </tr>

 <?php
 
$sumQTY = 0;
  if($data_obat->response=='200')
  {
    foreach ($data_obat->data as $dt) 
    {
      
         echo '<tr>';
         echo '<td align="left" width="255px" style="border:0.5px solid black;"> ';
         echo $dt->NAMA_OBAT;
         echo ' </td>';
         echo '<td align="center" width="60px" style="border:0.5px solid black;"> ';
         echo $dt->QTY_JUAL;
         echo ' </td>';
         echo '<td align="right" width="80px" style="border:0.5px solid black;">';
         echo rupiah($dt->TOTAL);
         $sumQTY+=$dt->TOTAL;
         echo '</td>';
      echo '</tr>';
    }
    
        echo '<tr>';
           echo '<td align="center" colspan="2" align="right" style="border: 0.5px solid black; font-size: 8px;">';
           echo '<b>Total</b>';
           echo '</td>';
           echo '<td align="right" style="border: 0.5px solid black; font-size: 8px;">';
           echo '<b>'.rupiah($sumQTY).'</b>';
           echo '</td>';
        echo '</tr>';
        echo '<tr>';
           echo '<td align="center" colspan="2" align="right" style="border: 0.5px solid black; font-size: 8px;">';
           echo '<b>Embalase</b>';
           echo '</td>';
           echo '<td align="right" style="border: 0.5px solid black; font-size: 8px;">';
           echo '<b>'.rupiah($tg->TOTAL_EMBALASE).'</b>';
           echo '</td>';
        echo '</tr>';
        echo '<tr>';
           echo '<td align="center" colspan="2" align="right" style="border: 0.5px solid black; font-size: 8px;">';
           echo '<b>Tuslah</b>';
           echo '</td>';
           echo '<td align="right" style="border: 0.5px solid black; font-size: 8px;">';
           echo '<b>'.rupiah($tg->TOTAL_TUSLAH+$tg->TOTAL_TUSLAH_RACIK).'</b>';
           echo '</td>';
        echo '</tr>';
        echo '<tr>';
           echo '<td align="center" colspan="2" align="right" style="border: 0.5px solid black; font-size: 8px;">';
           echo '<b>Total</b>';
           echo '</td>';
           echo '<td align="right" style="border: 0.5px solid black; font-size: 8px;">';
           echo '<b>'.rupiah($tg->ALL_TOTAL).'</b>';
           echo '</td>';
        echo '</tr>';
    }
 ?>
</table>
<?php
echo '<br>';
echo '<br>';
echo "<b>Terbilang</b> : ".terbilang($sumQTY).' rupiah.';
echo '<br>';
echo '<div>';
   echo '<div align="right">';
   echo '<table nobr="true">';
       echo '<tr><td width="600px" align="center">Mengetahui</td></tr>';
      echo '<tr><td width="600px" align="center">Ins. Farmasi</td></tr>';
      echo '<br>';
      echo '<br>';
      echo '<br>';
      echo '<br>';
      echo '<tr><td width="360px">( ________________________ )</td></tr>';
      echo '</table>';
   echo '</div>';
echo '</div>';
echo '<br>';
echo "Terima kasih atas kunjungannya.<br>";
echo "Semoga lekas sembuh.";
}