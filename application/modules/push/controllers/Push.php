<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'class/ClientAPI.php';
require_once 'class/line_class.php';
require_once 'class/MessageBuilder.php';
class Push extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {

  }

  function Bot($arrayMessage,$bot_id){//ganti kondisi ini
    $channelAccessToken = '{Ganti Access Token}';
    $channelSecret = '{Ganti Secret Token}';//sesuaikan
$client = new LINEBotTiny($channelAccessToken, $channelSecret);


   $push = array(
                'to' => $bot_id,
                'messages' => $arrayMessage
              );

              $client->pushMessage($push);
}

//Cara Pemanggilan jika ingin dipake di kelas lain
// $this->load->module('Push/class/MessageBuilder');
// $this->load->module('Push/Push');
// var_dump($this->messagebuilder->text("HALO"));
// $messages=[];
// $msg1=$this->messagebuilder->text("HALO");
// $msg2=$this->messagebuilder->text("Hai");
// array_push($messages,$msg1,$msg2);
// $this->push->Bot($messages,'BOT ID');

}
