<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }
  function getUser($username,$password){
    $this->db->select('*');
    $this->db->from('admin');
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    return $this->db->get();
  }
}
