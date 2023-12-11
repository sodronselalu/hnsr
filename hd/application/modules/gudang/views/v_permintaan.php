            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pembuatan Permintaan Farmasi <small>Data permintaan</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <form id="frm_minta">
                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">

                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-5 invoice-col">
                        <br/>
                          <div class="form-horizontal form-label-left">
                           
                            <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Petugas <span class="required">*</span></label>
                              <div class="col-md-9 col-sm-9 col-xs-9">
                                <div class="input-group">
                                  <input type="text" class="form-control" required="required" value="<?php echo $this->session->userdata('NAMA') ?>" readonly="readonly" id="NM_PETUGAS" name="NM_PETUGAS" placeholder="Petugas Penanggung Jawab">
                                  <span class="input-group-btn">
                                      <button type="button" class="btn btn-info" onclick="cari_petugas('')">Cari</button>
                                  </span>
                                </div>
                                <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('NIK') ?>" id="PJ_PERMINTAAN" name="PJ_PERMINTAAN">
                              </div>
                            </div>
                            <input type="hidden" class="form-control" id="URUT_PERMINTAAN" name="URUT_PERMINTAAN">
                          <div class="form-group"> 
                              <label class="control-label col-md-3 col-sm-3 col-xs-3">Tujuan <span class="required">*</span></label>
                              <div class="col-md-9 col-sm-9 col-xs-9">
                                <select class="form-control" required="required" id="KD_GUDANG_TUJUAN" name="KD_GUDANG_TUJUAN">
                                  <option value="">Pilih Gudang Tujuan</option>
                                  <?php
                                    if(!is_null($data_gudang))
                                    {
                                      if($data_gudang->response=='200')
                                      {
                                        foreach ($data_gudang->data as $dp) 
                                        {
                                          echo "<option value='".$dp->KD_GUDANG."'>".$dp->NM_GUDANG."</option>";
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
                                <textarea class="form-control" rows="2" id="KETERANGAN" name="KETERANGAN" placeholder=""></textarea>
                              </div>
                          </div> 
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Bahan<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                            <div class="input-group">
                              <input type="text" class="form-control" required="required" readonly="readonly" id="NAMA_OBAT" name="NAMA_OBAT" placeholder="Bahan / Obat">
                              <span class="input-group-btn">
                                  <button type="button" class="btn btn-info" onclick="cari_obat('')">Cari</button>
                              </span>
                            </div>
                            </div>
                            <input type="hidden" class="form-control" id="KD_OBAT" name="KD_OBAT">
                          </div>
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-3">Jumlah</label>
                              <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" oninput="angka(this)" onkeyup="format_rupiah(this);" id="JUMLAH" name="JUMLAH" placeholder="">
                              </div>
                          </div> 
                          <div class="form-group"> 
                              <label class="control-label col-md-3 col-sm-3 col-xs-3">Satuan <span class="required">*</span></label>
                              <div class="col-md-9 col-sm-9 col-xs-9">
                                <select class="form-control" required="required" id="KD_SATUAN" name="KD_SATUAN" readonly="">
                                  
                                </select>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                              <div class="col-md-9 col-sm-9 col-xs-9">
                                <button type="button" id="btn_mutasi" class="btn btn-success" onclick="simpan_permintaan()"><i class="fa fa-save"></i> Simpan</button>
                              </div>
                          </div>
                                
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-7 invoice-col">
                          <br>
                          <div id="data_permintaan"><?php $this->load->view('detail_permintaan'); ?></div>
                        </div>
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->                  
                    </section>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Permintaan Ke gudang Anda<small>Data permintaan ke gudang anda</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="data_permintaan_sini"><?php $this->load->view('detail_permintaan_sini'); ?></div>
                  </div>
                </div>
              </div>
            </div>
<!-- PENCARIAN -->

  <!-- Petugas -->
  <div class="modal fade" id="cari_petugas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Pegawai</h4>
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

   

   <!-- Obat -->
  <div class="modal fade" id="cari_obat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Obat</h4>
            </div>
            <div class="modal-body">
              <?php $this->load->view('cari/cari_obat'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_obat('')">Tutup</button>
            </div>
        </div>
    </div>
  </div>

<!-- END PENCARIAN -->
<script type="text/javascript">

 

 function cari_obat()
 {
   $('#cari_obat').modal({
        show: 'true'
   }); 
 }

function pilih_obat(kode)
{
  if(kode!='')
  {
    $('#cari_obat').modal('hide');
    $.ajax({
      url : "<?php echo base_url('index.php/gudang/permintaan_farmasi/detail_data'); ?>",
      type : "post",
      dataType : "json",
      data : {
               KD_OBAT : kode
             },
      success:function(resp)
      {
        
        if(resp.response=='200')
        {
          $('#KD_OBAT').val(resp.data[0].KD_OBAT);
          $('#NAMA_OBAT').val(resp.data[0].NAMA_OBAT);
          $('#KD_SATUAN').val(resp.data[0].KD_SATUAN_QTY);
          $('#KD_SATUAN').html("<option value='"+resp.data[0].KD_SATUAN_QTY+"'>"+resp.data[0].NM_SATUAN_QTY+"</option>");
        }
      }
    });
   }
   else
   {
      $('#KD_OBAT').val('');
      $('#NAMA_OBAT').val('');
      $('#KD_SATUAN').html('');
   }
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
          url : "<?php echo base_url('index.php/gudang/permintaan_farmasi/detail_petugas'); ?>",
          type : "post",
          dataType : "json",
          data : {
                  NIK : kode,
                },
          success:function(resp)
          {
            if(resp.response=='200')
            {
              $('#PJ_PAKAI').val(resp.data[0].NIK);
              $('#NM_PETUGAS').val(resp.data[0].NAMA);
            }
            else
            {
              $('#PJ_PAKAI').val('');
              $('#NM_PETUGAS').val('');
            }
          }
        });
    }
    else
    {
      $('#PENANGGUNG_JAWAB').val('');
      $('#NM_PETUGAS').val('');
    }
 }

 
function reset_form()
{
  $('#KD_GUDANG_TUJUAN').val('');
  $('#KETERANGAN').val('');
  $('#KD_OBAT').val('');
  $('#NAMA_OBAT').val('');
  $('#JUMLAH').val('0');
  $('#KD_SATUAN').val('');
  $('#URUT_PERMINTAAN').val('');
}


function simpan_permintaan()
{
  var gudang=$('#KD_GUDANG_TUJUAN').val();
  var jumlah=$('#JUMLAH').val();
  var obat=$('#KD_OBAT').val();
  if(gudang!='')
  {
    if(obat!='')
    {
      if(jumlah!='')
      {
        $('#JUMLAH').val(non_rupiah($('#JUMLAH').val()));
        tunggu_start();
        $.ajax({
            url : "<?php echo base_url('index.php/gudang/permintaan_farmasi/simpan_permintaan'); ?>",
            type : "post",
            data : $('#frm_minta').serialize(),
            success:function(resp)
            {
              tunggu_end();
              md_info(resp);
              detail_minta();
              reset_form();
            }
          });
      }
      else
      {
        md_warning('Jumlah Obat belum diisi!');
      }
    }
    else
    {
      md_warning('Obat belum diisi!');
    }
  }
  else
  {
    md_warning('Gudang tujuan belum diisi!');
  }
}

function detail_minta()
{
    $.ajax({
          url : "<?php echo base_url('index.php/gudang/permintaan_farmasi/data_permintaan'); ?>",
          type : "post",
          data : {
                  KD_GUDANG : '',
                },
          success:function(resp)
          {
            $('#data_permintaan').html(resp);
          }
        });
    
 }

function detail_minta_sini()
{
    $.ajax({
          url : "<?php echo base_url('index.php/gudang/permintaan_farmasi/data_permintaan_sini'); ?>",
          type : "post",
          data : {
                  KD_GUDANG : '',
                },
          success:function(resp)
          {
            $('#data_permintaan_sini').html(resp);
          }
        });
    
 }

function pilih_minta(kode)
{
  
   $.ajax({
          url : "<?php echo base_url('index.php/gudang/permintaan_farmasi/pilih_minta'); ?>",
          type : "post",
          dataType : "json",
          data : {
                  URUT_PERMINTAAN : kode
                },
          success:function(resp)
          {
             if(resp.response=='200')
             {
              $('#URUT_PERMINTAAN').val(resp.data.URUT_PERMINTAAN);
              $('#KD_GUDANG_TUJUAN').val(resp.data.KD_GUDANG_MINTA);
              $('#KETERANGAN').val(resp.data.KETERANGAN);
              $('#KD_OBAT').val(resp.data.KD_OBAT);
              $('#NAMA_OBAT').val(resp.data.NAMA_OBAT);
              $('#JUMLAH').val(resp.data.JUMLAH);
              $('#KD_SATUAN').val(resp.data.KD_SATUAN);
             }
             else
             {
              reset_form();
             }
          }
        });
}

function hapus_minta(kode)
{
   tunggu_start();
   $.ajax({
          url : "<?php echo base_url('index.php/gudang/permintaan_farmasi/hapus_permintaan'); ?>",
          type : "post",
          data : {
                  URUT_PERMINTAAN : kode
                },
          success:function(resp)
          { 
            tunggu_end();
            md_info(resp);
            detail_minta();
          }
        });
}

function verif_minta(kode)
{
   tunggu_start();
   $.ajax({
          url : "<?php echo base_url('index.php/gudang/permintaan_farmasi/verif_permintaan'); ?>",
          type : "post",
          data : {
                  URUT_PERMINTAAN : kode
                },
          success:function(resp)
          { 
            tunggu_end();
            md_info(resp);
            detail_minta_sini();
          }
        });
}

function cetak()
{
  var kode=$('#KD_PAKAI').val();
  var url="<?php echo base_url('index.php/percetakan/cetak_bukti_pakai') ?>/";
  window.open(url+kode,'_blank');
}
</script>