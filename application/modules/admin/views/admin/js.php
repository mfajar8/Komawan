<!-- BEGIN: Page Vendor JS-->
    <script src="<?= base_url()?>assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="<?= base_url()?>assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="<?= base_url()?>assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="<?= base_url()?>assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Dropify JS -->
    <script src="<?= base_url()?>assets/dropify/dist/js/dropify.js" charset="utf-8"></script>
    <script type="text/javascript">
    var drEvent = $('.dropify').dropify();
    var initFiles=null;

    drEvent.on('dropify.beforeClear', function(event, element){
      // console.log(element);
      initFiles=element.file.name;
        return confirm('Do you really want to delete ' + element.file.name +' ?');
    });
    drEvent.on('dropify.afterClear', function(event, element) {
      console.log(element);
      if(element.file.name==null){
        $("#deleteFiles").val(initFiles);
      }else{
        console.log('not deleted');
      }
        alert('File deleted');
    });
    </script>
    <!-- END: Dropify JS -->
    <script src="<?= base_url()?>assets/js/scripts/datatables/datatable.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){$('.crudtable').DataTable();
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".crudtable").on("click", ".modalDelete", function(){//event khusus untuk table datatables setelah pagination suka error
          var id=$(this).attr('value');
          $("#modalMsg").html("Apakah Anda Yakin Ingin Menghapus? "+id);
          $("#modalHref").attr("href", "<?php echo base_url().$module?>/<?php echo $controller; ?>/delete/"+id);
        });
      });
    </script>
    <script src="<?= base_url()?>assets/summernote/summernote.js" charset="utf-8"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 300
      });
      });
    </script>
    