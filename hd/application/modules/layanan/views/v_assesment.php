<form id="frm_asesmen_awal_keperawatan_ranap">
        <input type="hidden" id="KD_UNIT" name="KD_UNIT" value="<?php echo $dt->KD_UNIT; ?>">
        <input type="hidden" id="KD_KELAS" name="KD_KELAS" value="<?php echo $dt->KD_KELAS; ?>">
        <input type="hidden" id="NO_REG" name="NO_REG" value="<?php echo $dt->NO_REG; ?>">
        <input type="hidden" id="NO_CM" name="NO_CM" value="<?php echo $dt->NO_CM; ?>">
        <input type="hidden" id="IOL" name="IOL" value="I">
        <input type="hidden" id="NO_URUT_INAP" name="NO_URUT_INAP" value="<?php echo $dt->NO_URUT_INAP; ?>">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-bars"></i> Pengkajian Awal Keperawatan Hemodialisa</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="form-horizontal form-label-left">
               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">DPJP</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control selectpicker" id="NIK_DOKTER" name="NIK_DOKTER" data-live-search="true">
                              <?php  
                                if(!is_null($ses_dpjp))
                                {
                                  if($ses_dpjp['response']=='200')
                                  {
                                      foreach ($ses_dpjp['data'] as $sdp) 
                                      {
                                        echo "<option value='".$sdp->NIK_DOKTER."'>".$sdp->NAMA."</option>";
                                      }
                                  }
                                }
                              ?>
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Tiba diruangan</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <div class="control-group">
                              <div class="controls">
                                <input class="form-control mydatetime input-sm" placeholder="DD/MM/YYYY HH:MM" aria-describedby="inputSuccess2Status3" type="text" id="TGL_MASUK" name="TGL_MASUK" value="<?php echo $TGL_MASUK1; ?>">                                
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Pengkajian</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <div class="control-group">
                              <div class="controls">
                                <input class="form-control mydatetime input-sm" placeholder="DD/MM/YYYY HH:MM" aria-describedby="inputSuccess2Status3" type="text" id="TGL_ASESMEN" name="TGL_ASESMEN" value="<?php echo $TGL_ASESMEN1; ?>">                                
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Sumber Data</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                              <select class="form-control input-sm" id="SUMBER_DATA" name="SUMBER_DATA">
                                <option value="PASIEN" <?php if($SUMBER_DATA1=='PASIEN'){ echo "selected"; } ?>>PASIEN</option>
                                <option value="KELUARGA" <?php if($SUMBER_DATA1=='KELUARGA'){ echo "selected"; } ?>>KELUARGA PASIEN</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Penyelesaian Kajian</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                              <select class="form-control input-sm" id="PENYELESAIAN_KAJIAN" name="PENYELESAIAN_KAJIAN">
                                <option value="DALAM 24 JAM" <?php if($PENYELESAIAN_KAJIAN1=='DALAM 24 JAM'){ echo "selected"; } ?>>DALAM 24 JAM</option>
                                <option value="LEBIH DARI 24 JAM" <?php if($PENYELESAIAN_KAJIAN1=='LEBIH DARI 24 JAM'){ echo "selected"; } ?>>LEBIH DARI 24 JAM</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Cara Masuk Pasien</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="text" class="form-control input-sm" id="CARA_MASUK" name="CARA_MASUK" placeholder="" value="<?php echo $CARA_MASUK1; ?>">
                            <button type="button" class="btn btn-default btn-xs red" value="JALAN KAKI" onclick="copy_to(this.value,'CARA_MASUK')">Jalan Kaki</button>
                            <button type="button" class="btn btn-default btn-xs red" value="KURSI RODA" onclick="copy_to(this.value,'CARA_MASUK')">Kursi Roda</button>
                            <button type="button" class="btn btn-default btn-xs red" value="BRANKAR" onclick="copy_to(this.value,'CARA_MASUK')">Brankar</button>
                          </div>
                      </div>
                 </div>
               </div>
               
               <div class="row" style="display: none;">
                 <b>KELUARGA/ PENANGGUNG JAWAB PASIEN</b>
                 <div class="col-md-12">
                   <table class="table">
                     <tr>
                       <td>Nama</td>
                       <td>:</td>
                       <td><input type="text" class="form-control input-sm" name="NM_PJ" id="NM_PJ" value="<?php echo $NM_PJ1; ?>"></td>
                     </tr>
                     <tr>
                       <td>Umur</td>
                       <td>:</td>
                       <td><input type="text" class="form-control input-sm" name="UMUR_PJ" id="UMUR_PJ" value="<?php echo $UMUR_PJ1; ?>"></td>
                     </tr>
                     <tr>
                       <td>Alamat</td>
                       <td>:</td>
                       <td><input type="text" class="form-control input-sm" name="ALAMAT_PJ" id="ALAMAT_PJ" value="<?php echo $ALAMAT_PJ1; ?>"></td>
                     </tr>
                     <tr>
                       <td>No Indentitas</td>
                       <td>:</td>
                       <td><input type="text" class="form-control input-sm" name="ID_PJ" id="ID_PJ" value="<?php echo $ID_PJ1; ?>"></td>
                     </tr>
                     <tr>
                       <td>Hp</td>
                       <td>:</td>
                       <td><input type="text" class="form-control input-sm" name="HP_PJ" id="HP_PJ" value="<?php echo $HP_PJ1; ?>"></td>
                     </tr>
                     <tr>
                       <td>Agama</td>
                       <td>:</td>
                       <td>
                         <input type="text" class="form-control input-sm" name="AGAMA_PJ" id="AGAMA_PJ" value="<?php echo $AGAMA_PJ1; ?>">
                       </td>
                     </tr>
                   </table>
                 </div>
               </div>
               <br>
          <div class="x_title">
            <h2><i class="fa fa-bars"></i> PENGKAJIAN TERPADU</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="form-horizontal form-label-left">       
                   <b class="blue">1. DATA SUBJEKTIF</b>
                   
                   <div class="row">
                      <div class="col-md-6">
                         <b class="green">a. Keluhan Utama </b>
                          
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Keluhan utama</label>
                              <div class="col-md-9 col-sm-9 col-xs-9">
                                <textarea class="form-control input-sm" id="KELUHAN_UTAMA" name="KELUHAN_UTAMA" placeholder="Keluhan utama" ><?php echo $KELUHAN_UTAMA; ?></textarea>
                                <button type="button" class="btn btn-default btn-xs red" value="Alergi" onclick="copy_to(this.value,'KELUHAN_UTAMA')">Sesak Nafas</button>
                                <button type="button" class="btn btn-default btn-xs red" value="Asma" onclick="copy_to(this.value,'KELUHAN_UTAMA')">Mual Muntah</button>
                                <button type="button" class="btn btn-default btn-xs red" value="TBC" onclick="copy_to(this.value,'KELUHAN_UTAMA')">Gatal</button>
                                <button type="button" class="btn btn-default btn-xs red" value="Hipertensi" onclick="copy_to(this.value,'KELUHAN_UTAMA')">Nyeri</button>
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Skala Nyeri</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">                          
                              <div id="div_nyeri_rpk_0" class="col-lg-1 col-md-3 col-sm-4 col-xs-2 custom-radios-pain-scale">
                                <input type="radio" id="rad_nyeri_rpk_0" name="SKALA_NYERI" value="0" <?php if($SKALA_NYERI1=='0'){ echo 'checked=""'; } ?>
                                <label for="rad_nyeri_rpk_0"><span></span> 0</label>
                              </div>
                              <div id="div_nyeri_rpk_1" class="col-lg-1 col-md-3 col-sm-4 col-xs-2 custom-radios-pain-scale">
                                <input type="radio" id="rad_nyeri_rpk_1" name="SKALA_NYERI" value="1" <?php if($SKALA_NYERI1=='1'){ echo 'checked=""'; } ?>
                                <label for="rad_nyeri_rpk_1"><span></span> 1</label>
                              </div>
                              <div id="div_nyeri_rpk_2" class="col-lg-1 col-md-3 col-sm-4 col-xs-2 custom-radios-pain-scale">
                                <input type="radio" id="rad_nyeri_rpk_2" name="SKALA_NYERI" value="2" <?php if($SKALA_NYERI1=='2'){ echo 'checked=""'; } ?>
                                <label for="rad_nyeri_rpk_2"><span></span> 2</label>
                              </div>
                              <div id="div_nyeri_rpk_3" class="col-lg-1 col-md-3 col-sm-4 col-xs-2 custom-radios-pain-scale">
                                <input type="radio" id="rad_nyeri_rpk_3" name="SKALA_NYERI" value="3" <?php if($SKALA_NYERI1=='3'){ echo 'checked=""'; } ?>                                <label for="rad_nyeri_rpk_3"><span></span> 3</label>
                              </div>
                              <div id="div_nyeri_rpk_4" class="col-lg-1 col-md-3 col-sm-4 col-xs-2 custom-radios-pain-scale">
                                <input type="radio" id="rad_nyeri_rpk_4" name="SKALA_NYERI" value="4" <?php if($SKALA_NYERI1=='4'){ echo 'checked=""'; } ?>
                                <label for="rad_nyeri_rpk_4"><span></span> 4</label>
                              </div>
                              <div id="div_nyeri_rpk_5" class="col-lg-1 col-md-3 col-sm-4 col-xs-2 custom-radios-pain-scale">
                                <input type="radio" id="rad_nyeri_rpk_5" name="SKALA_NYERI" value="5" <?php if($SKALA_NYERI1=='5'){ echo 'checked=""'; } ?>
                                <label for="rad_nyeri_rpk_5"><span></span> 5</label>
                              </div>
                              <div id="div_nyeri_rpk_6" class="col-lg-1 col-md-3 col-sm-4 col-xs-2 custom-radios-pain-scale">
                                <input type="radio" id="rad_nyeri_rpk_6" name="SKALA_NYERI" value="6" <?php if($SKALA_NYERI1=='6'){ echo 'checked=""'; } ?>
                                <label for="rad_nyeri_rpk_6"><span></span> 6</label>
                              </div>
                              <div id="div_nyeri_rpk_7" class="col-lg-1 col-md-3 col-sm-4 col-xs-2 custom-radios-pain-scale">
                                <input type="radio" id="rad_nyeri_rpk_7" name="SKALA_NYERI" value="7" <?php if($SKALA_NYERI1=='7'){ echo 'checked=""'; } ?>
                                <label for="rad_nyeri_rpk_7"><span></span> 7</label>
                              </div>
                              <div id="div_nyeri_rpk_8" class="col-lg-1 col-md-3 col-sm-4 col-xs-2 custom-radios-pain-scale">
                                <input type="radio" id="rad_nyeri_rpk_8" name="SKALA_NYERI" value="8" <?php if($SKALA_NYERI1=='8'){ echo 'checked=""'; } ?>
                                <label for="rad_nyeri_rpk_8"><span></span> 8</label>
                              </div>
                              <div id="div_nyeri_rpk_9" class="col-lg-1 col-md-3 col-sm-4 col-xs-2 custom-radios-pain-scale">
                                <input type="radio" id="rad_nyeri_rpk_9" name="SKALA_NYERI" value="9" <?php if($SKALA_NYERI1=='9'){ echo 'checked=""'; } ?>
                                <label for="rad_nyeri_rpk_9"><span></span> 9</label>
                              </div>
                              <div id="div_nyeri_rpk_10" class="col-lg-1 col-md-3 col-sm-4 col-xs-2 custom-radios-pain-scale">
                                <input type="radio" id="rad_nyeri_rpk_10" name="SKALA_NYERI" value="10" <?php if($SKALA_NYERI1=='10'){ echo 'checked=""'; } ?>>
                                <label for="rad_nyeri_rpk_10"><span></span> 10</label>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Durasi</label>
                              <div class="col-md-9 col-sm-9 col-xs-9">
                                <textarea class="form-control input-sm" id="DURASI_KELUHAN" name="DURASI_KELUHAN" placeholder="Durasi keluhan" ><?php echo $DURASI_KELUHAN; ?></textarea>
                              </div>
                          </div>
                       
                          <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-3">Lokasi</label>
                             <div class="col-md-9 col-sm-9 col-xs-9">
                               <textarea class="form-control input-sm" id="LOKASI_KELUHAN" name="LOKASI_KELUHAN" placeholder="Lokasi keluhan" ><?php echo $LOKASI_KELUHAN; ?></textarea>
                             </div>
                         </div>

                      </div>
                      <div class="col-md-6">
                        <b class="green">b. Riwayat Kesehatan </b>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Riwayat Kesehatan Sekarang</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <textarea class="form-control input-sm" id="RIWAYAT_KESEHATAN_SEKARANG" name="RIWAYAT_KESEHATAN_SEKARANG" placeholder="Riwayat kesehatan sekarang" ><?php echo $RIWAYAT_KESEHATAN_SEKARANG; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Riwayat Kesehatan Dahulu</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <textarea class="form-control input-sm" id="RIWAYAT_KESEHATAN_DAHULU" name="RIWAYAT_KESEHATAN_DAHULU" placeholder="Riwayat kesehatan dahulu" ><?php echo $RIWAYAT_KESEHATAN_DAHULU; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Riwayat Alergi</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <textarea class="form-control input-sm" id="RIWAYAT_ALERGI" name="RIWAYAT_ALERGI" placeholder="Riwayat alergi" ><?php echo $RIWAYAT_ALERGI; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Riwayat Transfusi</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <textarea class="form-control input-sm" id="RIWAYAT_TRANSFUSI" name="RIWAYAT_TRANSFUSI" placeholder="Riwayat transfusi" ><?php echo $RIWAYAT_TARNSFUSI; ?></textarea>
                            </div>
                        </div>

                      </div>
                   </div>

                   <div class="clearfix">
                    <hr>
                   </div>
                  
                  <div class="row">                       
                    <div class="col-md-6">
                      <b class="blue">2. DATA OBJEKTIF</b><br>
                      <b class="green">a. Pemeriksaan Fisik</b>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Keadaan Umum</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <textarea class="form-control input-sm" id="KEADAAN_UMUM" name="KEADAAN_UMUM" placeholder="Keadaan umum" ><?php echo $KEADAAN_UMUM; ?></textarea>
                            <button type="button" class="btn btn-default btn-xs red" value="Baik" onclick="copy_to(this.value,'KEADAAN_UMUM')">Baik</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Sedang" onclick="copy_to(this.value,'KEADAAN_UMUM')">Sedang</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Buruk" onclick="copy_to(this.value,'KEADAAN_UMUM')">Buruk</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Lain-lain :" onclick="copy_to(this.value,'KEADAAN_UMUM')">Lain-Lain :</button>
                          </div>
                      </div>  
                                              
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-9">Tensi Sistole</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <div class="input-group">
                            <input type="text" class="form-control input-sm"  id="TD_SIS" name="TD_SIS" placeholder="" value="<?php echo $TD_SIS; ?>">
                              <span class="input-group-btn">                        
                                <div disabled class="btn btn-primary btn-sm">mmHg</div>
                              </span>
                          </div>
                        </div>
                      </div>  

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-9">Tensi Diastole</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <div class="input-group">
                            <input type="text" class="form-control input-sm"  id="TD_DIA" name="TD_DIA" placeholder="" value="<?php echo $TD_DIA; ?>">
                              <span class="input-group-btn">                        
                                <div disabled class="btn btn-primary btn-sm">mmHg</div>
                              </span>
                          </div>
                        </div>
                      </div>
  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-9">MAP</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <div class="input-group">
                            HASIL MAP
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Nadi</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <textarea class="form-control input-sm" id="NADI" name="NADI" placeholder="Nadi" ><?php echo $NADI; ?></textarea>
                            <button type="button" class="btn btn-default btn-xs red" value="Reguler" onclick="copy_to(this.value,'NADI')">Reguler</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Ireguler" onclick="copy_to(this.value,'NADI')">Ireguler</button>
                          </div>
                      </div>                        

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-9">Frekuensi</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" id="FREK_NADI" name="FREK_NADI" placeholder="Frekuensi nadi" value="<?php echo $FREK_NADI; ?>">
                            <span class="input-group-btn">
                              <div disabled class="btn btn-primary btn-sm">x/mnt</div>
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Respirasi</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <textarea class="form-control input-sm" id="RESPIRASI" name="RESPIRASI" placeholder="" ><?php echo $RESPIRASI; ?></textarea>
                            <button type="button" class="btn btn-default btn-xs red" value="Normal" onclick="copy_to(this.value,'RESPIRASI')">Normal</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Asidosis" onclick="copy_to(this.value,'RESPIRASI')">Asidosis</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Dipsnea" onclick="copy_to(this.value,'RESPIRASI')">Dipsnea</button>
                          </div>
                      </div>   

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-9">Frekuensi</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" id="FREK_RESPIRASI" name="FREK_RESPIRASI" placeholder="" value="<?php echo $FREK_RESPIRASI; ?>">
                            <span class="input-group-btn">
                              <div disabled class="btn btn-primary btn-sm">x/mnt</div>
                            </span>
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Konjungtiva</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <textarea class="form-control input-sm" id="KONJUNGTIVA" name="KONJUNGTIVA" placeholder="Konjungtiva" ><?php echo $KONJUNGTIVA; ?></textarea>
                            <button type="button" class="btn btn-default btn-xs red" value="Tidak Anemis" onclick="copy_to(this.value,'KONJUNGTIVA')">Tidak Anemis</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Anemis" onclick="copy_to(this.value,'KONJUNGTIVA')">Anemis</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Lain-lain :" onclick="copy_to(this.value,'KONJUNGTIVA')">Lain-Lain :</button>
                          </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Ekstrimitas</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <textarea class="form-control input-sm" id="EKSTRIMITAS" name="EKSTRIMITAS" placeholder="Ekstritas" ><?php echo $EKSTRIMITAS; ?></textarea>
                            <button type="button" class="btn btn-default btn-xs red" value="Tidak Edema / Dehidrasi" onclick="copy_to(this.value,'EKSTRIMITAS')">Tidak Edema / Dehidrasi</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Dehidrasi" onclick="copy_to(this.value,'EKSTRIMITAS')">Dehidrasi</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Dedema" onclick="copy_to(this.value,'EKSTRIMITAS')">Dedema</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Edema anasarka" onclick="copy_to(this.value,'EKSTRIMITAS')">Edema anasarka</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Pucat dan dingin" onclick="copy_to(this.value,'EKSTRIMITAS')">Pucat dan dingin</button>
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Berat Badan</label>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Pre HD</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" id="BB_PREHD" name="BB_PREHD" placeholder="" value="<?php echo $BB_PREHD; ?>">
                            <span class="input-group-btn">
                              <div disabled class="btn btn-primary btn-sm">kg</div>
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Kering</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" id="BB_KERING" name="BB_KERING" placeholder="" value="<?php echo $BB_KERING; ?>">
                            <span class="input-group-btn">
                              <div disabled class="btn btn-primary btn-sm">kg</div>
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">HD Lalu</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" id="BB_HDLALU" name="BB_HDLALU" placeholder="" value="<?php echo $BB_HDLALU; ?>">
                            <span class="input-group-btn">
                              <div disabled class="btn btn-primary btn-sm">kg</div>
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">POST HD</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" id="BB_POSTHD" name="BB_POSTHD" placeholder="" value="<?php echo $BB_POSTHD; ?>">
                            <span class="input-group-btn">
                              <div disabled class="btn btn-primary btn-sm">kg</div>
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Akses Vaskuler</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <textarea class="form-control input-sm" id="EKSTRIMITAS" name="AKSES_VASKULER" placeholder="Akses Vaskuler" ><?php echo $AKSES_VASKULER; ?></textarea>
                            <button type="button" class="btn btn-default btn-xs red" value="AV Fistular" onclick="copy_to(this.value,'AKSES_VASKULER')">AV Fistular</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Femoral" onclick="copy_to(this.value,'AKSES_VASKULER')">Femoral</button>
                            <button type="button" class="btn btn-default btn-xs red" value="HD Kateter" onclick="copy_to(this.value,'AKSES_VASKULER')">HD Kateter</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Sub Clavia" onclick="copy_to(this.value,'AKSES_VASKULER')">Sub Clavia</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Juguluris" onclick="copy_to(this.value,'AKSES_VASKULER')">Juguluris</button>
                            <button type="button" class="btn btn-default btn-xs red" value="Femoral lainya : " onclick="copy_to(this.value,'AKSES_VASKULER')">Femoral lainya :</button>

                          </div>
                      </div>

                      <b class="green">b. Resiko Jatuh</b>
                      
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6"><label class="control-label" style="margin-left: 20px;">1. Riwayat jatuh atau bulan terakhir</label></div>
                          <div class="col-md-6">
                            <select class="form-control input-sm" id="JATUH_TERAKHIR" name="JATUH_TERAKHIR">
                              <option value="0" <?php if($JATUH_TERAKHIR=='0'){ echo " selected "; } ?>0. Tidak</option>
                              <option value="25" <?php if($JATUH_TERAKHIR=='25'){ echo " selected "; } ?>25.Ya</option>
                            </select> 
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6"><label class="control-label" style="margin-left: 20px;">2. Diagnose medis sekunder > 2</label></div>
                          <div class="col-md-6">
                            <select class="form-control input-sm" id="DIAG_MEDIS_SEKUNDER" name="DIAG_MEDIS_SEKUNDER">
                              <option value="0" <?php if($DIAG_MEDIS_SEKUNDER=='0'){ echo " selected "; } ?>0. Tidak</option>
                              <option value="15" <?php if($DIAG_MEDIS_SEKUNDER=='15'){ echo " selected "; } ?>15.Ya</option>
                            </select> 
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6"> <label class="control-label" style="margin-left: 20px;">3. Alat bantu jalan</label></div>
                          <div class="col-md-6">
                               <select class="form-control input-sm" id="ALT_BANTU_JALAN" name="ALT_BANTU_JALAN">
                                 <option value="0" <?php if($ALT_BANTU_JALAN=='0'){ echo " selected "; } ?>0. Bedrest</option>
                                 <option value="15" <?php if($ALT_BANTU_JALAN=='15'){ echo " selected "; } ?>15. Penopang tongkat</option>
                                 <option value="25" <?php if($ALT_BANTU_JALAN=='25'){ echo " selected "; } ?>25. Furniture</option>
                               </select>  
                         </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6"> <label class="control-label" style="margin-left: 20px;">4. Memakai terapi heparin lock/iv</label></div>
                          <div class="col-md-6">
                               <select class="form-control input-sm" id="TERAPI_HEPARIN" name="TERAPI_HEPARIN">
                                 <option value="0" <?php if($TERAPI_HEPARIN=='0'){ echo " selected "; } ?>0. Tidak</option>
                                 <option value="25" <?php if($TERAPI_HEPARIN=='25'){ echo " selected "; } ?>15. Ya</option>
                               </select>  
                         </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6"> <label class="control-label" style="margin-left: 20px;">5. Cara berjalan / berpindah</label></div>
                          <div class="col-md-6">
                               <select class="form-control input-sm" id="CARA_BERJALAN" name="CARA_BERJALAN">
                                 <option value="0" <?php if($CARA_BERJALAN=='0'){ echo " selected "; } ?>0. Normal/Bedrest/Mobilisasi</option>
                                 <option value="15" <?php if($CARA_BERJALAN=='25'){ echo " selected "; } ?>15. Lemah</option>
                                 <option value="30" <?php if($CARA_BERJALAN=='25'){ echo " selected "; } ?>30. Terganggu</option>
                               </select>  
                         </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6"> <label class="control-label" style="margin-left: 20px;">6. Status mental</label></div>
                          <div class="col-md-6">
                               <select class="form-control input-sm" id="STATUS_MENTAL" name="STATUS_MENTAL">
                                 <option value="0" <?php if($STATUS_MENTAL=='0'){ echo " selected "; } ?>0. Orientasi sesuai kemampuan</option>
                                 <option value="15" <?php if($STATUS_MENTAL=='25'){ echo " selected "; } ?>25. Lupa keterbatasan</option>
                               </select>  
                         </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6"><label class="control-label" style="margin-left: 20px;">SKOR</label></div>
                          <div class="col-md-6">
                            <input type="text" class="form-control input-sm" name="SKOR_RJ" id="SKOR_RJ" value="<?php echo $SKOR_RJ; ?>">
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6"><label class="control-label" style="margin-left: 20px;">KESIMPULAN</label></div>
                          <div class="col-md-6">
                            <input type="text" class="form-control input-sm" name="KESIMPULAN" id="KESIMPULAN" value="<?php echo $KESIMPULAN; ?>">
                          </div>
                        </div>
                      </div>                  

                    </div>

                    <!-- Batas Kolom -->
                    
                    <div class="col-md-6">
                      
                      <div class="clearfix">
                        <br>
                      
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12"><label class="control-label"><b class="green">c. Pemeriksanaan Penunjang Medis</b></label></div>
                          </div>
                          <div class="row">
                            <div class="col-md-12" style="padding-left: 25px;">
                              <textarea class="form-control input-sm" id="PRIKSA_PEN_MEDIS" style="margin: 10px;" name="PRIKSA_PEN_MEDIS" placeholder="Pemeriksaan penunjang medis" ><?php echo $PRIKSA_PEN_MEDIS; ?></textarea>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12"><label class="control-label"><b class="green">d. Assesmen Gizi</b> (dikaji tiap 3-6 bulan sekali atau di ulangi jika terjadi pemburukan asupan gizi)</label></div>
                          </div>
                        </div>
                          
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6"><label class="control-label" style="margin-left: 20px;">Tanggal</label></div>
                            <div class="col-md-6">
                                <input class="form-control mydatetime input-sm" placeholder="DD/MM/YYYY" aria-describedby="inputSuccess2Status3" type="text" id="TGL_ASS_GIZI" name="TGL_ASS_GIZI" value="<?php echo $TGL_ASS_GIZI; ?>">                                
                                <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6"><label class="control-label" style="margin-left: 20px;">MIS. Score total</label></div>
                            <div class="col-md-6">
                              <input type="text" class="form-control input-sm" name="MIS" id="MIS" value="<?php echo $MIS; ?>">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6"><label class="control-label" style="margin-left: 20px;">SGA. Score total</label></div>
                            <div class="col-md-6">
                              <input type="text" class="form-control input-sm" name="SGA" id="SGA" value="<?php echo $SGA; ?>">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6"><label class="control-label" style="margin-left: 20px;">Kesimpulan</label></div>
                            <div class="col-md-6">
                              <select class="form-control input-sm" id="KESIMPULAN_GIZI" name="KESIMPULAN_GIZI">
                                <option value="0" <?php if($KESIMPULAN_GIZI=='0'){ echo " selected "; } ?>Tanpa Malnutrisi</option>
                                <option value="1" <?php if($KESIMPULAN_GIZI=='1'){ echo " selected "; } ?>Malnutrisi</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12"><label class="control-label"><label class="green">e. Assesmen Sosial dan Ekonomi</label></div>
                          </div>
                        </div>

                        <div class="clearfix">
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Pekerjaan</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <input type="text" class="form-control input-sm" id="PEKERJAAN" name="PEKERJAAN" placeholder="" value="<?php echo $PEKERJAAN1; ?>">
                              <button type="button" class="btn btn-default btn-xs red" value="Wiraswasta" onclick="copy_to(this.value,'PEKERJAAN')">Wiraswasta</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Swasta" onclick="copy_to(this.value,'PEKERJAAN')">Swasta</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Pegawai Negri" onclick="copy_to(this.value,'PEKERJAAN')">Pegawai Negri</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Pensiun" onclick="copy_to(this.value,'PEKERJAAN')">Pensiun</button>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Tinggal dirumah bersama</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <input type="text" class="form-control input-sm" id="TINGGAL_BERSAMA" name="TINGGAL_BERSAMA" placeholder="" value="<?php echo $TINGGAL_BERSAMA1; ?>">
                              <button type="button" class="btn btn-default btn-xs red" value="Suami/Istri" onclick="copy_to(this.value,'TINGGAL_BERSAMA')">Suami/Istri</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Orang tua" onclick="copy_to(this.value,'TINGGAL_BERSAMA')">Orang tua</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Anak" onclick="copy_to(this.value,'TINGGAL_BERSAMA')">Anak</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Sendiri" onclick="copy_to(this.value,'TINGGAL_BERSAMA')">Sendiri</button>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Kebutuhan pendampingan</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <select class="form-control input-sm" name="IS_BUTUH_PENDAMPINGAN" id="IS_BUTUH_PENDAMPINGAN">
                              <option value="T" <?php if($IS_BUTUH_PENDAMPINGAN1=='T'){ echo "selected"; } ?>>Tidak</option>
                              <option value="Y" <?php if($IS_BUTUH_PENDAMPINGAN1=='Y'){ echo "selected"; } ?>>Ya</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12"><label class="control-label"><label class="green">f. Kendala Komunikasi</label></div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Kemauan menerima pendidikan</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <textarea class="form-control input-sm" id="MENERIMA_PENDIDIKAN" name="MENERIMA_PENDIDIKAN" placeholder=""><?php echo $MENERIMA_PENDIDIKAN; ?></textarea>
                              <button type="button" class="btn btn-default btn-xs red" value="Tidak" onclick="copy_to(this.value,'MENERIMA_PENDIDIKAN')">Tidak ada</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Ada,.." onclick="copy_to(this.value,'MENERIMA_PENDIDIKAN')">Ada,..</button>
                             </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Identifikasi nilai nilai kepercayaan pasien dan keluarga </label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <textarea class="form-control input-sm" rows="4" id="IDENTIFIKASI_KEPERCAYAAN_PASIEN" name="IDENTIFIKASI_KEPERCAYAAN_PASIEN" placeholder=""><?php echo $IDENTIFIKASI_KEPERCAYAAN_PASIEN; ?></textarea>
                              <div class="row">
                                <div class="col-md-6">
                                  <button type="button" class="btn btn-default btn-xs red" value="Menolak dilakukan tranfusi" onclick="copy_to(this.value,'IDENTIFIKASI_KEPERCAYAAN_PASIEN')">Menolak dilakukan tranfusi</button><br>
                                  <button type="button" class="btn btn-default btn-xs red" value="Menolak pulang pada hari tertentu" onclick="copy_to(this.value,'IDENTIFIKASI_KEPERCAYAAN_PASIEN')">Menolak pulang pada hari tertentu</button><br>
                                  <button type="button" class="btn btn-default btn-xs red" value="Menolak dilayani oleh petugas lain jenis" onclick="copy_to(this.value,'IDENTIFIKASI_KEPERCAYAAN_PASIEN')">Menolak dilayani oleh petugas lain jenis</button><br>
                                  <button type="button" class="btn btn-default btn-xs red" value="Menolak diberikan imunisasi" onclick="copy_to(this.value,'IDENTIFIKASI_KEPERCAYAAN_PASIEN')">Menolak diberikan imunisasi</button>
                                </div>
                                <div class="col-md-6">
                                  <button type="button" class="btn btn-default btn-xs red" value="Lebih meyakini terapi alternatif" onclick="copy_to(this.value,'IDENTIFIKASI_KEPERCAYAAN_PASIEN')">Lebih meyakini terapi alternatif</button><br>
                                  <button type="button" class="btn btn-default btn-xs red" value="Tidak memakan makanan tertentu" onclick="copy_to(this.value,'IDENTIFIKASI_KEPERCAYAAN_PASIEN')">Tidak memakan makanan tertentu</button><br>
                                  <button type="button" class="btn btn-default btn-xs red" value="Sakit tidak wajib sholat" onclick="copy_to(this.value,'IDENTIFIKASI_KEPERCAYAAN_PASIEN')">Sakit tidak wajib sholat</button>
                                </div>
                              </div>
                            </div>
                        </div> 

                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12"><label class="control-label"><label class="green">g. Assesmen Spiritual</label></div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Halangan beribadah</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <textarea class="form-control input-sm" id="HALANGAN_BERIBADAH" name="HALANGAN_BERIBADAH" placeholder=""><?php echo $HALANGAN_BERIBADAH; ?></textarea>
                              <button type="button" class="btn btn-default btn-xs red" value="Tidak" onclick="copy_to(this.value,'HALANGAN_BERIBADAH')">Tidak ada</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Ada,.." onclick="copy_to(this.value,'HALANGAN_BERIBADAH')">Ada,..</button>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Kebutuhan Bimbingan Beribadah </label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <textarea class="form-control input-sm" id="KEBUTUHAN_BIMBINGAN_IBADAH" name="KEBUTUHAN_BIMBINGAN_IBADAH" placeholder=""><?php echo $KEBUTUHAN_BIMBINGAN_IBADAH; ?></textarea>
                              <button type="button" class="btn btn-default btn-xs red" value="Tidak" onclick="copy_to(this.value,'KEBUTUHAN_BIMBINGAN_IBADAH')">Tidak ada</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Bahasa" onclick="copy_to(this.value,'KEBUTUHAN_BIMBINGAN_IBADAH')">Ada,..</button>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Mengingatkan Waktu Sholat</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <textarea class="form-control input-sm" id="MENGINGATKAN_SHOLAT" name="MENGINGATKAN_SHOLAT" placeholder=""><?php echo $MENGINGATKAN_SHOLAT; ?></textarea>
                              <button type="button" class="btn btn-default btn-xs red" value="Tidak" onclick="copy_to(this.value,'MENGINGATKAN_SHOLAT')">Tidak ada</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Ada,.." onclick="copy_to(this.value,'MENGINGATKAN_SHOLAT')">Ada,..</button>
                            </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-12"><label class="control-label"><label class="green">h. Riwayat Psikiosoial</label></div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Kendala Komunikasi</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <textarea class="form-control input-sm" id="KENDALA_KOMUNIKASI" name="KENDALA_KOMUNIKASI" placeholder=""><?php echo $KENDALA_KOMUNIKASI; ?></textarea>
                              <button type="button" class="btn btn-default btn-xs red" value="Tidak" onclick="copy_to(this.value,'KENDALA_KOMUNIKASI')">Tidak ada</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Ada,.." onclick="copy_to(this.value,'KENDALA_KOMUNIKASI')">Ada,..</button>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Yang Merawat di Rumah</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <textarea class="form-control input-sm" id="MERAWAT_DIRUMAH" name="MERAWAT_DIRUMAH" placeholder=""><?php echo $MERAWAT_DIRUMAH; ?></textarea>
                              <button type="button" class="btn btn-default btn-xs red" value="Tidak" onclick="copy_to(this.value,'MERAWAT_DIRUMAH')">Tidak ada</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Ada,.." onclick="copy_to(this.value,'MERAWAT_DIRUMAH')">Ada,..</button>
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3">Mengingatkan Waktu Sholat</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                              <textarea class="form-control input-sm" id="MENGINGATKAN_SHOLAT" name="MENGINGATKAN_SHOLAT" placeholder=""><?php echo $MENGINGATKAN_SHOLAT; ?></textarea>
                              <button type="button" class="btn btn-default btn-xs red" value="Tidak" onclick="copy_to(this.value,'MENGINGATKAN_SHOLAT')">Tidak ada</button>
                              <button type="button" class="btn btn-default btn-xs red" value="Ada,.." onclick="copy_to(this.value,'MENERIMA_PENDIDIKAN')">Ada,..</button>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="clearfix">
                <hr>
              </div>

              <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-9">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3 blue">DIAGNOSIS MEDIS</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <textarea class="form-control input-sm" id="DIAGNOSIS_MEDIS" name="DIAGNOSIS_MEDIS" placeholder="Diagnosis medis"><?php echo $DIAGNOSIS_MEDIS; ?></textarea>
                      </div>
                  </div>                  
                </div>
              </div>
              
              <div class="row"  style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-9">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3 blue">DIAGNOSIS KEPERAWATAN</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <textarea class="form-control input-sm" id="DIAGNOSIS_KEPERAWATAN" name="DIAGNOSIS_KEPERAWATAN" placeholder="Diagnosis keperawatan"><?php echo $DIAGNOSIS_KEPERAWATAN; ?></textarea>
                      </div>
                  </div>
                </div>
              </div>

              <div class="row"  style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-9">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3 blue">DIAGNOSIS GIZI/PSIKOLOGI</label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <textarea class="form-control input-sm" id="DIAGNOSIS_GIZI_PSIKOLOG" name="DIAGNOSIS_GIZI_PSIKOLOG" placeholder="Diagnosis keperawatan"><?php echo $DIAGNOSIS_GIZI_PSIKOLOG; ?></textarea>
                      </div>
                  </div>
                </div>
              </div>

              <div class="clearfix">
                <hr>
              </div>
              
              <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3">INTERVENSI (Rekapitulasi Pre-Intra dan Post-HD)</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <textarea class="form-control input-sm" rows="4" id="INTERVENSI_REKAPITULASI" name="INTERVENSI_REKAPITULASI" placeholder=""><?php echo $INTERVENSI_REKAPITULASI; ?></textarea>
                      <div class="row">
                        <div class="col-md-6">
                          <button type="button" class="btn btn-default btn-xs red" value="Monitoring berat badan, Intake output" onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">Monitoring berat badan, Intake output</button><br>
                          <button type="button" class="btn btn-default btn-xs red" value="Atur posisi pasien agar ventilasi adekuat" onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">Atur posisi pasien agar ventilasi adekuat</button><br>
                          <button type="button" class="btn btn-default btn-xs red" value="Berikan terapi oksigen sesuai kebutuhan" onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">Berikan terapi oksigen sesuai kebutuhan</button><br>
                          <button type="button" class="btn btn-default btn-xs red" value="Observasi pasien (monitoring vital sign) dan mesin" onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">Observasi pasien (monitoring vital sign) dan mesin</button><br>
                          <button type="button" class="btn btn-default btn-xs red" value="Hentikan HD sesuai indikasi" onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">Hentikan HD sesuai indikasi</button><br>
                          <button type="button" class="btn btn-default btn-xs red" value="Kaji kemampuan pasien mendapatkan nutrisi yang dibutuhkan" onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">Kaji kemampuan pasien mendapatkan nutrisi yang dibutuhkan</button>
                          <button type="button" class="btn btn-default btn-xs red" value="Posisikan supinasi dengan elevasi kepala 30" dan elevasi kaki" onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">Posisikan supinasi dengan elevasi kepala 30" dan elevasi kaki</button><br>
                          <button type="button" class="btn btn-default btn-xs red" value="Bila pasien mulai hipotensi, (mual, muntah, keringat dingin, pusing, kram, hipoglikemi berikan caira sesuai SPO)" onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">Bila pasien mulai hipotensi, (mual, muntah, keringat dingin, pusing, kram, hipoglikemi berikan caira sesuai SPO)</button>
                        </div>
                        <div class="col-md-6">
                          <button type="button" class="btn btn-default btn-xs red" value="PENKES: diet, AV-Shunt,.." onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">PENKES: diet, AV-Shunt,..</button><br>
                          <button type="button" class="btn btn-default btn-xs red" value="Monitor tanda dan gejala infeksi (lokal dan sistematik)" onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">Monitor tanda dan gejala infeksi (lokal dan sistematik)</button><br>
                          <button type="button" class="btn btn-default btn-xs red" value="Ganti balutan luka sesuai dengan prosedur" onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">Ganti balutan luka sesuai dengan prosedur</button><br>
                          <button type="button" class="btn btn-default btn-xs red" value="Monitor tanda dan gejala hipoglikemi" onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">Monitor tanda dan gejala hipoglikemi</button><br>
                          <button type="button" class="btn btn-default btn-xs red" value="Lakukan teknik relaksasi" onclick="copy_to(this.value,'INTERVENSI_REKAPITULASI')">Lakukan teknik relaksasi</button><br>
                        </div>
                      </div>
                    </div>
                </div>
              </div>

              <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3">INTERVENSI KOLABORASI</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <textarea class="form-control input-sm" rows="4" id="INTERVENSI_KOLABORASI" name="INTERVENSI_KOLABORASI" placeholder=""><?php echo $INTERVENSI_KOLABORASI; ?></textarea>
                      <div class="row">
                        <div class="col-md-12">
                          <button type="button" class="btn btn-default btn-xs red" value="Program HD" onclick="copy_to(this.value,'INTERVENSI_KOLABORASI')">Program HD</button>
                          <button type="button" class="btn btn-default btn-xs red" value="Transfusi darah" onclick="copy_to(this.value,'INTERVENSI_KOLABORASI')">Transfusi darah</button>
                          <button type="button" class="btn btn-default btn-xs red" value="Kolaborasi diit" onclick="copy_to(this.value,'INTERVENSI_KOLABORASI')">Kolaborasi diit</button>
                          <button type="button" class="btn btn-default btn-xs red" value="Pemberian CaGlukonas" onclick="copy_to(this.value,'INTERVENSI_KOLABORASI')">Pemberian CaGlukonas</button>
                          <button type="button" class="btn btn-default btn-xs red" value="Pemberian antipiretik dan analgesik" onclick="copy_to(this.value,'INTERVENSI_KOLABORASI')">Pemberian antipiretik dan analgesik</button><br>
                          <button type="button" class="btn btn-default btn-xs red" value="Pemberian preparat besi" onclick="copy_to(this.value,'INTERVENSI_KOLABORASI')">Pemberian preparat besi</button>
                          <button type="button" class="btn btn-default btn-xs red" value="Pemberian Erytropoetin" dan elevasi kaki" onclick="copy_to(this.value,'INTERVENSI_KOLABORASI')">Pemberian Erytropoetin</button>
                          <button type="button" class="btn btn-default btn-xs red" value="Obat - obatan emergensi" onclick="copy_to(this.value,'INTERVENSI_KOLABORASI')">Obat - obatan emergensi</button>
                          <button type="button" class="btn btn-default btn-xs red" value="Pemberian antibiotik" onclick="copy_to(this.value,'INTERVENSI_KOLABORASI')">Pemberian antibiotik</button>
                        </div>
                      </div>
                    </div>
                </div>
              </div>

              <div class="clearfix"><hr></div>
              <b>INTERVENSI MEDIK</b>
              
              <div class="row" style="margin-top: 25px;">
                <div class="col-md-6">
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">RESEP HD</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <input type="text" class="form-control input-sm" name="RESEP_HD" id="RESEP_HD" value="<?php echo $RESEP_HD; ?>">
                      <div class="row">
                        <div class="col-md-12" style="margin-bottom: 20px;">
                          <button type="button" class="btn btn-default btn-xs red" value="Inisiasi" onclick="copy_to(this.value,'RESEP_HD')">Inisiasi</button>
                          <button type="button" class="btn btn-default btn-xs red" value="Akut" onclick="copy_to(this.value,'RESEP_HD')">Akut</button>
                          <button type="button" class="btn btn-default btn-xs red" value="Rutin" onclick="copy_to(this.value,'RESEP_HD')">Rutin</button>
                          <button type="button" class="btn btn-default btn-xs red" value="Pre-OP" onclick="copy_to(this.value,'RESEP_HD')">Pre-OP</button>
                          <button type="button" class="btn btn-default btn-xs red" value="SLED" onclick="copy_to(this.value,'RESEP_HD')">SLED</button><br>
                          <button type="button" class="btn btn-default btn-xs red" value="Lainya" onclick="copy_to(this.value,'RESEP_HD')">Lainya ...</button>
                        </div>
                      </div>
                    </div>
                  </div>                        
            
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">TD</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm" id="TD" name="TD" placeholder="" value="<?php echo $TD; ?>">
                        <span class="input-group-btn">
                          <div disabled class="btn btn-primary btn-sm">Jam</div>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">QB</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm" id="QB" name="QB" placeholder="" value="<?php echo $QB; ?>">
                        <span class="input-group-btn">
                          <div disabled class="btn btn-primary btn-sm">ml/menit</div>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">QD</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm" id="QD" name="QD" placeholder="" value="<?php echo $QD; ?>">
                        <span class="input-group-btn">
                          <div disabled class="btn btn-primary btn-sm">ml.menit</div>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">UF Goal</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm" id="UF_GOAL" name="UF_GOAL" placeholder="" value="<?php echo $UF_GOAL; ?>">
                        <span class="input-group-btn">
                          <div disabled class="btn btn-primary btn-sm">ml</div>
                        </span>
                      </div>
                    </div>
                  </div>                          

                </div>

                <div class="col-md-6">
                  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6"><label class="control-label" style="margin-left: 20px;">Dialisat</label></div>
                      <div class="col-md-6">
                        <input type="text" class="form-control input-sm" name="DIALISAT" id="DIALISAT" value="<?php echo $DIALISAT; ?>">
                        <button type="button" class="btn btn-default btn-xs red" value="Asetat" onclick="copy_to(this.value,'DIALISAT')">Asetat</button>
                        <button type="button" class="btn btn-default btn-xs red" value="Bicarbonat" onclick="copy_to(this.value,'DIALISAT')">Bicarbonat</button>
                      </div>
                    </div>
                  </div>
  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6"><label class="control-label" style="margin-left: 20px;">Conduktiviti</label></div>
                      <div class="col-md-6">
                        <input type="text" class="form-control input-sm" name="CONDUCTIVITI" id="CONDUCTIVITI" value="<?php echo $CONDUCTIVITI; ?>">
                      </div>
                    </div>                                
                  </div>
  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6"><label class="control-label" style="margin-left: 20px;">Temperatur</label></div>
                      <div class="col-md-6">
                        <input type="text" class="form-control input-sm" name="TEMPERATUR" id="TEMPERATUR" value="<?php echo $TEMPERATUR; ?>">
                      </div>
                    </div>                                
                  </div>
  
                  <b>Prog Proling :</b>
  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6" style="text-align: right;"><label class="control-label">NA</label></div>
                      <div class="col-md-6">
                        <input type="text" class="form-control input-sm" name="PROLING_NA" id="PROLING_NA" value="<?php echo $PROLING_NA; ?>">
                      </div>
                    </div>                                
                  </div>
  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6" style="text-align: right;"><label class="control-label">UF</label></div>
                      <div class="col-md-6">
                        <input type="text" class="form-control input-sm" name="PROLING_UF" id="PROLING_UF" value="<?php echo $PROLING_UF; ?>">
                      </div>
                    </div>                                
                  </div>
  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6" style="text-align: right;"><label class="control-label" style="margin-left: 20px;">Bicarbonat</label></div>
                      <div class="col-md-6">
                        <select class="form-control input-sm" id="BICARBONAT" name="BICARBONAT">
                          <option value="0" <?php if($BICARBONAT=='0'){ echo " selected "; } ?>Tidak</option>
                          <option value="1" <?php if($BICARBONAT=='1'){ echo " selected "; } ?>Ya</option>
                        </select>
                      </div>
                    </div>
                  </div>
  
                  
  
                </div>                         
                
              </div>

              <div class="row">
                <div class="col-md-6">
                  <b>Heparinisasi</b>

                  <div class="form-group" style="margin-top: 20px;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Dosis sirkulasi</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm" id="DOSIS_SIRKULASI" name="DOSIS_SIRKULASI" placeholder="" value="<?php echo $DOSIS_SIRKULASI; ?>">
                        <span class="input-group-btn">
                          <div disabled class="btn btn-primary btn-sm">UI</div>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Dosis awal</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm" id="DOSIS_AWAL" name="DOSIS_AWAL" placeholder="" value="<?php echo $DOSIS_AWAL; ?>">
                        <span class="input-group-btn">
                          <div disabled class="btn btn-primary btn-sm">UI</div>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">LMWH</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <select class="form-control input-sm" id="BICARBONAT" name="BICARBONAT">
                        <option value="0" <?php if($BICARBONAT=='0'){ echo " selected "; } ?>Tidak</option>
                        <option value="1" <?php if($BICARBONAT=='1'){ echo " selected "; } ?>Ya</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">(Penyebab) Tanpa Heparin </label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <div class="input-group"></div>
                      <input type="text" class="form-control input-sm" name="TANPA_HEPARIN" id="TANPA_HEPARIN" value="<?php echo $TANPA_HEPARIN; ?>">
                    </div>
                  </div>

                </div>

                <div class="col-md-6">
                  <div class="row" style="margin-top: 40px;"></div>
                  <b style="margin-left: 10px;margin-bottom: 20px;">Dosis Maintenance</b>                             
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Continue</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm" id="MAINT_CONTINUE" name="MAINT_CONTINUE" placeholder="" value="<?php echo $MAINT_CONTINUE; ?>">
                        <span class="input-group-btn">
                          <div disabled class="btn btn-primary btn-sm">UI/Jam</div>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Intermitten</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm" id="MAINT_INTERMITEN" name="MAINT_INTERMITEN" placeholder="" value="<?php echo $MAINT_INTERMITEN; ?>">
                        <span class="input-group-btn">
                          <div disabled class="btn btn-primary btn-sm">UI</div>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="row"  style="margin-top: 10px;margin-bottom: 10px;">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3 blue">Catatan Lain</label>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <textarea class="form-control input-sm" id="CATATAN_LAIN" name="CATATAN_LAIN" placeholder=""><?php echo $CATATAN_LAIN; ?></textarea>
                          </div>
                      </div>
                  </div>

                </div>
              </div>

              <div class="row">                
                
                <div class="clearfix">
                  <hr>
                </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Perawat</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <select class="form-control input-sm selectpicker" id="NIK_PETUGAS" name="NIK_PETUGAS" data-live-search="true">
                          <option value="">--</option>
                          <?php
                                      if(!is_null($data_perawat))
                                      {
                                        $select_perawat="";
                                        if($data_perawat->response=='200')
                                        {
                                          foreach ($data_perawat->data as $dprw) 
                                          {
                                            if($NIK_PETUGAS1=='')
                                            {
                                              if($dprw->NIK==$this->session->userdata('NIK'))
                                              {
                                                $select_perawat=' selected ';
                                              }
                                              else
                                              {
                                                $select_perawat=' ';
                                              }
                                            }
                                            else
                                            {
                                              if($dprw->NIK==$NIK_PETUGAS1)
                                              {
                                                $select_perawat=' selected ';
                                              }
                                              else
                                              {
                                                $select_perawat=' ';
                                              }
                                            }
                                            echo "<option value='".$dprw->NIK."' ".$select_perawat.">".$dprw->NAMA."</option>";
                                          }
                                        }
                                      }
        
                                      ?>
                        </select>
                      </div>
                  </div> 

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <button type="button" class="btn btn-success" onclick="simpan_asesmen_hd()">Simpan</button>
                      </div>
                  </div>
                
              </div>

              <!-- asdf Akhir koding -->                    
  

        
          </div>
               <!-- </div> -->
          </div>
          </div>
        </div>
        </form>
        
        <style type="text/css">
        .custom-radios-pain-scale div {
          display: inline-block;  
        }
        .custom-radios-pain-scale label {
          display: inline-block;
          font-weight: bold;
          text-align: center;
        }
        .custom-radios-pain-scale input[type="radio"] {
          display: none;
        }
        .custom-radios-pain-scale input[type="radio"] + label span {
          display: inline-block;
          width: 27px;
          height: 27px;
          vertical-align: middle;
          cursor: pointer;
          border-radius: 50%;
          border: 2px solid #FFFFFF;
          box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
          text-align: center;
          line-height: 44px;
        
          background-size: 199px 27px;
          filter: grayscale(180%);
        
        }
        .custom-radios-pain-scale input[type="radio"]:checked + label span {
          display: inline-block;
          background: "asset/img/pain_scale.png";
          background-size: 199px 27px;
          filter: none;
        }
        #div_nyeri_rpk_0 input[type="radio"] + label span {
          background-position: 0px 80px;
        }
        #div_nyeri_rpk_0 input[type="radio"]:checked + label span {
          background-position: 0px 80px;
        }
        #div_nyeri_rpk_1 input[type="radio"] + label span, #div_nyeri_rpk_2 input[type="radio"] + label span {
          background-position: 0px 80px;
        }
        #div_nyeri_rpk_1 input[type="radio"]:checked + label span, #div_nyeri_rpk_2 input[type="radio"]:checked + label span {
          background-position: -35px  80px;
        }
        #div_nyeri_rpk_3 input[type="radio"] + label span, #div_nyeri_rpk_4 input[type="radio"] + label span {
          background-position: 0px 80px;
        }
        #div_nyeri_rpk_3 input[type="radio"]:checked + label span ,#div_nyeri_rpk_4 input[type="radio"]:checked + label span{
          background-position: -270px  80px;
        }
        #div_nyeri_rpk_5 input[type="radio"] + label span, #div_nyeri_rpk_6 input[type="radio"] + label span {
          background-position: 0px 80px;
        }
        #div_nyeri_rpk_5 input[type="radio"]:checked + label span, #div_nyeri_rpk_6 input[type="radio"]:checked + label span {
          background-position: -504px 80px;
        }
        #div_nyeri_rpk_7 input[type="radio"] + label span, #div_nyeri_rpk_8 input[type="radio"] + label span {
          background-position: 0px 80px;
        }
        #div_nyeri_rpk_7 input[type="radio"]:checked + label span, #div_nyeri_rpk_8 input[type="radio"]:checked + label span {
          background-position: -539px 80px;
        }
        #div_nyeri_rpk_9 input[type="radio"] + label span, #div_nyeri_rpk_10 input[type="radio"] + label span {
          background-position: 0px 80px;
        }
        #div_nyeri_rpk_9 input[type="radio"]:checked + label span, #div_nyeri_rpk_10 input[type="radio"]:checked + label span {
          background-position: -574px 80px;
        }
        </style>
        
        <div class="modal fade" id="form_riwayat_kehamilan_persalinan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title blue" id="myModalLabel">Tambahkan Riwayat Persalinan</h4>
                        </div>
                    
                        <div class="modal-body">
                            <form id="frm_riwayat_persalinan" class="form-horizontal form-label-left">
                              <input type="hidden" name="KD_UNIT" value="<?php echo $dt->KD_UNIT; ?>">
                              <input type="hidden" name="NO_REG" value="<?php echo $dt->NO_REG; ?>">
                              <input type="hidden" name="NO_CM" value="<?php echo $dt->NO_CM; ?>">
                              <input type="hidden" name="NO_URUT" id="NO_URUT_RBID" value="">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Tahun</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                  <input type="text" class="form-control input-sm" name="TAHUN" id="TAHUN_RBID" oninput="angka(this)">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Umur Kehamilan</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                  <input type="text" class="form-control input-sm" name="UMUR_KEHAMILAN" id="UMUR_KEHAMILAN_RBID" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Persalinan</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                  <input type="text" class="form-control input-sm" name="PERSALINAN" id="PERSALINAN_RBID" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Oleh</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                  <input type="text" class="form-control input-sm" name="OLEH" id="OLEH_RBID" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">JK</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                  <select class="form-control input-sm" name="JK" id="JK_RBID">
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                  </select>
                                </div>
                              </div>
                              
                                </div>
                                <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">BB</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                  <input type="text" class="form-control input-sm" name="BB" id="BB_RBID" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">H/M</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                  <input type="text" class="form-control input-sm" name="H_M" id="H_M_RBID" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">HPP</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                  <input type="text" class="form-control input-sm" name="HPP" id="HPP_RBID" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">PEB</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                  <input type="text" class="form-control input-sm" name="PEB" id="PEB_RBID" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">FEBRIS</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                  <input type="text" class="form-control input-sm" name="FEBRIS" id="FEBRIS_RBID" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                  <button type="button" class="btn btn-success btn-sm" onclick="simpan_riwayat_persalinan()">Simpan</button>
                                </div>
                              </div>
                                </div>
                              </div>
                              
                              
                            </form>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="clear_form_riwayat_persalinan()">Tutup</button>
                        </div>
                    </div>
                </div>
        </div>
        
        <script type="text/javascript">
        function copy_to(source,dest)
        {
          var existing=$('#'+dest).val();
          if(existing!='')
          {
              existing+=",";
              $('#'+dest).val(existing+' '+source);
          }
          else
          {
            $('#'+dest).val(source);
          }
        }
        
        function cek_alergi(cmp)
        {
            if($(cmp).is(':checked'))
            {
              $('#ALERGI').attr('readonly',false);
              $('#ALERGI').focus();
            }
            else
            {
              $('#ALERGI').attr('readonly',true);
              $('#ALERGI').val('');
            }
        }
        
        function cek_terlayani_binroh(cmp)
        {
          if($(cmp).is(':checked'))
            {
              $('#NM_BINROH').attr('readonly',false);
              $('#NM_BINROH').focus();
            }
            else
            {
              $('#NM_BINROH').attr('readonly',true);
              $('#NM_BINROH').val('');
            }
        }
        
        function clear_form_riwayat_persalinan()
         {
            $('#NO_URUT_RBID').val('');
            $('#TAHUN_RBID').val('');
            $('#UMUR_KEHAMILAN_RBID').val('');
            $('#PERSALINAN_RBID').val('');
            $('#OLEH_RBID').val('');
            $('#JK_RBID').val('');
            $('#BB_RBID').val('');
            $('#H_M_RBID').val('');
            $('#HPP_RBID').val('');
            $('#PEB_RBID').val('');
            $('#FEBRIS_RBID').val('');
         }
        
         function tambah_riwayat_persalinan()
          {
            clear_form_riwayat_persalinan();
            $('#form_riwayat_kehamilan_persalinan').modal({
                show: 'true'
            }); 
          }
        
        function simpan_riwayat_persalinan()
         {
        
           $.ajax({
               url : "<?php echo base_url('index.php/ranap/simpan_riwayat_persalinan'); ?>",
               type : "post",
               data : $('#frm_riwayat_persalinan').serialize(),
               success:function(resp)
               {
        
                  md_info(resp); 
                  clear_form_riwayat_persalinan();
                  reload_riwayat_persalinan();
               }
             });
         }
        
         function hapus_riwayat_hamil(cmp)
         {
          var kode=$(cmp).attr('urut');
          if(kode!='')
          {
            $.ajax({
               url : "<?php echo base_url('index.php/ranap/hapus_riwayat_persalinan'); ?>",
               type : "post",
               data : {
                NO_URUT : kode
               },
               success:function(resp)
               {
                  md_info(resp); 
                  reload_riwayat_persalinan();
               }
             });
          }
         }
        
        function edit_riwayat_hamil(cmp)
        {
          var kode=$(cmp).attr('urut');
          if(kode!='')
          {
        
            $.ajax({
              url : "<?php echo base_url('index.php/ranap/detail_riwayat_persalinan'); ?>",
              type : "post",
              dataType : "json",
              async : false,
              data : {
               NO_URUT : kode
             },
             success:function(resp)
             {
        
                if(resp.response=='200')
                {
                  $('#NO_URUT_RBID').val(resp.data.NO_URUT);
                  $('#TAHUN_RBID').val(resp.data.TAHUN);
                  $('#UMUR_KEHAMILAN_RBID').val(resp.data.UMUR_KEHAMILAN);
                  $('#PERSALINAN_RBID').val(resp.data.PERSALINAN);
                  $('#OLEH_RBID').val(resp.data.OLEH);
                  $('#JK_RBID').val(resp.data.JK);
                  $('#BB_RBID').val(resp.data.BB);
                  $('#H_M_RBID').val(resp.data.H_M);
                  $('#HPP_RBID').val(resp.data.HPP);
                  $('#PEB_RBID').val(resp.data.PEB);
                  $('#FEBRIS_RBID').val(resp.data.FEBRIS);
                  
                  $('#form_riwayat_kehamilan_persalinan').modal({
                      show: 'true'
                  }); 
                }
                else
                {
                  $('#NO_URUT_RBID').val('');
                  $('#TAHUN_RBID').val('');
                  $('#UMUR_KEHAMILAN_RBID').val('');
                  $('#PERSALINAN_RBID').val('');
                  $('#OLEH_RBID').val('');
                  $('#JK_RBID').val('');
                  $('#BB_RBID').val('');
                  $('#H_M_RBID').val('');
                  $('#HPP_RBID').val('');
                  $('#PEB_RBID').val('');
                  $('#FEBRIS_RBID').val('');
                  md_warning("Data tidak ditemukan!");
                }
              }
            });
          }
          else
          {
                  $('#NO_URUT_RBID').val('');
                  $('#TAHUN_RBID').val('');
                  $('#UMUR_KEHAMILAN_RBID').val('');
                  $('#PERSALINAN_RBID').val('');
                  $('#OLEH_RBID').val('');
                  $('#JK_RBID').val('');
                  $('#BB_RBID').val('');
                  $('#H_M_RBID').val('');
                  $('#HPP_RBID').val('');
                  $('#PEB_RBID').val('');
                  $('#FEBRIS_RBID').val('');
                  md_warning("Data tidak ditemukan!");
          }
        
        }
        
         function reload_riwayat_persalinan()
         {
           $.ajax({
               url : "<?php echo base_url('index.php/ranap/reload_riwayat_persalinan'); ?>",
               type : "post",
               data : {
                        NO_CM : $('#NO_CM').val(),
                        NO_REG : $('#NO_REG').val(),
                        KD_UNIT : $('#KD_UNIT').val()
                      },
               success:function(resp)
               {
                  $('#data_riwayat_kehamilan_persalinan').html(resp);
                  
               }
             });
         }
        
          function gcs_score()
          {
            var e=parseInt($('#GCS_E_AS').val());
            var m=parseInt($('#GCS_M_AS').val());
            var v=parseInt($('#GCS_V_AS').val());
            if((e!='') && (m!='') && (v!=''))
            {
              var val=e+m+v;
              var lbl="";
              if(val>=14 && val <= 15)
              {
                lbl="Composmentis";
                $('#gcs_score').attr('class','btn btn-success btn-sm');
              };
          
              if(val>=12 && val <= 13)
              {
                lbl="Apatis";
                $('#gcs_score').attr('class','btn btn-success btn-sm');
              };
              if(val>=10 && val <= 11)
              {
                lbl="Delirium";
                $('#gcs_score').attr('class','btn btn-warning btn-sm');
              };
              if(val>=7 && val <= 9)
              {
                lbl="Somnolen";
                $('#gcs_score').attr('class','btn btn-danger btn-sm');
              };
              if(val>=5 && val <= 6)
              {
                lbl="Sopor";
                $('#gcs_score').attr('class','btn btn-danger btn-sm');
              };
          
              if(val==4)
              {
                lbl="Semi-coma";
                $('#gcs_score').attr('class','btn btn-danger btn-sm');
              };
          
              if(val==3)
              {
                lbl="Coma";
                $('#gcs_score').attr('class','btn btn-danger btn-sm');
              };
          
              $('#GCS_SCORE').val(val.toString());
              $('#KESADARAN').val(lbl);
              $('#gcs_score').text(lbl);
          
            }
            else
            {
              $('#GCS_SCORE').val('');
              $('#KESADARAN').val('');
              $('#gcs_score').text('');
            }
        
          }
        
        function status_mental(kode)
        {
          if(kode=='7')
          {
            $('#NM_STATUS_MENTAL').val('');
            $('#kolom_status_mental').slideDown('slow');
          }
          else
          {
            $('#kolom_status_mental').slideUp('slow');
            $('#NM_STATUS_MENTAL').val($("#STATUS_MENTAL option:selected").text());
          }
        }
        
        function cek_kejang(cmp)
         {
           if($(cmp).is(':checked'))
           {
             $('#TIPE_KEJANG').attr('readonly',false);
             $('#TIPE_KEJANG').focus();
           }
           else
           {
             $('#TIPE_KEJANG').attr('readonly',true);
             $('#TIPE_KEJANG').val('');
           }
         }
        
         function cek_hamil(kode)
         {
           if(kode=='Y')
           {
             hitung_hpl();
             $('#kolom_hamil').slideDown('slow');
           }
           else
           {
             $('#kolom_hamil').slideUp('slow');
           }
         }
        
        function hitung_hpl()
        {
          var tgl=$('#TGL_HPHT').val().split('/');
          var tahun=tgl[2];
          var bulan=tgl[1];
          var hari=tgl[0];
        
          var h=hari;
          var b=bulan;
          var t=tahun;
        
          if(parseInt(bulan)>=1 && parseInt(bulan)<=3)
          {
            t=tahun;
            b=parseInt(bulan)+9;
            h=parseInt(hari)+7;
          }
          else if(parseInt(bulan)>=4 && parseInt(bulan)<=12)
          {
            t=parseInt(tahun)+1;
            b=parseInt(bulan)-3;
            h=parseInt(hari)+7;
          };
        
        
          if(h.toString().length==1)
          {
            h='0'+h;
          };
          if(b.toString().length==1)
          {
            b='0'+b;
          };
        
        
          $('#TGL_HPL').val(h.toString()+'/'+b.toString()+'/'+t.toString());
        }
        
        
        <?php
        
        if(!is_null($data_skrining_nyeri))
        {
          if($data_skrining_nyeri->response=='200')
          {
              echo ' var posisi_nyeri='.count($data_skrining_nyeri->data).';';
          }
          else
          {
            echo ' var posisi_nyeri=0; ';
          }
        }
        else
        {
          echo ' var posisi_nyeri=0; ';
        }
        
        ?>
        
        
        function tambah_kolom_nyeri()
        {
          posisi_nyeri +=1;
        
          var ht='<tr id="pilihan_nyeri'+posisi_nyeri+'">'+
                    '<td>'+
                      '<input type="text" class="form-control" required="required" id="LOKASI_NYERI'+posisi_nyeri+'" name="LOKASI_NYERI[]">'+
                    '</td>'+
                    '<td>'+
                      '<input type="number" min="0" max="10" class="form-control" required="required" id="INTENSITAS_NYERI'+posisi_nyeri+'" name="INTENSITAS_NYERI[]">'+
                    '</td>'+
                    '<td>'+
                      '<input type="text" class="form-control" required="required" id="DURASI_NYERI'+posisi_nyeri+'" name="DURASI_NYERI[]">'+
                    '</td>'+
                    '<td>'+
                      '<input type="text" class="form-control" required="required" id="PENCETUS_NYERI'+posisi_nyeri+'" name="PENCETUS_NYERI[]">'+
                    '</td>'+
                    '<td>'+
                      '<select class="form-control input-sm" required="required" id="KUALITAS_NYERI'+posisi_nyeri+'" name="KUALITAS_NYERI[]">'+
                        '<option value="">-</option>'+
                        '<option value="TERBAKAR">TERBAKAR</option>'+
                        '<option value="TUMPUL">TUMPUL</option>'+
                        '<option value="TERTEKAN">TERTEKAN</option>'+
                        '<option value="BERAT">BERAT</option>'+
                        '<option value="TAJAM">TAJAM</option>'+
                        '<option value="KRAM">KRAM</option>'+
                      '</select>'+
                    '</td>'+
                    '<td>'+
                      '<select class="form-control input-sm" required="required" id="POLA_NYERI'+posisi_nyeri+'" name="POLA_NYERI[]">'+
                        '<option value="">-</option>'+
                        '<option value="MENETAP">MENETAP</option>'+
                        '<option value="INTERMITEN">INTERMITEN</option>'+
                      '</select>'+
                    '</td>'+
                    '<td>'+
                      '<input type="text" class="form-control" required="required" id="KETERANGAN_NYERI'+posisi_nyeri+'" name="KETERANGAN_NYERI[]">'+
                    '</td>'+
                    '<td>'+
                      '<button class="btn btn-danger" type="button" onclick="hapus_kolom_nyeri('+posisi_nyeri+')"><i class="fa fa-trash"></i></button>'+
                    '</td>'+
                '</tr>';
          $('#body_item_nyeri').append(ht);
        }
        
        function hapus_kolom_nyeri(urut)
        {
          if(urut>0)
          {
            $('#pilihan_nyeri'+urut).remove();
          }
          else
          {
            $('#LOKASI_NYERI0').val('');
            $('#INTENSITAS_NYERI0').val('');
            $('#DURASI_NYERI0').val('');
            $('#PENCETUS_NYERI0').val('');
            $('#KUALITAS_NYERI0').val('');
            $('#POLA_NYERI0').val('');
            $('#KETERANGAN_NYERI0').val('');
          }
        }
        
        function simpan_asesmen_hd()
        {
          var pengkaji=$('#NIK_PETUGAS').val();
          if(pengkaji!='')
          {
            $.ajax({
              url : "<?php echo base_url('index.php/ranap/simpan_asesmen_perawat_ranap'); ?>",
              type : "post",
              data : $('#frm_asesmen_awal_keperawatan_ranap').serialize(),
              success:function(resp)
              {
                md_info(resp);
              }
            });
          }
          else
          {
            md_warning('Perawat belum diisi!');
          }
        }
        </script>


