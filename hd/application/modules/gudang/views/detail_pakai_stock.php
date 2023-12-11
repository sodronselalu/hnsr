<table id="detail_pakai_stock" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Kode Stock</th>
      <th>Nama</th>
      <th>Qty</th>
      <th>Harga Beli</th>
      <th>Total</th>
      <th>Expired</th>
      <th>Kode Produksi</th>
      <th>Pabrik</th>
      <th>Kondisi</th>
      <th>Aksi</th>
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
                echo rupiah($dt->TOTAL_PAKAI);
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
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-success" title="Lihat stock ini?" pakai="'.$dt->KD_PAKAI.'" stock="'.$dt->KD_STOCK.'" onclick="pilih_pakai_stock(this);"><i class="fa fa-edit"></i></button>';
                echo '<button type="button" class="btn btn-round btn-danger" title="Hapus stock ini?" pakai="'.$dt->KD_PAKAI.'" stock="'.$dt->KD_STOCK.'" onclick="hapus_pakai_stock(this);"><i class="fa fa-trash"></i></button>';
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
    $('#detail_pakai_stock').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );
</script>