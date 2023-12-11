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
?>
<form id="frm_tindakan_pasien">
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Tindakan Pasien <small>Halaman Tindakan Pasien</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <section class="content invoice">
          <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
            <div class="col-md-2">
              <div class="profile_img">
                <div id="crop-avatar">
                  <img class="img-responsive avatar-view" src="<?php echo asset_url('asset/img/'.icon_gender($dt->JENIS_KELAMIN)) ?>" alt="Avatar" title="<?php echo $dt->NM_PASIEN; ?>">
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <h4><?php echo $dt->NM_PASIEN; ?></h4>
              <ul class="list-unstyled user_data">
                <li>
                  <i class="fa fa-map-marker user-profile-icon"></i> <?php echo $dt->ALAMAT; ?>
                </li>
                <li class="m-top-xs">
                  <i class="fa fa-external-link user-profile-icon"></i>
                  No. RM : <?php echo $dt->NO_CM; ?>
                </li>
                <li class="m-top-xs">
                  <i class="fa fa-external-link user-profile-icon"></i>
                  No. Reg :  <?php echo $dt->NO_REG; ?>
                </li>
                <li>
                  <i class="fa fa-external-link user-profile-icon"></i>
                  Layanan : <?php echo iol($dt->IOL); ?>
                </li>
              </ul>
            </div>
            <div class="col-md-5">
            <?php if($dt->IOL=='O'){ ?>
            <h4>Pemeriksaan Pasien</h4>
            <ul class="list-unstyled user_data">
              <li>
                <p>Unit : <?php echo $dt->NM_UNIT; ?></p>
              </li>
              <li>
                <p>Dokter : <?php echo $dt->NM_DOKTER; ?></p>
              </li>
              <li>
                <p>Asuransi : <?php echo $dt->NM_ASURANSI; ?></p>
              </li>
              <li>
                <p>Status : <?php echo status_periksa($dt->STATUS_PERIKSA); ?></p>
              </li>
            </ul>
            <?php } ?>
            <?php if($dt->IOL=='I'){ ?>
            <h4>Pemeriksaan Pasien</h4>
            <ul class="list-unstyled user_data">
              <li>
                <p>Kelas : <?php echo $dt->NM_KELAS; ?></p>
              </li>
              <li>
                <p>Ruang : <?php echo $dt->NM_RUANG; ?></p>
              </li>
              <li>
                <p>Bed : <?php echo $dt->NO_BED; ?></p>
              </li>
              <li>
                <p>Asuransi : <?php echo $dt->NM_ASURANSI; ?></p>
              </li>
            </ul>
            <?php } ?>
           </div>
          </div>
          <br/>
          <br/>
          <br/>
          <br/>
          <br/>
          <input type="hidden" id="KD_UNIT" name="KD_UNIT" value="<?php echo $dt->KD_UNIT; ?>">
          <input type="hidden" id="KD_RUANG" name="KD_RUANG" value="<?php echo $dt->KD_RUANG; ?>">
          <input type="hidden" id="IOL" name="IOL" value="<?php echo $dt->IOL; ?>">
          <input type="hidden" id="INDEX_RESEP" name="INDEX_RESEP" value="0">
          <input type="hidden" id="NO_REG" name="NO_REG" value="<?php echo $dt->NO_REG; ?>">
        </section>
      </div>
    </div>
  </div>
</div>


<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-bars"></i> Layanan <small>Layanan Hemodialisa</small></h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="col-md-4">
           <div class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Tgl Awal</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="control-group">
                    <div class="controls">
                      <input class="form-control has-feedback-left mydatetime" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="TGL_HD_AWAL" name="TGL_HD_AWAL">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Tgl Awal</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="control-group">
                    <div class="controls">
                      <input class="form-control has-feedback-left mydatetime" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="TGL_HD_AKHIR" name="TGL_HD_AKHIR">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" id="NO_URUT_HD" name="NO_URUT_HD" value="">

             
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Cito </label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <input type="checkbox" id="IS_CITO" name="IS_CITO">
                </div>
            </div>  
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <button type="button" class="btn btn-success" onclick="simpan_hd()">Simpan</button>
                </div>
            </div>      
          </div>
    </div>
    <div class="col-md-4">
      <?php $this->load->view('cari/cari_diagnosa'); ?>
    </div>
    <div class="col-md-4">
      <?php $this->load->view('cari/cari_tindakan'); ?>
    </div>
  </div>
</div>



<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-bars"></i> Detail Tindakan Pasien <small>Rincian Tindakan pasien</small></h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="col-md-4">
           <div class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Tanggal</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="control-group">
                    <div class="controls">
                      <input class="form-control has-feedback-left mydatetime" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="TGL_LAYANAN" name="TGL_LAYANAN">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                  </div>
                </div>
              </div>
            </div>
            
            <input type="hidden" id="NO_URUT_LAYANAN" name="NO_URUT_LAYANAN" value="">

             <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">DPJP <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <input type="text" class="form-control" value="<?php echo $nm_dpjp; ?>" readonly="readonly" required="required" id="NM_DPJP" name="NM_DPJP" placeholder="">
                  <input type="hidden" id="NIK_DPJP" name="NIK_DPJP" value="<?php echo $nik_dpjp; ?>">
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Pelaksana <span class="required">*</span></label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                    <div class="input-group">
                      <input type="text" class="form-control" required="required" value="" readonly="readonly" id="NM_DOKTER" name="NM_DOKTER" placeholder="Dokter Pelaksana">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-info" onclick="cari_petugas('')">Cari</button>
                      </span>
                    </div>
                    <input type="hidden" class="form-control" value="" id="NIK_DOKTER" name="NIK_DOKTER">
                  </div>
            </div>
            <div class="form-group" style="display: none;">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Unit Asal<span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <select class="form-control" id="KD_UNIT" name="KD_UNIT">
                    <option value="">Pilih Unit</option>
                      <?php
                       $CEHKED="";
                        if(!is_null($data_unit))
                        {
                          if($data_unit->response=='200')
                          {
                            foreach ($data_unit->data as $du) 
                            {
                              if($du->KD_UNIT==$dt->KD_UNIT)
                              {
                                $CEHKED=" selected ";
                              }
                              else
                              {
                                $CEHKED="";
                              }
                              echo "<option value='".$du->KD_UNIT."' $CEHKED>".$du->NM_UNIT."</option>";
                            }
                          }
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group" style="display: none;">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Kelas <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <select class="form-control" id="KD_KELAS" name="KD_KELAS"">
                    <option value="">Pilih Kelas</option>
                      <?php
                       $CEHKED="";
                        if(!is_null($data_kelas))
                        {
                          if($data_kelas->response=='200')
                          {
                            foreach ($data_kelas->data as $dk) 
                            {
                              if($dk->KD_KELAS==$dt->KD_KELAS)
                              {
                                $CEHKED=" selected ";
                              }
                              else
                              {
                                $CEHKED="";
                              }
                              echo "<option value='".$dk->KD_KELAS."' $CEHKED>".$dk->NM_KELAS."</option>";
                            }
                          }
                        }
                      ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Layanan <span class="required">*</span></label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                    <div class="input-group">
                      <input type="text" class="form-control" required="required" readonly="readonly" id="NM_LAYANAN" name="NM_LAYANAN" placeholder="Layanan">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-info" onclick="cari_layanan('')">Cari</button>
                      </span>
                    </div>
                    <input type="hidden" class="form-control" id="KD_LAYANAN" name="KD_LAYANAN">
                  </div>
            </div>
            <div class="form-group" style="display: none">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Jenis Rawat <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <select class="form-control" id="IOL_LAYAN" name="IOL_LAYAN">
                    <option value="O" <?php if($dt->IOL=='O'){ echo "selected";} ?> >Rawat Jalan</option>
                    <option value="I" <?php if($dt->IOL=='I'){ echo "selected";} ?> >Rawat Inap</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Tarif <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <input type="text" class="form-control" required="required" id="TARIF_LAYANAN" name="TARIF_LAYANAN" oninput="angka(this);" onkeyup="format_rupiah(this); hitung_layanan();" onchange="hitung_layanan();" placeholder="">
                </div>
            </div>  
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Qty <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <input type="text" class="form-control" required="required" id="QTY_LAYANAN" name="QTY_LAYANAN" oninput="angka(this);" onkeyup="format_rupiah(this); hitung_layanan();" placeholder="">
                </div>
            </div>  
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Total <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <input type="text" class="form-control" readonly="readonly" required="required" id="TOTAL_LAYANAN" name="TOTAL_LAYANAN" oninput="angka(this);" onkeyup="format_rupiah(this);" placeholder="">
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <button type="button" class="btn btn-primary" onclick="simpan_layanan()">Tambahkan Layanan</button>
                </div>
            </div>      
          </div>
    </div>
    <div class="col-md-8">
        <div id="data_pakai_layan"><?php $this->load->view('cari/cari_pakai_layanan'); ?></div>
    </div>
  </div>
</div>


</form>
<!-- PENCARIAN -->


  <!-- Petugas -->
  <div class="modal fade" id="cari_petugas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Dokter Pelaksana</h4>
            </div>
            <div class="modal-body">
              <?php $this->load->view('cari/cari_petugas'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_petugas('')">Tutup</button>
            </div>
        </div>
    </div>
  </div>

  <!-- Layanan -->
  <div class="modal fade" id="cari_layanan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Layanan</h4>
            </div>
            <div class="modal-body">
              <div id="kolom_layanan"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_obat('')">Tutup</button>
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


 
 function hitung_layanan()
 {
   var tarif=non_rupiah($('#TARIF_LAYANAN').val());
   var qty=non_rupiah($('#QTY_LAYANAN').val());
   if($.isNumeric(tarif) && $.isNumeric(qty))
   {
     var _tarif=parseInt(tarif);
     var _qty=parseInt(qty);
     var _total=_tarif*_qty;
     $('#TOTAL_LAYANAN').val(rupiah(_total.toString(),'.'));
   }
 }

 

 function reset_layanan()
 {
   $('#NO_URUT_LAYANAN').val('');
   $('#QTY_LAYANAN').val('');
   $('#TOTAL_LAYANAN').val('');
 }

 function simpan_layanan()
 {

  $('#TARIF_LAYANAN').val(non_rupiah($('#TARIF_LAYANAN').val()));
  $('#QTY_LAYANAN').val(non_rupiah($('#QTY_LAYANAN').val()));
  $('#TOTAL_LAYANAN').val(non_rupiah($('#TOTAL_LAYANAN').val()));
  tunggu_start();
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/simpan_layanan'); ?>",
       type : "post",
       data : $('#frm_tindakan_pasien').serialize(),
       success:function(resp)
       {
          tunggu_end();
          reload_layanan();
          reset_layanan();
          md_info(resp);
       }
     });
 }


 
 function reload_layanan()
 {
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/reload_layan'); ?>",
       type : "post",
       data : {
                NO_REG : $('#NO_REG').val()
              },
       success:function(resp)
       {
          $('#data_pakai_layan').html(resp);
       }
     });
 }

 

 function edit_layanan(kode)
 {
  if(kode!='')
  {
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/detail_pakai_layanan'); ?>",
       type : "post",
       dataType : "json",
       data : {
                NO_URUT_LAYANAN : kode
              },
       success:function(resp)
       {
 
          if(resp.response=='200')
          {
            $('#NO_URUT_LAYANAN').val(resp.data.NO_URUT_LAYANAN);
            $('#KD_KELAS').val(resp.data.KD_KELAS);
            $('#NIK_DOKTER').val(resp.data.NIK_PELAKSANA);
            $('#NM_DOKTER').val(resp.data.NM_PELAKSANA);
            $('#NIK_DPJP').val(resp.data.NIK_DOKTER);
            $('#NM_DPJP').val(resp.data.NM_DOKTER);
            $('#IOL_LAYAN').val(resp.data.IOL);
            $('#TARIF_LAYANAN').val(rupiah(resp.data.TARIF,'.'));
            $('#QTY_LAYANAN').val(rupiah(resp.data.QTY,'.'));
            $('#TOTAL_LAYANAN').val(rupiah(resp.data.TOTAL,'.'));
            $('#KD_LAYANAN').val(resp.data.KD_LAYANAN);
            $('#NM_LAYANAN').val(resp.data.NM_LAYANAN);
            //cek_layanan(resp.data.KD_KELAS,resp.data.KD_LAYANAN);
          }
          else
          {
            $('#NO_URUT_LAYANAN').val('');
            $('#KD_KELAS').val('');
            $('#NIK_DOKTER').val('');
            $('#NM_DOKTER').val('');
            $('#NIK_DPJP').val('');
            $('#NM_DPJP').val('');
            $('#TARIF_LAYANAN').val('');
            $('#QTY_LAYANAN').val('');
            $('#TOTAL_LAYANAN').val('');
            $('#IOL_LAYAN').val('');
          }
       }
     });
  }
 }



 function hapus_layanan(kode)
 {
   tunggu_start();
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/hapus_layanan'); ?>",
       type : "post",
       data : {
                NO_URUT_LAYANAN : kode
              },
       success:function(resp)
       {
         tunggu_end();
         reset_layanan();
         reload_layanan();
         reload_detail_tagihan();
         reload_detail_group_tagihan();
       }
     });
 }

 function cari_petugas()
 {
   $('#cari_petugas').modal({
        show: 'true'
    }); 
 }

 function pilih_petugas(kode)
 {
   if(kode!='')
   {
      $('#cari_petugas').modal('hide');
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
              $('#NIK_DOKTER').val(resp.data[0].NIK);
              $('#NM_DOKTER').val(resp.data[0].NAMA);
            }
            else
            {
              $('#NIK_DOKTER').val('');
              $('#NM_DOKTER').val('');
            }
          }
        });
    }
    else
    {
      $('#NIK_DOKTER').val('');
      $('#NM_DOKTER').val('');
    }
 }

 function cari_layanan()
 {

    $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/data_layanan'); ?>",
          type : "post",
          data : {
                  KD_KELAS : $('#KD_KELAS').val(),
                },
          success:function(resp)
          {
            $('#kolom_layanan').html(resp);
            $('#cari_layanan').modal({
              show: 'true'
            }); 
          }
        });

   
 }

 function pilih_layanan(cmp)
 {
   var layan=$(cmp).attr('layan');
   var kelas=$(cmp).attr('kelas');

   if(layan!='' && kelas != '')
   {
      $('#cari_layanan').modal('hide');
      $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/detail_layanan'); ?>",
       type : "post",
       dataType : "json",
       data : {
                KD_KELAS : kelas,
                KD_LAYANAN : layan
              },
       success:function(resp)
       {
          if(resp.response=='200')
          {
            $('#KD_LAYANAN').val(resp.data.KD_LAYANAN);
            $('#NM_LAYANAN').val(resp.data.NM_LAYANAN);
            $('#TARIF_LAYANAN').val(rupiah(resp.data.TARIF,'.'));
            hitung_layanan();
          }
          else
          {
            $('#KD_LAYANAN').val('');
            $('#NM_LAYANAN').val('');
            $('#TARIF_LAYANAN').val('0');
          }
       }
     });
    }
    else
    {
       $('#KD_LAYANAN').val('');
       $('#NM_LAYANAN').val('');
       $('#TARIF_LAYANAN').val('0');
    }
 }




</script>
<?php } ?>