<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

Class Api extends REST_Controller{
	function _construct(){
		parent::__construct();
		$this->load->model('ShopUser');


        $this->methods = [
        'login_post' => ['level' => 1, 'limit' => 100],];
	}

	public function login_post(){
		if ($this->post("user") && $this->post("password")){
			$this->load->model('ShopUser');
			$suser = $this->ShopUser->api_login_user($this->post("user"), $this->post("password"));
			if ($suser != false) {
				$resp = array(
					'status' => "success", 
					'user' => $suser);
				$this->response($resp, 200);
			}
			else{
				$message = array(
					'message' => "Usuario o password no concuerdan",
					'body' => $this->post(), 
				 );
				$this->response($message, 400);
			}
		}
		else{
			$message = array(
				'message' => "Usuario o password no validos",
				'body' => $this->post(),
			 );
			$this->response($message, 400);
		}
	}

	public function cita_post()
	{
		$authUser = $this->auth_check();
		if ($authUser) {
			if ($this->post("fecha") && $this->post("asunto")) 
			{
				$fecha = new DateTime(date("Y-m-d H:i", strtotime($this->post("fecha"))));
				if (!$fecha) {
					$message = array(
						'message' => "Fecha Invalida", 
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
						'message' => "Fecha Invalida", 
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
				$this->load->model('Cita');
				$cita = $this->Cita->AgendarCita($authUser["id"], date("Y-m-d H:i", strtotime($this->post("fecha"))), $asunto);
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
					'body' => $this->post(),
					);
				$this->response($message, 400);
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
	}
}