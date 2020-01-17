<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pre_controllers{


  function create($controller,$primary_key,$fields,$model,$moduleName,$viewForm,$viewEdit,$viewList,$serverSide)
  {
    $class=$controller;
    $moduleName=strtolower($moduleName);
    $controller=strtolower($controller);
    $string="<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class $class extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            \$this->load->model('$model');
            \$this->load->library('form_validation');
	    \$method=\$this->router->fetch_method();
            // if(\$method != 'ajax_list'){
            //   if(\$this->session->userdata('status')!='login'){
            //     redirect(base_url('login'));
            //   }
            // }
        }

        public function index()
        {";
          if($serverSide==0){
          $string .="\$data$controller=\$this->$model"."->get_all();//panggil ke modell";
        }else{
          $string .="\$data$controller=\$this->$model"."->getDataTable();//panggil ke modell";
        }
        $string .="
          \$datafield=\$this->$model"."->get_field();//panggil ke modell

           \$data = array(
             'content'=>'$moduleName/$controller/$viewList',
             'sidebar'=>'$moduleName/sidebar',
             'css'=>'$moduleName/$controller/css',
             'js'=>'$moduleName/$controller/js',
             'data$controller'=>\$data$controller,
             'datafield'=>\$datafield,
             'module'=>'$moduleName',
             'titlePage'=>'$controller',
             'controller'=>'$controller'
            );
          \$this->template->load(\$data);
        }

        //DataTable
        public function ajax_list()
      {
          \$list = \$this->$model"."->get_datatables();
          \$data = array();
          \$no = \$_POST['start'];
          foreach (\$list as \$$model) {
              \$no++;
              \$row = array();
              \$row[] = \$no;\n\t\t\t\t\t\t\t";
              foreach ($fields as $field) {
                if($field->primary_key!=1){
                $string .="\$row[] = \$$model->$field->name;\n\t\t\t\t\t\t\t";
              }
              }
              $string .="
              \$row[] =\"
              <a href='$controller/edit/\$$model->$primary_key'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='\$$model->$primary_key' href='#'><i class='feather icon-trash'></i></a>\";
              \$data[] = \$row;
          }

          \$output = array(
                          \"draw\" => \$_POST['draw'],
                          \"recordsTotal\" => \$this->$model"."->count_all(),
                          \"recordsFiltered\" => \$this->$model"."->count_filtered(),
                          \"data\" => \$data,
                  );
          //output to json format
          echo json_encode(\$output);
      }


        public function create(){
           \$data = array(
             'content'=>'$moduleName/$controller/$viewForm',
             'sidebar'=>'$moduleName/sidebar',
             'action'=>'$moduleName/$controller/create_action',
             'module'=>'$moduleName',
             'titlePage'=>'$controller',
             'controller'=>'$controller'
            );
          \$this->template->load(\$data);
        }

        public function edit(\$$primary_key){
          \$dataedit=\$this->$model"."->get_by_id(\$$primary_key);
           \$data = array(
             'content'=>'$moduleName/$controller/$viewEdit',
             'sidebar'=>'$moduleName/sidebar',
             'action'=>'$moduleName/$controller/update_action',
             'dataedit'=>\$dataedit,
             'module'=>'$moduleName',
             'titlePage'=>'$controller',
             'controller'=>'$controller'
            );
          \$this->template->load(\$data);
        }\n";
    $string.="public function create_action()
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->create();
        } else {
            \$data = array(\n";
        foreach ($fields as $field) {
          if($field->primary_key!=1){
          $string .="\t\t\t\t\t'$field->name' => \$this->input->post('$field->name',TRUE),\n";
        }
        }
	    $string.="\t\t\t\t\t\n);

            \$this->$model"."->insert(\$data);
            \$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('$moduleName/$controller'));
        }
    }\n



    public function update_action()
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->edit(\$this->input->post('id', TRUE));
        } else {
            \$data = array(\n";
      foreach ($fields as $field) {
              if($field->primary_key!=1){
                $string .="\t\t\t\t\t'$field->name' => \$this->input->post('$field->name',TRUE),\n";
              }
              }
      	    $string.="\t\t\t\t\t\n);

            \$this->$model"."->update(\$this->input->post('$primary_key', TRUE), \$data);
            \$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('$moduleName/$controller'));
        }
    }

    public function delete(\$$primary_key)
    {
        \$row = \$this->$model"."->get_by_id(\$$primary_key);

        if (\$row) {
            \$this->$model"."->delete(\$$primary_key);
            \$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('$moduleName/$controller'));
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('$moduleName/$controller'));
        }
    }

    public function _rules()
    {\n";
      foreach ($fields as $field) {
        if($field->primary_key!=1){
        $string .="\$this->form_validation->set_rules('$field->name', '$field->name', 'trim|required');\n";
      }
      }
      $string .="\n
	\$this->form_validation->set_rules('$primary_key', '$primary_key', 'trim');
	\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');\n
    }

}";
    return $string;
  }

}
