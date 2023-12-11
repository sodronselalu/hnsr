<table class="table table-striped table-bordered" id="tb_layanan">
  <thead>
  <tr>
    <th>Pilih</th>
    <th>Awal</th>
    <th>Akhir</th>
    <th>Jenis</th>
    <th>Aksi</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_hd))
      {
        if($data_hd->response=='200')
        {
          foreach ($data_hd->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' id='".$dt->URUT_HD."' ondblclick='pilih_hd(this.id)'>";
            echo "<td>";
                echo '<button type="button" class="btn btn-round btn-primary" title="Obat dan BHP data ini?" value="'.$dt->URUT_HD.'" onclick="detail_hd(this.value)">Obat & BHP <i class="fa fa-medkit"></i></button>';
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_HD_AWAL_F;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_HD_AKHIR_F;
              echo "</td>";
              echo "<td>";
                echo iol($dt->IOL);
              echo "</td>";    
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-success" title="Edit data ini?" value="'.$dt->URUT_HD.'" onclick="pilih_hd(this.value)"><i class="fa fa-check-square-o"></i></button>';
                echo '<button type="button" class="btn btn-round btn-danger" title="Hapus data ini?" value="'.$dt->URUT_HD.'" onclick="hapus_hd(this.value)"><i class="fa fa-trash"></i></button>';
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
    $('#tb_layanan').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv', 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );

</script>