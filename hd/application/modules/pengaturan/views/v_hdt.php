<table id="tb_hd" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Kode</th>
      <th>Nama</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(!is_null($data_hd))
      {
        if($data_hd->response=='200')
        {
          foreach ($data_hd->data as $dt) {
            echo "<tr style='cursor:pointer;' id='".$dt->KD_HD."' ondblclick='edit(this.id)'>";
              echo "<td>";
                echo $dt->KD_HD;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_HD;
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-info" title="Edit data ini?" value="'.$dt->KD_HD.'" onclick="edit(this.value)"><i class="fa fa-edit"></i></button>';
                echo '<button type="button" class="btn btn-round btn-danger" title="Hapus data ini?"  value="'.$dt->KD_HD.'" onclick="hapus(this.value)"><i class="fa fa-trash"></i></button>';
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
    $('#tb_hd').DataTable( {
        dom: 'Bfrtip', 
        buttons: [
            /*'copy', 'csv',*/ 'excel', 'pdf'/*, 'print'*/
        ]
    } );
} );
</script>