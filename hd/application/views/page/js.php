   <!-- FastClick -->
   <script src="<?php echo asset_url('asset/vendors/fastclick/lib/fastclick.js'); ?>"></script>
   <!-- NProgress -->
   <script src="<?php echo asset_url('asset/vendors/nprogress/nprogress.js'); ?>"></script>
   <!-- Chart.js -->
   <script src="<?php echo asset_url('asset/vendors/Chart.js/dist/Chart.min.js'); ?>"></script>
   <!-- gauge.js -->
   <script src="<?php echo asset_url('asset/vendors/gauge.js/dist/gauge.min.js'); ?>"></script>
   <!-- bootstrap-progressbar -->
   <script src="<?php echo asset_url('asset/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js'); ?>"></script>
   <!-- iCheck -->
   <script src="<?php echo asset_url('asset/vendors/iCheck/icheck.min.js'); ?>"></script>
   <!-- Skycons -->
   <script src="<?php echo asset_url('asset/vendors/skycons/skycons.js'); ?>"></script>
   <!-- Flot -->
   <script src="<?php echo asset_url('asset/vendors/Flot/jquery.flot.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/vendors/Flot/jquery.flot.pie.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/vendors/Flot/jquery.flot.time.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/vendors/Flot/jquery.flot.stack.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/vendors/Flot/jquery.flot.resize.js'); ?>"></script>
   <!-- Flot plugins -->
   <script src="<?php echo asset_url('asset/vendors/flot.orderbars/js/jquery.flot.orderBars.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/vendors/flot-spline/js/jquery.flot.spline.min.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/vendors/flot.curvedlines/curvedLines.js'); ?>"></script>
   <!-- DateJS -->
   <script src="<?php echo asset_url('asset/vendors/DateJS/build/date.js'); ?>"></script>
   <!-- JQVMap -->
   <script src="<?php echo asset_url('asset/vendors/jqvmap/dist/jquery.vmap.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/vendors/jqvmap/dist/maps/jquery.vmap.world.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js'); ?>"></script>
   <!-- bootstrap-daterangepicker -->
   <script src="<?php echo asset_url('asset/vendors/moment/min/moment.min.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/vendors/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'); ?>"></script>
   <!-- Datatables -->
   <script src="<?php echo asset_url('asset/datatables/js/jquery.dataTables.min.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/datatables/js/dataTables.buttons.min.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/datatables/js/buttons.flash.min.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/datatables/js/jszip.min.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/datatables/js/pdfmake.min.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/datatables/js/vfs_fonts.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/datatables/js/buttons.html5.min.js'); ?>"></script>
   <script src="<?php echo asset_url('asset/datatables/js/buttons.print.min.js'); ?>"></script>
    
   <script src="<?php echo asset_url('asset/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js'); ?>"></script>
   
   <script src="<?php echo asset_url('asset/vendors/validator/validator.js') ?>"></script>

   <!-- Custom Theme Scripts -->
   <script src="<?php echo asset_url('asset/build/js/custom.js'); ?>"></script>

   <!-- morris.js -->
   <script src="<?php echo asset_url('asset/vendors/raphael/raphael.min.js') ?>"></script>
   <script src="<?php echo asset_url('asset/vendors/morris.js/morris.min.js') ?>"></script>
   <script type="text/javascript">
      function tunggu_start()
      {
         $('#ctn_loader').html(' Harap Menunggu...');
         $('#mdl_wait').modal('show');
         if(!$('#mdl_wait').hasClass('in'))
         {
            $('#ctn_loader').html('<img src="<?php echo asset_url('asset/img/sabar.png') ?>">');
         }
      }

      function tunggu_end()
      {
         $('#mdl_wait').modal('hide');
         $('.modal-backdrop').remove();
         $('body').removeClass('modal-open');
         $('body').attr('style','');
      }
      
      function angka(cmp) 
      {
        cmp.value = cmp.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
      }

      function ganti_isi(dengan,ini)
      {
         if(dengan.value=='')
         {
            dengan.value=ini;
         }
      }

      function ganti_null(isi,ganti)
      {
         if(isi)
         {
            return ganti;
         }
         else
         {
            return isi;
         }
      }

      

      /*
      function init_mydatepicker() 
      {
         "undefined" != typeof $.fn.daterangepicker && (
         $(".mydate").daterangepicker(
         {
            singleDatePicker: !0,
            singleClasses: "picker_3",
            locale: {
               format: 'DD/MM/YYYY'
            }
         }));
      }*/

       $('.mydate').datetimepicker({
            format: 'DD/MM/YYYY',
            defaultDate: "now"
         });

       $('.mydatetime').datetimepicker({
            format: 'DD/MM/YYYY HH:mm',
            defaultDate: "now"
         });

      function rupiah(str, prefix)
      {
         var number_string = str.replace(/[^,\d]/g, '').toString(),
         split       = number_string.split(','),
         sisa        = split[0].length % 3,
         rupiah        = split[0].substr(0, sisa),
         ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
         // tambahkan titik jika yang di input sudah menjadi angka ribuan
         if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
         }
         rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
         return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
      }

      function non_rupiah(rupiah)
      {
      return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
      }

      function format_rupiah(a)
      {
         a.value=rupiah(a.value,'.');
      }

      $('body').on('hidden.bs.modal', function (e) {
                if($('.modal').hasClass('in')) {
                    $('body').addClass('modal-open');
                   
                }    
                 $('body').attr('style','');
            });

      function md_info(msg)
      {
         $('#md_msg_info').html(msg);
         $('#md_type').removeClass('panel-warning');
         $('#md_type').addClass('panel-primary');
         $('#md_msg').modal({
                    show: 'true'
                }); 
      }

      function md_warning(msg)
      {
         $('#md_msg_info').html(msg);
         $('#md_type').removeClass('panel-primary');
         $('#md_type').addClass('panel-warning');
         $('#md_msg').modal({
                    show: 'true'
                }); 
      }

      function baca_kondisi_stok(kondisi)
      {
         if(kondisi=='NONE')
         {
            return "BAIK";
         }
         else
         {
            return "RUSAK";
         }
      }
/*
    $('body').on('keydown', 'input, select, select2, textarea, button', function(e) {
      var self = $(this)
        , form = self.parents('form:eq(0)')
        , focusable
        , next
        ;
      if (e.keyCode == 13) {
          focusable = form.find('input,a,select, button, select2, textarea').filter(':visible');
          next = focusable.eq(focusable.index(this)+1);
          if (next.length) {
              next.focus();
          } else {
            //eksekusi 
          }
          return false;
      }
  });
*/

refresh_notif();

      function refresh_notif()
      {
         $.ajax({
            url : "<?php echo base_url('index.php/gudang/terima_mutasi/jml_notif') ?>",
            type : "post",
            data : {
               KD_MUTASI : "",
            },
            success : function(resp)
            {
               if(resp)
               {
                  if($.isNumeric(resp))
                  {
                     if(parseInt(resp)>0)
                     {
                        $('#jml_notif').html('<span class="badge bg-green" id="jml_notif">'+resp+'</span>');
                        $.ajax({
                        url : "<?php echo base_url('index.php/gudang/terima_mutasi/notif') ?>",
                        type : "post",
                        data : {
                           KD_MUTASI : "",
                        },
                        success : function(resp2)
                           {
                              $('#notif').html(resp2);
                           }
                        });
                     }
                  }
               }
            }
         });
      }

   refresh_minta();

      function refresh_minta()
      {
         $.ajax({
            url : "<?php echo base_url('index.php/gudang/permintaan_farmasi/jml_notif') ?>",
            type : "post",
            data : {
               URUT_PERMINTAAN : "",
            },
            success : function(resp)
            {
               if(resp)
               {
                  if($.isNumeric(resp))
                  {
                     if(parseInt(resp)>0)
                     {
                        $('#jml_notif_minta').html('<span class="badge bg-green" id="jml_notif_minta">'+resp+'</span>');
                        $.ajax({
                        url : "<?php echo base_url('index.php/gudang/permintaan_farmasi/notif') ?>",
                        type : "post",
                        data : {
                           URUT_PERMINTAAN : "",
                        },
                        success : function(resp2)
                           {
                              $('#notif_minta').html(resp2);
                           }
                        });
                     }
                  }
               }
            }
         });
      }

   </script>