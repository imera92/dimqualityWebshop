<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
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

  public function index()
  {
      $titulo = "Dimquality::Admin - Usuarios";
      $dataHeader['titlePage'] = $titulo;
      $crud=new grocery_CRUD();
      $crud->set_table('usuario');
      $crud->columns('nombre','email');
      $crud->required_fields('nombre');
      $crud->unset_export();
      $crud->unset_print();
      $crud->set_language("spanish");
      $output = $crud->render();
      $dataHeader['css_files']=$output->css_files;
      $dataHeader['js_files']=$output->js_files;
      $this->load->view('admin/header', $dataHeader);
      $this->load->view('crearUsuario',(array)$output);
      $this->load->view('admin/footer');
  }

 }
