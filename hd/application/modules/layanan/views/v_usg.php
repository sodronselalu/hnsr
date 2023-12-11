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
<form id="frm_usg_pasien">

<input type="hidden" id="USG_KD_KELAS" name="KD_KELAS" value="<?php echo $dt->KD_KELAS; ?>">
<input type="hidden" id="USG_KD_UNIT" name="KD_UNIT" value="<?php echo $dt->KD_UNIT; ?>">
<input type="hidden" id="USG_KD_RUANG" name="KD_RUANG" value="<?php echo $dt->KD_RUANG; ?>">
<input type="hidden" id="USG_IOL" name="IOL" value="<?php echo $dt->IOL; ?>">
<input type="hidden" id="USG_INDEX_RESEP" name="INDEX_RESEP" value="0">
<input type="hidden" id="USG_NO_REG" name="NO_REG" value="<?php echo $dt->NO_REG; ?>">
<input type="hidden" id="USG_NO_CM" name="NO_CM" value="<?php echo $dt->NO_CM; ?>">
  <div class="row">
    <div id="kolom_tabel_usg"><?php $this->load->view('layanan/v_usgt'); ?></div>
  </div>
      <div class="row">
        <div class="form-horizontal form-label-left">
           
          <?php


          if(!is_null($data_periksa_usg))
          {
            if($data_periksa_usg->response=='200')
            {
              $tmp="";
              echo '<div class="form-group">';
                echo '<label class="control-label col-md-3 col-sm-3 col-xs-3"> Dokter <span class="required">*</span></label>';
                  echo '<div class="col-md-9 col-sm-9 col-xs-9">';
                    echo '<div class="input-group">';
                      echo '<input type="text" class="form-control" required="required" value="'.$nm_dpjp.'" readonly="readonly" id="USG_NM_DOKTER" name="NM_DOKTER" placeholder="">';
                      echo '<span class="input-group-btn">';
                        echo '<button type="button" class="btn btn-info" onclick="cari_dokter_usg()">Cari</button>';
                      echo '</span>';
                    echo '</div>';
                    echo '<input type="hidden" class="form-control" value="'.$nik_dpjp.'" id="USG_NIK_DOKTER" name="NIK_DOKTER">';
                  echo '</div>';
                echo '</div>';

                  echo '<textarea class="form-control" rows="2" required="required" id="USG_CATATAN" name="CATATAN" placeholder="Catatan Dokter"></textarea>';
                  echo "<br>";
                  echo '<input type="checkbox" id="USG_IS_CITO" name="IS_CITO" value="T"> <b class="red">Pasien Cito</b>';
                  echo "<br>";
              foreach ($data_periksa_usg->data as $dp) 
              {
                  echo '<table>';
                    if($tmp!=$dp->KETERANGAN)
                    {
                      echo "<br>";
                      echo '<tr>';
                        echo '<td><b>'.strtoupper($dp->KETERANGAN).'</b></td>';
                      echo '</tr>';
                      $tmp=$dp->KETERANGAN;
                    }
                    echo '<tr>';
                      echo '<td>';
                        echo '<input type="checkbox" onclick="lihat_detail_usg(this)" class="cekusg" id="USG_KD_RAD'.$dp->KD_RAD.'" name="KD_RAD[]" value="'.$dp->KD_RAD.'"> '.$dp->NM_RAD;
                        echo '<input type="text" class="form-control input-sm tarifusg" onkeyup="total_subtotal()" name="TARIF[]" style="display:none;" oninput="format_rupiah(this)" id="USG_TARIF'.$dp->KD_RAD.'" value="'.rupiah($dp->TARIF).'" disabled>';
                      echo '</td>';
                    echo '</tr>';
                  echo '</table>';
              }
         
            }
          }
        ?>
        </div>
      </div>   
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                    <button type="button" class="btn btn-primary" onclick="simpan_usg()">Daftarkan USG <span class="fa fa-send"></span></button>
                    <button type="button" class="btn btn-warning" onclick="reset_form_usg()">Batal</button>
                  </div>
              </div>

</form>
<!-- PENCARIAN -->
<div class="modal fade" id="hasil_usg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Hasil Pemeriksaan</h4>
            </div>
            <div class="modal-body">
              <iframe width="100%" height="400px" id="iframe_usg"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
            </div>    
        </div>
    </div>
  </div>

<div class="modal fade" id="cari_dokter_usg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Dokter</h4>
            </div>
            <div class="modal-body">
              <?php $this->load->view('cari/cari_dokter_usg'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
  </div>
<!-- -->
<script type="text/javascript">

$('.mydate').datetimepicker({
    format: 'DD/MM/YYYY',
    defaultDate: "now"
  });

$('.mydatetime').datetimepicker({
    format: 'DD/MM/YYYY HH:mm',
    defaultDate: "now"
  });

function lihat_detail_usg(cmp)
{
  var rad=$(cmp).val();
  if($('#USG_KD_RAD'+rad).is(':checked'))
  {
    $('#USG_TARIF'+rad).attr('disabled',false);
  }
  else
  {
   
    $('#USG_TARIF'+rad).attr('disabled',true);
  }

}

function cari_dokter_usg()
 {
   $('#cari_dokter_usg').modal({
        show: 'true'
    }); 
 }

 function pilih_dokter_usg(kode)
 {
   if(kode!='')
   {
      $('#cari_dokter_usg').modal('hide');
      $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/detail_petugas'); ?>",
          type : "post",
          dataType : "json",
          data : {
                  NIK : kode,
                },
          success:function(resp)
          {

              if(resp.response=='200')
              {
                $('#USG_NIK_DOKTER').val(resp.data[0].NIK);
                $('#USG_NM_DOKTER').val(resp.data[0].NAMA);
              }
              else
              {
                $('#USG_NIK_DOKTER').val('');
                $('#USG_NM_DOKTER').val('');
              }
    
          }
        });
    }
    else
    {
      $('#USG_NIK_DOKTER').val('');
      $('#USG_NM_DOKTER').val('');
    }
 }
 
function clean_total_usg(){
    var arr = document.getElementsByName('TARIF[]');
    for(var i=0;i<arr.length;i++)
    {
      if(arr[i].disabled==false)
      {
        arr[i].value=non_rupiah(arr[i].value);
      }
    }
    
}


 function reset_form_usg()
 {
   
   $('#USG_IS_CITO').prop('checked',false);
   $('#USG_CATATAN').val('');
   $('.cekusg').prop('checked',false);
   $('.tarifusg').attr('disabled',true);
   $('.tarifusg').hide();
 }

 function simpan_usg()
 {
  if(confirm("Daftarkan pasien ke USG Radiologi sekarang?"))
  {
    clean_total_usg();
    tunggu_start();
    $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/simpan_usg'); ?>",
       type : "post",
       data : $('#frm_usg_pasien').serialize(),
       success:function(resp)
       {
         tunggu_end();
         md_info(resp);
        refresh_usg();
       }
     });
  }
 }


 
 function hapus_periksa_usg(cmp)
 {
    var jual=$(cmp).attr('jual');
    var rad=$(cmp).attr('rad');
    var kelas=$(cmp).attr('kelas');

    tunggu_start();
    $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/hapus_periksa_ro'); ?>",
          type : "post",
          data : {
                  KD_JUAL : jual,
                  KD_RAD : rad,
                  KD_KELAS : kelas
                },
          success:function(resp)
          {
             tunggu_end();
             md_info(resp);
            refresh_usg();
          }
        });

   
 }


function refresh_usg()
{
  
  $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/cari_plan_usg'); ?>",
          type : "post",
          data : {
                  NO_REG : $('#USG_NO_REG').val()
                },
          success:function(resp)
          {
            $('#kolom_tabel_usg').html(resp);
          }
      }); 
} 


</script>
<?php } ?>