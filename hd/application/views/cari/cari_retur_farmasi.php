<table class="table table-striped table-bordered" id="tb_retur_farmasi">
  <thead>
  <tr>
    <th>No</th>
    <th>Kode</th>
    <th>Nomor</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Keterangan</th>
    <th>Tagih</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_retur_farmasi))
      {
        if($data_retur_farmasi->response=='200')
        {
          foreach ($data_retur_farmasi->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' ondblclick='blok();'>";
              echo "<td>";
                echo $kode;
              echo "</td>";
              echo "<td>";
                echo $dt->KD_RETUR;
              echo "</td>";
              echo "<td>";
                echo $dt->NO_RETUR;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_RETUR;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TOTAL);
              echo "</td>";
              echo "<td>";
                echo $dt->KETERANGAN;
              echo "</td>";
              echo "<td>";
                echo is_tagih($dt->IS_TAGIH);
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
    $('#tb_retur_farmasi').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv', 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );


function blok(){
  $('table#tb_retur_farmasi tbody tr').on('click', function () {
      $(this).closest('table').find('td').removeClass('btn-info');
      $(this).find('td').addClass('btn-info');
  });
}
</script>