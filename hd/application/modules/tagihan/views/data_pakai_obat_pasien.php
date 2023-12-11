<table id="data_pakai_obat" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Harga</th>
      <th>Qty</th>
      <th>Total</th>
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
            echo "</tr>";
           
          }
        }
      }
    ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3" style="text-align: right;">Total</td>
      <td colspan="1" style="text-align: left;"><b><?php echo rupiah($total); ?></b></td>
    </tr>
  </tfoot>
</table>
<script type="text/javascript">
$(document).ready(function() 
{
    $('#data_pakai_obat').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );
</script>