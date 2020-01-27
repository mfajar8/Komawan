<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Gedung extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Gedung_model');
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
        {$datagedung=$this->Gedung_model->get_all();//panggil ke modell
          $datafield=$this->Gedung_model->get_field();//panggil ke modell

           $data = array(
             'content'=>'admin/gedung/gedung_list',
             'sidebar'=>'admin/sidebar',
             'css'=>'admin/gedung/css',
             'js'=>'admin/gedung/js',
             'datagedung'=>$datagedung,
             'datafield'=>$datafield,
             'module'=>'admin',
             'titlePage'=>'gedung',
             'controller'=>'gedung'
            );
          $this->template->load($data);
        }

        //DataTable
        public function ajax_list()
      {
          $list = $this->Gedung_model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $Gedung_model) {
              $no++;
              $row = array();
              $row[] = $no;
							$row[] = $Gedung_model->nama_gedung;
							$row[] = $Gedung_model->letak_gedung;
							$row[] = $Gedung_model->keterangan_gedung;

              $row[] ="
              <a href='gedung/edit/$Gedung_model->id_gedung'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='$Gedung_model->id_gedung' href='#'><i class='feather icon-trash'></i></a>";
              $data[] = $row;
          }

          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->Gedung_model->count_all(),
                          "recordsFiltered" => $this->Gedung_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


        public function create(){
           $data = array(
             'content'=>'admin/gedung/gedung_create',
             'sidebar'=>'admin/sidebar',
             'action'=>'admin/gedung/create_action',
             'module'=>'admin',
             'titlePage'=>'gedung',
             'controller'=>'gedung'
            );
          $this->template->load($data);
        }

        public function edit($id_gedung){
          $dataedit=$this->Gedung_model->get_by_id($id_gedung);
           $data = array(
             'content'=>'admin/gedung/gedung_edit',
             'sidebar'=>'admin/sidebar',
             'action'=>'admin/gedung/update_action',
             'dataedit'=>$dataedit,
             'module'=>'admin',
             'titlePage'=>'gedung',
             'controller'=>'gedung'
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
					'nama_gedung' => $this->input->post('nama_gedung',TRUE),
					'letak_gedung' => $this->input->post('letak_gedung',TRUE),
					'keterangan_gedung' => $this->input->post('keterangan_gedung',TRUE),

);

            $this->Gedung_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/gedung'));
        }
    }




    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
					'nama_gedung' => $this->input->post('nama_gedung',TRUE),
					'letak_gedung' => $this->input->post('letak_gedung',TRUE),
					'keterangan_gedung' => $this->input->post('keterangan_gedung',TRUE),

);

            $this->Gedung_model->update($this->input->post('id_gedung', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/gedung'));
        }
    }

    public function delete($id_gedung)
    {
        $row = $this->Gedung_model->get_by_id($id_gedung);

        if ($row) {
            $this->Gedung_model->delete($id_gedung);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/gedung'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/gedung'));
        }
    }

    public function _rules()
    {
$this->form_validation->set_rules('nama_gedung', 'nama_gedung', 'trim|required');
$this->form_validation->set_rules('letak_gedung', 'letak_gedung', 'trim|required');
$this->form_validation->set_rules('keterangan_gedung', 'keterangan_gedung', 'trim|required');


	$this->form_validation->set_rules('id_gedung', 'id_gedung', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

}
