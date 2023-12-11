<div class="col-md-5 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Form Daftar BHP Tindakan <small>Pendataan BHP Tindakan</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />
      <form class="form-horizontal form-label-left" id="frm_bhp_hd" novalidate>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tindakan <span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" id="KD_HD" name="KD_HD" onchange="refresh_tabel()">
              <option value="">Pilih Tindakan HD</option>
              <?php
                if(!is_null($data_hd))
                {
                  if($data_hd->response=='200')
                  {
                    foreach ($data_hd->data as $do) 
                    {
                      echo "<option value='".$do->KD_HD."'>".$do->NM_HD."</option>";
                    }
                  }
                }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Obat</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="input-group">
                    <input type="text" class="form-control" required="required" readonly="readonly" id="NAMA_OBAT" name="NAMA_OBAT" placeholder="Obat">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info" onclick="cari_obat()">Cari</button>
                    </span>
                  </div>
                  <input type="hidden" class="form-control" id="KD_OBAT" name="KD_OBAT">
                </div>
            </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah <span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" required="required" oninput="angka(this)" id="JUMLAH" name="JUMLAH" placeholder="Jumlah Kebutuhan" value="0">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Satuan  <span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" id="KD_SATUAN" name="KD_SATUAN">
            </select>
          </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="button" class="btn btn-success" onclick="simpan()">Simpan</button>
            <button type="reset" class="btn btn-warning">Batal</button>
            
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <div id="msg"></div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="col-md-7 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Data Operasi <small>Data Operasi</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
     <p class="text-muted font-13 m-b-30"></p>
      <div id="kolom_tabel">
        <?php $this->load->view('pengaturan/v_bhp_hdt'); ?>
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

<script type="text/javascript">

function cari_obat()
{
  var kode=$('#KD_HD').val();
  if(kode != '')
  {
      $('#cari_obat').modal({
        show: 'true'
      });
  }
  else
  {
     md_warning('Anda belum memilih tindakan HD!');
  } 
}

function pilih_obat(kode)
{
  if(kode!='')
  {
    $('#cari_obat').modal('hide');
    $.ajax({
      url : "<?php echo base_url('index.php/pengaturan/bhp_hd/detail_obat'); ?>",
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
          $('#KD_SATUAN').html("<option value='"+resp.data[0].KD_SATUAN_VOLUME+"'>"+resp.data[0].NM_SATUAN_VOLUME+"</option>");
        }
        else
        {
          $('#KD_OBAT').val('');
          $('#NAMA_OBAT').val('');
          $('#KD_SATUAN').html('');
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


  function edit(cmp)
  {
    var hd=$(cmp).attr('hd');
    var obat=$(cmp).attr('obat');
     detail_bhp(hd,obat);
  }

  function detail_bhp(hd,obat)
  {
    $.ajax({
      url : "<?php echo base_url('index.php/pengaturan/bhp_hd/detail_bhp_hd'); ?>",
      type : "post",
      dataType : "json",
      data : {
               KD_HD : hd,
               KD_OBAT : obat
             },
      success:function(resp)
      {

        if(resp.response=='200')
        {
          $('#KD_HD').val(resp.data.KD_HD);
          $('#KD_OBAT').val(resp.data.KD_OBAT);
          $('#NAMA_OBAT').val(resp.data.NAMA_OBAT);
          $('#JUMLAH').val(resp.data.JUMLAH);
          $('#KD_SATUAN').html("<option value='"+resp.data.KD_SATUAN+"'>"+resp.data.NM_SATUAN+"</option>");
     
        }
        else
        {
          $('#KD_HD').val('');
          $('#KD_OBAT').val('');
          $('#NAMA_OBAT').val('');
          $('#JUMLAH').val('0');
          $('#KD_SATUAN').html('');
        }
      }
    });
  }


  function simpan()
  {
    var KD_HD  = $('#KD_HD').val();//wajib
    var OBAT  = $('#KD_OBAT').val();//wajib
    var JML  = $('#JUMLAH').val();//wajib
    var SATUAN  = $('#KD_SATUAN').val();//wajib

    if(KD_HD=='')
    {
      md_warning('Tindakan HD belum diisi!');
    }
    else
    {
      if(OBAT=='')
      {
        md_warning('Nama belum diisi!');
      }
      else
      {
        if(JML=='')
        {
          md_warning('Jumlah belum diisi!');
        }
        else
        {
          if(SATUAN=='')
          {
            md_warning('Satuan belum diisi!');
          }
          else
          {
            $.ajax({
             url : "<?php echo base_url('index.php/pengaturan/bhp_hd/simpan'); ?>",
             type : "post",
             data : $('#frm_bhp_hd').serialize(),
             success:function(resp)
             {
               md_info(resp);
               refresh_tabel();
             }
            });
          }
        }

      }
    }
  
  }


  function hapus(cmp)
  {
    var kode=$(cmp).attr('hd');
    var obt=$(cmp).attr('obat');

    if(kode!='' && obt !='')
    {
      $.ajax({
        url : "<?php echo base_url('index.php/pengaturan/bhp_hd/hapus'); ?>",
        type : "post",
        data : {
            KD_HD : kode,
            KD_OBAT : obt
               },
        success:function(resp)
        {
          md_info(resp);
          refresh_tabel();
        }
      });
    }
    else
    {
      md_warning("Anda belum memilih data untuk dihapus!");
    }
    
  }

  function refresh_tabel()
  {
    tunggu_start();
    $.ajax({
      url : "<?php echo base_url('index.php/pengaturan/bhp_hd/tabel_hd'); ?>",
      type : "post",
      data : { KD_HD :$('#KD_HD').val()},
      success:function(resp)
      {
        tunggu_end();
        $('#kolom_tabel').html(resp);
      }
    });
  }

 
</script>