<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class rekam_medis extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('rekam_medis_model');
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
        {$datarekam_medis=$this->rekam_medis_model->get_all();//panggil ke modell
          $datafield=$this->rekam_medis_model->get_field();//panggil ke modell

           $data = array(
             'content'=>'admin/rekam_medis/rekam_medis_list',
             'sidebar'=>'admin/sidebar',
             'css'=>'admin/rekam_medis/css',
             'js'=>'admin/rekam_medis/js',
             'datarekam_medis'=>$datarekam_medis,
             'datafield'=>$datafield,
             'module'=>'admin',
             'titlePage'=>'rekam_medis',
             'controller'=>'rekam_medis'
            );
          $this->template->load($data);
        }

        //DataTable
        public function ajax_list()
      {
          $list = $this->rekam_medis_model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $rekam_medis_model) {
              $no++;
              $row = array();
              $row[] = $no;
							$row[] = $rekam_medis_model->berat_infus;
							$row[] = $rekam_medis_model->waktu_pasang;
							$row[] = $rekam_medis_model->waktu_selesai;
							$row[] = $rekam_medis_model->id_ruangan;
							$row[] = $rekam_medis_model->id_user;

              $row[] ="
              <a href='rekam_medis/edit/$rekam_medis_model->id_rekam_medis'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='$rekam_medis_model->id_rekam_medis' href='#'><i class='feather icon-trash'></i></a>";
              $data[] = $row;
          }

          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->rekam_medis_model->count_all(),
                          "recordsFiltered" => $this->rekam_medis_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


        public function create(){
           $data = array(
             'content'=>'admin/rekam_medis/rekam_medis_create',
             'sidebar'=>'admin/sidebar',
             'action'=>'admin/rekam_medis/create_action',
             'module'=>'admin',
             'titlePage'=>'rekam_medis',
             'controller'=>'rekam_medis'
            );
          $this->template->load($data);
        }

        public function edit($id_rekam_medis){
          $dataedit=$this->rekam_medis_model->get_by_id($id_rekam_medis);
           $data = array(
             'content'=>'admin/rekam_medis/rekam_medis_edit',
             'sidebar'=>'admin/sidebar',
             'action'=>'admin/rekam_medis/update_action',
             'dataedit'=>$dataedit,
             'module'=>'admin',
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

            $this->rekam_medis_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/rekam_medis'));
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

            $this->rekam_medis_model->update($this->input->post('id_rekam_medis', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/rekam_medis'));
        }
    }

    public function delete($id_rekam_medis)
    {
        $row = $this->rekam_medis_model->get_by_id($id_rekam_medis);

        if ($row) {
            $this->rekam_medis_model->delete($id_rekam_medis);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/rekam_medis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/rekam_medis'));
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
