<table id="tb_cari_stok_gudang" class="table table-striped table-hover table-bordered">
  <thead>
    <tr>
      <th>Pilih</th>
      <th>Kode Stock</th>
      <th>Urut</th>
      <th>Nama Obat</th>
      <th>Jumlah</th>
      <th>Isi</th>
      <th>Sisa</th>
      <th>Tgl. Masuk</th>
      <th>Exp. Date</th>
      <th>Hrg. Beli</th>
      <th>Hrg. Beli Satuan</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_stock))
      {
        if($data_stock->response=='200')
        {
          foreach ($data_stock->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' id='".$dt->KD_STOCK."' ondblclick='pilih_stock(this.id)'>";
              echo "<td>";
                echo '<button type="button" class="btn btn-round btn-success" title="Pilih obat ini?" value="'.$dt->KD_STOCK.'" onclick="pilih_stock(this.value)"><i class="fa fa-check-square-o"></i></button>';
              echo "</td>";
              echo "<td>";
                echo $dt->KD_STOCK;
              echo "</td>";
              echo "<td>";
                echo $dt->URUT;
              echo "</td>";
              echo "<td>";
                echo $dt->NAMA_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->NILAI_QTY.' '.$dt->NM_SATUAN_QTY;
              echo "</td>";
              echo "<td>";
                echo $dt->NILAI_VOLUME_SATUAN.' '.$dt->NM_SATUAN_VOLUME;
              echo "</td>";
              echo "<td>";
                echo $dt->QTY_SISA.' '.$dt->NM_SATUAN_VOLUME;
              echo "</td>";
              echo "<td>";
                echo $dt->TGL_MASUK;
              echo "</td>";
              echo "<td>";
                echo $dt->EXPIRED_DATE;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->HARGA_BELI);
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->HARGA_BELI_SATUAN);
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
    $('#tb_cari_stok_gudang').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv', 'excel', 'pdf' , 'print'*/
                 ]
    } );
} );
</script>