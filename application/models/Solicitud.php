<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            Solicitud
        Campos:
			id
			usuario
			fecha_creac
			fecha_cita
			asunto
			ubicacion
			estado

    */

	class Solicitud extends CI_Model{
        private $id;
		private $usuario;
        private $fecha_creac;
        private $fecha_cita;
        private $asunto;
        private $ubicacion;
        private $estado;



        function __construct() {
            parent::__construct();

            // Helpers
            $this->load->database();
            $this->userTbl = 'solicitud';
			$this->load->library('session');
			$this->load->model('ShopUser');
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
        public function getFecha_creac()
        {
            return $this->fecha_creac;
        }
        public function getFecha_cita()
        {
            return $this->fecha_cita;
        }
        public function getAsunto()
        {
            return $this->asunto;
        }
        public function getUbicacion()
        {
            return $this->ubicacion;
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
        public function setFecha_creac($fecha_creac){
            $this->fecha_creac = $fecha_creac;
        }
		public function setFecha_cita($fecha_fin){
            $this->fecha_cita = $fecha_cita;
        }
        public function setAsunto($asunto){
            $this->asunto = $asunto;
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

		// Método para obtener todas las solicitudes
		public function obtenerSolicitudes()
		{
			$solicitudes_arr = array();
            // Recuperamos los registros de subastas activas de la DB
            $solicitudes_db = $this->db->get('solicitud')->result();
            // Creamos las instancias de las subastas y las metemos en el arreglo
            foreach ($solicitudes_db as $row) {
                $solicitud = new Solicitud();
                $solicitud->getSolicitudPorId($row->id);
                array_push($solicitudes_arr, $solicitud);
            }

            return $solicitudes_arr;

		}


		// Método para comprobar si un ID de solicitud existe en la DB
		public function solicitudIdExists($solicitudId)
		{
			if (!is_null($solicitudId)) {
				// Obtener instancia de CodeIgniter para manejo de la DB
				$instanciaCI =& get_instance();
				// Intentamos obtener la subasta de la DB
				$solicitudBD = $instanciaCI->db->get_where('solicitud', array('id' => $solicitudId))->last_row();
				if (!is_null($solicitudBD)) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

        //Función para recuperar una Solicitud de la DB usando el ID
        public function getSolicitudPorId($solicitudId)
        {
            if (!is_null($solicitudId)) {
                // Validamos que el Id de producto proporcionado sea valido
                if ($this->solicitudIdExists($solicitudId)) {
                    // Obtentemos la subasta de la DB
					$solicitudBD = $this->db->get_where('solicitud', array('id' => $solicitudId))->last_row();
                    // Guardamos en la instancia los datos de la solicitud traidos de la DB
                    $this->id = $solicitudBD->id;
					$this->usuario = $solicitudBD->usuario;
                    $this->fecha_creac = $solicitudBD->fecha_creac;
                    $this->fecha_cita = $solicitudBD->fecha_cita;
                    $this->asunto = $solicitudBD->asunto;
					$this->ubicacion = $solicitudBD->ubicacion;
                    $this->estado = $solicitudBD->estado;

                    return true;
                } else {
                    return false;
                }
            } else {
                return null;
            }
        }

        // Devuelve el total de solicitudes en la base
        public function count_solicitudes()
        {
            $this->db->select('*');
            $this->db->from('solicitud');
            return $this->db->count_all_results();
        }

		// Devuelve el total de subastas activas en la base
		public function count_subastas_activas()
		{
            $this->db->select('*');
            $this->db->from('subasta');
			$this->db->where('estado', 1);
			return $this->db->count_all_results();
		}

		// Devuelve un array con las subastas activas según los parametros de paginación
		public function fetch_subastas_paginacion($inicio, $limite)
		{
			// Creamos el arreglo donde guardaremos las subastas
			$subastas_activas_arr = array();
			// Recuperamos los registros de subastas activas de la DB
			$subastas_activas_db = $this->db->get_where('subasta', array('estado' => 1), $limite, $inicio)->result();
			// Creamos las instancias de las subastas y las metemos en el arreglo
			foreach ($subastas_activas_db as $row) {
				$subasta = new Subastas();
				$subasta->getSubastaPorId($row->id);
				array_push($subastas_activas_arr, $subasta);
			}

			return $subastas_activas_arr;
		}
        // Devuelve un array con las subastas activas según los parametros de paginación

		// Método para eliminar una subasta dado su ID
		public function eliminarSubasta($id_subasta)
		{
			if (!is_null($id_subasta)) {
				$ofertas = $this->db->get_where('ofertasubasta', array('subasta' => $id_subasta));

				foreach ($ofertas->result() as $fila) {
					$this->db->delete('ofertasubasta', array('id' => $fila->id));
				}
				$this->db->delete('subasta', array('id' => $id_subasta));
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
