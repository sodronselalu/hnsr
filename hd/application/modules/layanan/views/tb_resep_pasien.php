<table id="tb_resep_pasien" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Nomor</th>
      <th>Dokter</th>
      <th>Tanggal</th>
      <th>Jenis</th>
      <th>Status</th>
      <th>Pilih</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $color="";
      if(!is_null($data_resep))
      {
        if($data_resep->response=='200')
        {
          foreach ($data_resep->data as $dt) {
            
            switch ($dt->STATUS_LAYANAN_RESEP) 
            {
              case '-1':
               $color=" ";
                break;
              case '0':
               $color=" background-color:#f9f5a1; ";
                break;
              default:
                $color=" background-color:#ccf9a1; ";
              break;

            }
            echo "<tr style='cursor:pointer;' id='".$dt->INDEX_RESEP."' ondbclick='lihat_resep(this.id)'>";
              echo "<td>";
                echo $dt->INDEX_RESEP;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_DOKTER_PERESEP;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_RESEP_F;
              echo "</td>";
              echo "<td>";
                if($dt->IS_RACIK=='T')
                {
                  echo "Racikan";
                }
                else
                {
                  echo "Non Racikan";
                }
              echo "</td>";
              echo "<td>";
                switch ($dt->STATUS_LAYANAN_RESEP) {
                  case '-1':
                    echo "<b>Resep belum direspon</b>";
                    break;
                  case '0':
                    echo "<b class='blue'>Resep dalam proses</b>";
                    break;
                  case '1':
                    echo "<b class='green'>Resep selesai</b>";
                    break;
                  case '2':
                    echo "<b class='red'>Resep telah diserahkan</b>";
                    break;
                  case '3':
                    echo "<b class='red'>Resep sudah ditagih</b>";
                    break;
                  case '9':
                    echo "<b class='red'>Resep lunas</b>";
                    break;
                }
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-primary" title="Lihat permintaan ini?" value="'.$dt->INDEX_RESEP.'" onclick="lihat_resep(this.value);"><i class="fa fa-check"></i></button>';
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
    $('#tb_resep_pasien').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );
</script>