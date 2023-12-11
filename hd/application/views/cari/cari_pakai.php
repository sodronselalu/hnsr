<table id="tb_cari_pakai" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Kode</th>
      <th>No</th>
      <th>Tgl</th>
      <th>Nilai</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_pakai))
      {
        if($data_pakai->response=='200')
        {
          foreach ($data_pakai->data as $dt) {
            
            $kode+=1;
            echo "<tr style='cursor:pointer;' id='".$dt->KD_PAKAI."' ondblclick='pilih_pakai(this.id)'>";
              echo "<td>";
                echo $dt->KD_PAKAI;
              echo "</td>";
              echo "<td>";
                echo $dt->NO_PAKAI;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_PAKAI;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TOTAL);
              echo "</td>";
              echo "<td>";
                echo status_pakai($dt->STATUS);
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-success" title="Pilih data ini?" value="'.$dt->KD_PAKAI.'" onclick="pilih_pakai(this.value)"><i class="fa fa-check-square-o"></i></button>';
                echo '<button type="button" class="btn btn-round btn-warning" title="Rincian musnah?" value="'.$dt->KD_PAKAI.'" onclick="rincian_pakai(this.value)"><i class="fa fa-search"></i></button>';
              echo "</td>";
            echo "</tr>";
           
          }
        }
      }
    ?>
  </tbody>
</table>
<br>
<div id="detail_pakai">
  
</div>
<script type="text/javascript">
$(document).ready(function() 
{
    $('#tb_cari_pakai').DataTable( {
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
         buttons: [
                     /*'copy', 'csv',*/ 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
});

function rincian_pakai(kode)
{
    $.ajax({
      url : "<?php echo base_url('index.php/gudang/pakai_bahan/rincian_pakai'); ?>",
      type : "post",
      data : {
        KD_PAKAI : kode
      },
      success:function(resp)
      {
        $('#detail_pakai').html(resp);
      }
    });
}

function tutup_detail()
{
  $('#detail_pakai').html('');
}
</script>