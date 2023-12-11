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
<div class="row">
    <div class="col-md-12">
    <div class="x_panel">
    <div class="x_title">
        <h2>Resep Obat </h2>
        <div class="clearfix"></div>
    </div>
      <div class="x_content">
        <form id="frm_resep">
      	<div class="col-md-4">
          <div class="form-horizontal form-label-left">
          <input type="hidden" id="RESEP_KD_UNIT" name="RESEP_KD_UNIT" value="<?php echo $dt->KD_UNIT; ?>">
          <input type="hidden" id="RESEP_KD_RUANG" name="RESEP_KD_RUANG" value="<?php echo $dt->KD_RUANG; ?>">
          <input type="hidden" id="RESEP_IOL" name="RESEP_IOL" value="<?php echo $dt->IOL; ?>">
          <input type="hidden" id="RESEP_NO_REG" name="RESEP_NO_REG" value="<?php echo $dt->NO_REG; ?>">

        	<div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Dokter <span class="required">*</span></label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                    <div class="input-group">
                      <input type="text" class="form-control" required="required" value="<?php echo $nm_dpjp; ?>" readonly="readonly" id="RESEP_NM_DOKTER" name="RESEP_NM_DOKTER" placeholder="Dokter Pelaksana">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-info" onclick="cari_dokter_resep('')">Cari</button>
                      </span>
                    </div>
                    <input type="hidden" class="form-control" value="<?php echo $nik_dpjp; ?>" id="RESEP_NIK_DOKTER" name="RESEP_NIK_DOKTER">
                  </div>
            </div>
        	<div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3">Nomor <span class="required">*</span></label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                    <div class="input-group">
                      <input type="text" class="form-control" readonly="readonly" required="required" id="RESEP_INDEX_RESEP" name="RESEP_INDEX_RESEP" placeholder="Nomor Resep">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-warning" onclick="buat_resep()">Baru</button><button type="button" onclick="cari_resep()" class="btn btn-info"><span class="fa fa-search"></span> Lihat</button>
                      </span>
                    </div>
                  </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Tanggal Resep</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="control-group">
                    <div class="controls">
                      <input class="form-control has-feedback-left mydate" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="RESEP_TGL_RESEP" name="RESEP_TGL_RESEP">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Jenis</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                   <select class="form-control" name="RESEP_STATUS_RESEP" id="RESEP_STATUS_RESEP">
                     <option value="D">Resep Dalam</option>
                     <option value="L">Resep Pulang</option>
                   </select>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input type="checkbox" id="cek_racik" onclick="cek_obat_racik()">
                    <input type="hidden" id="RESEP_IS_RACIK" name="RESEP_IS_RACIK" value="T">Resep Racikan
                </div>
            </div>
           <div id="grup_racik" style="display: none;">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Kode Racikan
              </label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="input-group">
                    <input type="text" class="form-control" readonly="readonly" id="RESEP_KD_GROUP_RACIK" name="RESEP_KD_GROUP_RACIK" placeholder="Kode Racikan">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-warning" onclick="buat_racikan('')">Baru</button>
                    </span>
                  </div>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Ket Racikan</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <textarea class="form-control" required="required" id="RESEP_NM_GROUP_RACIK" name="RESEP_NM_GROUP_RACIK" placeholder="Uraian Racikan"></textarea>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Qty Item</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input type="text" class="form-control" value="0" oninput="angka(this)" required="required" id="RESEP_QTY_RACIK" name="RESEP_QTY_RACIK" placeholder="Jumlah item racikan">
                </div>
            </div>
            <div class="ln_solid"></div>
          </div>
        	<div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Obat</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="input-group">
                    <input type="text" class="form-control" required="required" readonly="readonly" id="RESEP_NAMA_OBAT" name="RESEP_NAMA_OBAT" placeholder="Obat">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info" onclick="cari_obat_resep('')">Cari</button>
                      <button type="button" class="btn btn-primary" id="btn_stock" onclick="lihat_stock_resep()"> <span class="fa fa-cubes"></span> Stock</button>
                    </span>
                  </div>
                  <input type="hidden" class="form-control" id="RESEP_KD_OBAT" name="RESEP_KD_OBAT">
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Pakai</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <select class="form-control" id="RESEP_KD_ATURAN_PAKAI" name="RESEP_KD_ATURAN_PAKAI">
                        <?php
                          if(!is_null($data_aturan_pakai))
                          {
                            if($data_aturan_pakai->response=='200')
                            {
                              foreach ($data_aturan_pakai->data as $wp) {
                                echo "<option value='".$wp->KD_ATURAN_PAKAI."'>".$wp->NM_ATURAN_PAKAI."</option>";
                              }
                            }
                          }
                        ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">X </label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="input-group">
                      <span class="input-group-btn">
                        <input type="text" style="width: 50px;" class="form-control" value="1" id="RESEP_DOSIS_PAKAI" name="RESEP_DOSIS_PAKAI">
                      </span>
                      <input type="text" class="form-control" name="RESEP_NM_DOSIS_PAKAI" id="RESEP_NM_DOSIS_PAKAI">
                  </div>
                </div>     
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Jumlah</label>
              <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="input-group">
                  <input type="text" class="form-control" onblur="ganti_isi(this,'1');" oninput="angka(this); " value="1" onkeyup="" required="required" id="RESEP_JUMLAH" name="RESEP_JUMLAH" placeholder="">
                  <span class="input-group-btn">
                    <div disabled class="btn btn-default NM_SATUAN_VOLUME">---</div>
                  </span>
                </div>
              </div>
            </div>
        <input type="hidden" id="RESEP_KD_SATUAN" name="RESEP_KD_SATUAN">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Mulai</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="control-group">
                    <div class="controls">
                      <input class="form-control has-feedback-left mydate" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="RESEP_TGL_AWAL" name="RESEP_TGL_AWAL">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Sampai</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="control-group">
                    <div class="controls">
                      <input class="form-control has-feedback-left mydate" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="RESEP_TGL_AKHIR" name="RESEP_TGL_AKHIR">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Rute</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <select class="form-control" id="RESEP_KD_CARA_PEMBERIAN_OBAT" name="RESEP_KD_CARA_PEMBERIAN_OBAT">
                        <?php
                          if(!is_null($data_cara_pakai))
                          {
                            if($data_cara_pakai->response=='200')
                            {
                              foreach ($data_cara_pakai->data as $wp) {
                                echo "<option value='".$wp->KD_CARA_PEMBERIAN_OBAT."'>".$wp->NM_CARA_PEMBERIAN_OBAT."</option>";
                              }
                            }
                          }
                        ?>
                  </select>
                </div>
            </div>
                 <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Waktu</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <select class="form-control" id="RESEP_KD_WAKTU_OBAT" name="RESEP_KD_WAKTU_OBAT">
                          <?php
                           if(!is_null($data_waktu_pakai))
                           {
                             if($data_waktu_pakai->response=='200')
                             {
                               foreach ($data_waktu_pakai->data as $wp) {
                                 echo "<option value='".$wp->KD_WAKTU_OBAT."'>".$wp->NM_WAKTU_OBAT."</option>";
                               }
                             }
                           }
                          ?>
                        </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Instruksi Tambahan</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <textarea type="text" rows="2" class="form-control" id="RESEP_CATATAN" name="RESEP_CATATAN" placeholder=""></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <button type="button" class="btn btn-success" onclick="simpan_resep()">Simpan</button>
                      </div>
                  </div> 
              </div>
        </div>
              <div class="col-md-8">
                <div id="kolom_tabel_resep">
                  <?php $this->load->view("layanan/tb_resep_pasien"); ?>
                </div>
              </div>
        </form>
    </div>
</div>
</div>
</div>

  <!-- Obat -->
  <div class="modal fade" id="cari_obat_resep" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Obat</h4>
            </div>
            <div class="modal-body">
              <?php $this->load->view('cari/cari_obat_resep'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_obat('')">Tutup</button>
            </div>
        </div>
    </div>
  </div>

  <!-- Stok -->
  <div class="modal fade" id="cari_stock_resep" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="lbl_stock_obat">Stok Obat</h4>
            </div>
            <div class="modal-body">
              <div id="DT_STOCK_OBAT"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_stock_obat('')">Tutup</button>
            </div>
        </div>
    </div>
  </div>



  <!-- PETUGAS2 --> 
  <div class="modal fade" id="cari_dokter_resep" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Dokter Peresep</h4>
            </div>
            <div class="modal-body">
              <?php $this->load->view('cari/cari_dokter'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_petugas2('')">Tutup</button>
            </div>    
        </div>
    </div>
  </div>
<!-- -->

<script type="text/javascript">

$(document).ready(function(){
	init_autocomplete_ket_resep();
	init_autocomplete_dosis();
});

function cari_dokter_resep()
 {
   $('#cari_dokter_resep').modal({
        show: 'true'
    }); 
 }

 function pilih_dokter(kode)
 {
   if(kode!='')
   {
      $('#cari_dokter_resep').modal('hide');
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
              $('#RESEP_NIK_DOKTER').val(resp.data[0].NIK);
              $('#RESEP_NM_DOKTER').val(resp.data[0].NAMA);
              
            }
            else
            {
              $('#RESEP_NIK_DOKTER').val('');
              $('#RESEP_NM_DOKTER').val('');
            }
          }
        });
    }
    else
    {
      $('#RESEP_NIK_DOKTER').val('');
      $('#RESEP_NM_DOKTER').val('');
    }
 }

function init_autocomplete_ket_resep() {
if ("undefined" != typeof $.fn.autocomplete) {

var a = {
"Sampai Habis" : "",
"Sampai Habis, ANTIBIOTIK" : "",
"Kalau Perlu" : "",
"Sampai Habis, Dilarutkan dlm Sedikit Air" : "",
"Sampai Habis, Dilarutkan dlm Air/Susu/Makanan" : "",
"Kalau Perlu, Sesudah BAB" : ""
};
var  b = $.map(a, function (c, d) 
            {
             return {
                      value: d,
                      data: c
                    }
            });

      $("#RESEP_KETERANGAN").autocomplete({
         lookup: b
      });
   }

}

function init_autocomplete_dosis() {
if ("undefined" != typeof $.fn.autocomplete) {

var a = {
"Tablet (tab)" : "tab",
"Sendok makan" : "sdm",
"Sendok obat" : "sdo",
"Sachet" : ""
};
var  b = $.map(a, function (c, d) 
            {
             return {
                      value: d,
                      data: c
                    }
            });

      $("#RESEP_NM_DOSIS_PAKAI").autocomplete({
         lookup: b
      });
   }

}

 function cek_obat_racik()
 {
   if($('#cek_racik').is(":checked"))
   {
     $('#RESEP_IS_RACIK').val('T');
     $('#grup_racik').show();
   }
   else
   {
     $('#RESEP_IS_RACIK').val('F');
   	 $('#grup_racik').hide();
   }
  
 }

 function buat_resep()
 {
    tunggu_start();
    $.ajax({
        url : "<?php echo base_url('index.php/layanan/pelayanan_hd/baru_resep'); ?>",
        type : "post",
        dataType : "json",
        data : {INDEX_RESEP:"0"},
        success:function(resp)
        {
          tunggu_end();   
            if(resp.code=='200')
            {
              $('#RESEP_INDEX_RESEP').val(resp.kode);
            }
            else
            {
              $('#RESEP_INDEX_RESEP').val(resp.kode);
            }
        }
    });
 }

 function buat_racikan()
 {
    tunggu_start();
    $.ajax({
        url : "<?php echo base_url('index.php/layanan/pelayanan_hd/baru_racikan'); ?>",
        type : "post",
        dataType : "json",
        data : {KD_GROUP_RACIK:"0"},
        success:function(resp)
        {
          tunggu_end();   
            if(resp.code=='200')
            {
              $('#RESEP_KD_GROUP_RACIK').val(resp.kode);
            }
            else
            {
              $('#RESEP_KD_GROUP_RACIK').val(resp.kode);
            }
        }
    });
 }

 function cari_obat_resep()
 {
  var kode=$('#RESEP_INDEX_RESEP').val();
  var dokter =$('#RESEP_NIK_DOKTER').val();
  if(kode != '')
  {
    if(dokter != '')
    {
     
      $('#cari_obat_resep').modal({
        show: 'true'
      });
    }
    else
    {
      md_warning('Dokter pemberi resep belum diisi!');
    }
  }
  else
  {
     md_warning('Anda belum membuat kode jual!');
  } 

 }

function pilih_obat_resep(kode)
{
  if(kode!='')
  {
    $('#cari_obat_resep').modal('hide');

    $.ajax({
      url : "<?php echo base_url('index.php/layanan/pelayanan_hd/detail_obat'); ?>",
      type : "post",
      dataType : "json",
      data : {
               KD_OBAT : kode
             },
      success:function(resp)
      {

        if(resp.response=='200')
        {
          $('#RESEP_KD_OBAT').val(resp.data[0].KD_OBAT);
          $('#RESEP_NAMA_OBAT').val(resp.data[0].NAMA_OBAT);         
          $('.NM_SATUAN_VOLUME').text(resp.data[0].NM_SATUAN_VOLUME); 
          $('#RESEP_KD_SATUAN').val(resp.data[0].KD_SATUAN_VOLUME); 
          $('#RESEP_NM_DOSIS_PAKAI').val(resp.data[0].NM_SATUAN_VOLUME); 
          $('#RESEP_JUMLAH').val('1');

        }
        else
        {
          $('#RESEP_KD_OBAT').val('');
          $('#RESEP_NAMA_OBAT').val('');
          $('#CARI_HARGA_JUAL').val('');
          $('#RESEP_NM_DOSIS_PAKAI').val('');
          $('#RESEP_KD_SATUAN').val('');
          $('.NM_SATUAN_VOLUME').text('---');
          $('#RESEP_JUMLAH').val('0');
        }
      }
    });
   }
   else
   {
      $('#RESEP_KD_OBAT').val('');
      $('#RESEP_NAMA_OBAT').val('');
      $('#CARI_HARGA_JUAL').val('');
      $('#RESEP_NM_DOSIS_PAKAI').val('');
      $('.NM_SATUAN_VOLUME').text('---');
      $('#RESEP_JUMLAH').val('0');
   }
  }

function lihat_stock_resep()
{
    var hm="";
    $.ajax({
      url : "<?php echo base_url('index.php/layanan/pelayanan_hd/stock_obat'); ?>",
      type : "post",
      dataType : "json",
      data : {
               KD_OBAT : $('#RESEP_KD_OBAT').val()
             },
      success:function(resp)
      {

        if(resp.response=='200')
        {
           $.each( resp.data, function(i) {
              hm+="<b>"+resp.data[i].NM_GUDANG+" Jumlah : "+resp.data[i].SISA+"</b>";
          });
          
          $('#DT_STOCK_OBAT').html(hm);

           $('#cari_stock_resep').modal({
                show: 'true'
            }); 
        }
        else
        {
          md_warning("Stock tidak tersedia!");
        }
        
      }
    });
  
  }

function lihat_resep(kode)
{

  if(kode!='')
  {

    $.ajax({
      url : "<?php echo base_url('index.php/layanan/pelayanan_hd/detail_resep'); ?>",
      type : "post",
      dataType : "json",
      async : false,
      data : {
               INDEX_RESEP : kode
             },
      success:function(resp)
      {

        if(resp.response=='200')
        {
          $('#RESEP_INDEX_RESEP').val(resp.data.INDEX_RESEP);
          $('#RESEP_NIK_DOKTER').val(resp.data.NIK_DOKTER);
          $('#RESEP_NM_DOKTER').val(resp.data.NM_DOKTER_PERESEP);         
          $('#RESEP_TGL_RESEP').val(resp.data.TGL_RESEP_F);
          $('#RESEP_STATUS_RESEP').val(resp.data.STATUS_RESEP);
          if(resp.data.IS_RACIK=='T')
          {
            $('#cek_racik').prop('checked',true);
          }
          else
          {
            $('#cek_racik').prop('checked',false);
          }
          reload_resep_obat();

        }
        else
        {
          $('#RESEP_INDEX_RESEP').val('');
          $('#RESEP_NIK_DOKTER').val('');
          $('#RESEP_NM_DOKTER').val('');
          $('#RESEP_TGL_RESEP').val('');
          $('#RESEP_IS_RACIK').prop('checked',false);
        }
      }
    });
   }
   else
   {
      $('#RESEP_INDEX_RESEP').val('');
      $('#RESEP_NIK_DOKTER').val('');
      $('#RESEP_NM_DOKTER').val('');
      $('#RESEP_TGL_RESEP').val('');
      $('#RESEP_IS_RACIK').prop('checked',false);
   }
   
  }

  function reset_resep()
  {
    $('#RESEP_IS_RACIK').prop('checked',false);
    $('#RESEP_KD_OBAT').val('');
    $('#RESEP_NAMA_OBAT').val('');
    $('#RESEP_KD_ATURAN_PAKAI').val('');
    $('#RESEP_DOSIS_PAKAI').val('');
    $('#RESEP_NM_DOSIS_PAKAI').val('');
    $('#RESEP_JUMLAH').val('');
    $('#RESEP_KD_SATUAN').val('');
    $('.NM_SATUAN_VOLUME').text('---');
    $('#RESEP_KD_CARA_PEMBERIAN_OBAT').val('');
    $('#RESEP_KD_WAKTU_OBAT').val('');
    $('#RESEP_CATATAN').val('');
    $('#RESEP_IS_RACIK').prop('checked',false);
  }

 function simpan_resep()
 {

  tunggu_start();
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/simpan_resep'); ?>",
       type : "post",
       data : $('#frm_resep').serialize(),
       success:function(resp)
       {
          tunggu_end();
          md_info(resp);
          reset_resep();
          reload_resep_obat();
       }
     });
 }

 function cari_resep()
 {
  tunggu_start();
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/reload_resep'); ?>",
       type : "post",
       data : {
                NO_REG : $('#NO_REG').val()
              },
       success:function(resp)
       {
        tunggu_end();
          $('#kolom_tabel_resep').html(resp);  
       }
     });
 } 

 function reload_resep_obat()
 {
  tunggu_start();
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/reload_obat_resep'); ?>",
       type : "post",
       data : {
                INDEX_RESEP : $('#RESEP_INDEX_RESEP').val(),
              },
       success:function(resp)
       {
        tunggu_end();
          $('#kolom_tabel_resep').html(resp);  
       }
     });
 }



 function edit_obat_resep(cmp)
{
  var kode=$(cmp).attr('index');
  var obat=$(cmp).attr('obat');

    $.ajax({
      url : "<?php echo base_url('index.php/layanan/pelayanan_hd/detail_resep_obat'); ?>",
      type : "post",
      dataType : "json",
      async : false,
      data : {
               INDEX_RESEP : kode,
               KD_OBAT : obat
             },
      success:function(resp)
      {

        if(resp.response=='200')
        {
          $('#RESEP_KD_OBAT').val(resp.data.KD_OBAT);
          $('#RESEP_NAMA_OBAT').val(resp.data.NAMA_OBAT);
          $('#RESEP_KD_ATURAN_PAKAI').val(resp.data.KD_ATURAN_PAKAI);
          $('#RESEP_DOSIS_PAKAI').val(resp.data.DOSIS_PAKAI);         
          $('#RESEP_NM_DOSIS_PAKAI').val(resp.data.NM_DOSIS_PAKAI);
          $('#RESEP_JUMLAH').val(resp.data.JUMLAH);
          $('#RESEP_KD_SATUAN').val(resp.data.KD_SATUAN);
          $('.NM_SATUAN_VOLUME').text(resp.data.NM_SATUAN_VOLUME);
          $('#RESEP_TGL_AWAL').val(resp.data.TGL_AWAL_F);
          $('#RESEP_TGL_AKHIR').val(resp.data.TGL_AKHIR_F);
          $('#RESEP_KD_CARA_PEMBERIAN_OBAT').val(resp.data.KD_CARA_PEMBERIAN_OBAT);
          $('#RESEP_KD_WAKTU_OBAT').val(resp.data.KD_WAKTU_OBAT);
          $('#RESEP_CATATAN').val(resp.data.CATATAN);
          if(resp.data.IS_RACIK=='T')
          {
            cek_obat_racik();
            $('#RESEP_KD_GROUP_RACIK').val(resp.data.KD_GROUP_RACIK);
            $('#RESEP_NM_GROUP_RACIK').val(resp.data.NM_GROUP_RACIK);
            $('#RESEP_QTY_RACIK').val(resp.data.QTY_RACIK);
          }
          else
          {
            cek_obat_racik();
            $('#RESEP_KD_GROUP_RACIK').val('');
            $('#RESEP_NM_GROUP_RACIK').val('');
            $('#RESEP_QTY_RACIK').val('');
          }

        }
        else
        {
          $('#RESEP_KD_OBAT').val('');
          $('#RESEP_NAMA_OBAT').val('');
          $('#RESEP_KD_ATURAN_PAKAI').val('');
          $('#RESEP_DOSIS_PAKAI').val('');
          $('#RESEP_NM_DOSIS_PAKAI').val('');
          $('#RESEP_JUMLAH').val('');
          $('#RESEP_KD_SATUAN').val('');
          $('.NM_SATUAN_VOLUME').text('--');
          $('#RESEP_TGL_AWAL').val('');
          $('#RESEP_TGL_AKHIR').val('');
          $('#RESEP_KD_CARA_PEMBERIAN_OBAT').val('');
          $('#RESEP_KD_WAKTU_OBAT').val('');
          $('#RESEP_CATATAN').val('');
          $('#RESEP_IS_RACIK').prop('checked',false);
        }
      }
    });
   }

function hapus_obat_resep(cmp)
{
  var kode=$(cmp).attr('index');
  var obat=$(cmp).attr('obat');

    $.ajax({
      url : "<?php echo base_url('index.php/layanan/pelayanan_hd/hapus_resep_obat'); ?>",
      type : "post",
      data : {
               INDEX_RESEP : kode,
               KD_OBAT : obat
             },
      success:function(resp)
      {
       reload_resep_obat();
      }
    });
   }

</script>
<?php
}
 ?>