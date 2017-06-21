<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('grocery_CRUD');
        $this->load->model('SecurityUser');
        $this->load->model('ShopUser');
        date_default_timezone_set("America/Guayaquil");
	}

  public function anadirProducto()
  {
    // Obtenemos los productos enviados por POST
    $productoId = $this->input->post('id');
    $cantidadProducto = $this->input->post('cantidad');

    // Obtenemos el carrito de la sesion
    $carritoSesion = $this->session->carrito;

    // Validamos si hay un usuario logueado
    // Si un usuario no esta logueado, se crea un carrito en sesion
    if (empty($carritoSesion)) {
      $data_user = array(
          "carrito" => array("subtotal" => 0, "productos" => array())
      );
      $this->session->set_userdata($data_user);
      $carritoSesion = $this->session->carrito;
    }
    
    // Validamos si el producto que se va a anadir ya esta en el carrito
    $flag = false;
    $flagIndex = 0;
    if (!empty($carritoSesion['productos'])) {
      foreach ($carritoSesion['productos'] as $index => $producto) {
        if ($productoId == $producto['id']) {
          $flag = true;
          $flagIndex = $index;
        }
      }
    }
    // Guardamos el carrito en sesion
    if ($flag) {
      // Si el producto ya estaba en el carrito de la sesion, solo actualizamos la cantidad
      $carritoSesion['productos'][$flagIndex]['cantidad'] = $cantidadProducto;
    } else {
      // Si el producto no estaba en el carrito de la sesion, anadimos un producto nuevo
      $this->db->select('pvp');
      $this->db->from('producto');
      $this->db->where('id', $productoId);
      $result = $this->db->get()->result_array();
      $pvpProducto = $result[0]['pvp'];
      $productoCarrito = array('id' => $productoId, 'cantidad' => $cantidadProducto, 'pvp' => $pvpProducto);
      array_push($carritoSesion['productos'], $productoCarrito);
    }

    // Calculamos subtotal del carrito y lo actualizamos
    $subtotalCarrito = 0;
    foreach ($carritoSesion['productos'] as $index => $producto) {
      $subtotalProducto = $producto['cantidad'] * $producto['pvp'];
      $subtotalCarrito += $subtotalProducto;
      $carritoSesion['subtotal'] = $subtotalCarrito;
    }
    
    // Guardamos el carrito nuevo en sesion
    $this->session->set_userdata('carrito', $carritoSesion);

    // Validamos si hay un usuario logueado
    if ($this->loginCheck()) {
      // Obtenemos el id del usuario en sesion
      $userId = $this->session->id;

      // Verificamos si ya hay carrito guardado para el usuario en la DB
      $this->db->select('id');
      $this->db->from('carrito');
      $this->db->where('usuario', $userId);
      $result = $this->db->get()->result_array();
      if (empty($result)) {
        // Si no hay carrito, creamos uno nuevo
        $data = array(
          'usuario' => $userId,
          'subtotal' => $this->session->carrito['subtotal']
        );
        $this->db->insert('carrito', $data);

        // Obtenemos id del nuevo carrito
        $this->db->select('id');
        $this->db->from('carrito');
        $this->db->where('usuario', $userId);
        $result = $this->db->get()->result_array();
        $carritoId = $result[0]['id'];

        // Guardamos los productos del carrito en la DB
        foreach ($carritoSesion['productos'] as $index => $producto) {
          $data = array(
            'producto' => $producto['id'],
            'cantidad' => $producto['cantidad'],
            'fecha_insert' => date("Y-m-d h:i:s"),
            'carrito' => $carritoId
          );
          $this->db->insert('productocarrito', $data);
        }
      } else {
        // Obtenemos el id del carrito ya existene
        $carritoId = $result[0]['id'];

        // Actualizamos el carrito
        $data = array(
          'id' => $carritoId,
          'usuario' => $userId,
          'subtotal' => $this->session->carrito['subtotal']
        );
        $this->db->replace('carrito', $data);

        // Guardamos los productos del carrito en la DB
        foreach ($carritoSesion['productos'] as $index => $producto) {
          $data = array(
            'producto' => $producto['id'],
            'cantidad' => $producto['cantidad'],
            'fecha_insert' => date("Y-m-d h:i:s"),
            'carrito' => $carritoId
          );
          $this->db->replace('productocarrito', $data);
        }
      }
    }

    redirect('carrito');
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
