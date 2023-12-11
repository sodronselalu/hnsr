            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Main Menu</h3>
                <ul class="nav side-menu">
                  <?php 
                      $array_menu=array();
                      if(array_key_exists(APP_ID, $this->session->userdata('AKSES')))
                      {
                         $array_menu=$this->session->userdata('AKSES')[APP_ID]; 
                      }
                    ?>
                  <?php if(cek_menu("pengaturan",$array_menu)){ ?>
                  <li><a><i class="fa fa-archive"></i> Pengaturan HD <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if(cek_menu("tindakan_hd",$array_menu)){ ?><li><a href="<?php echo base_url('index.php/pengaturan/hd'); ?>">Tindakan HD</a></li><?php } ?>
                      <?php if(cek_menu("bhp_hd",$array_menu)){ ?><li><a href="<?php echo base_url('index.php/pengaturan/bhp_hd'); ?>">BHP Tindakan HD</a></li><?php } ?>
                    </ul>
                  </li>
                  <?php } ?>

                  <?php if(cek_menu("layanan_hd",$array_menu)){ ?>
                  <li><a><i class="fa fa-archive"></i> Layanan HD <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if(cek_menu("pelayanan_hd",$array_menu)){ ?><li><a href="<?php echo base_url('index.php/layanan/pelayanan_hd'); ?>">Pelayanan Pasien HD</a></li><?php } ?>
                      
                      <?php if($this->session->userdata('NIK')=='0'){ ?>
                       <?php if(cek_menu("rekam_medis",$array_menu)){ ?><li><a href="<?php echo base_url('index.php/rm/rekam_medis'); ?>">Rekam Medis</a></li><?php } ?>
                      <?php } ?>


                      <?php if(cek_menu("tagihan_hd",$array_menu)){ ?><li><a href="<?php echo base_url('index.php/tagihan/tagihan_hd'); ?>">Tagihan Pasien HD</a></li><?php } ?>
                      <?php if(cek_menu("daftar_kunjungan_hd",$array_menu)){ ?><li><a href="<?php echo base_url('index.php/layanan/daftar_kunjungan_hd'); ?>">Daftar Kunjungan HD</a></li><?php } ?>
                    </ul>
                  </li>
                  <?php } ?>

                <?php if(cek_menu("administrasi_gudang",$array_menu)){ ?>
                  <li><a><i class="fa fa-edit"></i>Gudang <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if(cek_menu("mutasi",$array_menu)){ ?><li><a href="<?php echo base_url('index.php/gudang/mutasi'); ?>">Mutasi Stok</a></li><?php } ?>
                      <?php if(cek_menu("penerimaan_mutasi",$array_menu)){ ?><li><a href="<?php echo base_url('index.php/gudang/terima_mutasi'); ?>">Penerimaan Mutasi Stok</a></li><?php } ?>
                      <?php if(cek_menu("data_stock",$array_menu)){ ?><li><a href="<?php echo base_url('index.php/gudang/stock_gudang'); ?>">Data Stock</a></li><?php } ?>
                      <?php if(cek_menu("pakai_bahan",$array_menu)){ ?><li><a href="<?php echo base_url('index.php/gudang/pakai_bahan'); ?>">Penggunaan Bahan</a></li><?php } ?>
                      <?php if(cek_menu("permintaan_farmasi",$array_menu)){ ?><li><a href="<?php echo base_url('index.php/gudang/permintaan_farmasi'); ?>">Permintaan Bahan</a></li><?php } ?>
                    </ul>
                  </li>
                   <?php } ?>
                </ul>
              </div>
            </div>