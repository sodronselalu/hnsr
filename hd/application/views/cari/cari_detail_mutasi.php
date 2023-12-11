<button type="button" class="btn btn-default btn-sm" onclick="tutup_detail()">Tutup Rincian</button>
<table id="tb_detail_mutasi" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Kode Obat</th>
      <th>Nama</th>
      <th>Qty</th>
      <th>Vol</th>
      <th>Harga Beli</th>
      <th>Expired</th>
      <th>Kode Produksi</th>
      <th>Pabrik</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $kode=0;
      if(!is_null($detail_mutasi))
      {
        if($detail_mutasi->response=='200')
        {
          foreach ($detail_mutasi->data as $dt) {
            
            $kode+=1;
            echo "<tr style='cursor:pointer;'>";
              echo "<td>";
                echo $dt->KD_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->NAMA_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->NILAI_QTY.' '.$dt->NM_SATUAN_QTY;
              echo "</td>";
              echo "<td>";
                echo $dt->NILAI_VOLUME_SATUAN.' '.$dt->NM_SATUAN_VOLUME;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->HARGA_BELI);
              echo "</td>";
              echo "<td>";
                echo $dt->EXPIRED_DATE;
              echo "</td>";
              echo "<td>";
                echo $dt->KODE_PRODUKSI;
              echo "</td>";
              echo "<td>";
                echo $dt->NAMA_PABRIK;
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
    $('#tb_detail_mutasi').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );
</script>