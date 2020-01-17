<?php
/**
 *
 */
class Pre_views
{
  function createCss(){
    $string="<link rel=\"stylesheet\" type=\"text/css\" href=\"<?= base_url() ?>assets/vendors/css/vendors.min.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"<?= base_url() ?>assets/vendors/css/tables/datatable/datatables.min.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"<?= base_url() ?>assets/summernote/summernote.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"<?= base_url() ?>assets/dropify/dist/css/dropify.css\">"; //ini isi pake syntax php
    return $string;
  }
  function createJs($serverSide,$module,$controller){
    $string="<!-- BEGIN: Page Vendor JS-->
    <script src=\"<?= base_url()?>assets/vendors/js/tables/datatable/vfs_fonts.js\"></script>
    <script src=\"<?= base_url()?>assets/vendors/js/tables/datatable/datatables.min.js\"></script>
    <script src=\"<?= base_url()?>assets/vendors/js/tables/datatable/datatables.buttons.min.js\"></script>
    <script src=\"<?= base_url()?>assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js\"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Dropify JS -->
    <script src=\"<?= base_url()?>assets/dropify/dist/js/dropify.js\" charset=\"utf-8\"></script>
    <script type=\"text/javascript\">
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
        $(\"#deleteFiles\").val(initFiles);
      }else{
        console.log('not deleted');
      }
        alert('File deleted');
    });
    </script>
    <!-- END: Dropify JS -->
    <script src=\"<?= base_url()?>assets/js/scripts/datatables/datatable.min.js\"></script>
    <script type=\"text/javascript\">
      $(document).ready(function(){";
        if($serverSide==0){
          $string .="$('.crudtable').DataTable();";
        }else{
          $string .="$('.crudtable').DataTable({
            \"processing\": true, //Feature control the processing indicator.
            \"serverSide\": true, //Feature control DataTables' server-side processing mode.
            \"order\": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            \"ajax\": {
                \"url\": \"<?php echo base_url()?>".strtolower($module)."/$controller/ajax_list\",
                \"type\": \"POST\"
            },

            //Set column definition initialisation properties.
            \"columnDefs\": [
            {
                \"targets\": [ 0 ], //first column / numbering column
                \"orderable\": false, //set not orderable
            },
            ],
        });
            ";
        }
        $string .="
      });
    </script>
    <script type=\"text/javascript\">
      $(document).ready(function(){
        $(\".crudtable\").on(\"click\", \".modalDelete\", function(){//event khusus untuk table datatables setelah pagination suka error
          var id=$(this).attr('value');
          $(\"#modalMsg\").html(\"Apakah Anda Yakin Ingin Menghapus? \"+id);
          $(\"#modalHref\").attr(\"href\", \"<?php echo base_url().\$module?>/<?php echo \$controller; ?>/delete/\"+id);
        });
      });
    </script>
    <script src=\"<?= base_url()?>assets/summernote/summernote.js\" charset=\"utf-8\"></script>
    <script type=\"text/javascript\">
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 300
      });
      });
    </script>
    "; //ini isi pake syntax php
    return $string;
  }
  function createForm($fields){
    $string="<section class=\"card\">
      <div class=\"card-header\">
        <h4 class=\"card-title\">Tambah Data</h4>
      </div>
      <div class=\"card-content\">
        <div class=\"card-body\">
          <form method=\"post\" action=\"<?php echo base_url().\$action ?>\" enctype=\"multipart/form-data\">\n";
          foreach ($fields as $field) {
            if($field->primary_key!=1){
              $string .="\t\t\t\t\t\t<div class=\"form-group row\">
                <label class=\"col-sm-2 col-form-label\">$field->name</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"$field->name\" class=\"form-control\">
                </div>
              </div>\n";
            }

          }
        $string .="</div>
        <div class=\"col-12\">
          <button type=\"submit\" class=\"btn btn-primary mr-1 mb-1 waves-effect
           waves-light float-right\">Simpan</button>
        </div>
      </form>
      </div>
    </section>"; //ini isi pake syntax php
    return $string;
  }
  function createEdit($primary_key,$fields,$controller){
    $controller=strtolower($controller);
    $string="<section class=\"card\">
      <div class=\"card-header\">
        <h4 class=\"card-title\">Edit $controller</h4>
      </div>
      <div class=\"card-content\">
        <div class=\"card-body\">
          <form method=\"post\" action=\"<?php echo base_url().\$action ?>\" enctype=\"multipart/form-data\">
            <div class=\"form-group row\">
              <label class=\"col-sm-2 col-form-label\">$primary_key</label>
              <div class=\"col-sm-10\">
                <input type=\"text\" name=\"$primary_key\" class=\"form-control\" placeholder=\"\" value=\"<?php echo \$dataedit->$primary_key?>\" readonly>
              </div>
            </div>\n";
            foreach ($fields as $field) {
              if($field->primary_key!=1){
                $string .="\t\t\t\t\t\t<div class=\"form-group row\">
              <label for=\"example-text-input\" class=\"col-sm-2 col-form-label\">$field->name</label>
              <div class=\"col-sm-10\">
                <input type=\"text\" name=\"$field->name\" class=\"form-control\" value=\"<?php echo \$dataedit->$field->name?>\">
              </div>
              </div>\n";
              }

            }
            $string .="
        </div>
        <input type=\"hidden\" id=\"deleteFiles\" name=\"deleteFiles\">
        <div class=\"col-12\">
          <button type=\"submit\" class=\"btn btn-primary mr-1 mb-1 waves-effect
           waves-light float-right\">Simpan</button>
        </div>
      </form>
      </div>
    </section>
"; //ini isi pake syntax php
    return $string;
  }

  function createList($primarykey,$controller,$serverSide){
    $controller=strtolower($controller);
    $string="<?php if(\$this->session->flashdata('message')) {
      \$flashMessage=\$this->session->flashdata('message');
    echo \"<script>alert('\$flashMessage')</script>\";
    } ?>
     <section id=\"basic-datatable\">
         <div class=\"row\">
             <div class=\"col-12\">
                 <div class=\"card\">
                     <div class=\"card-header\">
                         <h4 class=\"card-title\">Data $controller</h4>
      		    		<a href=\"<?= site_url(\$module.'/$controller/create') ?>\"><button type=\"button\" class=\"btn btn-primary round waves-effect waves-light\">
      	               	 Tambah Data
      	              	</button>
                      </a>
                     </div>
                     <div class=\"card-content\">

                         <div class=\"card-body card-dashboard\">
                             <div class=\"table-responsive\">
                                 <table class=\"table crudtable\">
                                     <thead>
                                       <tr>
                                           <?php foreach (\$datafield as \$d): ?>
                                             <th><?php echo str_replace(\"_\",\" \",\$d) ?></th>
                                           <?php endforeach; ?>
                                           <th>aksi</th>
                                       </tr>
                                     </thead>
                                     <tbody>";
                                      if($serverSide==0){
                                        $string .="
                                       <?php foreach (\$data$controller as \$d): ?>
                                         <tr>
                                           <?php foreach (\$datafield as \$df): ?>
                                             <td><?php echo \$d->\$df ?></td>
                                           <?php endforeach; ?>
                                           <td>
                                             <a href=\"<?php echo base_url().\$module?>/$controller/edit/<?php echo \$d->$primarykey ?>\"><i class=\"m-1 feather icon-edit-2\"></i></a>
                                             <a class=\"modalDelete\" data-toggle=\"modal\" data-target=\"#responsive-modal\" value=\"<?php echo \$d->$primarykey ?>\" href=\"#\"><i class=\"feather icon-trash\"></i></a>
                                           </td>

                                         </tr>
                                       <?php endforeach; ?>
                                       ";
                                     }
                                     $string .="</tbody>
                                     <tfoot>
                                       <tr>
                                           <?php foreach (\$datafield as \$d): ?>
                                             <th><?php echo str_replace(\"_\",\" \",\$d) ?></th>
                                           <?php endforeach; ?>
                                           <th>aksi</th>
                                       </tr>
                                     </tfoot>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>

    <div id=\"responsive-modal\" class=\"modal fade\" tabindex=\"-1\" $controller=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\" style=\"display: none;\">
        <div class=\"modal-dialog\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                    <h4 class=\"modal-title\"></h4>
                </div>
                <div class=\"modal-body\">
                  <p id=\"modalMsg\"></p>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default waves-effect\" data-dismiss=\"modal\">Tutup</button>
                    <a id=\"modalHref\" href=\"#\">
                    <button type=\"button\" class=\"btn btn-danger waves-effect waves-light\">Ya!</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
"; //ini isi pake syntax php
    return $string;
  }
}

 ?>
