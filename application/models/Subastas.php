<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            Subasta
        Campos:
			id
			fechaInicio
			fechaFin
			producto
			precioBase
			estado

    */

	class Subastas extends CI_Model{
        private $id;
		private $fechaInicio;
        private $fechaFin;
        private $producto;
        private $precioBase;
        private $estado;


        function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
            $this->userTbl = 'subasta';

			// modelos requeridos
			$this->load->model('Producto');
			$this->load->model('SecurityUser');
        }

        /*
        Getters
        */

        public function getId(){
            return $this->id;
        }
        public function getFechaInicio(){
            return $this->fechaInicio;
        }
        public function getFechaFin(){
            return $this->fechaFin;
        }
        public function getProducto(){
            return $this->producto;
        }
        public function getPrecioBase(){
            return $this->precioBase;
        }
        public function getEstado(){
            return $this->estado;
        }
		public function getSubasta()
		{
			$subastas = $this->db->get('subasta');
			return $subastas;
		}


		/*
        Setters
        */
        public function setId($id){
            $this->id = $id;
        }
        public function setFechaInicio($fechaInicio){
            $this->fechaInicio = $fechaInicio;
        }
		public function setFechaFin($fechaFin){
            $this->fechaFin = $fechaFin;
        }
        public function setProducto($producto){
            $this->producto = $producto;
        }
        public function setPrecioBase($precioBase){
            $this->precioBase = $precioBase;
        }
        public function setEstado($estado){
            $this->estado = $estado;
        }

        // Métodos

		// Función para comprobar si un Id de subasta existe en la DB
		public function subastaIdExists($subastaId)
		{
			if (!is_null($subastaId)) {
				// Obtener instancia de CodeIgniter para manejo de la DB
				$instanciaCI =& get_instance();
				// Intentamos obtener la subasta de la DB
				$subastaBD = $instanciaCI->db->get_where('subasta', array('id' => $subastaId))->last_row();
				if (!is_null($subastaBD)) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
        //Función para recuperar una Subasta de la DB usando el ID
        public function getSubastaPorId($subastaId)
        {
            if (!is_null($subastaId)) {
                // Validamos que el Id de producto proporcionado sea valido
                if ($this->subastaIdExists($subastaId)) {
                    // Obtener instancia de CodeIgniter para manejo de la DB
                    $instanciaCI =& get_instance();
                    // Obtentemos la subasta de la DB
					$subastaBD = $instanciaCI->db->get_where('subasta', array('id' => $subastaId))->last_row();
                    // Guardamos en la instancia los datos de subasta traidos de la DB
                    $this->id = $subastaBD->id;
                    $this->fechaInicio = $subastaBD->fechaInicio;
                    $this->fechaFin = $subastaBD->fechaFin;
					$this->producto = $subastaBD->producto;
                    $this->precioBase = $subastaBD->precioBase;
                    $this->estado = $subastaBD->estado;

                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

		// cuenta el total de subastas en la base
		public function num_subastas()
		{
			$numero = $this->db->count_all('subasta');
			return $numero;
		}

		// ontiene las subastas según la paginación
		public function obtener_paginacion($inicio, $limite){

			return $this->db->get('subasta', $limite, $inicio)->result();

		}

		// obtiene un array con la informacion de los productos que
		// están en subasta: nombre, código, imagen, ofertas realizadas
		public function obtenerSubastas()
		{
			$subastas = $this->db->get('subasta');

			$actuales = [];
			// para cada registro de la tabla subasta se obtiene la información del producto correspondiente
			foreach ($subastas->result() as $fila) {
				$actual = $this->db->get_where('producto', array('id' => $fila->producto));
				$ofertas = $this->db->get_where('ofertasubasta', array('subasta' => $fila->id))->num_rows();
				$nombre = $actual->row()->nombre;
				$imagen = $actual->row()->imagen;
				$codigo = $actual->row()->codigo;
				$id_producto = $fila->producto;
				$datos = ['nombre' => $nombre, 'imagen' => $imagen, 'codigo' => $codigo, 'ofertas' => $ofertas];
				$actuales[$id_producto] = $datos;
			}
			return $actuales;

		}

		// función que elimina una subasta dado su id
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
