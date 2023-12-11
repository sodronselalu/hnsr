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
      $nm_dpjp="Belum diisi.";
    }
  }
  else
  {
      $nik_dpjp="0";
      $nm_dpjp="Belum diisi.";
  }
?>
<form id="frm_op">

          <input type="hidden" id="OP_KD_KELAS" name="KD_KELAS" value="<?php echo $dt->KD_KELAS; ?>">
          <input type="hidden" id="OP_KD_UNIT" name="KD_UNIT" value="<?php echo $dt->KD_UNIT; ?>">
          <input type="hidden" id="OP_KD_RUANG" name="KD_RUANG" value="<?php echo $dt->KD_RUANG; ?>">
          <input type="hidden" id="OP_IOL" name="IOL" value="<?php echo $dt->IOL; ?>">
          <input type="hidden" id="OP_INDEX_RESEP" name="INDEX_RESEP" value="0">
          <input type="hidden" id="OP_NO_REG" name="NO_REG" value="<?php echo $dt->NO_REG; ?>">
          <input type="hidden" id="OP_NO_CM" name="NO_CM" value="<?php echo $dt->NO_CM; ?>">
      
      <input type="hidden" id="OP_NO_REG_OP" name="NO_REG_OP">

      <div class="col-md-4">
        <div class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Tgl. Daftar</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="control-group">
                    <div class="controls">
                      <input class="form-control has-feedback-left mydatetime" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="OP_TGL_DAFTAR" name="TGL_DAFTAR">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-3">CITO</label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                    <input type="checkbox" id="OP_IS_CITO" name="IS_CITO" value="T">
                  </div>
              </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3"> Dokter OP <span class="required">*</span></label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                    <div class="input-group">
                      <input type="text" class="form-control" required="required" value="<?php echo $nm_dpjp; ?>" readonly="readonly" id="OP_NM_DOKTER" name="NM_DOKTER" placeholder="">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-info" onclick="cari_dokter_op('')">Cari</button>
                      </span>
                    </div>
                    <input type="hidden" class="form-control" value="<?php echo $nik_dpjp; ?>" id="OP_NIK_DOKTER" name="NIK_DOKTER">
                  </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-3"> Operasi <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <select class="form-control" id="OP_KD_OP" name="KD_OP">
                      <?php
                      if(!is_null($data_op))
                      {
                        if($data_op->response=='200')
                        {
                          foreach ($data_op->data as $dt) 
                          {
                            echo "<option value='".$dt->KD_OP."'>".$dt->NM_OP."</option>";
                          }
                        }
                      }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Keterangan</label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                     <textarea class="form-control" id="OP_KETERANGAN" name="KETERANGAN"></textarea>
                  </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                    <button type="button" class="btn btn-primary" onclick="simpan_op()">Simpan <span class="fa fa-send"></span></button>
                    <button type="button" class="btn btn-warning" onclick="reset_form_op()">Batal</button>
                  </div>
              </div>
            <br>
          </div>
        </div>   
        <div class="col-md-8">
          <div id="kolom_tabel_op"><?php $this->load->view("layanan/v_opt"); ?></div>
        </div> 
</form>
<!-- PENCARIAN -->


  <div class="modal fade" id="cari_tim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Tim Operasi</h4>
            </div>
            <div class="modal-body">
              <?php //$this->load->view('cari/cari_petugas'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_petugas('')">Tutup</button>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade" id="cari_dokter_op" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Dokter Operasi</h4>
            </div>
            <div class="modal-body">
              <?php $this->load->view('cari/cari_dokter_op'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
  </div>
  
  <div class="modal fade" id="cari_op" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Operasi</h4>
            </div>
            <div class="modal-body">
              <div id="kolom_op"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_op('')">Tutup</button>
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

$('body').on('hidden.bs.modal', function (e) {
  $('.modal-backdrop').remove();
  $('body').removeClass('modal-open');    
});



 function reset_form_op()
 {
   $('#OP_NO_REG_OP').val('');
   $('#OP_NIK_DOKTER').val('');
   $('#OP_NM_DOKTER').val('');
   $('#OP_KD_OP').val('');
   $('#OP_IS_CITO').prop('checked',false);
   $('#OP_KETERANGAN').val('');
 }

 function simpan_op()
 {
  var daftar=$('#OP_TGL_DAFTAR').val();
  var dr=$('#OP_NIK_DOKTER').val();
  var op=$('#OP_KD_OP').val();

  if(daftar!='')
  {
    if(dr!='')
    {
      if(op!='')
      {
          tunggu_start();
          $.ajax({
              url : "<?php echo base_url('index.php/layanan/pelayanan_hd/simpan_op'); ?>",
              type : "post",
              data : $('#frm_op').serialize(),
              success:function(resp)
              {
                tunggu_end();
                md_info(resp);
                reset_form_op();
                refresh_op();
              }
            });
      }
      else
      {
        md_warning('Tanggal daftar kosong!');

      }
    }
    else
    {
      md_warning('Dokter kosong!');

    }
  }
  else
  {
    md_warning('Op kosong!');
  }
  
 }


 function cari_dokter_op()
 {
   $('#cari_dokter_op').modal({
        show: 'true'
    }); 
 }

 function pilih_dokter_op(kode)
 {
   if(kode!='')
   {
      $('#cari_dokter_op').modal('hide');
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
                $('#OP_NIK_DOKTER').val(resp.data[0].NIK);
                $('#OP_NM_DOKTER').val(resp.data[0].NAMA);
              }
              else
              {
                $('#OP_NIK_DOKTER').val('');
                $('#OP_NM_DOKTER').val('');
              }
          }
        });
    }
    else
    {
      $('#OP_NIK_DOKTER').val('');
      $('#OP_NM_DOKTER').val('');
    }
 }

 
function refresh_op()
{
    $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/data_plan_op'); ?>",
          type : "post",
          data : {
                  NO_CM : $('#OP_NO_CM').val()
                },
          success:function(resp)
          {
            $('#kolom_tabel_op').html(resp);
          }
    });    
} 

function pilih_op(reg_op)
{
    $('#cari_op').modal('hide');
    
      $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/detail_op'); ?>",
          type : "post",
          dataType : "json",
          data : {
                  NO_REG_OP : reg_op
                },
          success:function(resp)
          {
            if(resp.response=='200')
            {
              $('#OP_NO_REG_OP').val(resp.data.NO_REG_OP);
              $('#OP_TGL_DAFTAR').val(resp.data.TGL_DAFTAR_F);
              if(resp.data.IS_CITO=='T')
              {
                $('#OP_IS_CITO').prop('checked',true);
              }
              else
              {
                $('#OP_IS_CITO').prop('checked',false);
              }
              $('#OP_NIK_DOKTER').val(resp.data.NIK_DOKTER);
              $('#OP_NM_DOKTER').val(resp.data.NM_DOKTER);
              $('#OP_KD_OP').val(resp.data.KD_OP);
              $('#OP_KETERANGAN').val(resp.data.KETERANGAN);
            } 
          }
        });
}




function hapus_op(reg)
{
  if(reg)
  {
    tunggu_start();
    $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/hapus_op'); ?>",
          type : "post",
          data : {
                  NO_REG_OP : reg,
                },
          success:function(resp)
          {
            tunggu_end();
            md_info(resp);
            refresh_op();
          }
        });
   }
   else
   {
    md_warning('Register OP belum dipilih!');
   }
 }

</script>
<?php } ?>