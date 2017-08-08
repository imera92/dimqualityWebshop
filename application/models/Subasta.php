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

	class Subasta extends CI_Model{
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

	}
?>
