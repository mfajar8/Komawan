<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pre_modules{

  function createControllers($moduleName)
  {
    $class=$moduleName;
    $controller=strtolower($moduleName);
    $string="<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class $class extends MY_Controller{

      public function __construct()
      {
        parent::__construct();
        //KostLab : Write Less Do More
        // if(\$this->session->userdata('status')!='login'){
        //   redirect(base_url('login'));
        // }
        // if(\$this->session->userdata('role')!=1){
        //   redirect(redirect(\$_SERVER['HTTP_REFERER']));
        // }
      }

      function index()
      {

        \$data = array(
          'content'=>'$controller/dashboard',
          'data'=>null,
          'sidebar'=>'$controller/sidebar'
         );
        \$this->template->load(\$data);
      }

    }
";
    return $string;
  }

  function createSidebar($moduleName){
    $moduleName=strtolower($moduleName);
    $string="<div class=\"main-menu-content\">
            <ul class=\"navigation navigation-main\" id=\"sidebar\" data-menu=\"menu-navigation\">
                <li class=\"nav-item\"><a href=\"<?= base_url()?>$moduleName\"><i class=\"feather icon-home\"></i><span class=\"menu-title\" data-i18n=\"\">Dashboard</span></a>
                </li>
                <!-- Jika ingin menggunakan sidebar sub menu -->
                <!-- <li class=\" nav-item\"><a href=\"#\"><i class=\"feather icon-zap\"></i><span class=\"menu-title\" data-i18n=\"\">Starter kit</span></a>
                    <ul class=\"menu-content\">
                        <li class=\"sub-item\"><a href=\"sk-layout-floating-navbar.html\"><i class=\"feather icon-circle\"></i><span class=\"menu-item\" data-i18n=\"nav.sk_starter_kit.fixed_navigation\">Floating navbar</span></a>
                        </li>
                        <li class=\"sub-item\"><a href=\"sk-layout-floating-navbar.html\"><i class=\"feather icon-circle\"></i><span class=\"menu-item\" data-i18n=\"nav.sk_starter_kit.fixed_navigation\">Menu 2</span></a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
";
  return $string;
  }

  function createDashboard(){
    $string="<section id=\"dashboard-analytics\">
      <div class=\"row\">
          <div class=\"col-lg-6 col-md-12 col-sm-12\">
          <div class=\"card bg-analytics text-white\">
            <div class=\"card-content\">
              <div class=\"card-body text-center\">
                <img src=\"<?= base_url() ?>assets/images/elements/decore-left.png\" class=\"img-left\" alt=\"
                card-img-left\">
                <img src=\"<?= base_url() ?>assets/images/elements/decore-right.png\" class=\"img-right\" alt=\"
                card-img-right\">
                 <div class=\"avatar avatar-xl bg-primary shadow mt-0\">
                    <div class=\"avatar-content\">
                        <i class=\"feather icon-award white font-large-1\"></i>
                    </div>
                </div>
                <div class=\"text-center\">
                  <h1 class=\"mb-2 text-white\">Halo Admin!,</h1>
                  <p class=\"m-auto w-75\">Ini adalah contoh dari <strong>dashboard</strong> kostlab. <br>Silahkan ubah di view yaa.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
          <div class=\"col-lg-3 col-md-6 col-12\">
            <div class=\"card\">
              <div class=\"card-header d-flex flex-column align-items-start pb-0\">
                  <div class=\"avatar bg-rgba-primary p-50 m-0\">
                      <div class=\"avatar-content\">
                          <i class=\"feather icon-users text-primary font-medium-5\"></i>
                      </div>
                  </div>
                  <h2 class=\"text-bold-700 mt-1 mb-25\">12k</h2>
                  <p class=\"mb-0\">Total Pengguna</p>
              </div>
              <div class=\"card-content\">
                  <div id=\"subscribe-gain-chart\"></div>
              </div>
            </div>
          </div>
          <div class=\"col-lg-3 col-md-6 col-12\">
            <div class=\"card\">
                <div class=\"card-header d-flex flex-column align-items-start pb-0\">
                    <div class=\"avatar bg-rgba-warning p-50 m-0\">
                        <div class=\"avatar-content\">
                            <i class=\"feather icon-package text-warning font-medium-5\"></i>
                        </div>
                    </div>
                    <h2 class=\"text-bold-700 mt-1 mb-25\">25k</h2>
                    <p class=\"mb-0\">Total Order</p>
                </div>
                <div class=\"card-content\">
                    <div id=\"orders-received-chart\"></div>
                </div>
            </div>
          </div>
      </div>
      <div class=\"row\">
        <!-- Tambah Konten Disini -->
      </div>
    </section>
    <!-- Dashboard Analytics end -->";
    return $string;
  }

}
