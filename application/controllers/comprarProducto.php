<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class comprarProducto extends CI_Controller {
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
      $this->load->view('comprarProducto');
      $this->load->view('admin/footer');
  }

  public function comprarProducto(){

      if($this->form_validation->run() == true){
          $this->session->set_userdata('success_msg', 'Tu compra se ha realizado con éxito, por favor revise su e-mail'); 
          redirect('user/catalogo');
        }else{
          $data['error_msg'] = 'Ha ocurrido un problema, intente más tarde';
        }
    }
    $data['user'] = $userData;
        //load the view    
    $titulo = "Dimquality::Admin - Usuarios";
    $dataHeader['titlePage'] = $titulo;
    $this->load->view('admin/header', $dataHeader);
    $this->load->view('comprarProducto', $data);
    $this->load->view('admin/footer');

 }
