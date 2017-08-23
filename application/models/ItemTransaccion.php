<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            itemTransaccion
        Campos:
            producto (Foreign Key)
            cantidad (int)
            fecha_insert (datetime)
            transaccion (Foreign Key)
    */

	class ItemTransaccion extends CI_Model
    {
        private $producto;
        private $transaccion;
		private $cantidad;
        private $subtotal;        

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

        public function getTransaccion()
        {
            return $this->cantidad;
        }

        public function getCantidad()
        {
            return $this->cantidad;
        }

        public function getSubtotal()
        {
            return $this->subtotal;
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

        public function setTransaccion($transaccion)
        {
            $this->transaccion = $transaccion;
        }

        public function setSubtotal($subtotal)
        {
            $this->subtotal = $subtotal;
        }

        ///////////////////////////////////
        // Métodos
        ///////////////////////////////////
        // Funcion para guardar un registro item-transaccion en la DB
        public function guardarItemTransaccionDB()
        {   
            if (!is_null($this->transaccion)) {
                // Obtener instancia de CodeIgniter para manejo de la DB
                $instanciaCI =& get_instance();

                // Reducimos el stock del producto en la DB
                $this->producto->reducirStock($this->cantidad);

                // Guardamos el item de transaccion en la DB
                $data = array(
                        'producto' => $this->producto->getId(),
                        'cantidad' => $this->cantidad,
                        'subtotal' => $this->subtotal,
                        'transaccion' => $this->transaccion
                );
                $insert = $this->db->insert('itemtransaccion', $data);
                return $insert;                
            } else {
                return false;
            }

        }
	}
?>