<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class SecurityUser extends CI_Model{
		var $persona = "";
        var $correo = "";
        
        function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
        }

        function login_admin($user, $password){
        	$usuario = $this->db->get_where("admin", array('user'=> $user , 'password' => md5($password)))->row();

        	if ($usuario) {
                $data_user = array("tipo" => "admin", "user" => $usuario->user, "correo" => $usuario->correo, "persona" => $usuario->persona);
                $this->session->set_userdata($data_user);
                return true;
            }
            else{
                return false;
            }
        }

        function logout(){
        	$this->session->sess_destroy();
        }
	}
?>