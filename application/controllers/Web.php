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
    $dataBody['resultados']=$query->result();
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

    $dataBody['productosCarrito'] = $productos;*/

    $this->load->view('web/header', $dataHeader);
    $this->load->view('web/carrito');
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