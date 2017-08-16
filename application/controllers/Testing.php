<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('unit_test');
        $this->load->model('CarritoDeCompras');
        $this->load->model('Producto');
        $this->load->model('ProductoCarrito');
        date_default_timezone_set("America/Guayaquil");
    }

    public function run_tests()
    {   
        //////////////////////////////////////
        // Pruebas del Modelo CarritoDeCompras
        //////////////////////////////////////

        // Borramos todos los datos guardados en la DB
        $this->db->truncate('carrito');
        $this->db->truncate('productocarrito');
        $this->db->truncate('producto');
        $this->db->truncate('usuario');

        // Creamos un producto para poder ejecutar las pruebas
        $productoDB = array(
            'nombre' => 'Logitech G502',
            'marca' => 'LOGITECH',
            'categoria' => 'PERIFERICO',
            'codigo' => 'G502',
            'imagen' => '1e362-producto2.jpg',
            'pvp' => 50.99,
            'descripcion' => '',
            'estado' => 1,
            'stock' => 10,
            'destacado' => 1,
            'fechaCreacion' => date('Y-m-d')
        );
        $this->db->insert('producto', $productoDB);

        // Creamos un usuario para poder ejecutar las pruebas
        $usuarioDB = array(
            'user' => 'iamera',
            'password' => md5('cd3fg3cd3'),
            'nombre' => 'Iván Alejandro',
            'apellido' => 'Mera Maldonado',
            'email' => 'imera92@gmail.com',
            'cedula' => '0924166127',
            'direccion' => 'Guayacanes Mz. 211 V. 10',
            'telefono' => '0981617261',
            'carrito' => 1
        );
        $this->db->insert('usuario', $usuarioDB);

        // Metodo de prueba: crearNuevoCarrito
        $carrito = new CarritoDeCompras();
        $carrito->crearNuevoCarrito();
        if ($carrito->getId() == 1 && $carrito->getSubtotal() == 0.00) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        $this->unit->run($resultado, true, 'Metodo crearNuevoCarrito');

        // Metodo de prueba: guardarNuevoCarrito
        // Preparacion para la prueba:
        // 1. Crear una instancia de CarritoDeCompras
        $carrito = new CarritoDeCompras();
        $carrito->crearNuevoCarrito();
        // Ejecucion de la prueba:
        $carrito->guardarNuevoCarrito();
        $carritoDB = $this->db->get('carrito')->row();
        if ($carritoDB != null) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        $this->unit->run($resultado, true, 'Metodo guardarNuevoCarrito');

        // Metodo de prueba: getLastCarritoId
        // Preparacion para la prueba: crear una nueva instancia de CarritoDeCompras y guardarla en la DB
        // 1. Eliminar los carritos existentes en la DB
        $this->db->truncate('carrito');
        // 2. Crear un nuevo carrito de compras (vacio) en la DB
        $carritoDB = array(
            'subtotal' => 0.00
        );
        $this->db->insert('carrito', $carritoDB);
        // Ejecucion de la prueba:
        $carrito = new CarritoDeCompras();
        $resultado = $carrito->getLastCarritoId();
        if (!is_null($resultado)) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        $this->unit->run($resultado, true, 'Metodo getLastCarritoId');

        // Metodo de prueba: getCarritoPorId
        // Preparacion para la prueba:
        // 1. Eliminar los carritos existentes en la DB
        $this->db->truncate('carrito');
        // 2. Crear un nuevo carrito de compras (vacio) en la DB
        $carritoDB = array(
            'subtotal' => 0.00
        );
        $this->db->insert('carrito', $carritoDB);
        // Ejecucion de la prueba:
        $carrito = new CarritoDeCompras();
        $resultado = $carrito->getCarritoPorId(1);
        $this->unit->run($resultado, true, 'Metodo getCarritoPorId');

        // Metodo de prueba: guardarProducto
        // Preparacion para la prueba:
        // 1. Creamos una instancia de CarritoDeCompras
        $carrito = new CarritoDeCompras();
        $carrito->setId(1);
        $carrito->setSubtotal(0.00);
        $carrito->setProductosCarrito(array());
        // Ejecucion de la prueba:
        $carrito->guardarProducto(1, 5);
        $resultado = ($carrito->getSubtotal() > 0.00);
        $this->unit->run($resultado, true, 'Metodo guardarProducto');

        // Metodo de prueba: actualizarCantidadProducto
        // Preparacion para la prueba:
        // 1. Creamos una instancia de CarritoDeCompras
        $carrito = new CarritoDeCompras();
        $carrito->setId(1);
        $carrito->setSubtotal(0.00);
        // 2. Insertamos un producto en el carrito
        $producto = new Producto();
        $producto->setId(1);
        $producto->setNombre('Logitech G502');
        $producto->setPVP(50.99);
        $producto->setStock(10);
        $productoCarrito = new ProductoCarrito();
        $productoCarrito->setProducto($producto);
        $productoCarrito->setCantidad(5);
        $productoCarrito->setFechaInsert(date("Y-m-d h:i:s"));
        $productoCarritoArr = array();
        array_push($productoCarritoArr, $productoCarrito);
        $carrito->setProductosCarrito($productoCarritoArr);
        $carrito->calcularSubtotal();
        // Ejecucion de la prueba:
        $resultado = $carrito->actualizarCantidadProducto(1, 6);
        $resultado = ($carrito->getSubtotal() > 254.95);
        $this->unit->run($resultado, true, 'Metodo actualizarCantidadProducto');

        // Metodo de prueba: productoEstaEnCarrito
        // Preparacion para la prueba:
        // 1. Creamos una instancia de CarritoDeCompras
        $carrito = new CarritoDeCompras();
        $carrito->setId(1);
        $carrito->setSubtotal(0.00);
        // 2. Insertamos un producto en el carrito
        $producto = new Producto();
        $producto->setId(1);
        $productoCarrito = new ProductoCarrito();
        $productoCarrito->setProducto($producto);
        $productoCarritoArr = array();
        array_push($productoCarritoArr, $productoCarrito);
        $carrito->setProductosCarrito($productoCarritoArr);
        // Ejecucion de la prueba:
        $resultado = $carrito->productoEstaEnCarrito(1);
        $this->unit->run($resultado, true, 'Metodo productoEstaEnCarrito');

        // Metodo de prueba: eliminarProducto
        // Preparacion para la prueba:
        // 1. Creamos una instancia de CarritoDeCompras
        $carrito = new CarritoDeCompras();
        $carrito->setId(1);
        $carrito->setSubtotal(0.00);
        // 2. Insertamos un producto en el carrito
        $producto = new Producto();
        $producto->setId(1);
        $productoCarrito = new ProductoCarrito();
        $productoCarrito->setProducto($producto);
        $productoCarritoArr = array();
        array_push($productoCarritoArr, $productoCarrito);
        $carrito->setProductosCarrito($productoCarritoArr);
        // Ejecucion de la prueba:
        $carrito->eliminarProducto(1);
        $productosCarrito = $carrito->getProductosCarrito();
        $resultado = count($productosCarrito);
        $this->unit->run($resultado, 0, 'Metodo eliminarProducto');

        // Metodo de prueba: vaciarCarrito
        // Preparacion para la prueba:
        // 1. Creamos una instancia de CarritoDeCompras
        $carrito = new CarritoDeCompras();
        $carrito->setId(1);
        $carrito->setSubtotal(0.00);
        // 2. Insertamos un producto en el carrito
        $producto = new Producto();
        $producto->setId(1);
        $producto->setNombre('Logitech G502');
        $producto->setPVP(50.99);
        $producto->setStock(10);
        $productoCarrito = new ProductoCarrito();
        $productoCarrito->setProducto($producto);
        $productoCarrito->setCantidad(5);
        $productoCarrito->setFechaInsert(date("Y-m-d h:i:s"));
        $productoCarritoArr = array();
        array_push($productoCarritoArr, $productoCarrito);
        $carrito->setProductosCarrito($productoCarritoArr);
        $carrito->calcularSubtotal();
        // Ejecucion de la prueba:
        $carrito->vaciarCarrito();
        $productosCarrito = $carrito->getProductosCarrito();
        $subtotalCarrito = $carrito->getSubtotal();
        if (count($productosCarrito) == 0 && $subtotalCarrito == 0.00) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        $this->unit->run($resultado, true, 'Metodo vaciarCarrito');

        // Metodo de prueba: actualizarCarrito
        // Preparacion para la prueba:
        // 1. Creamos una instancia de CarritoDeCompras
        $carrito = new CarritoDeCompras();
        $carrito->setId(1);
        $carrito->setSubtotal(0.00);
        // 2. Insertamos un producto en el carrito
        $producto = new Producto();
        $producto->setId(1);
        $producto->setNombre('Logitech G502');
        $producto->setPVP(50.99);
        $producto->setStock(10);
        $productoCarrito = new ProductoCarrito();
        $productoCarrito->setProducto($producto);
        $productoCarrito->setCantidad(5);
        $productoCarrito->setFechaInsert(date("Y-m-d h:i:s"));
        $productoCarritoArr = array();
        array_push($productoCarritoArr, $productoCarrito);
        $carrito->setProductosCarrito($productoCarritoArr);
        $carrito->calcularSubtotal();
        // Ejecucion de la prueba:
        $carrito->actualizarCarrito();
        $carritoDB = $this->db->get('carrito')->row();
        $productoCarritoDB = $this->db->get_where('productocarrito', array('carrito' => $carritoDB->id))->row();
        if ($carritoDB->id == 1 && $carritoDB->subtotal > 0.00) {
            if ($carritoDB->id == $productoCarritoDB->carrito) {
                if ($productoCarritoDB->producto == 1 && $productoCarritoDB->cantidad == 5) {
                    $resultado = true;
                } else {
                    $resultado = false;
                }
            } else {
                $resultado = false;
            }
        } else {
            $resultado = false;
        }
        $this->unit->run($resultado, true, 'Metodo actualizarCarrito');

        //////////////////////////////////////
        // Finalizacion de Pruebas
        //////////////////////////////////////
        $this->db->truncate('carrito');
        $this->db->truncate('productocarrito');
        $this->db->truncate('producto');
        $this->db->truncate('usuario');

        echo $this->unit->report();
    }
}