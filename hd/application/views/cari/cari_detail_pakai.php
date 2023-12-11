<table id="tb_detail_pakai" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Kode Stock</th>
      <th>Nama</th>
      <th>Qty</th>
      <th>Harga Beli</th>
      <th>Expired</th>
      <th>Kode Produksi</th>
      <th>Pabrik</th>
      <th>Kondisi</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $kode=0;
      if(!is_null($detail_pakai))
      {
        if($detail_pakai->response=='200')
        {
          foreach ($detail_pakai->data as $dt) {
            
            $kode+=1;
            echo "<tr style='cursor:pointer;'>";
              echo "<td>";
                echo $dt->KD_STOCK;
              echo "</td>";
              echo "<td>";
                echo $dt->NAMA_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->QTY_PAKAI.' '.$dt->NM_SATUAN_VOLUME;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->HARGA_BELI_SATUAN);
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
              echo "<td>";
                echo kondisi_pakai($dt->KONDISI);
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
    $('#tb_detail_pakai').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );
</script>