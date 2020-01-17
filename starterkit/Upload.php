<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Tempatkan ini di module HMVC
  }

  function index()
  {
  echo "hi";
  }

  function dropzone(){//menerima proses dari dropzone
    if (!empty($_FILES)) {
      $pathFolder=$this->input->get('pathFolder');//get untuk menerima nama folder dari action di view
      $this->upload_foto('file',$pathFolder);

    }
  }

  public function upload_foto($formname,$pathFolder){
    $config['upload_path']          = './xfile/'.$pathFolder;
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['overwrite'] = FALSE;
    $config['encrypt_name'] = FALSE;
    //$config['max_size']             = 100;
    //$config['max_width']            = 1024;
    //$config['max_height']           = 768;
    $this->load->library('upload', $config);
    $this->upload->do_upload($formname);
    return $this->upload->data();
    /*Cara penggunaan
    PASTIKAN FOLDER TUJUAN PERMISSION NYA SUDAH BISA WRITE
    dan
    PASTIKAN FORM SUDAH BERUBAH DENGAN enctype="multipart/form-data"
    $this->upload_foto({ubah dengan name dari input type dari view},{ubah dengan tujuan folder});
    contoh
    jika <input type="file" name="file">

    maka
    $file=$this->upload_foto('file');
    untuk mengambil nama file gunakan $file['file_name'];
    untuk mengecek berhasil atau tidak gunakan kondisi
    if($file['is_image']!=1){
      echo "gagal";
    }else{
      echo "File Name : ".$file['file_name'];
      echo "Is Image ".$file['is_image'];
    }

Gunakan class ini untuk FORM create
<input type="file" id="input-file-now-custom-1" class="dropify" name="file">

Gunaka class ini untuk Form Edit, dan ubah default URL nya
<input type="file" id="input-file-now-custom-1" class="dropify" data-default-file="<?php echo base_url().'xfile/{namafoldertujuan}'.$dataedit->photoUrl?>" name="file">

    */
    }

    public function summernote(){
      $pathFolder=$this->input->post('pathFolder');
      $config['upload_path']          = './xfile/'.$pathFolder;
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['overwrite'] = FALSE;
      $config['encrypt_name'] = FALSE;
      //$config['max_size']             = 100;
      //$config['max_width']            = 1024;
      //$config['max_height']           = 768;
      $this->load->library('upload', $config);
      $this->upload->do_upload('file');
      $json=json_encode($this->upload->data());
      echo $json;
      /*Cara penggunaan
      PASTIKAN FOLDER TUJUAN PERMISSION NYA SUDAH BISA WRITE

      $this->upload_foto({ubah dengan name dari input type dari view});
      contoh
      jika <input type="file" name="file">
      maka
      $file=$this->upload_foto('file');
      untuk mengambil nama file gunakan $file['file_name'];
      untuk mengecek berhasil atau tidak gunakan kondisi
      if($file['is_image']!=1){
        echo "gagal";
      }else{
        echo "File Name : ".$file['file_name'];
        echo "Is Image ".$file['is_image'];
      }

      */
      }

}
