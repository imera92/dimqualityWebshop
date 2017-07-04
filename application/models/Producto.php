<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            carrito
        Campos:
            id (Primary Key)
            nombre (varchar)
            marca (varchar)
            categoria (varchar)
            codigo (Unique)(varchar)
            imagen (varchar)
            costo (varchar)
            pvp (varchar)
            descripcion (varchar)
            estado (int)
            stock (int)
            destacado (int)
            fechaCreacion (date)
    */

	class Producto extends CI_Model
    {
        private $id;
        private $nombre;
        private $marca;
        private $categoria;
        private $codigo;
        private $imagen;
        private $costo;
        private $pvp;
        private $descripcion;
        private $estado;
        private $stock;
        private $destacado;
        private $fechaCreacion;


        function __construct() {
            parent::__construct();
            // Helpers
            $this->load->database();
            $this->load->library('session');
        }

        ///////////////////////////////////
        // Getters
        ///////////////////////////////////
        public function getId()
        {
            return $this->id;
        }

        public function getNombre()
        {
            return $this->nombre;
        }

        public function getMarca()
        {
            return $this->marca;
        }

        public function getCategoria()
        {
            return $this->categoria;
        }

        public function getCodigo()
        {
            return $this->codigo;
        }

        public function getImagen()
        {
            return $this->imagen;
        }

        public function getCosto()
        {
            return $this->costo;
        }

        public function getPVP()
        {
            return $this->pvp;
        }

        public function getDescripcion()
        {
            return $this->descripcion;
        }

        public function getEstado()
        {
            return $this->estado;
        }

        public function getStock()
        {
            return $this->stock;
        }

        public function getFechaCreacion()
        {
            return $this->fechaCreacion;
        }

        ///////////////////////////////////
        // Setters
        ///////////////////////////////////
        public function setId($id)
        {
            $this->id = $id;
        }

        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }

        public function setMarca($marca)
        {
            $this->marca = $marca;
        }

        public function setCategoria($categoria)
        {
            $this->categoria = $categoria;
        }

        public function setCodigo($codigo)
        {
            $this->codigo = $codigo;
        }

        public function setImagen($imagen)
        {
            $this->imagen = $imagen;
        }

        public function setCosto($costo)
        {
            $this->costo = $costo;
        }

        public function setPVP($pvp)
        {
            $this->pvp = $pvp;
        }

        public function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }

        public function setEstado($estado)
        {
            $this->estado = $estado;
        }

        public function setStock($stock)
        {
            $this->stock = $stock;
        }

        public function setFechaCreacion($fechaCreacion)
        {
            $this->fechaCreacion = $fechaCreacion;
        }

        ///////////////////////////////////
        // Métodos
        ///////////////////////////////////
        // Funcion para recuperar un producto de la DB usando el ID
        public function getProductoPorId($productoId)
        {
            if (!is_null($productoId)) {
                // Validamos que el Id de producto proporcionado sea valido
                if ($this->productoIdExists($productoId)) {
                    // Obtener instancia de CodeIgniter para manejo de la DB
                    $instanciaCI =& get_instance();

                    // Obtentemos el producto de la DB
                    $productoDB = $instanciaCI->db->get_where('producto', array('id' => $productoId))->last_row();

                    // Guardamos en la instancia los datos de producto traidos de la DB
                    $this->id = $productoDB->id;
                    $this->nombre = $productoDB->nombre;
                    $this->marca = $productoDB->marca;
                    $this->categoria = $productoDB->categoria;
                    $this->codigo = $productoDB->codigo;
                    $this->imagen = $productoDB->imagen;
                    $this->costo = $productoDB->costo;
                    $this->pvp = $productoDB->pvp;
                    $this->descripcion = $productoDB->descripcion;
                    $this->estado = $productoDB->estado;
                    $this->stock = $productoDB->stock;
                    $this->destacado = $productoDB->destacado;
                    $this->fechaCreacion = $productoDB->fechaCreacion; 
                    
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Funcion para comprobar si un producto está destacado
        public function isDestacado()
        {
            if ($this->destacado == 1) {
                return true;
            } else {
                return false;
            }
        }

        // Funcion para comprobar si un Id de producto existe en la DB
        public function productoIdExists($productoId)
        {
            if (!is_null($productoId)) {
                // Obtener instancia de CodeIgniter para manejo de la DB
                $instanciaCI =& get_instance();

                // Intentamos obtener el producto de la DB
                $productoDB = $instanciaCI->db->get_where('producto', array('id' => $productoId))->last_row();
                if (!is_null($productoDB)) {
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