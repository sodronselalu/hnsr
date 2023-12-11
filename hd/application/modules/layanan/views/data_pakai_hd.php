<table id="data_pakai_hd" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Harga</th>
      <th>Qty</th>
      <th>Total</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $total=0;
      if(!is_null($detail_pakai))
      {
        if($detail_pakai->response=='200')
        {
          foreach ($detail_pakai->data as $dt) {

            echo "<tr style='cursor:pointer;'>";
              echo "<td>";
                echo $dt->NAMA_OBAT;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->HARGA_JUAL);
              echo "</td>";
              echo "<td>";
                echo $dt->QTY_PAKAI.' '.$dt->NM_SATUAN_VOLUME;
              echo "</td>";
              echo "<td>";
                $total+=$dt->TOTAL_PAKAI;
                echo rupiah($dt->TOTAL_PAKAI);
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
  <tfoot>
    <tr>
      <td colspan="3" style="text-align: right;">Total</td>
      <td colspan="2" style="text-align: left;"><b><?php echo rupiah($total); ?></b></td>
    </tr>
  </tfoot>
</table>
<script type="text/javascript">
$(document).ready(function() 
{
    $('#data_pakai_hd').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );
</script>