<table id="tb_permintaan_sini" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Tanggal</th>
      <th>Pemohon</th>
      <th>PJ</th>
      <th>Keterangan</th>
      <th>Nama</th>
      <th>Qty</th>
      <th>Verifikasi</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_minta_sini))
      {
        if($data_minta_sini->response=='200')
        {
          foreach ($data_minta_sini->data as $dt) {
            
            $kode+=1;
            echo "<tr style='cursor:pointer;' id='".$dt->URUT_PERMINTAAN."' ondbclick='verif_minta(this.id)'>";
              echo "<td>";
                echo $dt->TGL_PERMINTAAN;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_GUDANG;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_PJ_PERMINTAAN;
              echo "</td>";
              echo "<td>";
                echo $dt->KETERANGAN;
              echo "</td>";
              echo "<td>";
                echo $dt->NAMA_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->JUMLAH.' '.$dt->NM_SATUAN;
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-primary" title="Lihat permintaan ini?" value="'.$dt->URUT_PERMINTAAN.'" onclick="verif_minta(this.value);"><i class="fa fa-check"></i></button>';
              echo "</td>";
            echo "</tr>";
           
          }
        }
      }
    ?>
  </tbody>
</table>
<script type="text/javascript">
$(document).ready(function() 
{
    $('#tb_permintaan_sini').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );
</script>