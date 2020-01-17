<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Rekam_medis extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Rekam_medis_model');
            $this->load->library('form_validation');
	    $method=$this->router->fetch_method();
            // if($method != 'ajax_list'){
            //   if($this->session->userdata('status')!='login'){
            //     redirect(base_url('login'));
            //   }
            // }
        }

        public function index()
        {$datarekam_medis=$this->Rekam_medis_model->get_all();//panggil ke modell
          $datafield=$this->Rekam_medis_model->get_field();//panggil ke modell

           $data = array(
             'content'=>'rekam_medis/rekam_medis/rekam_medis_list',
             'sidebar'=>'rekam_medis/sidebar',
             'css'=>'rekam_medis/rekam_medis/css',
             'js'=>'rekam_medis/rekam_medis/js',
             'datarekam_medis'=>$datarekam_medis,
             'datafield'=>$datafield,
             'module'=>'rekam_medis',
             'titlePage'=>'rekam_medis',
             'controller'=>'rekam_medis'
            );
          $this->template->load($data);
        }

        //DataTable
        public function ajax_list()
      {
          $list = $this->Rekam_medis_model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $Rekam_medis_model) {
              $no++;
              $row = array();
              $row[] = $no;
							$row[] = $Rekam_medis_model->berat_infus;
							$row[] = $Rekam_medis_model->waktu_pasang;
							$row[] = $Rekam_medis_model->waktu_selesai;
							$row[] = $Rekam_medis_model->id_ruangan;
							$row[] = $Rekam_medis_model->id_user;
							
              $row[] ="
              <a href='rekam_medis/edit/$Rekam_medis_model->id_rekam_medis'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='$Rekam_medis_model->id_rekam_medis' href='#'><i class='feather icon-trash'></i></a>";
              $data[] = $row;
          }

          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->Rekam_medis_model->count_all(),
                          "recordsFiltered" => $this->Rekam_medis_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


        public function create(){
           $data = array(
             'content'=>'rekam_medis/rekam_medis/rekam_medis_create',
             'sidebar'=>'rekam_medis/sidebar',
             'action'=>'rekam_medis/rekam_medis/create_action',
             'module'=>'rekam_medis',
             'titlePage'=>'rekam_medis',
             'controller'=>'rekam_medis'
            );
          $this->template->load($data);
        }

        public function edit($id_rekam_medis){
          $dataedit=$this->Rekam_medis_model->get_by_id($id_rekam_medis);
           $data = array(
             'content'=>'rekam_medis/rekam_medis/rekam_medis_edit',
             'sidebar'=>'rekam_medis/sidebar',
             'action'=>'rekam_medis/rekam_medis/update_action',
             'dataedit'=>$dataedit,
             'module'=>'rekam_medis',
             'titlePage'=>'rekam_medis',
             'controller'=>'rekam_medis'
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
					'berat_infus' => $this->input->post('berat_infus',TRUE),
					'waktu_pasang' => $this->input->post('waktu_pasang',TRUE),
					'waktu_selesai' => $this->input->post('waktu_selesai',TRUE),
					'id_ruangan' => $this->input->post('id_ruangan',TRUE),
					'id_user' => $this->input->post('id_user',TRUE),
					
);

            $this->Rekam_medis_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('rekam_medis/rekam_medis'));
        }
    }




    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
					'berat_infus' => $this->input->post('berat_infus',TRUE),
					'waktu_pasang' => $this->input->post('waktu_pasang',TRUE),
					'waktu_selesai' => $this->input->post('waktu_selesai',TRUE),
					'id_ruangan' => $this->input->post('id_ruangan',TRUE),
					'id_user' => $this->input->post('id_user',TRUE),
					
);

            $this->Rekam_medis_model->update($this->input->post('id_rekam_medis', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('rekam_medis/rekam_medis'));
        }
    }

    public function delete($id_rekam_medis)
    {
        $row = $this->Rekam_medis_model->get_by_id($id_rekam_medis);

        if ($row) {
            $this->Rekam_medis_model->delete($id_rekam_medis);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('rekam_medis/rekam_medis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekam_medis/rekam_medis'));
        }
    }

    public function _rules()
    {
$this->form_validation->set_rules('berat_infus', 'berat_infus', 'trim|required');
$this->form_validation->set_rules('waktu_pasang', 'waktu_pasang', 'trim|required');
$this->form_validation->set_rules('waktu_selesai', 'waktu_selesai', 'trim|required');
$this->form_validation->set_rules('id_ruangan', 'id_ruangan', 'trim|required');
$this->form_validation->set_rules('id_user', 'id_user', 'trim|required');


	$this->form_validation->set_rules('id_rekam_medis', 'id_rekam_medis', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

}