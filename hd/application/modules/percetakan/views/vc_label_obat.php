<?php 
 if($data_obat->response=='200')
 { 
   $rs=$data_rs->data;
  ?>
<table>
  <tr>
    <td align="center" colspan="2"><?php echo $rs->NM_RS; ?></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><?php echo $rs->ALAMAT; ?></td>
  </tr>
 <hr>
  <tr>
    <td>No. RM</td>
    <td><?php echo $data_obat->data->NO_CM; ?></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td><?php echo $data_obat->data->NM_PASIEN; ?></td>
  </tr>
  <hr>
  <tr>
    <td colspan="2"><?php echo $data_obat->data->NAMA_OBAT;?></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $data_obat->data->NM_PAKAI.' '.$data_obat->data->DOSIS_PAKAI.' '.$data_obat->data->NM_DOSIS_PAKAI; ?></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $data_obat->data->NM_ATURAN_PAKAI.' '.$data_obat->data->NM_WAKTU_OBAT.' '.$data_obat->data->KETERANGAN; ?></td>
  </tr>
  <tr>
    <td colspan="2">ED :</td>
  </tr>
  <tr>
    <td colspan="2">
      Berdo'alah sebelum/sesudah minum obat. Sesungguhnya kesembuhan dari Allah Subhanahuwat'ala
    </td>
  </tr>
</table>
<?php
}
?>