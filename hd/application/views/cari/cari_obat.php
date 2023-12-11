<table id="tb_cari_obat" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Formularium</th>
      <th>Satuan Induk</th>
      <th>isi</th>
      <th>Kemasan</th>
      <th>Hrg. Umum</th>
      <th>Hrg. BPJS</th>
      <th>Stok</th>
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
            echo "<tr style='cursor:pointer;' id='".$dt->KD_OBAT."' ondblclick='pilih_obat(this.id)'>";
              echo "<td>";
                echo $dt->NAMA_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_FORMULARIUM;
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
                echo rupiah($dt->HARGA_JUAL);
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->HARGA_BPJS);
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->SISA);
              echo "</td>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-success" title="Pilih obat ini?" value="'.$dt->KD_OBAT.'" onclick="pilih_obat(this.value)"><i class="fa fa-check-square-o"></i></button>';
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
    $('#tb_cari_obat').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv',*/ 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );
</script>