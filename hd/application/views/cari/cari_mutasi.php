<table id="tb_cari_mutasi" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Kode</th>
      <th>No</th>
      <th>Tgl</th>
      <th>Gudang Asal</th>
      <th>Gudang Tujuan</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_mutasi))
      {
        if($data_mutasi->response=='200')
        {
          foreach ($data_mutasi->data as $dt) {
            
            $kode+=1;
            echo "<tr style='cursor:pointer;' id='".$dt->KD_MUTASI."' ondblclick='pilih_mutasi(this.id)'>";
              echo "<td>";
                echo $dt->KD_MUTASI;
              echo "</td>";
              echo "<td>";
                echo $dt->NO_MUTASI;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_MUTASI;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_GUDANG_ASAL;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_GUDANG_TUJUAN;
              echo "</td>";
              echo "<td>";
                echo status_mutasi($dt->STATUS_MUTASI);
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-success" title="Pilih mutasi ini?" value="'.$dt->KD_MUTASI.'" onclick="pilih_mutasi(this.value)"><i class="fa fa-check-square-o"></i></button>';
                echo '<button type="button" class="btn btn-round btn-warning" title="Rincian mutasi?" value="'.$dt->KD_MUTASI.'" onclick="rincian_mutasi(this.value)"><i class="fa fa-search"></i></button>';
              echo "</td>";
            echo "</tr>";
           
          }
        }
      }
    ?>
  </tbody>
</table>
<br>
<div id="detail_mutasi">
  
</div>
<script type="text/javascript">
$(document).ready(function() 
{
    $('#tb_cari_mutasi').DataTable( {
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
         buttons: [
                     /*'copy', 'csv',*/ 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
});

function rincian_mutasi(kode)
{
    $.ajax({
      url : "<?php echo base_url('index.php/gudang/mutasi/rincian_mutasi'); ?>",
      type : "post",
      data : {
        KD_MUTASI : kode
      },
      success:function(resp)
      {
        $('#detail_mutasi').html(resp);
      }
    });
}

function tutup_detail()
{
  $('#detail_beli').html('');
}
</script>