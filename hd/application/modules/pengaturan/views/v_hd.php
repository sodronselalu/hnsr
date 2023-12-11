<div class="col-md-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Form Daftar Tindakan HD <small>Pendataan Tindakan HD</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />
      <form class="form-horizontal form-label-left" id="frm_hd" novalidate>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode  <span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" required="required" id="KD_HD" name="KD_HD" placeholder="Kode" onblur="detail(this.value)">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama <span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" required="required" id="NM_HD" name="NM_HD" placeholder="Nama">
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
<div class="col-md-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Data Tindakan HD <small>Data Tindakan HD</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
     <p class="text-muted font-13 m-b-30"></p>
      <div id="kolom_tabel">
        <?php $this->load->view('pengaturan/v_hdt'); ?>
      </div>
   </div>
  </div>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title blue" id="myModalLabel">Konfirmasi Penghapusan</h4>
                </div>
            
                <div class="modal-body">
                    <p>Anda akan menghapus data ini. Lanjutkan menghapus data?</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-ok" data-dismiss="modal" id="btn_hapus" value="" onclick="do_hapus(this.value)">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
  var tk=0;
  function edit(kode)
  {
     detail(kode);
  }

  function detail(kode)
  {
    $.ajax({
      url : "<?php echo base_url('index.php/pengaturan/hd/detail_hd'); ?>",
      type : "post",
      dataType : "json",
      data : {
               KD_HD : kode,
             },
      success:function(resp)
      {

        if(resp.response=='200')
        {
          $('#KD_HD').val(resp.data.KD_HD);
          $('#NM_HD').val(resp.data.NM_HD);
        }
        else
        {
          $('#NM_HD').val('');
        }
      }
    });
  }


  function simpan()
  {
    var KD  = $('#KD_HD').val();//wajib
    var NM  = $('#NM_HD').val();//wajib

    if(KD=='')
    {
      md_warning('Kode belum diisi!');
    }
    else
    {
      if(NM=='')
      {
        md_warning('Nama belum diisi!');
      }
      else
      {
            $.ajax({
             url : "<?php echo base_url('index.php/pengaturan/hd/simpan'); ?>",
             type : "post",
             data : $('#frm_hd').serialize(),
             success:function(resp)
             {
               md_info(resp);
               refresh_tabel();
             }
            });

      }
    }
  
  }


  function hapus(kode)
  {
    $('#btn_hapus').val(kode);
    $('#confirm-delete').modal({
        show: 'true'
    }); 
  }

  function do_hapus(kode)
  {
    if(kode!='')
    {
      $.ajax({
        url : "<?php echo base_url('index.php/pengaturan/hd/hapus'); ?>",
        type : "post",
        data : {
            KD_HD : kode
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
    $.ajax({
      url : "<?php echo base_url('index.php/pengaturan/hd/tabel_hd'); ?>",
      type : "post",
      data : {KD_HD:''},
      success:function(resp)
      {
        $('#kolom_tabel').html(resp);
      }
    });
  }

 
</script>