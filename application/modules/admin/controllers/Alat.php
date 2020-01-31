<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class alat extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('alat_model');
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
        {$dataalat=$this->alat_model->get_all();//panggil ke modell
          $datafield=$this->alat_model->get_field();//panggil ke modell

           $data = array(
             'content'=>'admin/alat/alat_list',
             'sidebar'=>'admin/sidebar',
             'css'=>'admin/alat/css',
             'js'=>'admin/alat/js',
             'dataalat'=>$dataalat,
             'datafield'=>$datafield,
             'module'=>'admin',
             'titlePage'=>'alat',
             'controller'=>'alat'
            );
          $this->template->load($data);
        }

        //DataTable
        public function ajax_list()
      {
          $list = $this->alat_model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $alat_model) {
              $no++;
              $row = array();
              $row[] = $no;
							$row[] = $alat_model->nomor_alat;
							$row[] = $alat_model->status_alat;

              $row[] ="
              <a href='alat/edit/$alat_model->id_alat'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='$alat_model->id_alat' href='#'><i class='feather icon-trash'></i></a>";
              $data[] = $row;
          }

          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->alat_model->count_all(),
                          "recordsFiltered" => $this->alat_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


        public function create(){
           $data = array(
             'content'=>'admin/alat/alat_create',
             'sidebar'=>'admin/sidebar',
             'action'=>'admin/alat/create_action',
             'module'=>'admin',
             'titlePage'=>'alat',
             'controller'=>'alat'
            );
          $this->template->load($data);
        }

        public function edit($id_alat){
          $dataedit=$this->alat_model->get_by_id($id_alat);
           $data = array(
             'content'=>'admin/alat/alat_edit',
             'sidebar'=>'admin/sidebar',
             'action'=>'admin/alat/update_action',
             'dataedit'=>$dataedit,
             'module'=>'admin',
             'titlePage'=>'alat',
             'controller'=>'alat'
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
					'nomor_alat' => $this->input->post('nomor_alat',TRUE),
					'status_alat' => $this->input->post('status_alat',TRUE),

);

            $this->alat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/alat'));
        }
    }




    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
					'nomor_alat' => $this->input->post('nomor_alat',TRUE),
					'status_alat' => $this->input->post('status_alat',TRUE),

);

            $this->alat_model->update($this->input->post('id_alat', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/alat'));
        }
    }

    public function delete($id_alat)
    {
        $row = $this->alat_model->get_by_id($id_alat);

        if ($row) {
            $this->alat_model->delete($id_alat);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/alat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/alat'));
        }
    }

    public function _rules()
    {
$this->form_validation->set_rules('nomor_alat', 'nomor_alat', 'trim|required');
$this->form_validation->set_rules('status_alat', 'status_alat', 'trim|required');


	$this->form_validation->set_rules('id_alat', 'id_alat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

}
