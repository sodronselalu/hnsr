<?php 
$total=0;
?>
<table class="table table-striped table-bordered" id="tb_group_detail_tagihan">
  <thead>
  <tr>
    <th>Tagihan</th>
    <th>Total</th>
    <th>Detail</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $kode=0;
      if(!is_null($group_tagih))
      {
        if($group_tagih->response=='200')
        {
          foreach ($group_tagih->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' ondblclick='blok();'>";
              echo "<td>";
                echo $dt->NM_JENIS_LAYANAN;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TOTAL);
                $total+=$dt->TOTAL;
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-info" reg="'.$dt->NO_REG.'" jenis="'.$dt->KD_JENIS_LAYANAN.'" sub="'.$dt->KD_SUB_GROUP_TAGIHAN.'" grup="'.$dt->KD_GROUP_TAGIHAN.'" title="Informasi data ini?" onclick="lihat_detail_tagihan(this)"><i class="fa fa-search"></i></button>';
              echo "</td>";
            echo "</tr>";
          }
        }
      }
    ?>
  </tbody>
</table>
<table class="table">
  <thead>
    <tr>
      <th>
        Total 
      </th>
      <th>:</th>
      <th>
       <?php echo rupiah($total); ?>
      </th>
    </tr>
  </thead>
</table>
<script type="text/javascript">
$(document).ready(function() 
{
    $('#tb_group_detail_tagihan').DataTable( {
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