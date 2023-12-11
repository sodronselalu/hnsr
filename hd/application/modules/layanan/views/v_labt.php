<table class="table table-striped table-bordered" id="tb_layanan_lab">
  <thead>
  <tr>
    <th>Kode</th>
    <th>Tgl</th>
    <th>Status</th>
    <th>Periksa</th>
    <th>Catatan</th>
    <th>Hasil</th>
  </tr>
  </thead>              
  <tbody>
    <?php

      if(!is_null($data_daftar_lab))
      {
        if($data_daftar_lab->response=='200')
        {
          $no=0;
          $tmp="";
          $periksa="";
          foreach ($data_daftar_lab->data as $dt) {
     

                echo "<tr style='cursor:pointer;' ondblclick='blok();'>";
                  echo "<td>";
                   if($tmp!=$dt->KD_JUAL)
                   {
                     $no=0;
                     echo $dt->KD_JUAL;
                   }
                  echo "</td>";
                  echo "<td>";
                   if($tmp!=$dt->KD_JUAL)
                   {
                     echo $dt->TGL_JUAL;
                   }
                  echo "</td>";
                  echo "<td>";
                   if($tmp!=$dt->KD_JUAL)
                   {
                      //- : PERMINTAAN 0 : PROSES DAFTAR; 1 : AMBIL SAMPEL; 9 : HASIL SELESAI
                      switch ($dt->STATUS_PERIKSA) {
                        case '-':
                          echo "Permintaan Lab";
                          break;
                        case '0':
                          echo "Terdaftar";
                          break;
                        case '1':
                          echo "Pengambilan Sampel";
                          break;
                        case '9':
                          echo "Selesai";
                          break;
                        }
                    }
                  echo "</td>"; 
                  echo "<td>";
                    $no+=1;
                    echo $no.". ".$dt->NM_TARIF_LAB;
                  echo "</td>";
                  echo "<td>";
                    echo $dt->KETERANGAN;
                  echo "</td>";
                  echo "<td>";
                  if($tmp!=$dt->KD_JUAL)
                  {
                      
                      if($dt->STATUS_PERIKSA=='9')
                      {
                        echo '<button type="button" class="btn btn-round btn-success" title="Pilih data ini?" value="'.$dt->KD_JUAL.'" onclick="lihat_hasil_lab(this.value)"><i class="fa fa-file-archive-o"></i></button>';
                        echo "<div id='data_hasil".$dt->KD_JUAL."'></div>";
                      }
                      else if($dt->STATUS_PERIKSA=='-')
                      {
                        
                      }
                      else
                      {
                        echo "<i>Menunggu hasil</i>";
                      }
                      
                    $tmp=$dt->KD_JUAL;
                  }     
                  if($dt->STATUS_PERIKSA=='-')
                      {
                        echo '<button type="button" class="btn btn-round btn-danger" title=Hapus data ini?" jual="'.$dt->KD_JUAL.'" periksa="'.$dt->KD_PERIKSA.'" kelas="'.$dt->KD_KELAS.'" onclick="hapus_periksa_lab(this)"><i class="fa fa-trash"></i></button>';
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
    $('#tb_layanan_lab').DataTable( {
        dom: 'Bfrtip',
        bSort: false,
         buttons: [
                     /*'copy', 'csv', 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );


function blok(){
  $('table#tb_layanan_lab tbody tr').on('click', function () {
      $(this).closest('table').find('td').removeClass('btn-info');
      $(this).find('td').addClass('btn-info');
  });
}

function lihat_hasil_lab(jual)
{
  tunggu_start();
  $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/lihat_hasil_lab'); ?>",
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
                          htm+="<button type='button' class='btn btn-xs btn-primary' jual='"+resp.data[i].KD_JUAL+"' hasil='"+resp.data[i].KD_HASIL+"' onclick='cetak(this)'>"+resp.data[i].KD_HASIL+"</button>";

                      });

                  $('#data_hasil'+jual).html(htm);
            }
            
          }
      });    
}

function cetak(cmp)
{
   var kode=$(cmp).attr('jual');
   var hasil=$(cmp).attr('hasil');
   var url="<?php echo base_url('index.php/layanan/pelayanan_hd/cetak_hasil_lab') ?>/"+kode+'/'+hasil;
   $('#iframe_lab').attr('src',url);
    
    $('#hasil_lab').modal({
        show: 'true'
    });
    

}
</script>