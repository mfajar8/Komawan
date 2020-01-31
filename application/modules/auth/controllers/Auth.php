<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model(array('auth_model'));
  }

  function index()
  {
    $this->load->view('login');
  }

  function login(){
    $status=$this->session->userdata('status');
    if($status==''){
      $data['status']='belum login';
    }else{
      $data['status']=$status;
    }
    $this->load->view('auth/login',$data);
  }

  function login_action(){
    $username=$this->input->post('username');
    $password=$this->input->post('password');
    $dataUser=$this->auth_model->getUser($username,SHA1($password));
    if($dataUser->num_rows()>0){
      $dataUser=$dataUser->row();
      echo $dataUser->username;
      echo $dataUser->password;

      $dataSession=array(
        'username'=>$username,
        'status'=>'login',
        'id_user'=>$dataUser->id_user
      );
      $this->session->set_userdata($dataSession);
      redirect(base_url('admin'));
    }else{
      echo "data tidak ada";
    }

    // var_dump($dataUser);

  }

  function logout(){
    $this->session->sess_destroy();
    redirect(base_url('auth/login'));
  }
}
