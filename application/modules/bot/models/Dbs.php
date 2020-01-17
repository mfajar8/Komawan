<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dbs extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }


  function reset($target,$data){
      $this->db->get($target);
      $db=$this->db->update($target,$data);
      if ($this->db->affected_rows()>0) {
      return true;
      }else{
      return false;
      }
  }
  //insert data ke tabel
  function insert($data,$to){
    $insert = $this->db->insert($to, $data);
    if ($this->db->affected_rows()>0) {
      return true;
      }else{
      return false;
      }
  }

  //mengambil berdasarkan data userid
  function getdata($where,$from){
    $this->db->where($where);
    $db=$this->db->get($from);
    return $db;
  }




  //fungsi untuk mengambil lokasi terdekat berdasarkan longitude latitude di parameter
  function getdistance($kilo,$lat,$lng,$userid,$session1,$session2){
      $this->db->select("*, ( 6371 * acos( cos( radians($lat) ) * cos( radians( cur_lat ) ) * cos( radians( cur_long ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( cur_lat ) ) ) ) AS distance");
        $this->db->having('distance <= ' . $kilo);
        $this->db->order_by('distance');
        $this->db->limit(20, 0);
        $this->db->where('userid !=', $userid);
        $this->db->where('flag !=', $session1);
        $this->db->where('flag !=', $session2);
        $this->db->where('cur_order', null);
        $this->db->where('cur_help', null);
        $db=$this->db->get('donatur');
        return $db;
  }

  function getevent($kilo,$lat,$lng){
      $this->db->select("*, ( 6371 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance");
        $this->db->having('distance <= ' . $kilo);
        $this->db->order_by('distance');
        $this->db->limit(20, 0);
        $db=$this->db->get('event');
        return $db;
  }


  //fungsi untuk update field berdasarkan userid
  function update($where,$data,$to){
    $this->db->where($where);
    $db=$this->db->update($to,$data);
    if ($this->db->affected_rows()>0) {
      return true;
      }else{
      return false;
      }
  }



}
