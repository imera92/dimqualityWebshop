<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            carrito
        Campos:
            id (Primary Key)
            subtotal (Decimal)
    */

	class CarritoDeCompras extends CI_Model
    {
        private $id;
        private $subtotal;
        private $productosCarrito;

        function __construct() {
            parent::__construct();
            // Helpers
            $this->load->database();
            $this->load->library('session');

            // Modelos Requeridos
            $this->load->model('ShopUser');
            $this->load->model('Producto');
            $this->load->model('ProductoCarrito');
        }

        ///////////////////////////////////
        // Getters
        ///////////////////////////////////
        public function getId()
        {
            return $this->id;
        }

        public function getSubtotal()
        {
            return $this->subtotal;
        }

        public function getProductosCarrito()
        {
            return $this->productosCarrito;
        }

        ///////////////////////////////////
        // Setters
        ///////////////////////////////////
        public function setId ($id)
        {
            $this->id = $id;
        }

        public function setSubtotal($subtotal)
        {
            $this->$subtotal = $subtotal;
        }

        public function setProductosCarrito($productosCarrito)
        {
            $this->productosCarrito = $productosCarrito;
        }

        ///////////////////////////////////
        // Métodos
        ///////////////////////////////////
        // Funcion para recuperar un carrito de la DB usando el ID
        public function getCarritoPorId($carritoId)
        {
            if (!is_null($carritoId)) {
                // Obtener instancia de CodeIgniter para manejo de la DB
                $instanciaCI =& get_instance();

                $carritoDB = $instanciaCI->db->get_where('carrito', array('id' => $carritoId))->last_row();
                $productosCarritoDB = $instanciaCI->db->get_where('productocarrito', array('carrito' => $carritoId))->result_array();
                if (!is_null($carritoDB)) {
                    $this->id = $carritoDB->id;
                    $this->subtotal = $carritoDB->subtotal;

                    if (!is_null($productosCarritoDB)) {
                        $this->productosCarrito = array();
                        foreach ($productosCarritoDB as $key => $value) {
                            $productoDB = new Producto();
                            if ($productoDB->getProductoPorId($value['producto'])) {
                                $productoCarrito = new ProductoCarrito();
                                $productoCarrito->setProducto($productoDB);
                                $productoCarrito->setCantidad($value['cantidad']);
                                $productoCarrito->setFechaInsert($value['fecha_insert']);
                                array_push($this->productosCarrito, $productoCarrito);
                            }
                        }
                    }

                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Funcion para obtener el ultimo carrito anadido a la DB
        public function getLastCarrito()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            $instanciaCI->db->select('*');
            $instanciaCI->db->from('carrito');
            $instanciaCI->db->order_by('id', 'DESC');
            $instanciaCI->db->limit(1);
            $carritoDB = $instanciaCI->db->get()->row();
            if (!is_null($carritoDB)) {
                $this->id = $carritoDB->id;
                $this->subtotal = $carritoDB->subtotal;

                return true;
            } else {
                return false;
            }
        }

        // Funcion para obtener el ID del utlimo carrito anadido a la DB
        public function getLastCarritoId()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            $instanciaCI->db->select('id');
            $instanciaCI->db->from('carrito');
            $instanciaCI->db->order_by('id', 'DESC');
            $instanciaCI->db->limit(1);
            $result = $instanciaCI->db->get()->row();
            if (!is_null($result)) {
                $lastId = $result->id;
            } else {
                $lastId = null;
            }

            return $lastId;
        }

        // Funcion para validar si un producto esta presente en el carrito
        public function productoEstaEnCarrito($productoId)
        {
            if (!is_null($productoId)) {
                // Buscamos el producto en el carrito
                foreach ($this->productosCarrito as $index => $productoCarrito) {
                    if ($productoCarrito->getProducto()->getId() == $productoId) {
                        return true;
                    }
                }
                return false;
            } else {
                return false;
            }
        }

        // Funcion para actualizar la cantidad de un producto en el carrito
        public function actualizarCantidadProducto($productoId, $cantidadProducto)
        {
            if (!is_null($productoId) && !is_null($cantidadProducto)) {
                if ($this->productoEstaEnCarrito($productoId)) {
                    // Buscamos el producto en el carrito
                    foreach ($this->productosCarrito as $index => $productoCarrito) {
                        if ($productoCarrito->getProducto()->getId() == $productoId) {
                            $this->productosCarrito[$index]->setCantidad($cantidadProducto);
                        }
                    }

                    // Recalculamos el subtotal
                    $this->calcularSubtotal();

                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        }

        // Funcion para guardar un producto en el carrito
        public function guardarProducto($productoId, $cantidadProducto)
        {
            if (!is_null($productoId) && !is_null($cantidadProducto)) {
                $productoDB = new Producto();
                $productoDB->getProductoPorId($productoId);
                $productoCarrito = new ProductoCarrito();
                $productoCarrito->setProducto($productoDB);
                $productoCarrito->setCantidad($cantidadProducto);
                $productoCarrito->setFechaInsert(date("Y-m-d h:i:s"));

                array_push($this->productosCarrito, $productoCarrito);

                // Recalculamos el subtotal
                $this->calcularSubtotal();

                return true;
            } else {
                return false;
            }

        }

        // Funcion para eliminar un producto del carrito
        public function eliminarProducto($productoId)
        {   
            if (!is_null($productoId)) {
                // Verificamos que el producto este presente en el carrito
                if ($this->productoEstaEnCarrito($productoId)) {
                    // Si el producto esta presente, eliminamos el producto deseado de la instancia
                    foreach ($this->productosCarrito as $index => $productoCarrito) {
                        if ($productoCarrito->getProducto()->getId() == $productoId) {
                            unset($this->productosCarrito[$index]);
                        }
                    }
                    
                    // Recalculamos el subtotal
                    $this->calcularSubtotal();

                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Funcion para recalcular el subtotal del carrito
        public function calcularSubtotal()
        {   
            $this->subtotal = 0.00;

            // Validamos si hay productos en el carrito
            if (!empty($this->productosCarrito)) {
                // Si hay productos en el carrito, sumamos al subtotal el costo de cada producto (PVP * Cantidad)
                foreach ($this->productosCarrito as $index => $productoCarrito) {
                    $this->subtotal += $productoCarrito->getCosto();
                }
            }
        }

        // Funcion para vaciar el carrito
        public function vaciarCarrito()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            // Vaciamos el objeto de carrito y enceramos el subtotal
            $this->subtotal = 0.00;
            $this->productosCarrito = array();
        }

        public function crearNuevoCarrito()
        {   
            $lastId = $this->getLastCarritoId();
            $this->id = $lastId + 1;
            $this->subtotal = 0.00;
            $this->productosCarrito = array();   
        }
        // RECORDAR: la instancia del Carrito es una interfaz entre la aplicacion y la DB. Primero modificamos la instancia de carrito, luego utilizamos este metodo para propagar los cambios a la DB
        public function guardarNuevoCarrito()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            // Guardamos los datos del nuevo carrito
            $instanciaCI->db->insert('carrito', array(
                'id' => $this->id,
                'subtotal' => $this->subtotal
            ));
            // $this->setId($this->getLastCarritoId() + 1);

            // Guardamos los productos del carrito
            if (!empty($this->productosCarrito)) {
                foreach ($this->productosCarrito as $index => $productoCarrito) {
                    $productoCarrito->guardarProductoCarritoDB($this->id);
                }
            }

        }
        public function actualizarCarrito()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            // Actualizamos el subtotal del carrito
            $data = array(
                'id' => $this->id,
                'subtotal' => $this->subtotal
            );
            $instanciaCI->db->replace('carrito', $data);

            // Actualizamos los productos del carrito
            $instanciaCI->db->delete('productocarrito', array('carrito' => $this->id));
            if (!empty($this->productosCarrito)) {
                foreach ($this->productosCarrito as $index => $productoCarrito) {
                    $productoCarrito->guardarProductoCarritoDB($this->id);
                }
            }

        }
	}
?>