<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            cita2
        Campos:
			id
			usuario
			fecha
			ubicacion
			descripcion
			estado

    */

	class Citas extends CI_Model{
        private $id;
		private $usuario;
        private $fecha;
        private $ubicacion;
        private $descrpcion;
        private $estado;

        function __construct() {
            parent::__construct();

            // Helpers
            $this->load->database();
            $this->load->library('session');
            $this->userTbl = 'cita2';

			$this->load->model('SecurityUser');
        }

        ///////////////////////////////////
        // Getters
        ///////////////////////////////////
        public function getId()
        {
            return $this->id;
        }
        public function getUsuario()
        {
            return $this->usuario;
        }
        public function getFecha()
        {
            return $this->fecha;
        }
        public function getUbicacion()
        {
            return $this->ubicacion;
        }
        public function getDescripcion()
        {
            return $this->descripcion;
        }
        public function getEstado()
        {
            return $this->estado;
        }

		///////////////////////////////////
        // Setters
        ///////////////////////////////////
        public function setId($id){
            $this->id = $id;
        }
        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }
		public function setFecha($fecha){
            $this->fecha = $fecha;
        }
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        public function setUbicacion($ubicacion){
            $this->ubicacion = $ubicacion;
        }
        public function setEstado($estado){
            $this->estado = $estado;
        }

        ///////////////////////////////////
        // Métodos
        ///////////////////////////////////

		public function citaIdExists($citaId)
		{
			if (!is_null($citaId)) {
				$instanciaCI =& get_instance();
				$citaBD = $instanciaCI->db->get_where('cita2', array('id' => $citaId))->last_row();
				if (!is_null($citaBD)) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

        //Función para recuperar una cita de la DB usando el ID
        public function getCitaPorId($citaId)
        {
            if (!is_null($citaId)) {
                if ($this->citaIdExists($citaId)) {
                    // Obtentemos la cita de la DB
					$citaBD = $this->db->get_where('cita2', array('id' => $citaId))->last_row();

                    // Guardamos en la instancia los datos de cita traidos de la DB
                    $this->id = $citaBD->id;
                    $this->usuario = $citaBD->usuario;
                    $this->fecha = $citaBD->fecha;
                    $this->descripcion = $citaBD->descripcion;
					$this->ubicacion = $citaBD->ubicacion;
                    $this->estado = $citaBD->estado;

                    return true;
                } else {
                    return false;
                }
            } else {
                return null;
            }
        }

        // Devuelve el total de citas
        public function count_citas()
        {
            $this->db->select('*');
            $this->db->from('cita2');
            return $this->db->count_all_results();
        }


		// Método para eliminar una cita dado su ID
		public function eliminarCita($id_cita)
		{
			if (!is_null($id_cita)) {
				$this->db->delete('cita2', array('id' => $id_cita));
				return true;
			}else{
				return false;
			}
		}

		function securityCheckAdmin() {
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
	}
?>
