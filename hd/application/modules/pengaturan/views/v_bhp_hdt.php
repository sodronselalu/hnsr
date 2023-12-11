<table id="tb_bhp_hd" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Tindakan HD</th>
      <th>Bhp/ Obat</th>
      <th>Harga</th>
      <th>Jumlah</th>
      <th>Total</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(!is_null($data_bhp_hd))
      {
        if($data_bhp_hd->response=='200')
        {
          foreach ($data_bhp_hd->data as $dt) {
            echo "<tr style='cursor:pointer;' hd='".$dt->KD_HD."' obat='".$dt->KD_OBAT."' ondblclick='edit(this)'>";
              echo "<td>";
                echo $dt->NM_HD;
              echo "</td>";
              echo "<td>";
                echo $dt->NAMA_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->HARGA_JUAL;
              echo "</td>";
              echo "<td>";
                echo $dt->JUMLAH.' '.$dt->NM_SATUAN;
              echo "</td>";
              echo "<td>";
                echo $dt->HARGA_JUAL*$dt->JUMLAH;
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-info" title="Edit data ini?" hd="'.$dt->KD_HD.'" obat="'.$dt->KD_OBAT.'" onclick="edit(this)"><i class="fa fa-edit"></i></button>';
                echo '<button type="button" class="btn btn-round btn-danger" title="Hapus data ini?" hd="'.$dt->KD_HD.'" obat="'.$dt->KD_OBAT.'" onclick="hapus(this)"><i class="fa fa-trash"></i></button>';
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
    $('#tb_bhp_hd').DataTable( {
        dom: 'Bfrtip', 
        buttons: [
            /*'copy', 'csv',*/ 'excel', 'pdf'/*, 'print'*/
        ]
    } );
} );
</script>