<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cita extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('grocery_CRUD');
        $this->load->model('SecurityUser');

        date_default_timezone_set("America/Guayaquil");
	}

	public function citas()
	{
		if ($this->securityCheckAdmin()) {
			$dataHeader['titlePage'] = 'Dimquality::Admin - Citas';
	        $this->load->view('admin/header', $dataHeader);
	        $this->load->view('admin/lat-menu');
			$this->load->view('admin/citas');
	        $this->load->view('admin/footer');
		}else{
			redirect('admin/login');
		}

    }


    //Aseguhar que el Administrador este logeado
     function securityCheckAdmin()
     {
        $securityUser = new SecurityUser();
        $usuario = $this->session->userdata('user');
        if($usuario == ""){
            return false;
        }else{
            if ($this->session->userdata('tipo') == "admin") {
                return true;
            }else{
                $securityUser->logout();
                return false;
            }
        }
    }

    private function loginCheck()
    {
        $securityUser = new ShopUser();
        $usuario = $this->session->userdata('user');
        if($usuario == ""){
          return false;
        }else{
          return true;
        }
    }

}
