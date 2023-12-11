<table class="table table-striped table-bordered" id="tb_detail_tagihan">
  <thead>
  <tr>
    <th>Uraian</th>
    <th>Tanggal</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Aksi</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $kode=0;
      if(!is_null($detail_tagih))
      {
        if($detail_tagih->response=='200')
        {
          foreach ($detail_tagih->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' ondblclick='blok();'>";
              echo "<td>";
                echo $dt->NAMA_ITEM;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL;
              echo "</td>";
              echo "<td>";
                echo $dt->QTY;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TOTAL);
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-success" reg="'.$dt->NO_REG.'" jenis="'.$dt->KD_JENIS_LAYANAN.'" sub="'.$dt->KD_SUB_GROUP_TAGIHAN.'" grup="'.$dt->KD_GROUP_TAGIHAN.'" index="'.$dt->NO_INDEX_REF.'" item="'.$dt->KODE_ITEM.'" title="Pilih data ini?" onclick="edit_detail_tagihan(this)"><i class="fa fa-check-square-o"></i></button>';
                echo '<button type="button" class="btn btn-round btn-danger" title="Pilih data ini?" reg="'.$dt->NO_REG.'" jenis="'.$dt->KD_JENIS_LAYANAN.'" sub="'.$dt->KD_SUB_GROUP_TAGIHAN.'" grup="'.$dt->KD_GROUP_TAGIHAN.'" index="'.$dt->NO_INDEX_REF.'" item="'.$dt->KODE_ITEM.'" onclick="hapus_detail_tagihan(this)"><i class="fa fa-trash"></i></button>';
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
    $('#tb_detail_tagihan').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv', 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );


function blok(){
  $('table#tb_detail_tagihan tbody tr').on('click', function () {
      $(this).closest('table').find('td').removeClass('btn-info');
      $(this).find('td').addClass('btn-info');
  });
}
</script>