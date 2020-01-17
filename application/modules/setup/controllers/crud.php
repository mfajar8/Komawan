<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'crudlab/pre_modules.php';
require_once 'crudlab/pre_controllers.php';
require_once 'crudlab/pre_models.php';
require_once 'crudlab/pre_views.php';

class Crud extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->helper(array('crudlab'));
  }

  function index()
  {
    $data = array(
      'content'=>'setup/crudlab',
      'sidebar'=>'setup/sidebar',

     );
     $tables = $this->db->list_tables();
     $data['tables']=$tables;
     $this->template->load($data);
  }

  function field(){

  }

  function process(){
    //Inisialisasi Class
    $pre_controllers=new Pre_controllers();
    $pre_models=new Pre_models();
    $pre_modules=new Pre_modules();
    $pre_views=new Pre_views();
    //Terima dari form generator kostlab
    $moduleName=strtolower(safe($this->input->post('moduleTarget')));
    $controllersName=safe($this->input->post('cName'));
    $tableName=safe($this->input->post('tableName'));
    $serverSide=$this->input->post('serverSide');
    if($moduleName=='' || $controllersName==''){
      echo "<script>alert('form tidak lengkap')</script>";
      redirect(base_url('setup/crud'));
    }
    //Proses Ekstrak Table
    $primary_key=null;
    $fields = $this->db->field_data($tableName);

    foreach ($fields as $field)
    {
      if($field->primary_key==1){
          $primary_key=$field->name;
      }
            // echo $field->name."<br>";
            // echo $field->type."<br>";
            // echo $field->max_length."<br>";
            // echo $field->primary_key."<br>";
    }
    if($primary_key==null){
      die('Harap Buat Primary Key');
    }
    //Init Data
    $controller = $controllersName <> '' ? ucfirst($controllersName) : ucfirst($tableName);
    $model = $controllersName <> '' ? ucfirst($controllersName."_model") : ucfirst($tableName) . '_model';
    $viewForm = $tableName . "_create";
    $viewEdit = $tableName . "_edit";
    $viewList = $tableName . "_list";
    $viewCss = "css";
    $viewJs = "js";
    $primary_key=$primary_key;
    $fields=$fields;


    //Path untuk target dan pengecekan
    $pathModule="application/modules/$moduleName";
    $pathControllers=$pathModule."/controllers";
    $pathModels=$pathModule."/models";
    $pathViews=$pathModule."/views";
    $pathViewsCrud=$pathViews."/".strtolower($controllersName);

    //Memasukan semua nilai yang ada di builder crudlab
    $moduleBundle=$pre_modules->createControllers(ucfirst($moduleName));
    $moduleBundleSidebar=$pre_modules->createSidebar($moduleName);
    $moduleBundleDashboard=$pre_modules->createDashboard();
    $controllerBundle=$pre_controllers->create($controller,$primary_key,$fields,$model,$moduleName,$viewForm,$viewEdit,$viewList,$serverSide);
    $modelBundle=$pre_models->create($model,$primary_key,$tableName,$fields);
    $viewFormBundle=$pre_views->createForm($fields);
    $viewEditBundle=$pre_views->createEdit($primary_key,$fields,$controller);
    $viewListBundle=$pre_views->createList($primary_key,$controllersName,$serverSide);
    $viewCssBundle=$pre_views->createCss();
    $viewJsBundle=$pre_views->createJs($serverSide,$moduleName,$controller);

    //Mengecek Direktori Module
    if (!file_exists($pathModule)){
      $old_umask = umask(0);
      mkdir($pathModule,0777, true);
      umask($old_umask);
      //Init controller dan view di module
      if (!file_exists($pathControllers)){
        $old_umask = umask(0);
        mkdir($pathControllers,0777, true);
        umask($old_umask);
      }
      if (!file_exists($pathViews)){
        $old_umask = umask(0);
        mkdir($pathViews,0777, true);
        umask($old_umask);
      }
      createFile($moduleBundle,$pathControllers."/".ucfirst($moduleName).".php");
      createFile($moduleBundleSidebar,$pathViews."/sidebar.php");
      createFile($moduleBundleDashboard,$pathViews."/dashboard.php");

    }
    //Mengecek Direktori Controllers
    if (!file_exists($pathControllers)){
      $old_umask = umask(0);
      mkdir($pathControllers,0777, true);
      umask($old_umask);
    }

    //Mengecek Direktori Models
    if (!file_exists($pathModels)){
      $old_umask = umask(0);
      mkdir($pathModels,0777, true);
      umask($old_umask);
    }

    //Mengecek Direktori Views
    if (!file_exists($pathViews)){
      $old_umask = umask(0);
      mkdir($pathViews,0777, true);
      umask($old_umask);
    }

    //Mengecek Direktori Sub View didalem module
    if (!file_exists($pathViewsCrud)){
      $old_umask = umask(0);
      mkdir($pathViewsCrud,0777, true);
      umask($old_umask);
    }

    createFile($controllerBundle,$pathControllers."/".$controller.".php");
    createFile($modelBundle,$pathModels."/".$model.".php");
    createFile($viewFormBundle,$pathViewsCrud."/".$viewForm.".php");
    createFile($viewEditBundle,$pathViewsCrud."/".$viewEdit.".php");
    createFile($viewListBundle,$pathViewsCrud."/".$viewList.".php");
    createFile($viewCssBundle,$pathViewsCrud."/".$viewCss.".php");
    createFile($viewJsBundle,$pathViewsCrud."/".$viewJs.".php");

    echo "SUCCESS";
    // echo "oke";

  }


}
