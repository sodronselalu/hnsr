          <form id="frm_mutasi">
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pendataan Mutasi Stok <small>Data mutasi stok</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                              <i class="fa fa-edit"></i> Pendataan Mutasi Stok

                          </h1>
                        </div>

                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                        <br/>
                          <div class="form-horizontal form-label-left">
                           <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal</label>
                              <div class="col-md-5 col-sm-5 col-xs-5">
                                <div class="control-group">
                                  <div class="controls">
                                <input class="form-control has-feedback-left mydate" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" name="TGL_MUTASI" id="TGL_MUTASI">
                                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Mutasi <span class="required">*</span></label>
                              <div class="col-md-7 col-sm-7 col-xs-7">
                                <div class="input-group">
                                  <input type="text" class="form-control" readonly="readonly" required="required" id="KD_MUTASI" name="KD_MUTASI" placeholder="Kode Mutasi">
                                  <span class="input-group-btn">
                                      <button type="button" class="btn btn-warning" onclick="buat_mutasi()">Baru</button><button type="button" onclick="cari_mutasi()" class="btn btn-info">Cari</button>
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">No Mutasi <span class="required">*</span></label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" required="required" readonly="readonly" id="NO_MUTASI" name="NO_MUTASI" placeholder="Nomor Mutasi">
                              </div>
                              <input type="hidden" class="form-control" id="URUT_NOMOR" name="URUT_NOMOR">
                            </div>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pj. Mutasi <span class="required">*</span></label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                <div class="input-group">
                                  <input type="text" class="form-control" required="required" value="<?php echo $this->session->userdata('NAMA') ?>" readonly="readonly" id="NM_PETUGAS" name="NM_PETUGAS" placeholder="Petugas Penanggung Jawab">
                                  <span class="input-group-btn">
                                      <button type="button" class="btn btn-info" onclick="cari_petugas('')">Cari</button>
                                  </span>
                                </div>
                                <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('NIK') ?>" id="PENANGGUNG_JAWAB" name="PENANGGUNG_JAWAB">
                              </div>         
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 invoice-col">
                         <div class="form-horizontal form-label-left">
                            
                            <div class="form-group"> 
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Gudang Tujuan <span class="required">*</span></label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
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
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                <textarea class="form-control" rows="2" id="KETERANGAN" name="KETERANGAN" placeholder="Keterangan"></textarea>
                              </div>
                            </div>   
                             <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Catatan</label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                <textarea class="form-control" rows="2" id="CATATAN" name="CATATAN" placeholder="Catatan"></textarea>
                              </div>
                            </div>
                            <!--<div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                <select class="form-control" readonly="readonly" required="required" id="STATUS_MUTASI" name="STATUS_MUTASI">
                                  <option value="0">BELUM FIX</option>
                                  <option value="1">PROSES MUTASI</option>
                                  <option value="9">DITERIMA TUJUAN</option>
                                </select>
                              </div>
                            </div>-->
                        
                         </div>
                        </div>
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <br>
                      <br>
                      
                      <!-- /.row -->                    
                    </section>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Pendataan Mutasi Stok <small>Data mutasi stok</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                  <div class="x_content">
                     <div class="col-sm-6">
                          <div class="col-md-12 col-sm-8 col-xs-8">
                            <div class="input-group">
                              <input type="text" class="form-control" required="required" readonly="readonly" id="NAMA_OBAT" name="NAMA_OBAT" placeholder="Obat">
                              <span class="input-group-btn">
                                  <button type="button" class="btn btn-info" onclick="cari_obat('')">Cari Obat</button>
                              </span>
                            </div>
                            <input type="hidden" class="form-control" id="KD_OBAT" name="KD_OBAT">
                          </div>
                          <div class="scrollme" id="data_stock"></div>
                          <br>
                          <br>
                      </div>

                      <div class="col-sm-6">
                          <label class="blue">Daftar Stok Dimutasi</label>
                          <br>
                          <br>
                          <div class="scrollme">
                            <table class="table table-striped table-bordered" width="100%">
                              <thead>
                              <tr>
                                <th>Aksi</th>
                                <th>Kode Obat</th>
                                <th>Nama Obat</th>
                                <th>Hrg. Beli</th>
                                <th>Jumlah</th>
                                <th>Isi</th>
                                <th>Kondisi</th>
                                <th>Kode Stock</th>
                                <th>Urut Stock</th>
                              </tr>
                              </thead>
                              <tbody id="body_item">
                              </tbody>
                            </table>
                          </div>
                          <p class="lead">Detail Mutasi</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%" colspan="2">Jumlah Stok</th>
                                  <td><input type="text" onchange="total_semua()" value="0" class="form-control" readonly="readonly" required="required" id="ALL_STOCK" name="ALL_STOCK"></td>
                                </tr>
                                <tr>
                                  <th style="width:50%" colspan="2">Nilai Mutasi</th>
                                  <td><input type="text" onchange="total_semua()" value="0" class="form-control" readonly="readonly" required="required" id="ALL_SUB_TOTAL" name="ALL_SUB_TOTAL"></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <p>
                            <button type="button" id="btn_mutasi" class="btn btn-primary" onclick="kirim_mutasi()"><i class="fa fa-send"></i> KIRIM MUTASI</button>
                            <button type="button" class="btn btn-default" onclick="cetak()">CETAK BUKTI</button>
                          </p>
                        </div>
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
  <div class="modal fade" id="cari_mutasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Mutasi</h4>
            </div>
            <div class="modal-body">
             <div id="cari_tabel_mutasi"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_mutasi('')">Tutup</button>
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

 var jumlah=0;

 function hapus_kolom(urut)
 {
    $('#item'+urut).remove();
    total_semua();
 }

 function isi_item()
 {
   $('#item_obat').modal({
        show: 'true'
    }); 
 }

 
 function isi_kolom(json_data) 
 {
    var kd_obat=json_data.KD_OBAT;
    var nama_obat=json_data.NAMA_OBAT;
    var harga_beli=json_data.HARGA_BELI;
    var nilai_qty=json_data.NILAI_QTY;
    var nm_satuan_qty=json_data.NM_SATUAN_QTY;
    var nilai_volume_satuan=json_data.QTY_SISA;
    var nm_satuan_volume=json_data.NM_SATUAN_VOLUME;
    var kondisi_stock=json_data.KONDISI_STOCK;
    var kd_stock=json_data.KD_STOCK;
    var urut_stock=json_data.URUT;
    
    jumlah+=1;

              var blank_html='<tr class="cpy_item" id="item'+jumlah+'">'+
                               '<td>'+
                               '<button type="button" class="btn_hapus_item btn btn-round btn-danger" title="Batalkan stok ini?"  value="'+jumlah+'" onclick="hapus_kolom(this.value)"><i class="fa fa-trash"></i></button>'+
                               '</td>'+
                               '<td><div id="LBL_KD_OBAT'+jumlah+'">'+kd_obat+'</div><input type="hidden" class="form-control" id="KD_OBAT'+jumlah+'" name="KD_OBAT[]" value="'+kd_obat+'"></td>'+
                               '<td><div id="LBL_NAMA_OBAT'+jumlah+'">'+nama_obat+'</div></td>'+
                               '<td><div id="LBL_HARGA_BELI'+jumlah+'">'+rupiah(harga_beli.toString(),'.')+'</div><input type="hidden" class="form-control" value="'+harga_beli+'" id="HARGA_BELI'+jumlah+'" name="HARGA_BELI[]"></td>'+
                               '<td align="right"><div id="LBL_NILAI_VOLUME_QTY'+jumlah+'">'+nilai_qty.toString()+' <b class="red">'+nm_satuan_qty+'</b></div><input type="hidden" class="form-control" id="NILAI_QTY'+jumlah+'" value="'+nilai_qty+'" name="NILAI_QTY[]"></td>'+        
                               '<td align="right"><div id="LBL_NILAI_VOLUME_SATUAN'+jumlah+'">'+nilai_volume_satuan.toString()+' '+nm_satuan_volume+'</div><input type="hidden" class="form-control" id="NILAI_VOLUME_SATUAN'+jumlah+'" value="'+nilai_volume_satuan+'" name="NILAI_VOLUME_SATUAN[]"></td>'+                              
                               '<td><div id="LBL_KONDISI_STOCK'+jumlah+'">'+baca_kondisi_stok(kondisi_stock)+'</div><input type="hidden" class="form-control" value="'+kondisi_stock+'" id="KONDISI_STOCK'+jumlah+'" name="KONDISI_STOCK[]"></td>'+
                               '<td align="right"><div id="LBL_KD_STOCK'+jumlah+'">'+kd_stock+'</div><input type="hidden" class="form-control" value="'+kd_stock+'" id="KD_STOCK'+jumlah+'" name="KD_STOCK[]"></td>'+
                               '<td align="right"><div id="LBL_URUT_STOCK'+jumlah+'">'+urut_stock+'</div><input type="hidden" class="form-control" value="'+urut_stock+'" id="URUT_STOCK'+jumlah+'" name="URUT_STOCK[]"></td>'+
                              '</tr>';
                $('#body_item').append(blank_html);
                total_semua();          
 }

  function clear_form_item()
  {
    $('#CARI_KD_OBAT').val('');
    $('#CARI_NAMA_OBAT').val('');
    $('#CARI_NM_FORMULARIUM').val('');
    $('#CARI_HARGA_BELI_TERAKHIR').val('');
    $('#CARI_QTY_VOL_SATUAN').val('');
    $('#CARI_NM_SATUAN_QTY').text('---');
    $('#lbl_qty').text('Vol ');
    $('#CARI_NM_SATUAN_VOLUME').text('---');
    $('#CARI_HARGA_SATUAN').val('');
    $('#CARI_PROSEN_DISC').val('');
    $('#CARI_NILAI_DISC').val('');
    $('#CARI_QTY').val('');
    $('#CARI_TOTAL').val('');
    $('#CARI_SUB_TOTAL').val('');
    $('#CARI_NAMA_PABRIK').val('');
    $('#CARI_KODE_PRODUKSI').val('');
    //$('#CARI_EXPIRED_DATE').val('');
    $('#btn_edit_item_po').val('');
    $('#btn_tambah_item_po').show();
    $('#btn_edit_item_po').hide();
  }


 function cari_obat()
 {
  var mutasi=$('#KD_MUTASI').val();
  if(mutasi!='')
  {
    $('#cari_obat').modal({
        show: 'true'
    });
  }
  else 
  {
    md_warning('Kode mutasi masih kosong.');
  } 
 }

function pilih_obat(kode)
{
  if(kode!='')
  {
    $.ajax({
      url : "<?php echo base_url('index.php/gudang/pakai_bahan/detail_data'); ?>",
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
          cari_stock_obat(kode);
        }
        else
        {
         $('#KD_OBAT').val('');
         $('#NAMA_OBAT').val('');
         $('#body_item').html('');
        }
      }
    });
   }
   else
   {
      $('#KD_OBAT').val('');
      $('#NAMA_OBAT').val('');
      $('#body_item').html('');
   }
  }

function cari_stock_obat(kode)
{
  if(kode!='')
  {
    $('#cari_obat').modal('hide');

    $.ajax({
      url : "<?php echo base_url('index.php/gudang/mutasi/stock_obat'); ?>",
      type : "post",
      data : {
               KD_OBAT : kode
             },
      success:function(resp)
      {
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
              $('#PENANGGUNG_JAWAB').val(resp.data[0].NIK);
              $('#NM_PETUGAS').val(resp.data[0].NAMA);
            }
            else
            {
              $('#PENANGGUNG_JAWAB').val('');
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

 function buat_mutasi()
 {
   tunggu_start();
    $.ajax({
        url : "<?php echo base_url('index.php/gudang/mutasi/baru'); ?>",
        type : "post",
        dataType : "json",
        data : {KD_MUTASI:"0"},
        success:function(resp)
        {
          tunggu_end();
            if(resp.code=='200')
            {
              
              reset_form();
              $('#KD_MUTASI').val(resp.kode_mutasi);
              $('#URUT_NOMOR').val(resp.urut);
              $('#NO_MUTASI').val(resp.no_mutasi);
              pilih_obat($('#KD_OBAT').val());
            }
            else
            {
              md_info(resp.msg);
              $('#KD_MUTASI').val(resp.kode_mutasi);
              $('#URUT_NOMOR').val(resp.urut);
              $('#NO_MUTASI').val(resp.no_mutasi);
            }
           
        }
    });
 }


 function pilih_stock(kode)
 {
   if(!cek_stock(kode)) //belum ditambahkan
   {
       $.ajax({
          url : "<?php echo base_url('index.php/gudang/mutasi/cari_stock'); ?>",
          type : "post",
          dataType : "json",
          data : {
                  KD_STOCK : kode,
                },
          success:function(resp)
          {
            isi_kolom(resp.data);
           
          }
       });
    }
    else
    {
      md_info("Stok telah ditambahkan!");
    }
 }


function total_semua(){
    var arr = document.getElementsByName('HARGA_BELI[]');
    var tot=0;

    var arr_stock = document.getElementsByName('NILAI_QTY[]');
    var tot_stock=0;

    for(var i=0;i<arr_stock.length;i++){
        if(parseInt(non_rupiah(arr_stock[i].value)))
            tot_stock += parseInt(non_rupiah(arr_stock[i].value));
    }
    $('#ALL_STOCK').val(rupiah(tot_stock.toString(),'.'));
    
    for(var i=0;i<arr.length;i++){
        if(parseInt(non_rupiah(arr[i].value)))
            tot += parseInt(non_rupiah(arr[i].value));
    }
    $('#ALL_SUB_TOTAL').val(rupiah(tot.toString(),'.'));
}

function clean_format()
{
  $('#ALL_SUB_TOTAL').val(non_rupiah($('#ALL_SUB_TOTAL').val()));
}

function reset_form()
{
  $('#KD_MUTASI').val('');
  $('#NO_MUTASI').val('');
  $('#URUT_NOMOR').val('');
  $('#KD_GUDANG_TUJUAN').val('');
  $('#STATUS_MUTASI').val('');
  $('#CATATAN').val('');
  $('#KETERANGAN').val('');
  $('#ALL_STOCK').val('0');
  $('#ALL_SUB_TOTAL').val('0');
  $('#btn_mutasi').attr('disabled',false);
  $('.btn_hapus_item').attr('disabled',false);
  $('#body_item').html('');
  jumlah=0;
}

function jml_rincian(){
    var arr = document.getElementsByName('KD_OBAT[]');
    return arr.length;
}

function kirim_mutasi()
{
  var RINCI=jml_rincian();
  if(RINCI > 0) 
  {
    clean_format();
    tunggu_start();
      $.ajax({
          url : "<?php echo base_url('index.php/gudang/mutasi/kirim_mutasi'); ?>",
          type : "post",
          data : $('#frm_mutasi').serialize(),
          success:function(resp)
          {
            tunggu_end();
            md_info(resp);
            cetak();
            reset_form();
          }

        });
  }
  else
  {
    md_warning('Rincian Stok belum dipilih.');
  }
}

function cek_stock(stok)
{
    var arr = document.getElementsByName('KD_STOCK[]');
    var temu = false;
    for(var i=0;i<arr.length;i++){
        if(arr[i].value==stok)
          temu = true;
    }
    return temu;
}


function cari_mutasi()
{
    $.ajax({
          url : "<?php echo base_url('index.php/gudang/mutasi/tabel_mutasi'); ?>",
          type : "post",
          data : {
                  KD_MUTASI : '',
                },
          success:function(resp)
          {
            $('#cari_tabel_mutasi').html(resp);
          }
        });
    
   $('#cari_mutasi').modal({
        show: 'true'
   }); 
 }

function pilih_mutasi(kode)
 {
    if(kode!='')
    {
      reset_form();
      $('#cari_mutasi').modal('hide');
      $.ajax({
          url : "<?php echo base_url('index.php/gudang/mutasi/pilih_mutasi'); ?>",
          type : "post",
          dataType : "json",
          data : {
                  KD_MUTASI : kode,
                },
          success:function(resp)
          {
            
            if(resp.response=='200')
            {
                  $('#KD_MUTASI').val(resp.data.KD_MUTASI);
                  $('#KD_GUDANG_TUJUAN').val(resp.data.KD_GUDANG_TUJUAN);
                  $('#URUT_NOMOR').val(resp.data.URUT_NOMOR);
                  $('#NO_MUTASI').val(resp.data.NO_MUTASI);
                  $('#TGL_MUTASI').val(resp.data.TGL_MUTASI);
                  $('#PENANGGUNG_JAWAB').val(resp.data.PENANGGUNG_JAWAB);
                  $('#NM_PETUGAS').val(resp.data.NM_PETUGAS_PJ);
                  $('#KETERANGAN').val(resp.data.KETERANGAN);
                  $('#CATATAN').val(resp.data.CATATAN);
                  $('#STATUS_MUTASI').val(resp.data.STATUS_MUTASI);
                  $('#body_item').html('');
                    $.ajax({
                      url : "<?php echo base_url('index.php/gudang/mutasi/detail_mutasi'); ?>",
                      type : "post",
                      dataType : "json",
                      data : {
                            KD_MUTASI : kode,
                          },
                      success:function(resp_rinci)
                      {
                        
                        $.each (resp_rinci.data, function (i) {
                          isi_kolom(resp_rinci.data[i]);
                        });
              
                      }
                    });
                  $('#ALL_SUB_TOTAL').val(resp.data.TOT_NILAI_MUTASI);

              if(resp.data.STATUS_MUTASI=='0')
              {
                  $('.btn_hapus_item').attr('disabled',false);
                  $('#btn_mutasi').attr('disabled',false);
              }
              else
              {
                  $('.btn_hapus_item').attr('disabled',true);
                  $('#btn_mutasi').attr('disabled',true);
                  md_info("Status mutasi telah dikirim tidak dapat mengedit data.");
              }
            }
            else
            {
              md_info("Mutasi tidak ditemukan.");
            }                 
        
          }
        });
    }
 }

function cetak()
{
  var kode=$('#KD_MUTASI').val();
  var url="<?php echo base_url('index.php/percetakan/cetak_bukti_mutasi') ?>/";
  window.open(url+kode,'_blank');
}
</script>