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
<form id="frm_tindakan_pasien">
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Tindakan Pasien <small>Halaman Tindakan Pasien</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <section class="content invoice">
          <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
            <div class="col-md-2">
              <div class="profile_img">
                <div id="crop-avatar">
                  <img class="img-responsive avatar-view" src="<?php echo asset_url('asset/img/'.icon_gender($dt->JENIS_KELAMIN)) ?>" alt="Avatar" title="<?php echo $dt->NM_PASIEN; ?>">
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <h4><?php echo $dt->NM_PASIEN; ?></h4>
              <ul class="list-unstyled user_data">
                <li>
                  <i class="fa fa-map-marker user-profile-icon"></i> <?php echo $dt->ALAMAT; ?>
                </li>
                <li class="m-top-xs">
                  <i class="fa fa-external-link user-profile-icon"></i>
                  No. RM : <?php echo $dt->NO_CM; ?>
                </li>
                <li class="m-top-xs">
                  <i class="fa fa-external-link user-profile-icon"></i>
                  No. Reg :  <?php echo $dt->NO_REG; ?>
                </li>
                <li>
                  <i class="fa fa-external-link user-profile-icon"></i>
                  Layanan : <?php echo iol($dt->IOL); ?>
                </li>
                   <li>
                  <button type="button" class="btn btn-primary btn-sm" value="<?php echo $dt->NO_CM; ?>" onclick="identitas_pasien(this.value)">Lihat Identitas Pasien</button>
                </li>
              </ul>
            </div>
            <div class="col-md-5">
            <?php if($dt->IOL=='O'){ ?>
            <h4>Pemeriksaan Pasien</h4>
            <ul class="list-unstyled user_data">
              <li>
                <p>Unit : <?php echo $dt->NM_UNIT; ?></p>
              </li>
              <li>
                <p>Dokter : <?php echo $dt->NM_DOKTER; ?></p>
              </li>
              <li>
                <p>Asuransi : <?php echo $dt->NM_ASURANSI; ?></p>
              </li>
              <li>
                <p>Status : <?php echo status_periksa($dt->STATUS_PERIKSA); ?></p>
              </li>
            </ul>
            <?php } ?>
            <?php if($dt->IOL=='I'){ ?>
            <h4>Pemeriksaan Pasien</h4>
            <ul class="list-unstyled user_data">
              <li>
                <p>Kelas : <?php echo $dt->NM_KELAS; ?></p>
              </li>
              <li>
                <p>Ruang : <?php echo $dt->NM_RUANG; ?></p>
              </li>
              <li>
                <p>Bed : <?php echo $dt->NO_BED; ?></p>
              </li>
              <li>
                <p>Asuransi : <?php echo $dt->NM_ASURANSI; ?></p>
              </li>
            </ul>
            <?php } ?>
           </div>
          </div>
          <br/>
          <br/>
          <br/>
          <br/>
          <br/>
          <input type="hidden" id="KD_UNIT" name="KD_UNIT" value="<?php echo $dt->KD_UNIT; ?>">
          <input type="hidden" id="KD_RUANG" name="KD_RUANG" value="<?php echo $dt->KD_RUANG; ?>">
          <input type="hidden" id="IOL" name="IOL" value="<?php echo $dt->IOL; ?>">
          <input type="hidden" id="INDEX_RESEP" name="INDEX_RESEP" value="0">
          <input type="hidden" id="NO_REG" name="NO_REG" value="<?php echo $dt->NO_REG; ?>">
        </section>
      </div>
    </div>
  </div>
</div>


<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-bars"></i> Layanan <small>Layanan Hemodialisa</small></h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="col-md-4">
           <div class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Tgl Awal</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="control-group">
                    <div class="controls">
                      <input class="form-control has-feedback-left mydatetime" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="TGL_HD_AWAL" name="TGL_HD_AWAL">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Tgl Akhir</label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <div class="control-group">
                    <div class="controls">
                      <input class="form-control has-feedback-left mydatetime" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="TGL_HD_AKHIR" name="TGL_HD_AKHIR">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" id="URUT_HD" name="URUT_HD" value="">

             
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">Cito </label>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <input type="checkbox" id="IS_CITO" name="IS_CITO" value="T">
                </div>
            </div>  

    
     

            </div>  
        <div class="form-group">
             
              <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <button type="button" class="btn btn-success" onclick="simpan_hd()">Simpan Pasien HD</button>
                </div>


             <div class="col-md-3 col-sm-3 col-xs-3">
                  <button type="button" class="btn btn-danger" title="Rujuk Pasien?" reg="'.$dt->NO_REG.'" dr="'.$dt->NIK_DOKTER.'" unit="'.$dt->KD_UNIT.'" sep="'.$dt->NO_SEP.'" cm="'.$dt->NO_CM.'" onclick="buat_skdp(this)">SKDP/Kontrol</button>
                </div>
          </div>
    </div>
    <div class="col-md-4">
     <b>DIAGNOSA PASIEN</b> <button type="button" class="btn btn-sm btn-primary btn-round" onclick="buka_diagnosa()"><span class="fa fa-plus"></span></button>
      <div id="data_diagnosa">
        <?php 
      if(!is_null($data_diagnosa))
      {
        if($data_diagnosa->response=='200')
        {
          foreach ($data_diagnosa->data as $dd) 
          {
            echo "<p><b>".$dd->KD_PENYAKIT."</b> ".$dd->NM_PENYAKIT."</p>";
          }
        }
      }

       ?></div>
    </div>
    <div class="col-md-4">
     <b>PROSEDUR PASIEN</b> <button type="button" class="btn btn-sm btn-primary btn-round" onclick="buka_tindakan()"><span class="fa fa-plus"></span></button>
        <div id="data_tindakan">
        <?php 
      if(!is_null($data_tindakan))
      {
        if($data_tindakan->response=='200')
        {
          foreach ($data_tindakan->data as $dtn) 
          {
            echo "<p><b>".$dtn->KD_TINDAKAN."</b> ".$dtn->NM_TINDAKAN."</p>";
          }
        }
      }
       ?></div>
    </div>
  </div>
</div>

<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-bars"></i> Riwayat HD Pasien <small>Riwayat HD Pasien</small></h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div id="data_pakai_layan"><?php $this->load->view('layanan/v_tindakant'); ?></div>
    <br>
    
  </div>
</div>

</form>


<div class="row">
  <div class="col-md-12">

       <div id="resep">
       <?php $this->load->view('layanan/v_resep',$for_resep); ?> 
       </div>  
  </div>
</div>

<div class="row">
  <div class="col-md-12">

       <div id="penunjang">
       <div class="row">
    <div class="col-md-12">
    <div class="x_panel">
    <div class="x_title">
        <h2>Penunjang Pasien </h2>
        <div class="clearfix"></div>
    </div>
      <div class="x_content">
        
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active">
              <a href="#tab_operasi" role="tab" id="operasi-tab" data-toggle="tab" aria-expanded="false"><b>Operasi</b></a>
            </li>
            <li role="presentation">
              <a href="#tab_lab" role="tab" id="lab-tab" data-toggle="tab" aria-expanded="true"><b>Laboratorium</b></a>
            </li>
            <li role="presentation">
              <a href="#tab_rad" role="tab" id="rad-tab" data-toggle="tab" aria-expanded="false"><b>Radiologi</b></a>
            </li>
            <li role="presentation">
              <a href="#tab_usg" role="tab" id="usg-tab" data-toggle="tab" aria-expanded="false"><b>USG RO</b></a>
            </li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_operasi" aria-labelledby="operasi-tab">     
              <?php $this->load->view('layanan/v_op',$for_op); ?>               
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_lab" aria-labelledby="lab-tab">  
              <?php $this->load->view('layanan/v_lab',$for_lab); ?>                     
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_rad" aria-labelledby="rad-tab">        
              <?php $this->load->view('layanan/v_rad',$for_rad); ?>                  
            </div>
           <div role="tabpanel" class="tab-pane fade" id="tab_usg" aria-labelledby="usg-tab">  
            <?php $this->load->view('layanan/v_usg',$for_usg); ?>                    
            </div>
          </div>
        </div>
<button class="btn btn-warning" type="button" onclick="go_tagihan()"><span class="fa fa-money"></span> Resume Tagihan</button>    </div>
</div>
</div>
</div>
       </div>  
  </div>

  
</div>
<!-- PENCARIAN -->

  <!-- diagnosa -->
  <div class="modal fade" id="cari_penyakit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Data Diagnosa</h4>
            </div>
            <div class="modal-body">
              <form id="frm_diagnosa">
                <input type="hidden" name="NO_URUT_DIAGNOSA" id="NO_URUT_DIAGNOSA" value="">
                <input type="hidden" id="NO_REG_DIAGNOSA" name="NO_REG" value="<?php echo $dt->NO_REG; ?>">
                  <div class="form-horizontal form-label-left">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Jenis </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <select class="form-control" id="KD_JENIS_DIAGNOSA" name="KD_JENIS_DIAGNOSA">
                            <option value="DP">Diagnosa Primer</option>
                            <option value="DS">Diagnosa Sekunder</option>
                          </select>
                        </div>
                    </div> 
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Dokter</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <div class="input-group">
                            <input type="text" class="form-control" required="required" readonly="readonly" id="NM_DOKTER_DIAGNOSA" name="NM_DOKTER" placeholder="Dokter Pendiagnosa">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-info" onclick="cari_petugas('1')">Cari</button>
                            </span>
                          </div>
                          <input type="hidden" class="form-control" id="NIK_DOKTER_DIAGNOSA" name="NIK_DOKTER">
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Penyakit</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <div class="input-group">
                            <input type="text" class="form-control" id="NM_PENYAKIT" name="NM_PENYAKIT" onkeyup="cari_penyakit(this.value)" placeholder="Ketikan minimal 3 huruf">
                            
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-primary" onclick="tambah_penyakit()"><span class="fa fa-plus"></span></button>
                            </span>
                          </div>
                          <div class="dropdown">
                                <div id="diagsugest" class="dropdown-content" style="display: none;"></div>
                            </div>
                          <input type="hidden" class="form-control" id="KD_PENYAKIT" name="KD_PENYAKIT">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <button type="button" class="btn btn-success" onclick="simpan_diagnosa()">Simpan</button>
                          </div>
                      </div>  
                    <div id="load_diagnosa">
                      <?php $this->load->view('cari/cari_diagnosa'); ?>
                    </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" >Tutup</button>
            </div>
        </div>
    </div>
  </div>

  <!-- tindakan -->
  <div class="modal fade" id="cari_tindakan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Data Tindakan</h4>
            </div>
            <div class="modal-body">
              <form id="frm_tindakan">
                <input type="hidden" name="NO_URUT_TINDAKAN" id="NO_URUT_TINDAKAN" value="">
                <input type="hidden" id="NO_REG_TINDAKAN" name="NO_REG" value="<?php echo $dt->NO_REG; ?>">
                  <div class="form-horizontal form-label-left">
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Dokter</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <div class="input-group">
                            <input type="text" class="form-control" required="required" readonly="readonly" id="NM_DOKTER_TINDAKAN" name="NM_DOKTER" placeholder="Dokter Penindak">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-info" onclick="cari_petugas('2')">Cari</button>
                            </span>
                          </div>
                          <input type="hidden" class="form-control" id="NIK_DOKTER_TINDAKAN" name="NIK_DOKTER">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Prosedure </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" class="form-control" id="NM_TINDAKAN" name="NM_TINDAKAN" onkeyup="cari_tindakan(this.value)" placeholder="Ketikan minimal 3 huruf">
                            <div class="dropdown">
                                <div id="tindaksugest" class="dropdown-content" style="display: none;"></div>
                            </div>
                            <input type="hidden" class="form-control" id="KD_TINDAKAN" name="KD_TINDAKAN">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <button type="button" class="btn btn-success" onclick="simpan_tindakan()">Simpan</button>
                          </div>
                      </div>  
                    <div id="load_tindakan">
                      <?php $this->load->view('cari/cari_tindakan'); ?>
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

  <!-- pakai bahan -->
  <div class="modal fade" id="cari_pakai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Penggunaan Obat dan BHP</h4>
            </div>
            <div class="modal-body">
              <form id="frm_pakai_pasien">
                <input type="hidden" id="NO_REG_PAKAI" name="NO_REG" value="<?php echo $dt->NO_REG; ?>">
                <input type="hidden" id="KD_UNIT_PAKAI" name="KD_UNIT" value="<?php echo $dt->KD_UNIT; ?>">
                <input type="hidden" id="URUT_HD_PAKAI" name="URUT_HD">
      <div class="form-horizontal form-label-left">
        <div class="col-md-5">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Bahan<span class="required">*</span></label>
              <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="input-group">
                  <input type="text" class="form-control" required="required" readonly="readonly" id="NAMA_OBAT" name="NAMA_OBAT" placeholder="Bahan / Obat">
                  <span class="input-group-btn">
                      <button type="button" class="btn btn-info" onclick="cari_obat('')">Cari</button>
                  </span>
                </div>
              </div>
                <input type="hidden" class="form-control" id="KD_OBAT" name="KD_OBAT">
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Stock <span class="required">*</span></label>
              <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="input-group">
                  <input type="text" class="form-control" required="required" readonly="readonly" id="KD_STOCK" name="KD_STOCK" placeholder="Stock">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-info" onclick="cari_stock('')">Cari</button>
                  </span>
                </div>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Sisa</label>
              <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="input-group">
                  <input type="text" class="form-control" required="required" readonly="readonly" id="QTY_SISA" name="QTY_SISA">
                  <span class="input-group-btn">
                    <input type="text" readonly="" style="width: 100px;" class="form-control SATUAN_SISA">
                  </span>
                </div>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Pakai <span class="required">*</span></label>
              <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="input-group">
                  <input type="text" class="form-control" required="required" oninput="angka(this)" id="QTY_PAKAI" name="QTY_PAKAI" placeholder="Jumlah Pemakaian">
                  <span class="input-group-btn">
                    <input type="text" readonly="" style="width: 100px;" class="form-control SATUAN_SISA">
                  </span>
                </div>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Harga</label>
              <div class="col-md-9 col-sm-9 col-xs-9">
                <input type="text" class="form-control" oninput="angka(this)" onkeyup="format_rupiah(this);" required="required" id="HARGA_JUAL" name="HARGA_JUAL">
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <button type="button" class="btn btn-success" onclick="simpan_pakai()">Simpan</button>
              </div>
          </div> 
        </div>
        <div class="col-md-7">
          <div id="detail_pakai_stok"></div>
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

  <!-- PETUGAS -->
  <div class="modal fade" id="cari_petugas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Pencarian Dokter</h4>
            </div>
            <input type="hidden" id="kode_petugas">
            <div class="modal-body">
              
              <?php $this->load->view('cari/cari_petugas'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_petugas('')">Tutup</button>
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



  <!-- DIAGNOSA MASTER -->
  <div class="modal fade" id="diagnosa_master" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Tambah Data Diagnosa / ICD 10 </h4>
            </div>
            <div class="modal-body">
              <form id="frm_master_diagnosa">
              
                  <div class="form-horizontal form-label-left">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Kode / ICD 10 </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" class="form-control" id="MASTER_KD_PENYAKIT" name="KD_PENYAKIT">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Uraian ICD 10 </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <textarea class="form-control" id="MASTER_NM_PENYAKIT" name="NM_PENYAKIT"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-3">Bahasa </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <textarea class="form-control" id="MASTER_NM_PENYAKIT_INA" name="NM_PENYAKIT_INA"></textarea>
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <button type="button" class="btn btn-success" onclick="simpan_master_penyakit()">Simpan</button>
                          </div>
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
<!-- -->

    <!-- detail identitas -->

  <div class="modal fade" id="identitas_pasien" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Data Pasien</h4>
            </div>
            <div class="modal-body">
              <div id="data_identitas_pasien"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
  </div>


    <!-- stock -->
  <div class="modal fade" id="cari_stock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title blue" id="myModalLabel">Data Stok</h4>
            </div>
            <div class="modal-body">
              <div id="data_stock"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="pilih_stock('')">Tutup</button>
            </div>
        </div>
    </div>
  </div>

<button class="float_btn" type="button" onclick="reload_all()"> <span class="fa fa-refresh"></span> Refresh</button>


<script type="text/javascript">
$('.mydate').datetimepicker({
    format: 'DD/MM/YYYY',
    defaultDate: "now"
  });
$('.mydatetime').datetimepicker({
    format: 'DD/MM/YYYY HH:mm',
    defaultDate: "now"
  });

$(document).click(function(){
        $('#diagsugest').hide();
        $('#tindaksugest').hide();
});

function tambah_penyakit()
{
    $('#diagnosa_master').modal({
        show: 'true'
    }); 
}

function reload_all()
{
  tunggu_start();
  cari_resep();
  refresh_op();
  table_daftar_lab();
  refresh_ro();
  refresh_usg();
  reload_layanan_diet();
  tunggu_end();
}


 function simpan_master_penyakit()
 {
  var kd=$('#MASTER_KD_PENYAKIT').val();
  var nm=$('#MASTER_NM_PENYAKIT').val();
  if(kd!='')
  {
    if(nm!='')
    {
      tunggu_start();
      $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/simpan_master_penyakit'); ?>",
          type : "post",
          data : $('#frm_master_diagnosa').serialize(), 
          success:function(resp)
          {
              tunggu_end();
              md_info(resp);
          
          }
        });
    }
    else
    {
      md_warning('Uraian harus diisi!');
    }
  }
  else
  {
    md_warning('Kode harus diisi!');
  }
  
 }

function go_tagihan()
{
  $.ajax({
          url : "<?php echo base_url('index.php/tagihan/tagihan_hd/pilih_pasien'); ?>",
          type : "post",
          data : {
            NO_REG : $('#NO_REG').val(),
            KD_UNIT : $('#KD_UNIT').val(),
            IOL : $('#IOL').val(),
          },
          success:function(resp)
          {
            tunggu_end();
            $('#ctn_layan').html(resp);
          }
        });
}

function cari_penyakit(keywords)
 {
    if(keywords.length > 2)
    {
        $.ajax({
            url : "<?php echo base_url('index.php/layanan/pelayanan_hd/cari_penyakit'); ?>",
            type : "post",
            data : {
                        NM_PENYAKIT : keywords
                    },
            success:function(resp)
            {
                $('#diagsugest').html(resp);
                $('#diagsugest').fadeIn();
            }
        });
    }
    else
    {
        $('#diagsugest').hide();
    }
}

function terima_penyakit(cmp)
{
    $('#NM_PENYAKIT').val($(cmp).attr('nama'));
    $('#KD_PENYAKIT').val($(cmp).attr('kode'));
    $('#diagsugest').hide();
}
 

function cari_tindakan(keywords)
 {
    if(keywords.length > 2)
    {
        $.ajax({
            url : "<?php echo base_url('index.php/layanan/pelayanan_hd/cari_tindakan'); ?>",
            type : "post",
            data : {
                        NM_TINDAKAN : keywords
                    },
            success:function(resp)
            {
                $('#tindaksugest').html(resp);
                $('#tindaksugest').fadeIn();
            }
        });
    }
    else
    {
        $('#tindaksugest').hide();
    }
}

function terima_tindakan(cmp)
{
    $('#NM_TINDAKAN').val($(cmp).attr('nama'));
    $('#KD_TINDAKAN').val($(cmp).attr('kode'));
    $('#tindaksugest').hide();
}
 
 function cari_petugas(kode)
 {
   $('#kode_petugas').val(kode);
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
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/detail_petugas'); ?>",
          type : "post",
          dataType : "json",
          data : {
                  NIK : kode,
                },
          success:function(resp)
          {
            var kode=$('#kode_petugas').val();
            if(kode=='1')
            {
              if(resp.response=='200')
              {
                $('#NIK_DOKTER_DIAGNOSA').val(resp.data[0].NIK);
                $('#NM_DOKTER_DIAGNOSA').val(resp.data[0].NAMA);
              }
              else
              {
                $('#NIK_DOKTER_DIAGNOSA').val('');
                $('#NM_DOKTER_DIAGNOSA').val('');
              }
            }
            else if(kode=='2')
            {
              if(resp.response=='200')
              {
                $('#NIK_DOKTER_TINDAKAN').val(resp.data[0].NIK);
                $('#NM_DOKTER_TINDAKAN').val(resp.data[0].NAMA);
              }
              else
              {
                $('#NIK_DOKTER_TINDAKAN').val('');
                $('#NM_DOKTER_TINDAKAN').val('');
              }
            }
          }
        });
    }
 }



 function buka_diagnosa()
 {
  $('#cari_penyakit').modal({
        show: 'true'
    }); 
 }

 function buka_tindakan()
 {
  $('#cari_tindakan').modal({
        show: 'true'
    }); 
 }

 function simpan_diagnosa()
 {
  tunggu_start();
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/simpan_diagnosa'); ?>",
       type : "post",
       data : $('#frm_diagnosa').serialize(),
       success:function(resp)
       {
          tunggu_end();
         // md_info(resp);
          reload_diagnosa();
          reload_diagnosa_depan();
       }
     });
 }


 function reload_diagnosa()
 {
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/reload_diagnosa'); ?>",
       type : "post",
       data : {
                NO_REG : $('#NO_REG').val()
              },
       success:function(resp)
       {
          $('#load_diagnosa').html(resp);
       }
     });
 }


 function reload_diagnosa_depan()
 {
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/reload_diagnosa_depan'); ?>",
       type : "post",
       data : {
                NO_REG : $('#NO_REG').val()
              },
       success:function(resp)
       {
          $('#data_diagnosa').html(resp);
       }
     });
 }

 function hapus_diagnosa(kode)
 {
   tunggu_start();
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/hapus_diagnosa'); ?>",
       type : "post",
       data : {
                NO_URUT_DIAGNOSA : kode
              },
       success:function(resp)
       {
         tunggu_end();
        // md_info(resp);
         reload_diagnosa();
         reload_diagnosa_depan();
       }
     });
 }


 function simpan_tindakan()
 {
  tunggu_start();
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/simpan_tindakan'); ?>",
       type : "post",
       data : $('#frm_tindakan').serialize(),
       success:function(resp)
       {
          tunggu_end();
         // md_info(resp);
          reload_tindakan();
          reload_tindakan_depan();
       }
     });
 }


 function reload_tindakan()
 {
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/reload_tindakan'); ?>",
       type : "post",
       data : {
                NO_REG : $('#NO_REG').val()
              },
       success:function(resp)
       {
          $('#load_tindakan').html(resp);
       }
     });
 }


 function reload_tindakan_depan()
 {
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/reload_tindakan_depan'); ?>",
       type : "post",
       data : {
                NO_REG : $('#NO_REG').val()
              },
       success:function(resp)
       {
          $('#data_tindakan').html(resp);
       }
     });
 }

 function hapus_tindakan(kode)
 {
   tunggu_start();
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/hapus_tindakan'); ?>",
       type : "post",
       data : {
                NO_URUT_TINDAKAN : kode
              },
       success:function(resp)
       {
         tunggu_end();
        // md_info(resp);
         reload_tindakan();
         reload_tindakan_depan();
       }
     });
 }


function simpan_hd()
 {
  tunggu_start();
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/simpan_hd'); ?>",
       type : "post",
       data : $('#frm_tindakan_pasien').serialize(),
       success:function(resp)
       {
          tunggu_end();
          md_info(resp);
          $('#URUT_HD').val('');
          reload_hd();
       }
     });
 }

 
 function reload_hd()
 {
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/reload_hd'); ?>",
       type : "post",
       data : {
                NO_REG : $('#NO_REG').val()
              },
       success:function(resp)
       {
          $('#data_pakai_layan').html(resp);
       }
     });
 }

 

 function pilih_hd(kode)
 {
  if(kode!='')
  {
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/detail_hd'); ?>",
       type : "post",
       dataType : "json",
       data : {
                URUT_HD : kode
              },
       success:function(resp)
       {
 
          if(resp.response=='200')
          {
            $('#URUT_HD').val(resp.data.URUT_HD);
            $('#TGL_HD_AWAL').val(resp.data.TGL_HD_AWAL_F);
            $('#TGL_HD_AKHIR').val(resp.data.TGL_HD_AKHIR_F);
            if(resp.data.IS_CITO=='T')
            {
              $('#IS_CITO').prop('checked',true);
            }
            else
            {
              $('#IS_CITO').prop('checked',false);
            }
          }
          else
          {
            $('#URUT_HD').val('');
            $('#TGL_HD_AWAL').val('');
            $('#TGL_HD_AKHIR').val('');
            $('#IS_CITO').prop('checked',false);
          }
       }
     });
  }
 }



 function hapus_hd(kode)
 {
   tunggu_start();
   $.ajax({
       url : "<?php echo base_url('index.php/layanan/pelayanan_hd/hapus_hd'); ?>",
       type : "post",
       data : {
                URUT_HD : kode
              },
       success:function(resp)
       {
         tunggu_end();
         md_info(resp);
         reload_hd();
       }
     });
 }


function detail_hd(kode)
{
  $('#URUT_HD_PAKAI').val(kode);
  detail_pakai();
  $('#cari_pakai').modal({
        show: 'true'
   });
}


function cari_obat()
 {
   $('#cari_obat').modal({
        show: 'true'
   }); 
 }

function pilih_obat(kode)
{
  if(kode!='')
  {

    $.ajax({
      url : "<?php echo base_url('index.php/layanan/pelayanan_hd/detail_data'); ?>",
      type : "post",
      dataType : "json",
      data : {
               KD_OBAT : kode
             },
      success:function(resp)
      {

        $('#KD_STOCK').val('');
        $('#QTY_PAKAI').val('1');
        $('#QTY_SISA').val('0');
        $('#EXPIRED_DATE').val('');
        $('.SATUAN_SISA').val('');
        $('#TOTAL').val('0');
        $('#KONDISI').val('0');
        $('#HARGA_JUAL').val('0');

        if(resp.response=='200')
        {
          $('#KD_OBAT').val(resp.data[0].KD_OBAT);
          $('#NAMA_OBAT').val(resp.data[0].NAMA_OBAT);
          $('#HARGA_JUAL').val(rupiah(resp.data[0].HARGA_JUAL,'.'));
          $('.SATUAN_SISA').val(resp.data[0].NM_SATUAN_VOLUME);
          stock_obat_focus();
          cari_stock_obat(kode);
        }
        else
        {
         $('#KD_OBAT').val('');
         $('#NAMA_OBAT').val('');
         $('.SATUAN_SISA').val('');
        }
      }
    });
   }
   else
   {
      $('#KD_OBAT').val('');
      $('#NAMA_OBAT').val('');
      $('.SATUAN_SISA').val('');
   }
  }

function cari_stock()
 {
 
   $('#cari_stock').modal({
        show: 'true'
   }); 
 }

function cari_stock_obat(kode)
{
  if(kode!='')
  {
    $('#cari_obat').modal('hide');

    $.ajax({
      url : "<?php echo base_url('index.php/layanan/pelayanan_hd/cari_stock_obat'); ?>",
      type : "post",
      data : {
               KD_OBAT : kode
             },
      success:function(resp)
      {
        $('#data_stock').html(resp);
      }
    });
   }
   else
   {
     md_warning('Obat belum dipilih!');
   }
}

function stock_obat_focus()
 {
   var kode = $('#KD_OBAT').val();
   if(kode!='')
   {
     $.ajax({
      url : "<?php echo base_url('index.php/layanan/pelayanan_hd/stock_obat_focus'); ?>",
      type : "post",
      dataType : "json",
      data : {
               KD_OBAT : kode,
             },
      success:function(resp)
      {
        
        if(resp.response=='200')
        {
          $('#KD_STOCK').val(resp.data.KD_STOCK);
          $('#QTY_SISA').val(resp.data.QTY_SISA);
          
        }
        else
        {
          md_warning("Stock tidak tersedia!");
          $('#KD_STOCK').val('');
          $('#QTY_SISA').val('');
        }
        
      }
     });
   }
 }


 function pilih_stock(kode)
 {
    $('#cari_stock').modal('hide');
    $.ajax({
        url : "<?php echo base_url('index.php/layanan/pelayanan_hd/cari_stock'); ?>",
        type : "post",
        dataType : "json",
        data : {
                KD_STOCK : kode,
              },
        success:function(resp)
        {
          if(resp.response=='200')
          {
            $('#KD_STOCK').val(resp.data.KD_STOCK);
            $('#QTY_SISA').val(resp.data.QTY_SISA);
          }
        }
      });
 }

 function pilih_pakai_stock(cmp)
{
  var pakai=$(cmp).attr('pakai');
  var stock=$(cmp).attr('stock');

   $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/detail_stock_pakai'); ?>",
          type : "post",
          dataType : "json",
          data : {
                  KD_PAKAI : pakai,
                  KD_STOCK : stock
                },
          success:function(resp)
          {
             if(resp.response=='200')
             {
              $('#KD_STOCK').val(resp.data.KD_STOCK);
              $('#KD_OBAT').val(resp.data.KD_OBAT);
              $('#NAMA_OBAT').val(resp.data.NAMA_OBAT);
              $('#HARGA_JUAL').val(rupiah(resp.data.HARGA_JUAL,'.'));
              pilih_stock(resp.data.KD_STOCK);
              $('#QTY_PAKAI').val(resp.data.QTY_PAKAI);
              //$('#TOTAL').val(rupiah(resp.data.TOTAL_PAKAI,'.'));
              cari_stock_obat(obat);
             }
          }
        });
}


 function detail_pakai()
{
    $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/stock_pakai'); ?>",
          type : "post",
          data : {
                  URUT_HD : $('#URUT_HD_PAKAI').val(),
                },
          success:function(resp)
          {
            $('#detail_pakai_stok').html(resp);
          }
        }); 
    
 }

function hapus_pakai_stock(cmp)
{
  var pakai=$(cmp).attr('pakai');
  var stock=$(cmp).attr('stock');
  tunggu_start();
   $.ajax({
          url : "<?php echo base_url('index.php/layanan/pelayanan_hd/hapus_pakai_stock'); ?>",
          type : "post",
          data : {
                  KD_PAKAI : pakai,
                  KD_STOCK : stock
                },
          success:function(resp)
          {
            tunggu_end();
            md_info(resp);
            detail_pakai();
            stock_obat_focus();
          }
        });
}


function identitas_pasien(rm)
{
    $.ajax({
      url : "<?php echo base_url('index.php/layanan/pelayanan_hd/identitas_pasien'); ?>",
      type : "post",
      data : {
               NO_CM : rm,
             },
      success:function(resp)
      {

        // md_warning(resp);
          

          $('#data_identitas_pasien').html(resp);
          
          $('#identitas_pasien').modal({
            show: 'true'
          }); 

          
      }
    });
  
  }


function simpan_pakai()
{
  var hd=$('#URUT_HD_PAKAI').val();
  var reg=$('#NO_REG_PAKAI').val();
  var unit=$('#KD_UNIT_PAKAI').val();
  var iol=$('#IOL').val();
  var stok=$('#KD_STOCK').val();
  var qty=$('#QTY_PAKAI').val();
  var hrg=non_rupiah($('#HARGA_JUAL').val());
  if(hd!='')
  {
    if(reg!='')
    {
      if(stok!='')
      {
        if(qty!='')
        {
          if(hrg!='')
          {
          tunggu_start();
          $.ajax({
              url : "<?php echo base_url('index.php/layanan/pelayanan_hd/simpan_pakai'); ?>",
              type : "post",
              data : {
                URUT_HD : hd,
                NO_REG : reg,
                KD_UNIT : unit,
                IOL : iol,
                KD_STOCK : stok,
                QTY_PAKAI : qty,
                HARGA_JUAL : hrg,
              },
              success:function(resp)
              {
                tunggu_end();
                md_info(resp);
                detail_pakai();
                stock_obat_focus();
              }
            });
          }
          else
          {
            md_warning('Harga jual belum diisi!');
          }
        }
        else
        {
          md_warning('Jumlah pakai belum diisi!');
        }
      }
      else
      {
        md_warning('Stok pakai belum diisi!');
      }
    }
    else
    {
        md_warning('Pasien belum diisi!');
    }
  }
  else
  {
    md_warning('Kode HD belum diisi!');
  }
}
</script>
<?php } ?>