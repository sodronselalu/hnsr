<table id="tb_dokter_op" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>NIK</th>
      <th>Nama</th>
      <th>Profesi</th>
      <th>Spesialis</th>
      <th>Pilih</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(!is_null($data_dokter))
      {
        if($data_dokter->response=='200')
        {
          foreach ($data_dokter->data as $dt) {
            echo "<tr style='cursor:pointer;' id='".$dt->NIK."' ondblclick='pilih_dokter_op(this.id)'>";
              echo "<td>";
                echo $dt->NIK;
              echo "</td>";
              echo "<td>";
                echo $dt->NAMA;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_PROFESI;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_SPESIALIS;
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-success" title="Pilih dokter ini?" value="'.$dt->NIK.'" onclick="pilih_dokter_op(this.value)"><i class="fa fa-check-square-o"></i></button>';
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
    $('#tb_dokter_op').DataTable( {
        dom: 'Bfrtip',
        buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );

</script>