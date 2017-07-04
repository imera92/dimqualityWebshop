<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            productocarrito
        Campos:
            producto (Foreign Key)
            cantidad (int)
            fecha_insert (datetime)
            carrito (Foreign Key)
    */

	class ProductoCarrito extends CI_Model
    {
        private $producto;
		private $cantidad;
        private $fechaInsert;

        function __construct() {
            parent::__construct();
            // Helpers
            $this->load->database();
            $this->load->library('session');

            // Modelos Requeridos
            $this->load->model('Producto');
        }

        ///////////////////////////////////
        // Getters
        ///////////////////////////////////
        public function getProducto()
        {
            return $this->producto;
        }

        public function getCantidad()
        {
            return $this->cantidad;
        }

        public function getCosto()
        {
            return $this->producto->getPVP() * $this->cantidad;
        }

        ///////////////////////////////////
        // Setters
        ///////////////////////////////////
        public function setProducto($producto)
        {
            $this->producto = $producto;
        }

        public function setCantidad($cantidad)
        {
            $this->cantidad = $cantidad;
        }

        public function setFechaInsert($fechaInsert)
        {
            $this->fechaInsert = $fechaInsert;
        }

        ///////////////////////////////////
        // Métodos
        ///////////////////////////////////
        // Funcion para guardar un registro producto-carrito en la DB
        public function guardarProductoCarritoDB($carritoId)
        {   
            if (!is_null($carritoId)) {
                // Obtener instancia de CodeIgniter para manejo de la DB
                $instanciaCI =& get_instance();

                // Guardamos el producto de carrito en la DB
                $data = array(
                        'producto' => $this->producto->getId(),
                        'cantidad' => $this->cantidad,
                        'fecha_insert' => $this->fechaInsert,
                        'carrito' => $carritoId
                );
                $this->db->insert('productocarrito', $data);
                
            } else {
                return false;
            }

        }

        // Funcion para eliminar un registro producto-carrito de la DB
        public function eliminarProductoCarritoPorId($productoId, $carritoId)
        {
            if (!is_null($productoId)) {
                // Obtener instancia de CodeIgniter para manejo de la DB
                $instanciaCI =& get_instance();
                // Eliminamos el registro correspondiente de la tabla productocarrito
                $instanciaCI->db->delete('productocarrito', array('producto' => $productoId, 'carrito' => $carritoId));

                return true;
            } else {
                return false;
            }
        }
	}
?>