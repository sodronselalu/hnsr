<table id="tb_jenis" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Kode</th>
      <th>RM</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Waktu</th>
      <th>Ranap</th>
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
            echo "<tr style='cursor:pointer;' id='".$dt->URUT_HD."' ondblclick='edit(this.id)'>";
              echo "<td>";
                echo $dt->URUT_HD;
              echo "</td>";
              echo "<td>";
                echo $dt->NO_CM;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_PASIEN;
              echo "</td>";
              echo "<td>";
                echo $dt->ALAMAT;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_HD_AWAL.' - '.$dt->TGL_HD_AKHIR;
              echo "</td>";
              echo "<td>";
                echo iol($dt->IOL);
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-primary" title="Detail data ini?" urut="'.$dt->URUT_HD.'" reg="'.$dt->NO_REG.'" onclick="detail_hd(this)"><i class="fa fa-search"></i></button>';
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
    $('#tb_jenis').DataTable( {
        dom: 'Bfrtip', 
        buttons: [
            /*'copy', 'csv',*/ 'excel', 'pdf'/*, 'print'*/
        ]
    } );
} );
</script>