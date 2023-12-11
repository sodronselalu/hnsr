<div id="ctn_layan">
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pasien <small>Cari Data Pasien</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <form id="frm_cari_pasien" method="post">
      
      <div class="row">
        <div class="col-sm-6">
          <div class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
              <div class="col-md-7 col-sm-9 col-xs-12">
                <input type="text" name="NM_PASIEN" id="NM_PASIEN" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" name="ALAMAT" id="ALAMAT" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">No RM</label>
              <div class="col-md-4 col-sm-9 col-xs-12">
                <input type="text" name="NO_CM" id="NO_CM" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Layanan</label>
                <div class="col-md-5 col-sm-9 col-xs-12">
                  <div class="control-group">
                    <div class="controls">
                      <input class="form-control has-feedback-left mydate" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="TGL_LAYAN" name="TGL_LAYAN">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Pasien</label>
              <div class="col-md-6 col-sm-9 col-xs-12">
                <select class="form-control" id="KD_JENIS" name="KD_JENIS" onchange="cari()">
                  <option value="O">Pasien Rawat Jalan</option>
                  <option value="I">Pasien Rawat Inap</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">No Register</label>
              <div class="col-md-4 col-sm-9 col-xs-12">
                <input type="text" name="NO_REG" id="NO_REG" class="form-control">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
            <div class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-6"></label>
                  <div class="col-md-6 col-sm-9 col-xs-12">
                    <button type="button" class="btn btn-warning" onclick="cari()"><i class="fa fa-search"></i> CARI</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </form>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div id="data_pasien" align="center"><?php $this->load->view('layanan/tb_pasien',array('IOL'=>'O')); ?></div>
    </div>
  </div>
</div>
<script type="text/javascript">
 function cari() 
 {
   tunggu_start();
   $.ajax({
         url : "<?php echo base_url('index.php/layanan/pelayanan_hd/cari_pasien'); ?>",
         type : "post",
         data : $('#frm_cari_pasien').serialize(),
         success:function(resp)
         {
           tunggu_end();
           $('#data_pasien').html(resp);
         }
       });
 }

   $(document).keydown(function(e) {  
         if(e.which === 114) {
            return false;   
         }
      });
</script>
</div>