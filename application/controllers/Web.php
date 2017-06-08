<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
      $this->load->database();
      $this->load->helper('url');
      $this->load->helper('form');
      date_default_timezone_set("America/Guayaquil");
	}

  public function crearUsuario()
  {
    $titulo = "Dimquality::Admin - Usuarios";
    $dataHeader['titlePage'] = $titulo;

    $this->load->view('web/header', $dataHeader);
    $this->load->view('web/crearUsuario');
    $this->load->view('web/footer');
  }

}