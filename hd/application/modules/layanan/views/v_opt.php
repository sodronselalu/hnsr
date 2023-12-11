<table class="table table-striped table-hovered table-bordered" id="tb_op">
  <thead>
  <tr>
    <th>Tgl Daftar</th>
    <th>Tgl Jadwal</th>
    <th>Dokter OP</th>
    <th>Asal / Kelas</th>
    <th>Tindakan</th>
    <th>Status</th>
    <th>Ket.</th>
    <th>Aksi</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_plan_op))
      {
        if($data_plan_op->response=='200')
        {
          foreach ($data_plan_op->data as $dt) {
            $kode+=1;
            $style="";
            switch ($dt->STATUS_OP) {
                  case '0':
                    $style=" background-color:#fff;";
                    break;
                  case '1':
                    $style=" background-color:#74d183; color:#fff;";
                    break;
                  case '2':
                    $style=" background-color:#74d183; color:#fff;";
                    break;
                  case '3':
                    $style=" background-color:#74d183; color:#red;";
                    break;
                  default:
                    $style=" background-color:red; color:#fff;";
                    break;
                }

            echo "<tr style='cursor:pointer; $style' ondblclick='blok();' id='".$dt->NO_REG_OP."'>";
              echo "<td>";
                echo $dt->TGL_DAFTAR_F;
              echo "</td>";
              echo "<td>";
                if($dt->STATUS_OP!='0')
                {
                  echo $dt->TGL_JADWAL_F;
                }
                else
                {
                  echo "Belum Dijadwalkan.";
                }
              echo "</td>";
              echo "<td>";
                echo $dt->NM_DOKTER_OPERATOR;
              echo "</td>";  
              echo "<td>";
                echo $dt->NM_UNIT.', '.$dt->NM_KELAS;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_OP;
              echo "</td>";
              echo "<td>";
                switch ($dt->STATUS_OP) {
                  case '0':
                    echo "Rencana";
                    break;
                  case '1':
                    echo "Jadwal FIX";
                    break;
                  case '2':
                    echo "Selesai";
                    break;
                  case '3':
                    echo "Batal";
                    break;
                  default:
                    echo "Unknown";
                    break;
                }
              echo "</td>";
              echo "<td>";
                echo $dt->KETERANGAN;
              echo "</td>";
              echo "<td>";
              if($dt->STATUS_OP=='0')
              {
                 echo '<button type="button" class="btn btn-round btn-success" value="'.$dt->NO_REG_OP.'" title="Pilih data ini?" onclick="pilih_op(this.value)"><i class="fa fa-check-square-o"></i></button>';
                echo '<button type="button" class="btn btn-round btn-danger" title="Hapus data ini?" value="'.$dt->NO_REG_OP.'" onclick="hapus_op(this.value)"><i class="fa fa-trash"></i></button>';
              }
              else
              {
                echo "<div class='red'><b>Data tidak dapat diedit!</b></div>";
              }
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
    $('#tb_op').DataTable( {
        dom: 'Bfrtip',
        buttons: [
                     /*'copy', 'csv',*/ 'excel', 'pdf' /*, 'print'*/
                 ],
        order: [[ 0, "desc" ]]
    } );
} );


function blok(){
  $('table#tb_op tbody tr').on('click', function () {
      $(this).closest('table').find('td').removeClass('btn-info');
      $(this).find('td').addClass('btn-info');
  });
}
</script>