
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pendataan Pemakaian Stok <small>Data pemakaian stok</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <form id="frm_pakai">
                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                              <i class="fa fa-edit"></i> Pendataan Pemakaian Stok

                          </h1>
                        </div>

                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-5 invoice-col">
                        <br/>
                          <div class="form-horizontal form-label-left">
                          <div class="form-group" style="display: none;">
                            <label class="control-label col-md-2 col-sm-2 col-xs-2">Pengguna</label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                              <select class="form-control" name="KD_UNIT" id="KD_UNIT">
                                <option value="">Tidak ada</option>
                                <?php
                                  if(!is_null($data_unit))
                                  {
                                    if($data_unit->response=='200')
                                    {
                                      foreach ($data_unit->data as $dg) 
                                      {
                                        echo "<option value='".$dg->KD_UNIT."'>".$dg->NM_UNIT."</option>";
                                      }
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                           <div class="form-group">
                              <label class="control-label col-md-2 col-sm-2 col-xs-2">Tanggal</label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="control-group">
                                  <div class="controls">
                                <input class="form-control has-feedback-left mydate" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" name="TGL_PAKAI" id="TGL_PAKAI">
                                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-2">Kode <span class="required">*</span></label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="input-group">
                                  <input type="text" class="form-control" readonly="readonly" required="required" id="KD_PAKAI" name="KD_PAKAI" placeholder="Kode Pakai">
                                  <span class="input-group-btn">
                                      <button type="button" class="btn btn-warning" onclick="buat_pakai()">Baru</button><button type="button" onclick="cari_pakai()" class="btn btn-info">Cari</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-2 col-xs-2">No <span class="required">*</span></label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <input type="text" class="form-control" required="required" readonly="readonly" id="NO_PAKAI" name="NO_PAKAI" placeholder="Nomor Pakai">
                              </div>
                              <input type="hidden" class="form-control" id="URUT_NOMOR" name="URUT_NOMOR">
                            </div>
                            <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-2">Pj. <span class="required">*</span></label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="input-group">
                                  <input type="text" class="form-control" required="required" value="<?php echo $this->session->userdata('NAMA') ?>" readonly="readonly" id="NM_PETUGAS" name="NM_PETUGAS" placeholder="Petugas Penanggung Jawab">
                                  <span class="input-group-btn">
                                      <button type="button" class="btn btn-info" onclick="cari_petugas('')">Cari</button>
                                  </span>
                                </div>
                                <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('NIK') ?>" id="PJ_PAKAI" name="PJ_PAKAI">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-2 col-xs-2">Ket.</label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <textarea class="form-control" id="KETERANGAN" name="KETERANGAN" placeholder=""></textarea>
                              </div>
                            </div>  
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-2 col-xs-2">Catatan</label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <textarea class="form-control" rows="2" id="CATATAN" name="CATATAN" placeholder=""></textarea>
                              </div>
                            </div>       
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-7 invoice-col">
                          <br>
                          <div class="form-horizontal form-label-left">
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-2">Bahan<span class="required">*</span></label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
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
                            <label class="control-label col-md-2 col-sm-2 col-xs-2">Stock <span class="required">*</span></label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="input-group">
                                  <input type="text" class="form-control" required="required" readonly="readonly" id="KD_STOCK" name="KD_STOCK" placeholder="Stock">
                                  <span class="input-group-btn">
                                  <button type="button" class="btn btn-info" onclick="cari_stock('')">Cari</button>
                              </span>
                            </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-2">Expired</label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <input type="text" class="form-control" required="required" readonly="readonly" id="EXPIRED_DATE" name="EXPIRED_DATE">
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-2">Hrg Beli</label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <input type="text" class="form-control" required="required" readonly="" id="HARGA_BELI" onkeyup="format_rupiah(this); hitung();" name="HARGA_BELI">
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-2">Sisa</label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="input-group">
                                  <input type="text" class="form-control" required="required" readonly="readonly" id="QTY_SISA" name="QTY_SISA">
                                  <span class="input-group-btn">
                                    <input type="text" class="form-control SATUAN_SISA" style="width: 100px;" readonly="">
                                  </span>
                            </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-2">Pakai <span class="required">*</span></label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="input-group">
                                  <input type="text" class="form-control" required="required" oninput="angka(this)" onkeyup="hitung();" id="QTY_PAKAI" name="QTY_PAKAI" placeholder="Jumlah Pemakaian">
                                  <span class="input-group-btn">
                                    <input type="text" class="form-control SATUAN_SISA" style="width: 100px;" readonly="">
                                  </span>
                            </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-2">Total<span class="required">*</span></label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <input type="text" class="form-control" readonly="readonly" required="required" oninput="angka(this)" onkeyup="format_rupiah(this); hitung();" id="TOTAL" name="TOTAL" placeholder="">
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-2"></label>
                              <div class="col-md-10 col-sm-10 col-xs-10">
                                <button type="button" id="btn_mutasi" class="btn btn-success" onclick="simpan_pakai()"><i class="fa fa-save"></i> Simpan</button>
                              </div>
                          </div>
                          
                          </div>
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
                    <h2>Data Pemakaian Stok <small>Data pemakaian stok</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="detail_pakai_stok"></div>
                  </div>
                </div>
              </div>
              <!-- /.col -->
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

   <!-- Mutasi -->
  <div class="modal fade" id="cari_pakai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Pemakaian</h4>
            </div>
            <div class="modal-body">
             <div id="cari_tabel_pakai"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_pakai('')">Tutup</button>
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

    <!-- stock -->
  <div class="modal fade" id="cari_stock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Data Stok</h4>
            </div>
            <div class="modal-body">
              <div id="data_stock"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_stock('')">Tutup</button>
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
    tunggu_start();
    $.ajax({
      url : "<?php echo base_url('index.php/gudang/pakai_bahan/detail_data'); ?>",
      type : "post",
      dataType : "json",
      data : {
               KD_OBAT : kode
             },
      success:function(resp)
      {
        tunggu_end();
        $('#KD_STOCK').val('');
        $('#QTY_PAKAI').val('1');
        $('#QTY_SISA').val('0');
        $('.SATUAN_SISA').val('');
        $('#EXPIRED_DATE').val('');
        $('#TOTAL').val('0');
        

        if(resp.response=='200')
        {
          $('#KD_OBAT').val(resp.data[0].KD_OBAT);
          $('#NAMA_OBAT').val(resp.data[0].NAMA_OBAT);
          $('.SATUAN_SISA').val(resp.data[0].NM_SATUAN_VOLUME);
          stock_obat_focus();
          cari_stock_obat(kode);
        }
        else
        {
         $('#KD_OBAT').val('');
         $('#NAMA_OBAT').val('');
         $('.SATUAN_SISA').val('');
        }
      }
    });
   }
   else
   {
      $('#KD_OBAT').val('');
      $('#NAMA_OBAT').val('');
   }
  }

function cari_stock()
 {
 
   $('#cari_stock').modal({
        show: 'true'
   }); 
 }

function cari_stock_obat(kode)
{
  if(kode!='')
  {
    $('#cari_obat').modal('hide');
    tunggu_start();
    $.ajax({
      url : "<?php echo base_url('index.php/gudang/pakai_bahan/stock_obat'); ?>",
      type : "post",
      data : {
               KD_OBAT : kode
             },
      success:function(resp)
      {
        tunggu_end();
        $('#data_stock').html(resp);
      }
    });
   }
   else
   {
     md_warning('Obat belum dipilih!');
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
          url : "<?php echo base_url('index.php/gudang/pakai_bahan/detail_petugas'); ?>",
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
      $('#PJ_PAKAI').val('');
      $('#NM_PETUGAS').val('');
    }
 }

 function buat_pakai()
 {
    tunggu_start();
    $.ajax({
        url : "<?php echo base_url('index.php/gudang/pakai_bahan/baru'); ?>",
        type : "post",
        dataType : "json",
        data : {KD_PAKAI:"0"},
        success:function(resp)
        {
          tunggu_end();
            if(resp.code=='200')
            {
              
              reset_form();
              $('#KD_PAKAI').val(resp.kode);
              $('#URUT_NOMOR').val(resp.urut);
              $('#NO_PAKAI').val(resp.no);
            }
            else
            {
              md_info(resp.msg);
              $('#KD_PAKAI').val(resp.kode);
              $('#URUT_NOMOR').val(resp.urut);
              $('#NO_PAKAI').val(resp.no);
            }
           
        }
    });
 }


 function stock_obat_focus()
 {
   var kode = $('#KD_OBAT').val();
   if(kode!='')
   {
     $.ajax({
      url : "<?php echo base_url('index.php/gudang/pakai_bahan/stock_obat_focus'); ?>",
      type : "post",
      dataType : "json",
      data : {
               KD_OBAT : kode,
             },
      success:function(resp)
      {
        
        if(resp.response=='200')
        {
          $('#KD_STOCK').val(resp.data.KD_STOCK);
          $('#QTY_SISA').val(resp.data.QTY_SISA);
          $('#HARGA_BELI').val(rupiah(resp.data.HARGA_BELI_SATUAN,'.'));
          $('#EXPIRED_DATE').val(resp.data.EXPIRED_DATE);

          hitung();
        }
        else
        {
          md_warning("Stock tidak tersedia!");
          $('#KD_STOCK').val('');
          $('#QTY_SISA').val('');
          $('#HARGA_BELI').val('');
          $('#EXPIRED_DATE').val('');
        }
        
      }
     });
   }
 }


 function pilih_stock(kode)
 {
    $('#cari_stock').modal('hide');
    tunggu_start();
    $.ajax({
        url : "<?php echo base_url('index.php/gudang/pakai_bahan/cari_stock'); ?>",
        type : "post",
        async : false,
        dataType : "json",
        data : {
                KD_STOCK : kode,
              },
        success:function(resp)
        {
          tunggu_end();
          if(resp.response=='200')
          {
            $('#KD_STOCK').val(resp.data.KD_STOCK);
            $('#QTY_SISA').val(resp.data.QTY_SISA);
            $('#EXPIRED_DATE').val(resp.data.EXPIRED_DATE);
            $('#HARGA_BELI').val(rupiah(resp.data.HARGA_BELI_SATUAN,'.')); 
          }
        }
      });
 }

function hitung()
{
  var harga=non_rupiah($('#HARGA_BELI').val());
  var qty_musnah=non_rupiah($('#QTY_PAKAI').val());
  var qty_sisa=non_rupiah($('#QTY_SISA').val());

  if($.isNumeric(harga) && $.isNumeric(qty_musnah) && $.isNumeric(qty_sisa))
  {
    var harga_=parseInt(harga);
    var qty_musnah_=parseInt(qty_musnah);
    var qty_sisa_=parseInt(qty_sisa);
    var total = 0;

    if(qty_sisa_ >= qty_musnah_)
    {
       total= harga_ * qty_musnah_;
    }
    else
    {
      md_warning('Jumlah Musnah Melebihi Sisa Stock!');
      total = 0;
    }

    $('#TOTAL').val(rupiah(total.toString(),'.'));
  }
}

function reset_form()
{
  $('#KD_PAKAI').val('');
  $('#NO_PAKAI').val('');
  $('#URUT_NOMOR').val('');
  $('#CATATAN').val('');
  $('#KETERANGAN').val('');
  $('#ALL_STOCK').val('0');
  $('#ALL_SUB_TOTAL').val('0');
  $('#btn_mutasi').attr('disabled',false);
  $('.btn_hapus_item').attr('disabled',false);
  $('#body_item').html('');
  jumlah=0;
}


function simpan_pakai()
{
  var stok=$('#KD_STOCK').val();
  var qty=$('#QTY_MUSNAH').val();
  var kode=$('#KD_PAKAI').val();
  var pj=$('#PJ_PAKAI').val();
  if(kode!='')
  {
    if(pj!='')
    {
      if(stok!='')
      {
        if(qty!='')
        {
          $('#TOTAL').val(non_rupiah($('#TOTAL').val()));
          $('#HARGA_BELI').val(non_rupiah($('#HARGA_BELI').val()));
          tunggu_start();
          $.ajax({
              url : "<?php echo base_url('index.php/gudang/pakai_bahan/simpan_pakai'); ?>",
              type : "post",
              data : $('#frm_pakai').serialize(),
              success:function(resp)
              {
                tunggu_end();
                md_info(resp);
                detail_pakai();
                stock_obat_focus();
                //cetak();
                //reset_form();
              }
            });
        }
        else
        {
          md_warning('Jumlah musnah belum diisi!');
        }
      }
      else
      {
        md_warning('Stok musnah belum diisi!');
      }
    }
    else
    {
      md_warning("Penanggung Jawab Belum diisi!");
    }
  }
  else
  {
    md_warning("Kode Pemakaian belum dibuat!");
  }
}



function cari_pakai()
{

    $.ajax({
          url : "<?php echo base_url('index.php/gudang/pakai_bahan/tabel_pakai'); ?>",
          type : "post",
          data : {
                  KD_PAKAI : '',
                },
          success:function(resp)
          {

            $('#cari_tabel_pakai').html(resp);
          }
        });
    
   $('#cari_pakai').modal({
        show: 'true'
   }); 
 }

function pilih_pakai(kode)
 {
    if(kode!='')
    {
      reset_form();
      $('#cari_pakai').modal('hide');
      $.ajax({
          url : "<?php echo base_url('index.php/gudang/pakai_bahan/pilih_pakai'); ?>",
          type : "post",
          dataType : "json",
          data : {
                  KD_PAKAI : kode,
                },
          success:function(resp)
          {
            
            if(resp.response=='200')
            {
                  $('#KD_PAKAI').val(resp.data.KD_PAKAI);
                  $('#URUT_NOMOR').val(resp.data.URUT_NOMOR);
                  $('#NO_PAKAI').val(resp.data.NO_PAKAI);
                  $('#TGL_MUSNAH').val(resp.data.TGL_MUSNAH);
                  pilih_petugas(resp.data.PJ_PAKAI);
                  $('#KETERANGAN').val(resp.data.KETERANGAN);
                  $('#CATATAN').val(resp.data.CATATAN);
                  detail_pakai();
                  
            }
            else
            {
              md_info("Mutasi tidak ditemukan.");
            }                 
        
          }
        });
    }
 }

function detail_pakai()
{

    $.ajax({
          url : "<?php echo base_url('index.php/gudang/pakai_bahan/stock_pakai'); ?>",
          type : "post",
          data : {
                  KD_PAKAI : $('#KD_PAKAI').val(),
                },
          success:function(resp)
          {
            $('#detail_pakai_stok').html(resp);
          }
        });
    
 }

function hapus_pakai_stock(cmp)
{
  var pakai=$(cmp).attr('pakai');
  var stock=$(cmp).attr('stock');
  tunggu_start();
   $.ajax({
          url : "<?php echo base_url('index.php/gudang/pakai_bahan/hapus_pakai_stock'); ?>",
          type : "post",
          data : {
                  KD_PAKAI : pakai,
                  KD_STOCK : stock
                },
          success:function(resp)
          {
            tunggu_end();
            md_info(resp);
            detail_pakai();
            stock_obat_focus();
          }
        });
}

function pilih_pakai_stock(cmp)
{
  var pakai=$(cmp).attr('pakai');
  var stock=$(cmp).attr('stock');

   $.ajax({
          url : "<?php echo base_url('index.php/gudang/pakai_bahan/detail_stock_pakai'); ?>",
          type : "post",
          async : false,
          dataType : "json",
          data : {
                  KD_PAKAI : pakai,
                  KD_STOCK : stock
                },
          success:function(resp)
          {
             if(resp.response=='200')
             {
              $('#KD_STOCK').val(resp.data.KD_STOCK);
              $('#KD_OBAT').val(resp.data.KD_OBAT);
              $('#NAMA_OBAT').val(resp.data.NAMA_OBAT);
              pilih_stock(resp.data.KD_STOCK);
              $('#HARGA_BELI').val(rupiah(resp.data.HARGA_BELI_SATUAN,'.'));
              $('#QTY_PAKAI').val(resp.data.QTY_PAKAI);
              $('#TOTAL').val(rupiah(resp.data.TOTAL_PAKAI,'.'));
              hitung();
              cari_stock_obat(obat);
             }
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