<table class="table table-striped table-bordered" id="tb_layanan_ro">
  <thead>
  <tr>
    <th>Kode</th>
    <th>Tanggal</th>
    <th>Pemeriksaan</th>
    <th>Status</th>
    <th>Aksi</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_plan_ro))
      {
        if($data_plan_ro->response=='200')
        {
          foreach ($data_plan_ro->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' ondblclick='blok();'>";
              echo "<td>";
                echo $dt->KD_JUAL;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_JUAL;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_RAD;
              echo "</td>"; 
              echo "<td>";
                 //- : PERMINTAAN 0 : PROSES DAFTAR; 1 : PEMERIKSAAN; 9 : HASIL SELESAI
                switch ($dt->STATUS_PERIKSA) {
                  case '-':
                    echo "Permintaan";
                    break;
                  case '0':
                    echo "Terdaftar";
                    break;
                  case '1':
                    echo "Pemeriksaan";
                    break;
                  case '9':
                    echo "Selesai";
                    break;
                }
              echo "</td>"; 
              echo "<td>";
              if($dt->STATUS_PERIKSA=='-')
              {
                echo '<button type="button" class="btn btn-round btn-danger" title=Hapus data ini?" jual="'.$dt->KD_JUAL.'" rad="'.$dt->KD_RAD.'" kelas="'.$dt->KD_KELAS.'" onclick="hapus_periksa_rad(this)"><i class="fa fa-trash"></i></button>';
              }
              else if($dt->STATUS_PERIKSA=='9')
              {
                echo '<button type="button" class="btn btn-round btn-success" title="Pilih data ini?" value="'.$dt->KD_JUAL.'" onclick="lihat_hasil_rad(this.value)"><i class="fa fa-file-archive-o"></i></button>';
                echo "<div id='data_hasil_ro".$dt->KD_JUAL."'></div>";
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
    $('#tb_layanan_ro').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv', 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );


function blok(){
  $('table#tb_layanan_ro tbody tr').on('click', function () {
      $(this).closest('table').find('td').removeClass('btn-info');
      $(this).find('td').addClass('btn-info');
  });
}

function lihat_hasil_rad(jual)
{
   tunggu_start();
  $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/lihat_hasil_ro'); ?>",
          type : "post",
          dataType : "json",
          data : {
                  KD_JUAL : jual
                },
          success:function(resp)
          {
             tunggu_end();
            if(resp.response=='200')
            {
                var htm="";
                      $.each (resp.data, function (i) 
                      {
                          htm+="<button type='button' class='btn btn-xs btn-primary' jual='"+resp.data[i].KD_JUAL+"' rad='"+resp.data[i].KD_RAD+"' kelas='"+resp.data[i].KD_KELAS+"' onclick='cetak_ro(this)'><span class='fa fa-print'></span></button>";

                      });

                  $('#data_hasil_ro'+jual).html(htm);
            }
          }
      });    
}

function cetak_ro(cmp)
{
   var kode=$(cmp).attr('jual');
   var rad=$(cmp).attr('rad');
   var kelas=$(cmp).attr('kelas');
   var url="<?php echo base_url('index.php/layanan/pelayanan_hd/cetak_hasil_ro') ?>/"+kode+'/'+rad+'/'+kelas;
   $('#iframe_ro').attr('src',url);
    
    $('#hasil_ro').modal({
        show: 'true'
    });
}
</script>