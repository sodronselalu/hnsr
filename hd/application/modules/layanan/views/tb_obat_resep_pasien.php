<table id="tb_obat_resep_pasien" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Obat</th>
      <th>Jum. Pakai</th>
      <th>Dosis/Aturan</th>
      <th>Pemakaian</th>
      <th>Rute</th>
      <th>Periode</th>
      <th>Instruksi</th>
      <th>Pilih</th>
    </tr>
  </thead>
  <tbody>
    <?php
   
      if(!is_null($data_obat_resep))
      {
        if($data_obat_resep->response=='200')
        {
          $tmp_racik="";
          foreach ($data_obat_resep->data as $dt) {
            
            if($dt->IS_RACIK=='T')
            {
              if($tmp_racik!=$dt->KD_GROUP_RACIK)
              {
                echo "<tr style='cursor:pointer; background-color:#a5e0d6;'>";
                echo "<td>";
                
                echo "</td>";
                echo "<td>";
                  
                echo "</td>";
                echo "<td>";
                  echo "R/";
                echo "</td>";
                echo "<td>";
                  echo $dt->NM_GROUP_RACIK;
                echo "</td>";
                echo "<td>";
                  echo "Jumlah :".$dt->QTY_RACIK;
                echo "</td>";
                echo "<td>";
                  
                echo "</td>";
                echo "<td>";
                
                echo "</td>";
                echo "<td>";
                
                echo "</td>";
                echo "</tr>";
              $tmp_racik=$dt->KD_GROUP_RACIK;
              }

            echo "<tr style='cursor:pointer;' index='".$dt->INDEX_RESEP."' obat='".$dt->KD_OBAT."' ondbclick='edit_obat_resep(this)'>";
              echo "<td>";
                echo $dt->NAMA_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->JUMLAH.' '.$dt->NM_SATUAN_VOLUME;
              echo "</td>";
              echo "<td>";
               echo $dt->DOSIS_PAKAI.' X '.$dt->NM_ATURAN_PAKAI.' / '.$dt->NM_DOSIS_PAKAI;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_WAKTU_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_CARA_PEMBERIAN_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_AWAL_F.' - '.$dt->TGL_AKHIR_F;
              echo "</td>";
              echo "<td>";
                echo $dt->CATATAN;
              echo "</td>";
              echo "<td>";
              if($dt->STATUS_LAYANAN_RESEP=='-1')
              {
                echo '<button type="button" class="btn btn-round btn-primary" title="Edit obat ini?" index="'.$dt->INDEX_RESEP.'" obat="'.$dt->KD_OBAT.'" onclick="edit_obat_resep(this);"><i class="fa fa-check"></i></button>';
                echo '<button type="button" class="btn btn-round btn-danger" title="Hapus obat ini?" index="'.$dt->INDEX_RESEP.'" obat="'.$dt->KD_OBAT.'" onclick="hapus_obat_resep(this);"><i class="fa fa-trash"></i></button>';
              }
              echo "</td>";
            echo "</tr>";
            }
            else
            {
              echo "<tr style='cursor:pointer;' index='".$dt->INDEX_RESEP."' obat='".$dt->KD_OBAT."' ondbclick='edit_obat_resep(this)'>";
              echo "<td>";
                echo $dt->NAMA_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->JUMLAH.' '.$dt->NM_SATUAN_VOLUME;
              echo "</td>";
              echo "<td>";
               echo $dt->DOSIS_PAKAI.' X '.$dt->NM_ATURAN_PAKAI.' / '.$dt->NM_DOSIS_PAKAI;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_WAKTU_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_CARA_PEMBERIAN_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_AWAL_F.' - '.$dt->TGL_AKHIR_F;
              echo "</td>";
              echo "<td>";
                echo $dt->CATATAN;
              echo "</td>";
              echo "<td>";
              if($dt->STATUS_LAYANAN_RESEP=='-1')
              {
                echo '<button type="button" class="btn btn-round btn-primary" title="Edit obat ini?" index="'.$dt->INDEX_RESEP.'" obat="'.$dt->KD_OBAT.'" onclick="edit_obat_resep(this);"><i class="fa fa-check"></i></button>';
                echo '<button type="button" class="btn btn-round btn-danger" title="Hapus obat ini?" index="'.$dt->INDEX_RESEP.'" obat="'.$dt->KD_OBAT.'" onclick="hapus_obat_resep(this);"><i class="fa fa-trash"></i></button>';
              }
              echo "</td>";
            echo "</tr>";
            }
           
          }
        }
      }
    ?>
  </tbody>
</table>
<script type="text/javascript">
$(document).ready(function() 
{
    $('#tb_obat_resep_pasien').DataTable( {
        dom: 'Bfrtip',
        bSort: false,
         buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );
</script>