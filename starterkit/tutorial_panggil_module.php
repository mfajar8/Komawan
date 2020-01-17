<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContohClass extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {

  }

  function contoh(){
    //Cara Memanggil Method di didalam module lain
    //langkah pertama inisialisasi
    // Jika class yang akan dipanggil strukturnya begini
    //
    // Module
    //   -Login {namaModule}
    //     -folderclass {namafolderClass}
    //       -namacontroller.php {namacontroller}
    // $this->load->module('{NamaModule}/{namafolderClass}/{namacontroller}') //Contoh Inisialiasasi
    //Cara Memanggil Method
    //  $this->{namacontroller}->text("HALO")  <- contoh method text dalam controller


    //Contoh Lihat Dibawah Ini
    // $this->load->module('Push/class/MessageBuilder');
    // $this->load->module('Push/Push');
    // var_dump($this->messagebuilder->text("HALO"));
    // $messages=[];
    // $msg1=$this->messagebuilder->text("HALO");
    // $msg2=$this->messagebuilder->text("Hai");
    // array_push($messages,$msg1,$msg2);
    // $this->push->BotGuru($messages,'U4d764405f14220a7951fc5fab795495a');
  }

}
