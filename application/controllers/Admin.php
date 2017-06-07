<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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

	public function login() {
        if($this->securityCheckAdmin()){
            redirect("admin/index");
        }else{
            $titulo = "Dimquality::Admin";
            $dataHeader['titlePage'] = $titulo;

            $this->load->view('admin/header', $dataHeader);
            $this->load->view('admin/login');
            $this->load->view('admin/footer');
        }
    }

    public function index() {
    	if ($this->securityCheckAdmin()) {
    		$titulo = "Dimquality::Admin - Inicio";

    		$dataHeader['titlePage'] = $titulo;

    		$this->load->view('admin/header', $dataHeader);
    		$this->load->view('admin/lat-menu');
    		$this->load->view('admin/index');
    		$this->load->view('admin/footer');
    	} else {
    		redirect("admin/login");
    	}
    }

	public function logout() {
        if($this->securityCheckAdmin()){
            $securityUser = new SecurityUser();
            $securityUser->logout();
            redirect("admin/login");
        }else{
            redirect("admin/login");
        }
    }

	public function auth() {
        $user = $this->input->post("user");
        $password = $this->input->post("password");

        $securityUser = new SecurityUser();
        $securityUser->login_admin($user, $password);

        if($this->session->userdata('user') != "" && $this->session->userdata('tipo') == "admin"){
            redirect("admin/index");
        }else{
            redirect("admin/login");
        }
    }

    function securityCheckAdmin() {
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



}