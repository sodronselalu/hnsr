<table class="table table-striped table-bordered" id="tb_pakai_admin">
  <thead>
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Tarif</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Tagih</th>
    <th>Aksi</th>
  </tr>
  </thead>              
  <tbody>
    <?php
     $kode=0;
      if(!is_null($data_pakai_admin))
      {
        if($data_pakai_admin->response=='200')
        {
          foreach ($data_pakai_admin->data as $dt) {
            $kode+=1;
            echo "<tr style='cursor:pointer;' ondblclick='blok();'>";
              echo "<td>";
                echo $kode;
              echo "</td>";
              echo "<td>";
                echo $dt->NM_ADMINISTRASI;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TARIF);
              echo "</td>";
              echo "<td>";
                echo $dt->QTY;
              echo "</td>";
              echo "<td>";
                echo rupiah($dt->TOTAL);
              echo "</td>";
              echo "<td>";
              /*
                if($dt->IS_TAGIH=='F')
                {
                  echo '<button type="button" class="btn btn-round btn-primary" title="Pilih data ini?" value="'.$dt->NO_INDEX_ADM.'" onclick="tagih_admin(this.value)">Tagih</button>';
                }
                else
                {
                  echo '<button type="button" class="btn btn-round btn-warning" title="Pilih data ini?" value="'.$dt->NO_INDEX_ADM.'" onclick="batal_tagih_admin(this.value)">Batal</button>';
                }*/
                echo is_tagih($dt->IS_TAGIH);
              echo "</td>";
              echo "<td>";
              if($dt->IS_TAGIH=='F')
              {
                echo '<button type="button" class="btn btn-round btn-success" title="Pilih data ini?" value="'.$dt->NO_INDEX_ADM.'" onclick="edit_admin(this.value)"><i class="fa fa-check-square-o"></i></button>';
                echo '<button type="button" class="btn btn-round btn-danger" title="Pilih data ini?" value="'.$dt->NO_INDEX_ADM.'" onclick="hapus_admin(this.value)"><i class="fa fa-trash"></i></button>';
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
    $('#tb_pakai_admin').DataTable( {
        dom: 'Bfrtip',
         buttons: [
                     /*'copy', 'csv', 'excel', 'pdf' /*, 'print'*/
                 ]
    } );
} );


function blok(){
  $('table#tb_pakai_admin tbody tr').on('click', function () {
      $(this).closest('table').find('td').removeClass('btn-info');
      $(this).find('td').addClass('btn-info');
  });
}
</script>