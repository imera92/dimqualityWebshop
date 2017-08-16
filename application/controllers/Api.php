<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php')

Class Api extends REST_Controller{
	function _construct(){
		parent::__construct();
		$this->load->model('ShopUser');


        $this->methods['login_post']['level'] = 0;
	}

	public function login_get{
		if ($this->post("user") && $this->post("password")){
			$sUser = $this->ShopUser->api_login_user($this->post("user"), $this->post("password"))
			if ($sUser != false) {	
				$this->response($sUser, 200);
			}
			else{
				$this->response("Usuario o contraseña no concuerdan", 400);
			}
		}
		else{
			$this->response("Usuario o contraseña invalidos", 400);
		}
	}
}