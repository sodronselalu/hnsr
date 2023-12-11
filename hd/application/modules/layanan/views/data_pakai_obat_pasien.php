<table class="table table-striped table-bordered" id="tb_pakai_layanan">
  <thead>
  <tr>
    <th>Layanan Pasien</th>
    <th>Tanggal</th>
    <th>Pelaksana</th>
    <th>Tarif</th>
    <th>Pakai</th>
    <th>Total</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $total=0;
     $kode=0;
      if(!is_null($data_pakai_layanan))
      {
        if($data_pakai_layanan->response=='200')
        {
          foreach ($data_pakai_layanan->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' ondblclick='blok();'>";
              echo "<td>";
                echo $dt->NM_LAYANAN;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_LAYANAN;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_PELAKSANA;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TARIF);
              echo "</td>";
              echo "<td>";
                echo $dt->QTY;
              echo "</td>";
              echo "<td>";
                $total+=$dt->TOTAL;
                echo rupiah($dt->TOTAL);
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
    $('#tb_pakai_layanan').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv', 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );


function blok(){
  $('table#tb_pakai_layanan tbody tr').on('click', function () {
      $(this).closest('table').find('td').removeClass('btn-info');
      $(this).find('td').addClass('btn-info');
  });
}
</script>
<br>
<table id="data_pakai_obat" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Nama Obat / BHP</th>
      <th>Harga</th>
      <th>Qty</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $total=0;
      if(!is_null($detail_pakai))
      {
        if($detail_pakai->response=='200')
        {
          foreach ($detail_pakai->data as $dt) {

            echo "<tr style='cursor:pointer;'>";
              echo "<td>";
                echo $dt->NAMA_OBAT;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->HARGA_JUAL);
              echo "</td>";
              echo "<td>";
                echo $dt->QTY_PAKAI.' '.$dt->NM_SATUAN_VOLUME;
              echo "</td>";
              echo "<td>";
              $total+=$dt->TOTAL_PAKAI;
                echo rupiah($dt->TOTAL_PAKAI);
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
    $('#data_pakai_obat').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );
</script>