<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class pasien extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('pasien_model');
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
        {$datapasien=$this->pasien_model->get_all();//panggil ke modell
          $datafield=$this->pasien_model->get_field();//panggil ke modell

           $data = array(
             'content'=>'admin/pasien/pasien_list',
             'sidebar'=>'admin/sidebar',
             'css'=>'admin/pasien/css',
             'js'=>'admin/pasien/js',
             'datapasien'=>$datapasien,
             'datafield'=>$datafield,
             'module'=>'admin',
             'titlePage'=>'pasien',
             'controller'=>'pasien'
            );
          $this->template->load($data);
        }

        //DataTable
        public function ajax_list()
      {
          $list = $this->pasien_model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $pasien_model) {
              $no++;
              $row = array();
              $row[] = $no;
							$row[] = $pasien_model->nama_pasien;
							$row[] = $pasien_model->jenis_kelamin;
							$row[] = $pasien_model->ttl;
							$row[] = $pasien_model->alamat;
							$row[] = $pasien_model->id_rekam_medis;

              $row[] ="
              <a href='pasien/edit/$pasien_model->id_pasien'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='$pasien_model->id_pasien' href='#'><i class='feather icon-trash'></i></a>";
              $data[] = $row;
          }

          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->pasien_model->count_all(),
                          "recordsFiltered" => $this->pasien_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


        public function create(){
           $data = array(
             'content'=>'admin/pasien/pasien_create',
             'sidebar'=>'admin/sidebar',
             'action'=>'admin/pasien/create_action',
             'module'=>'admin',
             'titlePage'=>'pasien',
             'controller'=>'pasien'
            );
          $this->template->load($data);
        }

        public function edit($id_pasien){
          $dataedit=$this->pasien_model->get_by_id($id_pasien);
           $data = array(
             'content'=>'admin/pasien/pasien_edit',
             'sidebar'=>'admin/sidebar',
             'action'=>'admin/pasien/update_action',
             'dataedit'=>$dataedit,
             'module'=>'admin',
             'titlePage'=>'pasien',
             'controller'=>'pasien'
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
					'nama_pasien' => $this->input->post('nama_pasien',TRUE),
					'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
					'ttl' => $this->input->post('ttl',TRUE),
					'alamat' => $this->input->post('alamat',TRUE),
					'id_rekam_medis' => $this->input->post('id_rekam_medis',TRUE),

);

            $this->pasien_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/pasien'));
        }
    }




    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
					'nama_pasien' => $this->input->post('nama_pasien',TRUE),
					'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
					'ttl' => $this->input->post('ttl',TRUE),
					'alamat' => $this->input->post('alamat',TRUE),
					'id_rekam_medis' => $this->input->post('id_rekam_medis',TRUE),

);

            $this->pasien_model->update($this->input->post('id_pasien', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/pasien'));
        }
    }

    public function delete($id_pasien)
    {
        $row = $this->pasien_model->get_by_id($id_pasien);

        if ($row) {
            $this->pasien_model->delete($id_pasien);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/pasien'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/pasien'));
        }
    }

    public function _rules()
    {
$this->form_validation->set_rules('nama_pasien', 'nama_pasien', 'trim|required');
$this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'trim|required');
$this->form_validation->set_rules('ttl', 'ttl', 'trim|required');
$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
$this->form_validation->set_rules('id_rekam_medis', 'id_rekam_medis', 'trim|required');


	$this->form_validation->set_rules('id_pasien', 'id_pasien', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

}
