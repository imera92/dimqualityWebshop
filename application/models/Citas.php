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
		private $fechaInicio;
        private $fechaFin;
        private $producto;
        private $precioBase;
        private $estado;
        private $ofertas;


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
        public function getFechaInicio()
        {
            return $this->fechaInicio;
        }
        public function getFechaFin()
        {
            return $this->fechaFin;
        }
        public function getProducto()
        {
            return $this->producto;
        }
        public function getPrecioBase()
        {
            return $this->precioBase;
        }
        public function getEstado()
        {
            return $this->estado;
        }
        public function getOfertas()
        {
        	return $this->ofertas;
        }


		///////////////////////////////////
        // Setters
        ///////////////////////////////////
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

        ///////////////////////////////////
        // Métodos
        ///////////////////////////////////
		// Método para comprobar si un ID de subasta existe en la DB
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
                    // Obtentemos la subasta de la DB
					$subastaBD = $this->db->get_where('subasta', array('id' => $subastaId))->last_row();

                    // Guardamos en la instancia los datos de subasta traidos de la DB
                    $this->id = $subastaBD->id;
                    $this->fechaInicio = $subastaBD->fechaInicio;
                    $this->fechaFin = $subastaBD->fechaFin;
                    $this->precioBase = $subastaBD->precioBase;
                    $this->estado = $subastaBD->estado;

                    // Obtenemos la instancia del producto subastado
                    $producto_ins = new Producto();
                    $producto_ins->getProductoPorId($subastaBD->producto);
                    $this->producto = $producto_ins;

                    // Obtenemos las instancias de las ofertas realizadas
                    // Al momento de recuperar las ofertas de la DB las traemos ordenadas de forma DESCENDENTE
                    $this->ofertas = array();
                    $this->db->order_by('monto', 'DESC');
                    $ofertas_db = $this->db->get_where('ofertasubasta', array('subasta' => $subastaBD->id))->result();
                    foreach ($ofertas_db as $row) {
                    	$oferta = new Oferta();
                    	$oferta->fetch_by_id($row->id);
                    	array_push($this->ofertas, $oferta);
                    }

                    return true;
                } else {
                    return false;
                }
            } else {
                return null;
            }
        }

        // Devuelve el total de subastas activas en la base
        public function count_subastas()
        {
            $this->db->select('*');
            $this->db->from('subasta');
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
        public function fetch_subastas_paginacion_admin($inicio, $limite)
        {
            // Creamos el arreglo donde guardaremos las subastas
            $subastas_arr = array();
            // Recuperamos los registros de subastas activas de la DB
            $subastas_db = $this->db->get('subasta', $limite, $inicio)->result();
            // Creamos las instancias de las subastas y las metemos en el arreglo
            foreach ($subastas_db as $row) {
                $subasta = new Subastas();
                $subasta->getSubastaPorId($row->id);
                array_push($subastas_arr, $subasta);
            }

            return $subastas_arr;
        }

        public function get_mayor_oferta()
        {
            if (!empty($this->ofertas)) {
                return $this->ofertas[0];
            }

            return null;
        }

		// Devuelve un array con la informacion de los productos que
		// están en subasta: nombre, código, imagen, ofertas realizadas
        /*
		public function obtenerSubastas()
		{
			$subastas = $this->db->get('subasta');

			$actuales = [];
			// Para cada registro de la tabla subasta se obtiene la información del producto correspondiente
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
        */

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
