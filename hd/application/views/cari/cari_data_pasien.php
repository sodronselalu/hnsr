<?php  
$dt=$data_pasien->data;

$NAMA_PJ="";
$HP_PJ="";

if($data_pj->response=='200')
{
	$pj=$data_pj->data;
	$NAMA_PJ=$pj->NM_PJ;
	$HP_PJ=$pj->HP_PJ.'  '.$pj->TELP_PJ;
}
				echo '<div class="row">
						<div class="col-sm-12">
							
							<div class="left col-sm-6">
								<h2>'.$dt->NM_PASIEN.'</h2>
								<p><strong>RM : '.$dt->NO_CM.'</strong></p>
								<p><strong>Alamat : '.$dt->ALAMAT_D.'</strong></p>
								<p><strong>Tgl Lahir: '.$dt->TGL_LAHIR_F.'</strong></p>
								<p><strong>Suami/Istri: '.$NAMA_PJ.'  '.$HP_PJ.'</strong></p>
								<ul class="list-unstyled">
									<li>NIK : <strong>'.$dt->NO_KTP.'</strong></li>
									<li>BPJS : '.$dt->NO_BPJS.'</li>
									<li>HP/Telp : '.$dt->HP.'</li>
								</ul>
							</div>
							<div class="right col-sm-6 text-center">
								<img src="'.asset_url('asset/img/'.icon_gender($dt->JENIS_KELAMIN)).'" title="'.$dt->NM_PASIEN.'" class="img-circle img-fluid">
							</div>
						</div>
					</div>';

					?>