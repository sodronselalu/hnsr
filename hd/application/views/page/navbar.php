        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user"></i> <?php echo $this->session->userdata('NAMA'); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    
                    <li><a href="<?php echo base_url('index.php/auth/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    <li><a href="#" onclick="ganti_password()"><i class="fa fa-key pull-right"></i> Ganti Password</a></li>
                  </ul>
                </li>
       
                 <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-shopping-cart" title="Mutasi Masuk"></i>
                    <span id="jml_notif"></span>
                  </a>
                  <ul id="notif" class="dropdown-menu list-unstyled msg_list" role="menu">
                  </ul>
                </li>
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o" title="Permintaan Farmasi"></i>
                    <span id="jml_notif_minta"></span>
                  </a>
                  <ul id="notif_minta" class="dropdown-menu list-unstyled msg_list" role="menu">
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>

          <!-- Modal Message -->
    <div class="modal fade" id="ganti_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title blue" id="myModalLabel">Ganti Password</h4>
                </div>
            
                <div class="modal-body">
                  <form class="form-horizontal form-label-left" id="frm_ganti_password" novalidate>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Password Lama <span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="password" class="form-control" required="required" id="OLD_PASSWORD" name="OLD_PASSWORD">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Password Baru <span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="password" class="form-control" required="required" id="NEW_PASSWORD1" name="NEW_PASSWORD1">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ulangi Password <span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="password" class="form-control" required="required" id="NEW_PASSWORD2" name="NEW_PASSWORD2">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <button class="btn btn-success" type="button" onclick="simpan_password()">SIMPAN PERUBAHAN</button>
                    </div>
                  </div>
                </form>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
      function ganti_password() {
       $('#ganti_password').modal({
                    show: 'true'
                }); 
      }

      function simpan_password()
      {
        var OLD  = $('#OLD_PASSWORD').val();//wajib
        var NEW1  = $('#NEW_PASSWORD1').val();//wajib
        var NEW2  = $('#NEW_PASSWORD2').val();//wajib
    
        if(OLD=='')
        {
          md_warning('Password Lama belum diisi!');
        }
        else
        {
          if(NEW1=='')
          {
            md_warning('Password Baru belum diisi!');
          }
          else
          {
            if(NEW2=='')
            {
              md_warning('Ketik ulang Password Baru anda!');
            }
            else
            {
              if(NEW1!=NEW2)
              {
                md_warning('Ketik ulang Password Baru tidak cocok!');
              }
              else
              {
                tunggu_start();
                $.ajax({
                url : "<?php echo base_url('index.php/auth/auth/ganti_password'); ?>",
                type : "post",
                dataType : "json",
                data : $('#frm_ganti_password').serialize(),
                success:function(resp)
                {
                  tunggu_end();
                  if(resp.response=='200')
                  {
                    md_info(resp.data);
                  }
                  else if(resp.response=='201')
                  {
                    md_warning(resp.data);
                  }
                  else
                  {
                    md_warning("Password gagal diupdate");
                  }
                }
                });
              }
            }
    
          }
        }
      
      }
    </script>