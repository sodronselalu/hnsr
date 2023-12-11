<table class="table table-striped table-bordered" id="tb_pakai_kamar">
  <thead>
  <tr>
    <th>No</th>
    <th>Ruang</th>
    <th>Kelas</th>
    <th>Tarif</th>
    <th>Hari</th>
    <th>Total</th>
    <th>Tagih</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_pakai_kamar))
      {
        if($data_pakai_kamar->response=='200')
        {
          foreach ($data_pakai_kamar->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' ondblclick='blok();'>";
              echo "<td>";
                echo $kode;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_RUANG;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_KELAS;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TARIF);
              echo "</td>";
              echo "<td>";
                echo $dt->JUMLAH;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TOTAL);
              echo "</td>";
              echo "<td>";
              /*
                if($dt->IS_TAGIH=='F')
                {
                  echo '<button type="button" class="btn btn-round btn-primary" title="Pilih data ini?" value="'.$dt->NO_URUT_INAP.'" onclick="tagih_kamar(this.value)">Tagih</button>';
                }
                else
                {
                  echo '<button type="button" class="btn btn-round btn-warning" title="Pilih data ini?" value="'.$dt->NO_URUT_INAP.'" onclick="batal_tagih_kamar(this.value)">Batal</button>';
                }*/
                echo is_tagih($dt->IS_TAGIH);
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
    $('#tb_pakai_kamar').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv', 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );


function blok(){
  $('table#tb_pakai_kamar tbody tr').on('click', function () {
      $(this).closest('table').find('td').removeClass('btn-info');
      $(this).find('td').addClass('btn-info');
  });
}
</script>