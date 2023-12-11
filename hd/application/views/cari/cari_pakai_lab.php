<table class="table table-striped table-bordered" id="tb_pakai_lab">
  <thead>
  <tr>
    <th>No</th>
    <th>Kode</th>
    <th>Nomor</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Keterangan</th>
    <th>Tagih</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_pakai_laborat))
      {
        if($data_pakai_laborat->response=='200')
        {
          foreach ($data_pakai_laborat->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' ondblclick='blok();'>";
              echo "<td>";
                echo $kode;
              echo "</td>";
              echo "<td>";
                echo $dt->KD_JUAL;
              echo "</td>";
              echo "<td>";
                echo $dt->NO_JUAL;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_JUAL;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TOTAL);
              echo "</td>";
              echo "<td>";
                echo $dt->KETERANGAN;
              echo "</td>";
              echo "<td>";
              /*
                if($dt->IS_TAGIH=='F')
                {
                  echo '<button type="button" class="btn btn-round btn-primary" title="Pilih data ini?" value="'.$dt->KD_JUAL.'" onclick="tagih_lab(this.value)">Tagih</button>';
                }
                else
                {
                  echo '<button type="button" class="btn btn-round btn-warning" title="Pilih data ini?" value="'.$dt->KD_JUAL.'" onclick="batal_tagih_lab(this.value)">Batal</button>';
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
    $('#tb_pakai_lab').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv', 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );


function blok(){
  $('table#tb_pakai_lab tbody tr').on('click', function () {
      $(this).closest('table').find('td').removeClass('btn-info');
      $(this).find('td').addClass('btn-info');
  });
}
</script>