<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {

  }

  function pdf(){//contoh file upload pdf
    header('Content-Type: application/json');
    $pdf=upload('pdf','pdf','file',TRUE);
    if($pdf){
      $size=$pdf['file_size'];
      header("Content-length: $size");
      echo json_encode(array("message"=>'Sukses',"size"=>$size));
    }else{
      $size=$pdf['file_size'];
      header("Content-length: $size");
      echo json_encode(array("message"=>'Gagal',"size"=>$size));
    }
  }

}
