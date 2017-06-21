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

    /*$user = $this->db->get_where('usuario', array('id' => 6))->result_array();
    $this->session->set_userdata(array('id' => $user[0]['id'], 'user' => $user[0]['user']));

    $carrito = $this->db->get_where('carrito', array('usuario' => $user[0]['id']))->result_array();
    $dataBody['subtotal'] = $carrito[0]['subtotal'];
    $productos = $this->db->get_where('productocarrito', array('carrito' => $carrito[0]['id']))->result_array();
    print_r($productos);
    die();
    */
    $carritoSesion = $this->session->carrito;
    $productosCarrito = array();
    foreach ($carritoSesion['productos'] as $index => $producto) {
      $productoId = $producto['id'];
      $productoCantidad = $producto['cantidad'];
      $productoPvp = $producto['pvp'];

      $this->db->select('descripcion, imagen');
      $this->db->from('producto');
      $this->db->where('id', $productoId);
      $productoDB = $this->db->get()->row();

      $productoDescripcion = $productoDB->descripcion;
      $productoImagen = $productoDB->imagen;
      array_push($productosCarrito, array(
        'id' => $productoId,
        'cantidad' => $productoCantidad,
        'pvp' => $productoPvp,
        'descripcion' => $productoDescripcion,
        'imagen' => $productoImagen
      ));
    }

    $dataBody['subtotal'] = $carritoSesion['subtotal'];
    $dataBody['productosCarrito'] = $productosCarrito;

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
}