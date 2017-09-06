<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require(APPPATH.'libraries/REST_Controller.php');

// Class Api extends REST_Controller{
Class Api extends CI_Controller{
	function _construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('ShopUser');
		$this->load->model('Cita');

        $this->methods = [
        'login_post' => ['level' => 1, 'limit' => 100],];
	}

	public function api_test()
	{
		$this->load->view('web/api_test');
	}

	public function login_post()
	{
		if ($this->input->post('user') && $this->input->post('password')){
			$this->load->model('ShopUser');
			$suser = $this->ShopUser->api_login_user($this->input->post('user'), $this->input->post('password'));
			if ($suser != false) {
				$resp = array(
					'error' => false,
					'user' => $suser
				);
				// $this->response($resp, 200);
			} else {
				$resp = array(
					'error' => true,
					'message' => 'Usuario o contraseña no coinciden'
				 );
				// $this->response($message, 400);
			}
		} else {
			$resp = array(
				'error' => true,
				'message' => 'No se envió usuario o contraseña'
			 );
			// $this->response($message, 400);
		}

		header('Content-Type: application/json');
		echo json_encode($resp);
	}
/*
	public function cita_post()
	{
		$authUser = $this->auth_check();
		if ($authUser) {
			if ($this->post("fecha") && $this->post("asunto") && $this->post("categoria")) 
			{
				$fecha = new DateTime(date("Y-m-d H:i", strtotime($this->post("fecha"))));
				if (!$fecha) {
					$message = array(
						'message' => "Fecha Inválida", 
						'body' => $this->post(),
						);
					$this->response($message, 400);
					return;
				}
				$tday = new DateTime(date("Y-m-d"));
				$days = $fecha->diff($tday)->days;
				if ($days > 30 || $days <= 0) 
				{
					$message = array(
						'message' => "Fecha Inválida", 
						'body' => $this->post(),
						);
					$this->response($message, 400);
					return;
				}
				$asunto = $this->post("asunto");
				if (strlen($asunto) == 0) {
					$message = array(
						'message' => "Asunto es necesario", 
						'body' => $this->post(),
						);
					$this->response($message, 400);
					return;
				}
				$categoria = $this->post("categoria");
				$this->load->model('Cita');
				if (empty($this->Cita->GetCategoria($categoria))) {
					$message = array(
						'message' => "Categoría Inválida.", 
						'body' => $this->post(),
						);
					$this->response($message, 400);
					return;
				}
				$cita = $this->Cita->AgendarCita($authUser["id"], date("Y-m-d H:i", strtotime($this->post("fecha"))), $asunto, $categoria);
				if ($cita["result"]) {
					if ($cita["error"]) {
						$this->response("Error al ingresar a la base de datos.", 500);
						return;
					}
					$this->response($cita, 201);
					return;
				}
				else{					
					$this->response($cita, 400);
					return;
				}

			}
			else{
				$message = array(
					'message' => "Faltan Campos", 
					'body' => $this->post(),
					);
				$this->response($message, 400);
			}
		}
		else{
			$this->response("Unauthorized",401);
		}
	}

	public function cita_put()
	{
		$authUser = $this->auth_check();
		if ($authUser) {
			$id = $this->put('id');
			if(empty($id)){
				$message = array(
						'message' => "Falta ID de Cita", 
						'body' => $this->put(),
						);
					$this->response($message, 400);
					return;
			}
			if ($this->put("fecha") && $this->put("asunto") && $this->put("categoria")) 
			{
				$fecha = new DateTime(date("Y-m-d H:i", strtotime($this->put("fecha"))));
				if (!$fecha) {
					$message = array(
						'message' => "Fecha Inválida", 
						'body' => $this->put(),
						);
					$this->response($message, 400);
					return;
				}
				$tday = new DateTime(date("Y-m-d"));
				$days = $fecha->diff($tday)->days;
				if ($days > 30 || $days <= 0) 
				{
					$message = array(
						'message' => "Fecha Inválida", 
						'body' => $this->put(),
						);
					$this->response($message, 400);
					return;
				}
				$asunto = $this->put("asunto");
				if (strlen($asunto) == 0) {
					$message = array(
						'message' => "Asunto es necesario", 
						'body' => $this->put(),
						);
					$this->response($message, 400);
					return;
				}
				$citaID = $this->put("id");
				$categoria = $this->put("categoria");
				$this->load->model('Cita');
				if (empty($this->Cita->GetCategoria($categoria))) {
					$message = array(
						'message' => "Categoría Inválida.", 
						'body' => $this->post(),
						);
					$this->response($message, 400);
					return;
				}
				$cita = $this->Cita->ModificarCita($authUser["id"], $citaID, date("Y-m-d H:i", strtotime($this->put("fecha"))), $asunto, $categoria);
				if ($cita["result"]) {
					if ($cita["error"]) {
						$this->response("Error al ingresar a la base de datos.", 500);
					}
					$this->response($cita, 201);
					return;
				}
				else{					
					$this->response($cita, 400);
					return;
				}

			}
			else{
				$message = array(
					'message' => "Faltan Campos", 
					'body' => $this->put(),
					);
				$this->response($message, 400);
			}
		}
		else{
			$this->response("Unauthorized",401);
		}
	}
	
	public function cita_delete($citaID)
	{
		$authUser = $this->auth_check();
		if ($authUser) {
			$this->load->model('Cita');
			$citaCanc = $this->Cita->CancelarCita($authUser["id"], $citaID);
			if (empty($citaCanc)) {
				$this->response('Cita no existe o no pertenece al usuario.', 404);
				return;
			}
			if ($citaCanc["result"]) {
				$this->response($citaCanc, 200);
			}
			else{
				$this->response($citaCanc, 400);
			}
		}
		else{
			$this->response("Unauthorized",401);
		}
	}

	public function cita_get(){
		$authUser = $this->auth_check();
		if ($authUser) {
			$this->load->model('Cita');
			$citaID = $this->get('id');
			if ($citaID === NULL) {
				$this->response($this->Cita->getCitas($authUser["id"]));
			}
			else
			{
				$this->response($this->Cita->getCita($authUser["id"], $citaID));
			}
		}
		else{
			$this->response("Unauthorized",401);
		}
	}

	private function auth_check()
	{
		$hdr = $this->head("X-Api-Key");
		if ($hdr) {
			$this->load->model('ShopUser');
			$apikey = $this->ShopUser->getApiKey($hdr);
			if ($apikey) {
				$tday = new DateTime("now");
				$kday = new DateTime($apikey->date_created);
				$kage = $tday->diff($kday);
				$days = $kage->days;
				if ($days < 30) {
					$user=$this->ShopUser->getUserData($apikey->user_id);
					if ($user) {
						$user["days"]=$days;
						return $user;
					}
					
				}
			}
		}
		return false;
	}*/
}