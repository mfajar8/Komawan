<script type="text/javascript">

$("#uploadPdf").click(function(){
  var file=$("#formPdf")[0].files[0];//untuk menerima dari input type
  // console.log(file);
proses(file);
});
function proses(formFile){
var form = new FormData();
form.append("pdf", formFile);

var settings = {
  "async": true,
  "crossDomain": true,
  "url": "http://localhost/kostlabkit/api/upload/pdf",
  "method": "POST",
  "headers": {
    "cache-control": "no-cache",
    "Postman-Token": "4e8011a6-5cdd-48de-b2ad-c2685d88c470"
  },
  "processData": false,
  "contentType": false,
  "mimeType": "multipart/form-data",
  "data": form
};

settings.xhr= function() {
    var xhr = new window.XMLHttpRequest();
    xhr.upload.addEventListener("progress", function(evt) {
        if (evt.lengthComputable) {
          console.log(evt);
            var percentComplete = evt.loaded / evt.total;
            //Do something with upload progress here
            console.log(percentComplete+" UPLOAD");
        }
   }, false);

   xhr.addEventListener("progress", function(evt) {
       if (evt.lengthComputable) {
           var percentComplete = evt.loaded / evt.total;
           console.log(percentComplete+" DOWNLOAd");
           //Do something with download progress
       }
   }, false);

   return xhr;
};
$.ajax(settings).done(function (response) {
  console.log(response);
});
}
</script>
