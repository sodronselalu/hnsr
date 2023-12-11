<?php
  if($IOL=='O')
  {
?>
<table id="tb_pasien" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Reg</th>
      <th>RM</th>
      <th>Tgl. Layan</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Layanan</th>
      <th>Unit</th>
      <th>Asuransi</th>
      <th>Dokter</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_pasien))
      {
        if($data_pasien->response=='200')
        {
          foreach ($data_pasien->data as $dt) {
            
            $kode+=1;
            echo "<tr style='cursor:pointer;' reg='".$dt->NO_REG."' unit='".$dt->KD_UNIT."' iol='".$dt->IOL."'>";
              echo "<td>";
                echo $dt->NO_REG;
              echo "</td>";
              echo "<td>";
                echo $dt->NO_CM;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_LAYAN;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_PASIEN;
              echo "</td>";
              echo "<td>";
                echo $dt->ALAMAT;
              echo "</td>";
              echo "<td>";
                echo 'Rawat Jalan';
              echo "</td>";
              echo "<td>";
                echo $dt->NM_UNIT;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_ASURANSI;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_DOKTER;
              echo "</td>";
              echo "<td>";
                switch ($dt->STATUS_PERIKSA) {
                  case '1':
                   echo "<p class='green' > Pasien Belum di Layani unit ".$dt->NM_UNIT."</p> ";
                    break;
                    case '2':
                   echo "<p class='red' > Pasien Telah di Layani unit ".$dt->NM_UNIT."</p> ";
                    break;
                    case '3':
                   echo "<p class='red' > Pasien Telah DIPULANGKAN KASIR </p> ";
                    break;
                }
              echo "</td>";
              echo "<td>";
              if(in_array($dt->STATUS_PERIKSA, array('1','2')))
              {
                echo '<button type="button" class="btn btn-round btn-success" reg="'.$dt->NO_REG.'" unit="'.$dt->KD_UNIT.'" iol="'.$dt->IOL.'" title="Buat tagihan pasien ini?" value="" onclick="pilih_pasien_jl(this)"><i class="fa fa-check-square-o"></i></button>';
              }
              echo "</td>";
            echo "</tr>";
           
          }
        }
      }
    ?>
  </tbody>
</table>
<script type="text/javascript">
$(document).ready(function() 
{
    $('#tb_pasien').DataTable( {
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
         buttons: [
                    /*'copy', 'csv',*/ 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
});

function pilih_pasien_jl(cmp)
{
  var reg=$(cmp).attr('reg');
  var unit=$(cmp).attr('unit');
  var iol=$(cmp).attr('iol');
  tunggu_start();
   $.ajax({
          url : "<?php echo base_url('index.php/tagihan/tagihan_hd/pilih_pasien'); ?>",
          type : "post",
          data : {
            NO_REG : reg,
            KD_UNIT : unit,
            IOL : iol,
          },
          success:function(resp)
          {
            tunggu_end();
            $('#ctn_layan').html(resp);
          }
        });
}

</script>
<?php 

}
elseif($IOL=='I')
{ 
?>

<table id="tb_pasien" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Reg</th>
      <th>RM</th>
      <th>Tgl. Masuk</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Kelas</th>
      <th>Ruang</th>
      <th>Bed</th>
      <th>Asuransi</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_pasien))
      {
        if($data_pasien->response=='200')
        {
          foreach ($data_pasien->data as $dt) {
            
            $kode+=1;
            echo "<tr style='cursor:pointer;' reg='".$dt->NO_REG."' unit='".$dt->KD_UNIT."' iol='".$dt->IOL."' inap='".$dt->NO_URUT_INAP."'>";
              echo "<td>";
                echo $dt->NO_REG;
              echo "</td>";
              echo "<td>";
                echo $dt->NO_CM;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_MASUK;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_PASIEN;
              echo "</td>";
              echo "<td>";
                echo $dt->ALAMAT;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_KELAS;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_RUANG;
              echo "</td>";
              echo "<td>";
                echo $dt->NO_BED;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_ASURANSI;
              echo "</td>";
              echo "<td>";
              if(in_array($dt->STATUS_AKTIF, array('1','2')))
              {
                echo '<button type="button" class="btn btn-round btn-success" reg="'.$dt->NO_REG.'" unit="'.$dt->KD_UNIT.'" iol="'.$dt->IOL.'" inap="'.$dt->NO_URUT_INAP.'" title="Buat tagihan pasien ini?" onclick="pilih_pasien_in(this)"><i class="fa fa-check-square-o"></i></button>';
              }
              echo "</td>";
            echo "</tr>";
           
          }
        }
      }
    ?>
  </tbody>
</table>
<script type="text/javascript">
$(document).ready(function() 
{
    $('#tb_pasien').DataTable( {
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
         buttons: [
                    /*'copy', 'csv',*/ 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
});

function pilih_pasien_in(cmp)
{
  
  var reg=$(cmp).attr('reg');
  var unit=$(cmp).attr('unit');
  var iol=$(cmp).attr('iol');
  var idx=$(cmp).attr('inap');
  tunggu_start();
   $.ajax({
          url : "<?php echo base_url('index.php/tagihan/tagihan_hd/pilih_pasien'); ?>",
          type : "post",
          data : {
                NO_REG : reg,
                KD_UNIT : unit,
                IOL : iol,
                NO_URUT_INAP : idx
              },
          success:function(resp)
          {
            tunggu_end();
            $('#ctn_layan').html(resp);
          }
        });
}

</script>

<?php } ?>