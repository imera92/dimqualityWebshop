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
		$this->load->model('Solicitud');
		$this->load->model('Citas');
        date_default_timezone_set("America/Guayaquil");
	}
	public function solicitudes()
	{
		if ($this->securityCheckAdmin()) {
			$solicitud = new Solicitud();
			$num_solicitudes = $solicitud->count_solicitudes();
			$data['num_solicitudes'] = $num_solicitudes;
			$solicitudes = $solicitud->obtenerSolicitudes();
			$data['solicitudes'] = $solicitudes;
			$dataHeader['titlePage'] = 'Dimquality::Admin - Solicitudes';
	        $this->load->view('admin/header', $dataHeader);
	        $this->load->view('admin/lat-menu');
			$this->load->view('admin/solicitudes', $data);
	        $this->load->view('admin/footer');
		}else{
			redirect('admin/login');
		}
    }
	public function leer_solicitud_por_id()
	{
		$solicitud_id = $this->input->post('solicitud_id');
        $solicitud = new Solicitud();
        $solicitud->getSolicitudPorId($solicitud_id);
		$usuario = new ShopUser();
		$usuario->getUsuarioPorId($solicitud->getUsuario());
        $response = array();
        $response['id'] = $solicitud->getId();
		$response['usuario'] = $solicitud->getUsuario();
		$response['cedula'] = $usuario->getCedula();
		$response['correo'] = $usuario->getEmail();
		$response['fecha_creac'] = $solicitud->getFecha_creac();
		$response['fecha_cita'] = $solicitud->getFecha_cita();
		$response['ubicacion'] = $solicitud->getUbicacion();
		$response['estado'] = $solicitud->getEstado();
		$this->output->set_output(json_encode($response));
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
