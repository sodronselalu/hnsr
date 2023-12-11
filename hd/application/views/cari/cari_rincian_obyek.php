<table id="tb_rekening" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Kode</th>
      <th>Nama</th>
      <th>Pilih</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(!is_null($data_rekening))
      {
        if($data_rekening->response=='200')
        {
          foreach ($data_rekening->data as $dt) {
            echo "<tr style='cursor:pointer;' id='".$dt->KD_REKENING."' ondblclick='pilih_rekening(this.id)'>";
              echo "<td>";
                echo $dt->KD_REKENING;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_RINCIAN_OBYEK;
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-success" title="Pilih data ini?" value="'.$dt->KD_REKENING.'" onclick="pilih_rekening(this.value)"><i class="fa fa-check-square-o"></i></button>';
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
    $('#tb_rekening').DataTable( {
        dom: 'Bfrtip',
        buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );

</script>