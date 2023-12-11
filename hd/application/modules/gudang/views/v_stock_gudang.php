
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Stok <small>Data stok gudang <?php echo $this->session->userdata('NM_GUDANG'); ?></small></h2>
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
                              <i class="fa fa-edit"></i> Stok Obat/ BHP/ Alkes

                          </h1>
                        </div>

                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-horizontal form-label-left">
                            <div class="form-group"> 
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Gudang<span class="required">*</span></label>
                              <div class="col-md-7 col-sm-9 col-xs-12">
                                <select class="form-control" required="required" id="KD_GUDANG" name="KD_GUDANG">
                                  <?php
                                    if(!is_null($data_gudang))
                                    {
                                      if($data_gudang->response=='200')
                                      {
                                        $cek="";
                                        foreach ($data_gudang->data as $dp) 
                                        {
                                          if($dp->KD_GUDANG==$this->session->userdata('KD_GUDANG'))
                                          {
                                            $cek=" selected ";
                                          }
                                          else
                                          {
                                            $cek="";
                                          }
                                          echo "<option value='".$dp->KD_GUDANG."' ".$cek.">".$dp->NM_GUDANG."</option>";
                                        }
                                      }
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                            
                            <div class="form-group"> 
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Obat<span class="required">*</span></label>
                                <div class="col-md-7 col-sm-9 col-xs-12">
                                <div class="input-group">
                                  <input type="text" class="form-control" required="required" readonly="readonly" id="NAMA_OBAT" name="NAMA_OBAT" placeholder="Obat">
         
                                  <span class="input-group-btn">
                                    <button type="button" class="btn btn-info" onclick="cari_obat('')">Cari</button>
                                  </span>
                                </div>
                                </div>
                            </div>

                            <div class="form-group"> 
                              <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-7 col-sm-9 col-xs-12">
                                <button type="button" class="btn btn-success" onclick="all_stock()">Tampilkan Semua</button>
                                <button type="button" class="btn btn-default" onclick="cari_stock_obat($('#KD_OBAT').val())">Tampilkan Hanya Obat ini</button>
                                </div>
                            </div>
                          </div>
                            <input type="hidden" class="form-control" id="KD_OBAT" name="KD_OBAT">
                          </div>

                          <div id="data_stock">    
                      </div>
                      <!-- /.row -->
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
   <!-- Obat -->
  <div class="modal fade" id="cari_obat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Obat</h4>
            </div>
            <div class="modal-body">
              <div id="data_obat">
                
              </div>
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
  var gudang=$('#KD_GUDANG').val();
  if(gudang !='')
  {
    $('#cari_obat').modal('hide');
    tunggu_start();
    $.ajax({
      url : "<?php echo base_url('index.php/gudang/stock_gudang/cari_obat'); ?>",
      type : "post",
      data : {
               KD_GUDANG : gudang
             },
      success:function(resp)
      {
        tunggu_end();
        $('#data_obat').html(resp);

         $('#cari_obat').modal({
                show: 'true'
          }); 
      }
    });
   }
   else
   {
     md_warning(' Gudang belum dipilih!');
   }
  }

function pilih_obat(kode)
{
  if(kode!='')
  {
    tunggu_start();
    $.ajax({
      url : "<?php echo base_url('index.php/gudang/stock_gudang/detail_data'); ?>",
      type : "post",
      dataType : "json",
      data : {
               KD_OBAT : kode
             },
      success:function(resp)
      {
        tunggu_end();
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

function cari_stock_obat(kode)
{
  var gudang=$('#KD_GUDANG').val();
  if(kode!='' && gudang !='')
  {
    $('#cari_obat').modal('hide');
    tunggu_start();
    $.ajax({
      url : "<?php echo base_url('index.php/gudang/stock_gudang/stock_obat'); ?>",
      type : "post",
      data : {
               KD_OBAT : kode,
               KD_GUDANG : gudang
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
     md_warning('Obat / Gudang belum dipilih!');
   }
  }

function all_stock()
{
  var gudang=$('#KD_GUDANG').val();
  if(gudang !='')
  {
    $('#cari_obat').modal('hide');
    tunggu_start();
    $.ajax({
      url : "<?php echo base_url('index.php/gudang/stock_gudang/stock_gudang'); ?>",
      type : "post",
      data : {
               KD_GUDANG : gudang
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
     md_warning(' Gudang belum dipilih!');
   }
  }

 function pilih_stock(kode)
 {
  
  tunggu_start();
       $.ajax({
          url : "<?php echo base_url('index.php/gudang/stock_gudang/cari_stock'); ?>",
          type : "post",
          dataType : "json",
          data : {
                  KD_STOCK : kode,
                },
          success:function(resp)
          {
            tunggu_end();
          }
       });
 }

function cetak()
{
  var kode=$('#KD_STOCK').val();
  var url="<?php echo base_url('index.php/percetakan/cetak_stok') ?>/";
  window.open(url+kode,'_blank');
}
</script>