<table id="tb_permintaan" class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Tanggal</th>
      <th>Kepada</th>
      <th>Nama</th>
      <th>Qty</th>
      <th>Status</th>
      <th>Keterangan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_minta))
      {
        if($data_minta->response=='200')
        {
          foreach ($data_minta->data as $dt) {
            
            $kode+=1;
            echo "<tr style='cursor:pointer;' id='".$dt->URUT_PERMINTAAN."' ondbclick='pilih_minta(this.id)'>";
              echo "<td>";
                echo $dt->TGL_PERMINTAAN;
              echo "</td>";
               echo "<td>";
                echo $dt->NM_GUDANG_MINTA;
              echo "</td>";
              echo "<td>";
                echo $dt->NAMA_OBAT;
              echo "</td>";
              echo "<td>";
                echo $dt->JUMLAH.' '.$dt->NM_SATUAN;
              echo "</td>";
               echo "<td>";
                if($dt->STATUS=='0')
                {
                  echo "<div class='red'>Menunggu</div>";
                }
                else
                {
                  echo "<div class='green'>Telah diproses</div>";
                }
              echo "</td>";
              echo "<td>";
                echo $dt->KETERANGAN;
              echo "</td>";
              echo "<td>";
              if($dt->STATUS=='0')
              {
                echo '<button type="button" class="btn btn-round btn-success" title="Lihat permintaan ini?" value="'.$dt->URUT_PERMINTAAN.'" onclick="pilih_minta(this.value);"><i class="fa fa-edit"></i></button>';
                echo '<button type="button" class="btn btn-round btn-danger" title="Hapus permintaan ini?" value="'.$dt->URUT_PERMINTAAN.'" onclick="hapus_minta(this.value);"><i class="fa fa-trash"></i></button>';
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
    $('#tb_permintaan').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                    /*'copy', 'csv', 'excel', 'pdf', 'print'*/
                 ]
    } );
} );
</script>