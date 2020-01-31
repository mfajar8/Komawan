<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class admin extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('admin_model');
            $this->load->library('form_validation');
	          $method=$this->router->fetch_method();

            if($this->session->userdata('id_user') == null ){
              redirect(base_url('auth/login'));
            }
            // if($method != 'ajax_list'){
            //   if($this->session->userdata('status')!='login'){
            //     redirect(base_url('login'));
            //   }
            // }
        }

        public function index()
        {$dataadmin=$this->admin_model->get_all();//panggil ke modell
          $datafield=$this->admin_model->get_field();//panggil ke modell

           $data = array(
             'content'=>'admin/admin/admin_list',
             'sidebar'=>'admin/sidebar',
             'css'=>'admin/admin/css',
             'js'=>'admin/admin/js',
             'dataadmin'=>$dataadmin,
             'datafield'=>$datafield,
             'module'=>'admin',
             'titlePage'=>'admin',
             'controller'=>'admin'
            );
          $this->template->load($data);
        }

        //DataTable
        public function ajax_list()
      {
          $list = $this->admin_model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $admin_model) {
              $no++;
              $row = array();
              $row[] = $no;
							$row[] = $admin_model->username;
							$row[] = $admin_model->password;
							$row[] = $admin_model->nama_user;
							$row[] = $admin_model->NIP;

              $row[] ="
              <a href='admin/edit/$admin_model->id_user'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='$admin_model->id_user' href='#'><i class='feather icon-trash'></i></a>";
              $data[] = $row;
          }

          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->admin_model->count_all(),
                          "recordsFiltered" => $this->admin_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


        public function create(){
           $data = array(
             'content'=>'admin/admin/admin_create',
             'sidebar'=>'admin/sidebar',
             'action'=>'admin/admin/create_action',
             'module'=>'admin',
             'titlePage'=>'admin',
             'controller'=>'admin'
            );
          $this->template->load($data);
        }

        public function edit($id_user){
          $dataedit=$this->admin_model->get_by_id($id_user);
           $data = array(
             'content'=>'admin/admin/admin_edit',
             'sidebar'=>'admin/sidebar',
             'action'=>'admin/admin/update_action',
             'dataedit'=>$dataedit,
             'module'=>'admin',
             'titlePage'=>'admin',
             'controller'=>'admin'
            );
          $this->template->load($data);
        }
public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
					'username' => $this->input->post('username',TRUE),
					'password' => $this->input->post('password',TRUE),
					'nama_user' => $this->input->post('nama_user',TRUE),
					'NIP' => $this->input->post('NIP',TRUE),

);

            $this->admin_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/admin'));
        }
    }




    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
					'username' => $this->input->post('username',TRUE),
					'password' => $this->input->post('password',TRUE),
					'nama_user' => $this->input->post('nama_user',TRUE),
					'NIP' => $this->input->post('NIP',TRUE),

);

            $this->admin_model->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/admin'));
        }
    }

    public function delete($id_user)
    {
        $row = $this->admin_model->get_by_id($id_user);

        if ($row) {
            $this->admin_model->delete($id_user);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/admin'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/admin'));
        }
    }

    public function _rules()
    {
$this->form_validation->set_rules('username', 'username', 'trim|required');
$this->form_validation->set_rules('password', 'password', 'trim|required');
$this->form_validation->set_rules('nama_user', 'nama_user', 'trim|required');
$this->form_validation->set_rules('NIP', 'NIP', 'trim|required');


	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

}
