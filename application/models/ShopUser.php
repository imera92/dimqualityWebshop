<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            usuario
        Campos:
            id
            user
            password
            nombre
            apellido
            email
            cedula
            cuidad
            provincia
            direccion
            telefono
            carrito
    */

	class ShopUser extends CI_Model{
        private $id;
		private $user;
        private $password;
        private $nombre;
        private $apellido;
        private $email;
        private $cedula;
        //private $cuidad;
        //private $provincia;
        private $telefono;

        function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
            $this->userTbl = 'usuario';

            // Modelos Requeridos
            $this->load->model('CarritoDeCompras');
        }

        /*
        Getters
        */
        public function getId(){
            return $this->id;
        }
        public function getUser(){
            return $this->user;
        }
        public function getPassword(){
            return $this->password;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getApellido(){
            return $this->apellido;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getCedula(){
            return $this->cedula;
        }
        public function getTelefono(){
            return $this->telefono;
        }

        /*
        Setters
        */
        public function setId($id){
            $this->id = $id;
        }
        public function setUser($user){
            $this->user = $user;
        }
        public function setPassword($password){
            $this->password = $password;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setApellido($apellido){
            $this->apellido = $apellido;
        }
        public function setEmail($email){
            $this->email = $email;
        }
        public function setCedula($cedula){
            $this->cedula = $cedula;
        }
        public function setTelefono($telefono){
            $this->telefono = $telefono;
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
                    "apellido" => $usuarioDB->apellido,
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

        public function update($id, $userData)
        {
            $this->db->where('id', $id);
            $update = $this->db->update($this->userTbl, $userData);
            if ($update){
                return true;
            }
            else{
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
		function getUsuarioPorId($usuario_id)
		{
			$usuarioDB = $this->db->get_where('usuario', array('id' => $usuario_id))->last_row();

			// Guardamos en la instancia los datos de cita traidos de la DB
			$this->id = $usuarioDB->id;
			$this->cedula = $usuarioDB->cedula;
			$this->email = $usuarioDB->email;
			return true;
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
