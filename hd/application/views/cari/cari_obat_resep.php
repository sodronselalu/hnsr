<table id="tb_cari_obat_resep" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Formularium</th>
      <th>Sat. Formula</th>
      <th>Sat. Pakai</th>
      <th>Jumlah</th>
      <th>Isi</th>
      <th>Sat. Kemasan</th>
      <th>Hrg. Beli Akhir</th>
      <th>Hrg. Jual</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_obat))
      {
        if($data_obat->response=='200')
        {
          foreach ($data_obat->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' id='".$dt->KD_OBAT."' ondblclick='pilih_obat_resep(this.id)'>";
              echo "<td>";
                echo $dt->NAMA_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_FORMULARIUM;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_SATUAN_FORMULA;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_SATUAN_PAKAI;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_SATUAN_QTY;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_SATUAN_VOLUME;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_SATUAN_KEMASAN;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->HARGA_BELI_TERAKHIR);
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->HARGA_JUAL);
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-success" title="Pilih obat ini?" value="'.$dt->KD_OBAT.'" onclick="pilih_obat_resep(this.value)"><i class="fa fa-check-square-o"></i></button>';
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
    $('#tb_cari_obat_resep').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv',*/ 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );
</script>