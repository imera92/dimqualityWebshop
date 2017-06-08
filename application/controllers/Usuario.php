<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');        
        $this->load->library('form_validation');
        $this->load->model('ShopUser');
        date_default_timezone_set("America/Guayaquil");
	}

  public function registrarUsuario(){
    $data = array();
    $userData = array();
    if($this->input->post('submit')){
      $this->form_validation->set_rules('usuario', 'Usuario', 'required');
      $this->form_validation->set_rules('nombre', 'Nombre', 'required');
      $this->form_validation->set_rules('apellido', 'Apellido', 'required');      
      $this->form_validation->set_rules('correo', 'Email', 'required|valid_email|callback_email_check');
      $this->form_validation->set_rules('clave', 'password', 'required');
      $this->form_validation->set_rules('conf_clave', 'confirmar clave', 'required|matches[clave]');
      $this->form_validation->set_rules('cedula', 'Cédula', 'required|callback_cedula_check');
      $this->form_validation->set_rules('pais', 'País');
      $this->form_validation->set_rules('direccion', 'Direccion');
      $this->form_validation->set_rules('telefono', 'Teléfono');

      $userData = array(
        'user' => $this->input->post('usuario'),
        'nombre' => strip_tags($this->input->post('nombre')),
        'apellido' => strip_tags($this->input->post('apellido')),
        'email' => strip_tags($this->input->post('correo')),
        'password' => md5($this->input->post('password')),        
        'cedula' => strip_tags($this->input->post('cedula')),
        'pais' => strip_tags($this->input->post('pais')),
        'direccion' => strip_tags($this->input->post('direccion')),
        'telefono' => strip_tags($this->input->post('telefono'))
        );

      if($this->form_validation->run() == true){
        $insert = $this->ShopUser->insert($userData);
        if($insert){
          $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.'); 
          redirect('user/login');
        }else{
          $data['error_msg'] = 'Some problems occured, please try again.';
        }
      }
    }
    $data['user'] = $userData;
        //load the view    
    $titulo = "Dimquality::Admin - Usuarios";
    $dataHeader['titlePage'] = $titulo;
    $this->load->view('admin/header', $dataHeader);
    $this->load->view('crearUsuario', $data);
    $this->load->view('admin/footer');
  }

    /*
     * Existing email check during validation
     */
    public function email_check($str){
      $con['returnType'] = 'count';
      $con['conditions'] = array('email'=>$str);
      $checkEmail = $this->ShopUser->getRows($con);
      if($checkEmail > 0){
        $this->form_validation->set_message('email_check', 'El correo ya está registrado.');
        return FALSE;
      } else {
        return TRUE;
      }
    }

    public function cedula_check($str){
      $con['returnType'] = 'count';
      $con['conditions'] = array('cedula'=>$str);
      $checkEmail = $this->ShopUser->getRows($con);
      if($checkEmail > 0){
        $this->form_validation->set_message('cedula_check', 'La cédula ya está registrado.');
        return FALSE;
      } else {
        return TRUE;
      }
    }


  }

 
