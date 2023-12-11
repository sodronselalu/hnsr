<table class="table table-striped table-bordered" id="tb_layanan">
  <thead>
  <tr>
    <th>Kode</th>
    <th>Jamin</th>
    <th>Nama</th>
    <th>Tarif</th>
    <th>Aksi</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_layanan))
      {
        if($data_layanan->response=='200')
        {
          foreach ($data_layanan->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' layan='".$dt->KD_LAYANAN."' kelas='".$dt->KD_KELAS."' ondblclick='pilih_layanan(this)'>";
              echo "<td>";
                echo $dt->KD_LAYANAN;
              echo "</td>";
              echo "<td>";
                 if($dt->IS_PENJAMIN=='Y')
                 {
                  echo "<b class='green'>BPJS</b>";
                 }
                 else
                 {
                  echo "<b class='blue'>UMUM</b>";
                 }
              echo "</td>";
              echo "<td>";
                echo $dt->NM_LAYANAN;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TARIF);
              echo "</td>";    
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-success" title="Pilih data ini?" layan="'.$dt->KD_LAYANAN.'" kelas="'.$dt->KD_KELAS.'" onclick="pilih_layanan(this)"><i class="fa fa-check-square-o"></i></button>';
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