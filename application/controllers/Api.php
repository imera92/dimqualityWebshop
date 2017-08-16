<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

Class Api extends REST_Controller{
	function _construct(){
		parent::__construct();
		$this->load->model('ShopUser');


        $this->methods['login_post']['level'] = 0;
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
				'message' => "Usuario o password no invalidos",
				'body' => $this->post(),
			 );
			$this->response($message, 400);
		}
	}
}