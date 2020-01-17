<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //KostLab : Write Less Do More
    // if($this->session->userdata('status')!='login'){
    //   redirect(base_url('login'));
    // }
    // if($this->session->userdata('role')!=1){
    //   redirect(redirect($_SERVER['HTTP_REFERER']));
    // }
  }

  function index()
  {

    $data = array(
      'content'=>'setup/dashboard',
      'data'=>null,
      'sidebar'=>'setup/sidebar'
     );
    $this->template->load($data);
  }

}
