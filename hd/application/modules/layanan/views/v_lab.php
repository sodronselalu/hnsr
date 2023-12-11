<?php 
if($data_pasien->response=='200')
{
  $dt=$data_pasien->data;
  $nik_dpjp="";
  $nm_dpjp="";
  if(!is_null($dpjp_pasien))
  {
    if($dpjp_pasien->response=='200')
    {
      $nik_dpjp=$dpjp_pasien->data->NIK;
      $nm_dpjp=$dpjp_pasien->data->NAMA;
    }
    else
    {
      $nik_dpjp="0";
      $nm_dpjp="Tidak diisi.";
    }
  }
  else
  {
    $nik_dpjp="0";
    $nm_dpjp="Tidak diisi.";
  }
?>
<form id="frm_lab_pasien">
          <input type="hidden" id="LAB_NIK_DPJP" name="NIK_DPJP" value="<?php echo $nik_dpjp; ?>">
          <input type="hidden" id="LAB_KD_UNIT" name="KD_UNIT" value="<?php echo $dt->KD_UNIT; ?>">
          <input type="hidden" id="LAB_KD_RUANG" name="KD_RUANG" value="<?php echo $dt->KD_RUANG; ?>">
          <input type="hidden" id="LAB_IOL" name="IOL" value="<?php echo $dt->IOL; ?>">
          <input type="hidden" id="LAB_NO_REG" name="NO_REG" value="<?php echo $dt->NO_REG; ?>">
          <input type="hidden" id="LAB_NO_CM" name="NO_CM" value="<?php echo $dt->NO_CM; ?>">
          <input type="hidden" id="LAB_KD_KELAS" name="KD_KELAS" value="<?php echo $dt->KD_KELAS; ?>">

    <div class="form-horizontal form-label-left">
     <div id="tabel_pelayanan_lab">
      <?php $this->load->view("layanan/v_labt"); ?>
      </div>
    </div>
      <div class="row">
        <div class="form-horizontal form-label-left">

          <?php
        
          if(!is_null($data_periksa_lab))
          {
            if($data_periksa_lab->response=='200')
            {
              $URUT=0;
              $tmp="";
              foreach ($data_periksa_lab->data as $dp) 
              {
                $URUT+=1;
                if($URUT=='1')
                {
                  echo "<div class='col-md-4'>";
                  echo '<input type="checkbox" id="LAB_IS_CITO" name="IS_CITO" value="T"> <b class="red">Pasien Cito</b>';
                  echo "<br>";
                }
                elseif ($URUT=='97') 
                {
                  echo "</div>";
                  echo "<div class='col-md-4'>";
                }
                elseif ($URUT=='187') 
                {
                  echo "</div>";
                  echo "<div class='col-md-4'>";
                }

                  echo '<table>';
                    if($tmp!=$dp->NM_JENIS_LAB)
                    {
                      echo "<br>";
                      echo '<tr>';
                        echo '<td><b>'.strtoupper($dp->NM_JENIS_LAB).'</b></td>';
                      echo '</tr>';
                      $tmp=$dp->NM_JENIS_LAB;
                    }
                    echo '<tr>';
                      echo '<td>';
                        echo '<input type="checkbox" onclick="lihat_detail(this)" class="ceklab" id="LAB_KD_PERIKSA'.$dp->KD_PERIKSA.'" name="LAB_KD_PERIKSA[]" value="'.$dp->KD_PERIKSA.'"> '.$dp->NM_PERIKSA;

                        echo '<input type="text" class="form-control input-sm tariflab" name="LAB_KETERANGAN[]" style="display:none;" id="LAB_KETERANGAN'.$dp->KD_PERIKSA.'" value="" disabled placeholder="Keterangan">';

                        echo '<input type="text" class="form-control input-sm tariflab" onkeyup="total_subtotal()" name="LAB_TARIF[]" style="display:none;" oninput="format_rupiah(this)" id="LAB_TARIF'.$dp->KD_PERIKSA.'" value="'.rupiah($dp->TARIF).'" disabled>';
                      echo '</td>';
                    echo '</tr>';
                  echo '</table>';
              }
                echo '</div>';
            }
          }
        ?>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                    <button type="button" class="btn btn-primary" onclick="simpan_lab()">Daftarkan Lab <span class="fa fa-send"></span></button>
                    <button type="button" class="btn btn-warning" onclick="reset_form_lab()">Batal</button>
                  </div>
              </div>
        </div>
    </div>


</form>

  <div class="modal fade" id="hasil_lab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Hasil Pemeriksaan</h4>
            </div>
            <div class="modal-body">
              <iframe width="100%" height="400px" id="iframe_lab"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
            </div>    
        </div>
    </div>
  </div>

<script type="text/javascript">

$('.mydate').datetimepicker({
    format: 'DD/MM/YYYY',
    defaultDate: "now"
  });

$('.mydatetime').datetimepicker({
    format: 'DD/MM/YYYY HH:mm',
    defaultDate: "now"
  });

function lihat_detail(cmp)
{
  var lab=$(cmp).val();
  if($('#LAB_KD_PERIKSA'+lab).is(':checked'))
  {
    $('#LAB_TARIF'+lab).attr('disabled',false);
    $('#LAB_KETERANGAN'+lab).attr('disabled',false);
    $('#LAB_KETERANGAN'+lab).show();
  }
  else
  {
    $('#LAB_KETERANGAN'+lab).val('');
    $('#LAB_TARIF'+lab).attr('disabled',true);
    $('#LAB_KETERANGAN'+lab).attr('disabled',true);
    $('#LAB_KETERANGAN'+lab).hide();
  }

}

function clean_total_lab(){
    var arr = document.getElementsByName('LAB_TARIF[]');
    for(var i=0;i<arr.length;i++)
    {
      if(arr[i].disabled==false)
      {
        arr[i].value=non_rupiah(arr[i].value);
      }
    }
    
}
 

 function reset_form_lab()
 {
   $('#IS_CITO').prop('checked',false);
   $('.ceklab').prop('checked',false);
   $('.tariflab').attr('disabled',true);
   $('.tariflab').hide();
 }

 function simpan_lab()
 {
  if(confirm("Daftarkan pasien ke Laboratorium sekarang?"))
  {
      clean_total_lab();
      tunggu_start();
      $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/simpan_lab'); ?>",
          type : "post",
          data : $('#frm_lab_pasien').serialize(),
          success:function(resp)
          {
            tunggu_end();
            md_info(resp);
            table_daftar_lab();
          }
        });
  }
 }



 function hapus_periksa_lab(cmp)
 {
    var jual=$(cmp).attr('jual');
    var periksa=$(cmp).attr('periksa');
    var kelas=$(cmp).attr('kelas');
    
    tunggu_start();
    $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/hapus_periksa_lab'); ?>",
          type : "post",
          data : {
                  KD_JUAL : jual,
                  KD_PERIKSA : periksa,
                  KD_KELAS : kelas
                },
          success:function(resp)
          {
              tunggu_end();
              md_info(resp);
              table_daftar_lab();
          }
        });

   
 }


function table_daftar_lab()
{
  
  $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/reload_lab'); ?>",
          type : "post",
          data : {
                  NO_REG : $('#LAB_NO_REG').val()
                },
          success:function(resp)
          {
            $('#tabel_pelayanan_lab').html(resp);
          }
      }); 
} 


</script>
<?php } ?>