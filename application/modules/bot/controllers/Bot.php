<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('line_class.php');
require_once('class/MessageBuilder.php');
require_once('class/Register.php');


class Bot extends MY_Controller {

   /*
        WELCOME TO KOSTLAB X CODEIGNITER FRAMEWORK
        Framework inidibuat untuk memudahkan development chatbot LINE
        Coders : @kostlab @fataelislami


        Dokumentasi Fungsi
                                   function update($where,$data,$to)
                                   function getdata($userid,$from)
                                   function insert($data,$to)

        Struktur Model
            DBS
        Struktur Controller
            Welcome


      Brief Docs
            Set Flag

      Check Flag
      if($db[0]->flag=='blablabla')

      Message Type
      if($message['type']=='location')
      if($message['type']=='text')
      if($message['type']=='image')
      if($message['type']=='audio')
      if($message['type']=='video')

      Event Type
      $event['type'] == 'follow'
      $event['type'] == 'unfollow'
      $event['type'] == 'join'
      $event['type'] == 'leave'




     */

     public function __construct()
          {
            parent::__construct();
            //Codeigniter : Write Less Do More
      $this->load->model(array('Dbs'));


          }


  public function index()
  {

    //Konfigurasi Chatbot
    $channelAccessToken = 'PLACEHERE';
    $channelSecret = 'PLACEHERE';//sesuaikan
    //Konfigurasi Chatbot END

    $client = new LINEBotTiny($channelAccessToken, $channelSecret);
    $send= new MessageBuilder();
    $reg= new Register();

        $userId   = $client->parseEvents()[0]['source']['userId'];
        $groupId    = $client->parseEvents()[0]['source']['groupId'];
        $replyToken = $client->parseEvents()[0]['replyToken'];
        $timestamp  = $client->parseEvents()[0]['timestamp'];
        $message  = $client->parseEvents()[0]['message'];
        $messageid  = $client->parseEvents()[0]['message']['id'];
        $latitude=$client->parseEvents()[0]['message']['latitude'];
        $longitude=$client->parseEvents()[0]['message']['longitude'];
        $address=$client->parseEvents()[0]['message']['address'];
        $addresstitle=$client->parseEvents()[0]['message']['title'];
        $postback=$client->parseEvents() [0]['postback'];
        $profil = $client->profil($userId);
        $nama=$profil->displayName;
        $pesan_datang = $message['text'];
        $upPesan = strtoupper($pesan_datang);
        $pecahnama=explode(" ",$profil->displayName);
        $namapanggilan=$pecahnama[0];
        $event=$client->parseEvents() [0];
        function getRandom($length = 3) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        //Fungsi cek register

        //

            if ($event['type'] == 'follow')//Yang bot lakukan pertama kali saat di add oleh user
              {

              }
              if ($event['type'] == 'unfollow')//Yang bot lakukan pertama kali saat di add oleh user
              {

              }

            if ($event['type'] == 'join')
              {

              }


        if ($upPesan == 'GET@MYID'){
              $pre=array($send->text($userId));
              $output=$send->reply($replyToken,$pre);
          }
        if ($upPesan == 'CEK') {
           if(!$reg->check($userId)){//pengecekan register
             $output=$send->reply($replyToken,$reg->message());
             $client->replyMessage($output);
             die;//proses tidak diteruskan jika kondisi ini terpenuhi
          }

          $ballons = [];
          $ballon1 = $send->text("Hasil : ");
          array_push($ballons, $ballon1);
          $output = $send->reply($replyToken, $ballons);

        }
        if ($upPesan == '@@A')//pemanggilan TEXT biasa
              {
              $ballons = [];
              $ballon1 = $send->text("Text Pertama");
              $ballon2 = $send->text("Text Kedua");
              $ballon3 = $send->image("https://via.placeholder.com/450x400");

              array_push($ballons, $ballon1, $ballon2,$ballon3);
              $output = $send->reply($replyToken, $ballons);
              }
          if ($upPesan == '@@B')//pemanggilan button Template
              {
              $buttons=[];
              $button1 = array('type'=>'postback','label'=>'Test1','data'=>'lol');
              $button2 = array('type'=>'postback','label'=>'Test2','data'=>'lol');
              array_push($buttons,$button1,$button2);
              $ballons=[];
              $ballon1=$send->text("ini template");
              $ballon2=$send->buttonMessage("https://via.placeholder.com/450x400","ini alt","ini title","ini caption",$buttons);
              array_push($ballons,$ballon1,$ballon2);
              $output = $send->reply($replyToken,$ballons);
              }
          if ($upPesan == '@@C')//pemanggilan Confirm Template
              {
              $buttons=[];
              $button1 = array('type'=>'postback','label'=>'Test1','data'=>'lol');
              $button2 = array('type'=>'postback','label'=>'Test2','data'=>'lol');
              array_push($buttons,$button1,$button2);
              $ballons=[];
              $ballon1=$send->text("ini template");
              $ballon2=$send->confirmMessage("Alt","caption",$buttons);
              array_push($ballons,$ballon1,$ballon2);
              $output = $send->reply($replyToken,$ballons);
              }
          if ($upPesan == '@@D')//pemanggilan imageMap
              {
              $ballons=array($send->imagemap("https://islamify.id/dashboard/imagemap/mapfy/","ini alt"));//CONTOH REPLY 1 BALLON CHAT
              $output = $send->reply($replyToken,$ballons);
              }


        $client->replyMessage($output);


  }




}
