<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductoCarrito extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('grocery_CRUD');
        date_default_timezone_set("America/Guayaquil");
	}

  public function agregar($producto, $cantidad, $fecha)
  {
    $usuario = $this->session->userdata('user');
    if($usuario == ""){
        return false;
    }else{
        if ($this->session->userdata('tipo') == "user") {
            //si el usuario tiene carrito, se recupera y actualiza carrito
            $query = $this->db->get_where('carrito', array('usuario' => $usuario));
            $data = array(
              'usuario' => $usuario,
              'subtotal' => $this->db->get('carrito')->row()->subtotal + $cantidad * $producto;
            );
            $this->db->replace('carrito', $data);
        }else{
          // usuario no tiene carrito, se debe crear registro en tabla
          $data = array(
            'usuario' => $usuario,
            'subtotal' => $producto * $cantidad
          );
          $this->db->insert('carrito', $data);
        }
    }
  }




}
?>
