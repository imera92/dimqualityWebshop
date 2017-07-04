<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
      $this->load->database();
      $this->load->helper('url');
      $this->load->helper('form');
      $this->load->library('session');
      $this->load->model('ShopUser');
      $this->load->model('CarritoDeCompras');
      date_default_timezone_set("America/Guayaquil");
	}

  public function index() {
    $titulo = "Dimquality - Lo mejor en Tecnología y Electrodomésticos";
    $destacado=1;
    $dataHeader['titlePage'] = $titulo;
    $this->db->where('destacado',$destacado);
    $query=$this->db->get('producto');
    $query2 = $this->db->query("SELECT * FROM producto where fechaCreacion BETWEEN '2017-06-15' AND '2017-06-21';");
    $dataBody['resultados']=$query->result();
    $dataBody['Nuevos']=$query2->result();
    $this->load->view('web/header', $dataHeader);
    $this->load->view('web/index', $dataBody);
    $this->load->view('web/footer');
  }
  public function carrito()
  {
    $titulo = "Dimquality::Admin - Shopping Cart";
    $dataHeader['titlePage'] = $titulo;

    // Validamos si hay un usuario logueado
    if ($this->loginCheck()) {
      // Obtenemos el ID del carrito perteneciente al usuario logueado
      $carritoId = $this->session->userdata('carritoId');
      $carritoDB = new CarritoDeCompras();
      $carritoDB->getCarritoPorId($carritoId);

      // Verificamos si el carrito tiene productos
      if (empty($carritoDB->getProductosCarrito())) {
        // Si no productos en el carrito, enviamos un mensaje al frontend
        $dataBody['mensaje'] = 'No hay datos para mostrar.';
      } else {
        // Guardamos los datos de todos los productos del carrito temporal en un arreglo para enviar al frontend
        $productosCarrito = array();
        foreach ($carritoDB->getProductosCarrito() as $index => $productoCarrito) {
          array_push($productosCarrito, array(
            'id' => $productoCarrito->getProducto()->getId(),
            'cantidad' => $productoCarrito->getCantidad(),
            'pvp' => $productoCarrito->getProducto()->getPVP(),
            'nombre' => $productoCarrito->getProducto()->getNombre(),
            'imagen' => $productoCarrito->getProducto()->getImagen()
          ));        
        }
        $dataBody['subtotal'] = $carritoDB->getSubtotal();
        $dataBody['productosCarrito'] = $productosCarrito;        
      }

    } else {
      // Si no hay un usuario logueado, verificamos si hay un carrito temporal cargado en sesion
      $carritoSesion = $this->session->carritoSesion;
      if (is_null($carritoSesion)) {
        // Si no hay un carrito temporal cargado en sesion, enviamos un mensaje al frontend
        $dataBody['mensaje'] = 'No hay datos para mostrar.';
      } else {
        // Si ya habia un carrito temporal cargado en sesion, cargamos todos sus datos
        $productosCarrito = array();
        foreach ($carritoSesion['productos'] as $index => $productoCarrito) {
          $productoId = $productoCarrito['producto'];
          $productoCantidad = $productoCarrito['cantidad'];
          $productoPvp = $productoCarrito['pvp'];

          // Obtenemos de la DB el nombre y la imagen de cada producto en el carrito temporal
          $this->db->select('nombre, imagen');
          $this->db->from('producto');
          $this->db->where('id', $productoId);
          $productoDB = $this->db->get()->row();
          $productoNombre = $productoDB->nombre;
          $productoImagen = $productoDB->imagen;

          // Guardamos los datos de todos los productos del carrito temporal en un arreglo para enviar al frontend
          array_push($productosCarrito, array(
            'id' => $productoId,
            'cantidad' => $productoCantidad,
            'pvp' => $productoPvp,
            'nombre' => $productoNombre,
            'imagen' => $productoImagen
          ));
          $dataBody['subtotal'] = $carritoSesion['subtotal'];
          $dataBody['productosCarrito'] = $productosCarrito;
        }

      }
    }

    $this->load->view('web/header', $dataHeader);
    $this->load->view('web/carrito', $dataBody);
    $this->load->view('web/footer');
  }
  
  public function comprarProductos(){
    $titulo = "Dimquality::WebShop - Comprar Productos";
    $dataHeader['titlePage'] = $titulo;

    $this->load->view('web/header', $dataHeader);
    $this->load->view('web/comprarProductos');
    $this->load->view('web/footer');
  }

  private function loginCheck() {
    $securityUser = new ShopUser();
    $usuario = $this->session->userdata('user');
    if($usuario == ""){
      return false;
    }else{
      return true;
    }
  }
}