<table id="tb_tindakan" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>ICD 9</th>
      <th>Uraian</th>
      <th>Dokter</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(!is_null($data_tindakan))
      {
        if($data_tindakan->response=='200')
        {
          foreach ($data_tindakan->data as $dt) {
            echo "<tr style='cursor:pointer;' id='".$dt->NO_URUT_TINDAKAN."'>";
              echo "<td>";
                echo $dt->KD_TINDAKAN;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_TINDAKAN;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_DOKTER;
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-danger" title="Hapus data ini?" value="'.$dt->NO_URUT_TINDAKAN.'" onclick="hapus_tindakan(this.value)"><i class="fa fa-trash"></i></button>';
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
    $('#tb_tindakan').DataTable( {
        dom: 'Bfrtip',
        searching: false,
        buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );

</script>