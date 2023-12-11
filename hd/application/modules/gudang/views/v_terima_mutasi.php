            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Penerimaan Mutasi Stok <small>Penerimaan stok</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <form id="frm_mutasi">
                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                              <i class="fa fa-edit"></i> Penerimaan Mutasi Stok

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
                              <div class="col-md-5 col-sm-9 col-xs-12">
                                <div class="control-group">
                                  <div class="controls">
                                <input class="form-control has-feedback-left mydate" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" name="TGL_TERIMA" id="TGL_TERIMA">
                                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Mutasi <span class="required">*</span></label>
                              <div class="col-md-7 col-sm-1 col-xs-1">
                                <div class="input-group">
                                  <input type="text" class="form-control" readonly="readonly" required="required" id="KD_MUTASI" name="KD_MUTASI" placeholder="Kode Mutasi">
                                  <span class="input-group-btn">
                                      <button type="button" onclick="cari_mutasi()" class="btn btn-info">Cari</button>
                                  </span>
                                </div>
                              </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Mutasi</label>
                              <div class="col-md-5 col-sm-9 col-xs-12">
                                <div class="control-group">
                                  <div class="controls">
                                <input class="form-control has-feedback-left" readonly="readonly" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" name="TGL_MUTASI" id="TGL_MUTASI">
                                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                                  </div>
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
                            <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Pj. Mutasi <span class="required">*</span></label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                  <input type="text" class="form-control" required="required" readonly="readonly" id="NM_PJ_MUTASI" name="NM_PJ_MUTASI" placeholder="Petugas Penanggung Jawab">
                                <input type="hidden" class="form-control" id="PENANGGUNG_JAWAB_MUTASI" name="PENANGGUNG_JAWAB_MUTASI">
                              </div> 
                            </div>  
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan Kirim</label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                <textarea class="form-control" readonly="readonly" rows="1" id="KETERANGAN" name="KETERANGAN" placeholder="Keterangan"></textarea>
                              </div>
                            </div> 
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                <select class="form-control" readonly="readonly" required="required" id="STATUS_MUTASI" name="STATUS_MUTASI">
                                  <option value="0">BELUM FIX</option>
                                  <option value="1">PROSES MUTASI</option>
                                  <option value="9">DITERIMA TUJUAN</option>
                                </select>
                              </div>
                            </div>     
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 invoice-col">
                         <div class="form-horizontal form-label-left">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Penerima <span class="required">*</span></label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                <div class="input-group">
                                  <input type="text" class="form-control" required="required" value="<?php echo $this->session->userdata('NAMA') ?>" readonly="readonly" id="NM_PETUGAS" name="NM_PETUGAS" placeholder="Petugas Penanggung Jawab">
                                  <span class="input-group-btn">
                                      <button type="button" class="btn btn-info" onclick="cari_petugas('')">Cari</button>
                                  </span>
                                </div>
                                <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('NIK') ?>" id="PENERIMA" name="PENERIMA">
                            </div>
                            <div class="form-group"> 
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Gudang Asal <span class="required">*</span></label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" required="required" readonly="readonly" id="NM_GUDANG_ASAL" name="NM_GUDANG_ASAL" placeholder="Nomor Mutasi">
                              </div>
                            </div>
                            <div class="form-group"> 
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Gudang Tujuan <span class="required">*</span></label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" required="required" readonly="readonly" id="NM_GUDANG_TUJUAN" name="NM_GUDANG_TUJUAN" placeholder="Nomor Mutasi">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan Terima</label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                <textarea class="form-control" rows="3" id="KETERANGAN_TERIMA" name="KETERANGAN_TERIMA" placeholder="Keterangan"></textarea>
                              </div>
                            </div>   
                         </div>
                        </div>
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <br>
                      <br>
                      <div class="row">
                        <div class="col-sm-12">
                          <label class="blue">Daftar Stok Dimutasi</label>
                          <br>
                          <br>
                            <table class="table table-striped table-bordered">
                              <thead>
                              <tr>
                                <th>Kode Obat</th>
                                <th>Nama Obat</th>
                                <th>Hrg. Beli</th>
                                <th>Jumlah</th>
                                <th>Kondisi</th>
                                <th>Kode Stock</th>
                                <th>Formularium</th>
                              </tr>
                              </thead>
                              <tbody id="body_item">
                              </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      <br>
                      <br>
                      <div class="row">
                        <div class="col-xs-6">
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
                            <button type="button" id="btn_mutasi" class="btn btn-success" onclick="terima_mutasi()"><i class="fa fa-cube"></i> TERIMA MUTASI</button>
                          </p>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->                     
                    </section>
                    </form>
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
<!-- END PENCARIAN -->

<script type="text/javascript">
 
 <?php 
  if($KD_MUTASI!='')
  {
    echo "pilih_mutasi('".$KD_MUTASI."')";
  }
 ?>

 var jumlah=0;

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
    var nm_satuan=json_data.NM_SATUAN_QTY;
    var kondisi_stock=json_data.KONDISI_STOCK;
    var kd_stock=json_data.KD_STOCK;
    var nm_formularium=json_data.NM_FORMULARIUM;
    
    jumlah+=1;

              var blank_html='<tr class="cpy_item" id="item'+jumlah+'">'+
                               '<td><div id="LBL_KD_OBAT'+jumlah+'">'+kd_obat+'</div><input type="hidden" class="form-control" id="KD_OBAT'+jumlah+'" name="KD_OBAT[]" value="'+kd_obat+'"></td>'+
                               '<td><div id="LBL_NAMA_OBAT'+jumlah+'">'+nama_obat+'</div></td>'+
                               '<td><div id="LBL_HARGA_BELI'+jumlah+'">'+rupiah(harga_beli.toString(),'.')+'</div><input type="hidden" class="form-control" value="'+harga_beli+'" id="HARGA_BELI'+jumlah+'" name="HARGA_BELI[]"></td>'+
                               '<td align="right"><div id="LBL_NILAI_QTY'+jumlah+'">'+nilai_qty.toString()+' '+nm_satuan+'</div><input type="hidden" class="form-control" id="NILAI_QTY'+jumlah+'" value="'+nilai_qty+'" name="NILAI_QTY[]"></td>'+                              
                               '<td><div id="LBL_KONDISI_STOCK'+jumlah+'">'+baca_kondisi_stok(kondisi_stock)+'</div><input type="hidden" class="form-control" value="'+kondisi_stock+'" id="KONDISI_STOCK'+jumlah+'" name="KONDISI_STOCK[]"></td>'+
                               '<td align="right"><div id="LBL_KD_STOCK'+jumlah+'">'+kd_stock+'</div><input type="hidden" class="form-control" value="'+kd_stock+'" id="KD_STOCK'+jumlah+'" name="KD_STOCK[]"></td>'+
                               '<td align="right"><div id="LBL_FORMULARIUM'+jumlah+'">'+nm_formularium+'</div><input type="hidden" class="form-control" value="'+nm_formularium+'" id="NM_FORMULARIUM'+jumlah+'" name="NM_FORMULARIUM[]"></td>'+
                              '</tr>';
                $('#body_item').append(blank_html);
                total_semua();          
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
              $('#PENERIMA').val(resp.data[0].NIK);
              $('#NM_PETUGAS').val(resp.data[0].NAMA);
            }
            else
            {
              $('#PENERIMA').val('');
              $('#NM_PETUGAS').val('');
            }
          }
        });
    }
    else
    {
      $('#PENERIMA').val('');
      $('#NM_PETUGAS').val('');
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
  $('#ALL_SUB_TOTAL').val('0');
  $('#btn_mutasi').attr('disabled',false);
  $('.btn_hapus_item').attr('disabled',false);
  $('#body_item').html('');
  jumlah=0;
}

function terima_mutasi()
{
  var kode=$('#KD_MUTASI').val();
  var terima=$('#PENERIMA').val();
  if(kode!='')
  {
    if(terima!='')
    {
      clean_format();
      tunggu_start();
      $.ajax({
          url : "<?php echo base_url('index.php/gudang/terima_mutasi/terima_mutasi'); ?>",
          type : "post",
          data : $('#frm_mutasi').serialize(),
          success:function(resp)
          {
            tunggu_end();
            md_info(resp);
            pilih_mutasi($('#KD_MUTASI').val());
          }

        });
      }
    else
    {
      md_warning("Penerima belum diisi!");
    }
  }
  else
  {
    md_warning("Kode mutasi belum dipilih!");
  }
}

function cari_mutasi()
{
    $.ajax({
          url : "<?php echo base_url('index.php/gudang/terima_mutasi/tabel_mutasi'); ?>",
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
                  $('#NM_GUDANG_ASAL').val(resp.data.NM_GUDANG_ASAL);
                  $('#NM_GUDANG_TUJUAN').val(resp.data.NM_GUDANG_TUJUAN);
                  $('#URUT_NOMOR').val(resp.data.URUT_NOMOR);
                  $('#NO_MUTASI').val(resp.data.NO_MUTASI);
                  $('#TGL_MUTASI').val(resp.data.TGL_MUTASI);
                  $('#PENANGGUNG_JAWAB_MUTASI').val(resp.data.PENANGGUNG_JAWAB);
                  $('#NM_PJ_MUTASI').val(resp.data.NM_PETUGAS_PJ);
                  if(resp.data.PENERIMA!='')
                  {
                    pilih_petugas(resp.data.PENERIMA);
                  }
                  $('#KETERANGAN').val(resp.data.KETERANGAN);
                  $('#STATUS_MUTASI').val(resp.data.STATUS_MUTASI);
                  $('#body_item').html('');
                    $.ajax({
                      url : "<?php echo base_url('index.php/gudang/terima_mutasi/detail_mutasi'); ?>",
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
                  $('.btn_hapus_item').attr('disabled',true);
                  $('#btn_mutasi').attr('disabled',true);
                  md_info("Status mutasi belum selesai. tidak dapat menerima mutasi ini.");
              }
              else if(resp.data.STATUS_MUTASI=='1')
              {
                  $('.btn_hapus_item').attr('disabled',false);
                  $('#btn_mutasi').attr('disabled',false);
              }
              else
              {
                  $('.btn_hapus_item').attr('disabled',true);
                  $('#btn_mutasi').attr('disabled',true);
                  md_info("Status mutasi telah diterima.");
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

</script>