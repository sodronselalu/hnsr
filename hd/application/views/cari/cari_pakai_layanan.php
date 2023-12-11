<table class="table table-striped table-bordered" id="tb_pakai_layanan">
  <thead>
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Tanggal</th>
    <th>Pelaksana</th>
    <th>Tarif</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Aksi</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $total=0;
     $kode=0;
      if(!is_null($data_pakai_layanan))
      {
        if($data_pakai_layanan->response=='200')
        {
          foreach ($data_pakai_layanan->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' ondblclick='blok();'>";
              echo "<td>";
                echo $kode;
              echo "</td>";
              echo "<td>";
                echo "<b>".$dt->NM_LAYANAN."</b>";
                echo "<BR><small>Pelaksana: ".$dt->NM_PELAKSANA."</small>";
                echo "<BR><small>Unit: ".$dt->NM_UNIT."</small>";
              echo "</td>";
               echo "<td>";
                echo $dt->TGL_LAYANAN_F;
              echo "</td>";
               echo "<td>";
                echo $dt->NM_PELAKSANA;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TARIF);
              echo "</td>";
              echo "<td>";
                echo $dt->QTY;
              echo "</td>";
              echo "<td>";
                $total+=$dt->TOTAL;
                echo rupiah($dt->TOTAL);
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-success" title="Pilih data ini?" value="'.$dt->NO_URUT_LAYANAN.'" onclick="edit_layanan(this.value)"><i class="fa fa-check-square-o"></i></button>';
                echo '<button type="button" class="btn btn-round btn-danger" title="Pilih data ini?" value="'.$dt->NO_URUT_LAYANAN.'" onclick="hapus_layanan(this.value)"><i class="fa fa-trash"></i></button>';
              echo "</td>";
            echo "</tr>";
          }
        }
      }
    ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="4" style="text-align: right;">Total</td>
      <td colspan="4" style="text-align: left;">
        <b><?php echo rupiah($total); ?></b>
      </td>
    </tr>
  </tfoot>
</table>

<script type="text/javascript">
$(document).ready(function() 
{
    $('#tb_pakai_layanan').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv', 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );


function blok(){
  $('table#tb_pakai_layanan tbody tr').on('click', function () {
      $(this).closest('table').find('td').removeClass('btn-info');
      $(this).find('td').addClass('btn-info');
  });
}
</script>