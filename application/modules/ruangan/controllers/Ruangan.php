<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Ruangan extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Ruangan_model');
            $this->load->library('form_validation');
	    $method=$this->router->fetch_method();
            // if($method != 'ajax_list'){
            //   if($this->session->userdata('status')!='login'){
            //     redirect(base_url('login'));
            //   }
            // }
        }

        public function index()
        {$dataruangan=$this->Ruangan_model->get_all();//panggil ke modell
          $datafield=$this->Ruangan_model->get_field();//panggil ke modell

           $data = array(
             'content'=>'ruangan/ruangan/ruangan_list',
             'sidebar'=>'ruangan/sidebar',
             'css'=>'ruangan/ruangan/css',
             'js'=>'ruangan/ruangan/js',
             'dataruangan'=>$dataruangan,
             'datafield'=>$datafield,
             'module'=>'ruangan',
             'titlePage'=>'ruangan',
             'controller'=>'ruangan'
            );
          $this->template->load($data);
        }

        //DataTable
        public function ajax_list()
      {
          $list = $this->Ruangan_model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $Ruangan_model) {
              $no++;
              $row = array();
              $row[] = $no;
							$row[] = $Ruangan_model->nama_ruangan;
							$row[] = $Ruangan_model->letak_ruangan;
							$row[] = $Ruangan_model->keterangan_ruangan;
							$row[] = $Ruangan_model->id_gedung;
							
              $row[] ="
              <a href='ruangan/edit/$Ruangan_model->id_ruangan'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='$Ruangan_model->id_ruangan' href='#'><i class='feather icon-trash'></i></a>";
              $data[] = $row;
          }

          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->Ruangan_model->count_all(),
                          "recordsFiltered" => $this->Ruangan_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


        public function create(){
           $data = array(
             'content'=>'ruangan/ruangan/ruangan_create',
             'sidebar'=>'ruangan/sidebar',
             'action'=>'ruangan/ruangan/create_action',
             'module'=>'ruangan',
             'titlePage'=>'ruangan',
             'controller'=>'ruangan'
            );
          $this->template->load($data);
        }

        public function edit($id_ruangan){
          $dataedit=$this->Ruangan_model->get_by_id($id_ruangan);
           $data = array(
             'content'=>'ruangan/ruangan/ruangan_edit',
             'sidebar'=>'ruangan/sidebar',
             'action'=>'ruangan/ruangan/update_action',
             'dataedit'=>$dataedit,
             'module'=>'ruangan',
             'titlePage'=>'ruangan',
             'controller'=>'ruangan'
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
					'nama_ruangan' => $this->input->post('nama_ruangan',TRUE),
					'letak_ruangan' => $this->input->post('letak_ruangan',TRUE),
					'keterangan_ruangan' => $this->input->post('keterangan_ruangan',TRUE),
					'id_gedung' => $this->input->post('id_gedung',TRUE),
					
);

            $this->Ruangan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ruangan/ruangan'));
        }
    }




    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
					'nama_ruangan' => $this->input->post('nama_ruangan',TRUE),
					'letak_ruangan' => $this->input->post('letak_ruangan',TRUE),
					'keterangan_ruangan' => $this->input->post('keterangan_ruangan',TRUE),
					'id_gedung' => $this->input->post('id_gedung',TRUE),
					
);

            $this->Ruangan_model->update($this->input->post('id_ruangan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ruangan/ruangan'));
        }
    }

    public function delete($id_ruangan)
    {
        $row = $this->Ruangan_model->get_by_id($id_ruangan);

        if ($row) {
            $this->Ruangan_model->delete($id_ruangan);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ruangan/ruangan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruangan/ruangan'));
        }
    }

    public function _rules()
    {
$this->form_validation->set_rules('nama_ruangan', 'nama_ruangan', 'trim|required');
$this->form_validation->set_rules('letak_ruangan', 'letak_ruangan', 'trim|required');
$this->form_validation->set_rules('keterangan_ruangan', 'keterangan_ruangan', 'trim|required');
$this->form_validation->set_rules('id_gedung', 'id_gedung', 'trim|required');


	$this->form_validation->set_rules('id_ruangan', 'id_ruangan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

}