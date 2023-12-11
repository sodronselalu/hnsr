<table class="table table-striped table-bordered" id="tb_pakai_farmasi">
  <thead>
  <tr>
    <th>Kode</th>
    <th>Tanggal</th>
    <th>Kd. Obat</th>
    <th>Nama</th>
    <th>Hrg. Jual</th>
    <th>Qty</th>
    <th>Emb</th>
    <th>Tuslah</th>
    <th>Total</th>
    <th>Tagih</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_pakai_farmasi))
      {
        if($data_pakai_farmasi->response=='200')
        {
          foreach ($data_pakai_farmasi->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' ondblclick='blok();'>";
              echo "<td>";
                echo $dt->KD_JUAL;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_JUAL;
              echo "</td>";
              echo "<td>";
                echo $dt->KD_OBAT;
              echo "</td>";
              echo "<td>";
               if($dt->IS_RACIK=='T')
               {
                 echo '<b>R/ </b>'.$dt->NAMA_OBAT;
               }
               else
               {
                 echo $dt->NAMA_OBAT;
               }
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->HARGA_JUAL);
              echo "</td>";
              echo "<td>";
                echo $dt->QTY_JUAL.' '.$dt->NM_SATUAN_VOLUME;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->EMBALASE);
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TUSLAH);
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TOTAL);
              echo "</td>";
              echo "<td>";
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
    $('#tb_pakai_farmasi').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv', 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );


function blok(){
  $('table#tb_pakai_farmasi tbody tr').on('click', function () {
      $(this).closest('table').find('td').removeClass('btn-info');
      $(this).find('td').addClass('btn-info');
  });
}
</script>