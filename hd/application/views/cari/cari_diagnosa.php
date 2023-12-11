<table id="tb_diagnosa" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>ICD 10</th>
      <th>Uraian</th>
      <th>Dokter</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(!is_null($data_diagnosa))
      {
        if($data_diagnosa->response=='200')
        {
          foreach ($data_diagnosa->data as $dt) {
            echo "<tr style='cursor:pointer;' id='".$dt->NO_URUT_DIAGNOSA."'>";
              echo "<td>";
                echo $dt->KD_PENYAKIT;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_PENYAKIT;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_DOKTER;
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-danger" title="Hapus data ini?" value="'.$dt->NO_URUT_DIAGNOSA.'" onclick="hapus_diagnosa(this.value)"><i class="fa fa-trash"></i></button>';
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
    $('#tb_diagnosa').DataTable( {
        dom: 'Bfrtip',
        searching : false,
        buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );

</script>