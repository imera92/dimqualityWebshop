<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AñadirACarrito extends CI_Controller {
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
      $titulo = "Dimquality::Admin - Inicio";
      $dataHeader['titlePage'] = $titulo;
      
      $this->load->view('admin/header', $dataHeader);
      $this->load->view('añadiraCarrito');
      $this->load->view('admin/footer');
  }

 }
