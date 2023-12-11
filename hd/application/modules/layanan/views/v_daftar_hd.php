<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Daftar Kunjungan HD <small>Pendataan pasien HD</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />
      <form class="form-horizontal form-label-left" id="frm_kunjungan" novalidate>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Awal</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
              <div class="control-group">
                <div class="controls">
                  <input class="form-control has-feedback-left mydate" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="TGL_AWAL" name="TGL_AWAL">
                  <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                  <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                </div>
              </div>
            </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Akhir</label>
            <div class="col-md-5 col-sm-9 col-xs-12">
              <div class="control-group">
                <div class="controls">
                  <input class="form-control has-feedback-left mydate" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="TGL_AKHIR" name="TGL_AKHIR">
                  <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                  <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                </div>
              </div>
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="button" class="btn btn-success" onclick="cari()">Cari</button>
            
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Data Pasien HD <small>Data kunjungan pasien hd</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
     <p class="text-muted font-13 m-b-30"></p>
      <div id="kolom_tabel">
      </div>
   </div>
  </div>
</div>

  <div class="modal fade" id="detail_hd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Data Riwayat Pelayanan Hemodialisa</h4>
            </div>
            <div class="modal-body">
              <div id="data_hd"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
  </div>
  


<script type="text/javascript">
  
  function cari()
  {
    $.ajax({
      url : "<?php echo base_url('index.php/layanan/daftar_kunjungan_hd/cari_hd'); ?>",
      type : "post",
      data : $('#frm_kunjungan').serialize(),
      success:function(resp)
      {
        $('#kolom_tabel').html(resp);
      }
    });
  }

  function detail_hd(cmp)
  {
    var kode =$(cmp).attr('urut');
    var reg = $(cmp).attr('reg');
    $.ajax({
      url : "<?php echo base_url('index.php/layanan/daftar_kunjungan_hd/detail_hd'); ?>",
      type : "post",
      data : { 
                URUT_HD : kode,
                NO_REG : reg
             },
      success:function(resp)
      {
        $('#data_hd').html(resp);

         $('#detail_hd').modal({
              show: 'true'
          }); 
      }
    });
  }

 
</script>