<?php $this->load->view($header); ?>
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url(); ?>" class="site_title"><?php  ?> <img src="<?php echo asset_url('asset/img/logo.png') ?>" width="40px" height="40px"> <?php echo HEADER_SORT_TITLE; ?></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info 
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2></h2>
              </div>
            </div>-->
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php $this->load->view($sidebar); ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('index.php/auth/logout') ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php $this->load->view($navbar); ?>
        <!-- /top navigation -->
        <!-- page content -->
      <div class="right_col" role="main">
          <!-- top tiles -->
        <div class="row tile_count">  
            <div class="col-md-12 col-sm-12 col-xs-12 tile_stats_count">
              <div class="count green"><i class="fa fa-home"></i> <?php echo HEADER_SORT_TITLE;//$this->session->userdata('NM_GUDANG'); ?></div>
              <span class="count_bottom"><i class="green">Assalamu'alaikum.. <?php echo $this->session->userdata('NAMA'); ?></i><i> Terakhir login : <?php echo $this->session->userdata('LAST_LOGIN'); ?></i></span>
              <br><b class="red blink">JANGAN LUPA LOGOUT SETELAH SELESAI!</b>
            </div>
        </div>
          <!-- /top tiles -->
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="row">
                 <?php  $this->load->view($content); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->
    <!-- footer content -->
    <?php $this->load->view($footer); ?>
    <!-- /footer content -->


    <!-- Modal Message -->
    <div class="modal fade" id="md_msg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" >
          <div id="md_type" class="modal-content">
              <div class="modal-header panel-heading">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title white">Information</h4>
              </div>
              <div class="modal-body">
                <h5 id="md_msg_info"></h5>
              </div>                   
          </div>
      </div>
    </div>
    <div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="mdl_wait">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <span class="fa fa-spinner fa-spin" style="font-size: 50px; color: white;"></span>
        <br>
        <br>
        <div class="center" id="ctn_loader" style="color: white;"> Harap Menunggu...</div>
    </div>
  </div>
	<?php $this->load->view($js); ?>
  </body>
 </html>