<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// make sure you include this header to your function
// header('Content-Type: application/json');

class Api extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    echo "API DOCS!";
  }
  function docs(){
    echo base_url()."api/{endpoint}  <br>";
  }
}
