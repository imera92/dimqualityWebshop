<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class ShopUser extends CI_Model{
		private $user;
        private $password;

        function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
            $this->userTbl = 'usuario';

            // Modelos Requeridos
            $this->load->model('CarritoDeCompras');
        }

        function login_user($user, $password){
            // Buscamos el usuario en la DB
        	$usuarioDB = $this->db->get_where("usuario", array('user'=> $user , 'password' => md5($password)))->row();

        	if ($usuarioDB) {
                // Cargamos el carrito de compras del usuario
                $carritoUsuario = new CarritoDeCompras();

                $data_user = array(
                    "id" => $usuarioDB->id,
                    "user" => $usuarioDB->user,
                    "nombre" => $usuarioDB->nombre,
                    "apellido" => $usuarioDB->nombre,
                    "correo" => $usuarioDB->email,
                    "cedula" => $usuarioDB->cedula,
                    "direccion" => $usuarioDB->direccion,
                    "telefono" => $usuarioDB->telefono,
                    "carritoId" => $usuarioDB->carrito,
                    "tipo" => "user"
                );
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

        public function insert($data = array()) {

        //insert user data to users table
            $insert = $this->db->insert($this->userTbl, $data);

        //return the status
            if($insert){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }

        function getRows($params = array()){
            $this->db->select('*');
            $this->db->from($this->userTbl);

        //fetch data by conditions
            if(array_key_exists("conditions",$params)){
                foreach ($params['conditions'] as $key => $value) {
                    $this->db->where($key,$value);
                }
            }

            if(array_key_exists("id",$params)){
                $this->db->where('id',$params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
            //set start and limit
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                $query = $this->db->get();
                if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                    $result = $query->num_rows();
                }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                    $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
                }else{
                    $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
                }
            }

        //return fetched data
            return $result;
        }

		function securityCheckUser() {
	        $securityUser = new ShopUser();
	        $usuario = $this->session->userdata('user');
	        if($usuario == ""){
	            return false;
	        }else{
	            if ($this->session->userdata('tipo') == "user") {
	                return true;
	            }else{
	                $securityUser->logout();
	                return false;
	            }
	        }
	    }

	}
?>
