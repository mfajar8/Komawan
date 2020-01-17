<!-- Panggil Semua CSS dan Javascript dari Summernote, biasanya sudah terinstall default oleh harviacode
pasatikan file upload.php sudah dicopy kedalam module yang dituju

Masukan ini ke script

$('.summernote').summernote({
    height: 350, // set editor height
    minHeight: null, // set minimum height of editor
    maxHeight: null, // set maximum height of editor
    focus: false, // set focus to editable area after initializing summernote
    fontNames: [
    'Arial', 'Arial Black', 'Cambria', 'Comic Sans MS', 'Courier New',
    'Helvetica Neue', 'Helvetica', 'Impact', 'Lucida Grande',
    'Tahoma', 'Times New Roman', 'Verdana',
    ],
    callbacks: {
      onImageUpload: function(image) {
                  uploadImage(image[0],this);
                      // console.log(image[0]);
                  }
}
});

function uploadImage(image,summernoteID,pathFolder) { //pathFolder diisi dengan nama folder tujuan
  var form = new FormData();
  form.append("file", image);
  form.append("pathFolder", pathFolder);

  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "<?php echo base_url()?>{namamodule}/upload/summernote",
    "method": "POST",
    "headers": {
      "cache-control": "no-cache",
      "Postman-Token": "710b393d-9fe8-4eb5-bdbc-2d53b3c077b9"
    },
    "processData": false,
    "contentType": false,
    "mimeType": "multipart/form-data",
    "data": form
  }

  $.ajax(settings).done(function (response) {
    var obj=JSON.parse(response);
    var url="<?php echo base_url() ?>xfile/"+pathFolder+"/"+obj.file_name;
    var image = $('<img>').attr('src',url);
    $(summernoteID).summernote("insertNode", image[0]);
    // console.log(obj.file_name);
  });
}


tambahkan class summernote pada text area, sesuai dengan class summernote (contoh : .summernote)
<textarea name="soal" class="form-control summernote" rows="8" cols="80"><?php echo $dataedit['soal']?></textarea>


pastikan file folder upload permissionnya sudah oke -->
