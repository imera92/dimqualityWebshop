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
        $this->load->model('ShopUser');
        $this->load->model('CarritoDeCompras');
        $this->load->model('Producto');
        $this->load->model('ProductoCarrito');
        $this->load->model('SecurityUser');
        date_default_timezone_set("America/Guayaquil");
	}

  public function anadirProducto()
  { 
    // Obtenemos los datos del producto enviados por POST
    $productoId = $this->input->post('id');
    $cantidadProducto = $this->input->post('cantidad');

    // Validamos si hay un usuario logueado
    if ($this->loginCheck()) {
      // Si hay un usuario logueado obtenemos el ID de su carrito de la sesion
      $carritoSesionId = $this->session->carritoId;

      // Traemos el carrito de la DB
      $carritoDB = new CarritoDeCompras();
      $carritoDB->getCarritoPorId($carritoSesionId);

      // Validamos si el carrito tiene productos
      if (!empty($carritoDB->getProductosCarrito())) {
        // Validamos si el producto que se va a anadir ya esta en el carrito
        if ($carritoDB->productoEstaEnCarrito($productoId)) {
          // Si el producto esta presente en el carrito, actualizamos la cantidad
          $carritoDB->actualizarCantidadProducto($productoId, $cantidadProducto);
        } else {
          // Si el producto no estaba en el carrito, lo anadimos
          $carritoDB->guardarProducto($productoId, $cantidadProducto);
        }
      } else {
        // Si el carrito no tiene productos, anadimos el producto nuevo directamente
        $carritoDB->guardarProducto($productoId, $cantidadProducto);
      }

      // Guardamos el carrito de vuelta a la DB
      $carritoDB->actualizarCarrito();
    } else {
      // Si no hay usuario logueado, verificamos si ya hay un carrito temporal guardado en sesion
      $carritoSesion = $this->session->carritoSesion;
      if (is_null($carritoSesion)) {
        // Si no hay un carrito temporal ya creado en sesion, creamos uno y anadimos el producto
        $carritoSesion = array("subtotal" => 0, "productos" => array());
        $this->db->select('pvp');
        $this->db->from('producto');
        $this->db->where('id', $productoId);
        $result = $this->db->get()->row();
        $productoPvp = $result->pvp;
        $productoCarrito = array('producto' => $productoId, 'pvp' => $productoPvp, 'cantidad' => $cantidadProducto, 'fechaInsert' => date("Y-m-d h:i:s"));
        array_push($carritoSesion['productos'], $productoCarrito);
      } else {
        // Si ya hay un carrito temporal creado en sesion, verificamos que tenga productos
        $flag = false;
        $flagIndex = 0;
        if (!empty($carritoSesion['productos'])) {
          foreach ($carritoSesion['productos'] as $index => $productoCarrito) {
            if ($productoId == $productoCarrito['producto']) {
              $flag = true;
              $flagIndex = $index;
            }
          }

          // Si hay productos en el carrito temporal, verificamos si el producto enviado ya fue anadido previamente
          if ($flag) {
            // Si el producto ya fue anadido previdamente, solo actualizamos la cantidad enviada
            $carritoSesion['productos'][$flagIndex]['cantidad'] = $cantidadProducto;
          } else {
            // Si el producto no estaba en el carrito temporal, lo anadimos como producto nuevo
            $this->db->select('pvp');
            $this->db->from('producto');
            $this->db->where('id', $productoId);
            $result = $this->db->get()->row();
            $productoPvp = $result->pvp;
            $productoCarrito = array('producto' => $productoId, 'pvp' => $productoPvp, 'cantidad' => $cantidadProducto);
            array_push($carritoSesion['productos'], $productoCarrito);
          }  
        } else {
          // Si el carrito temporal no tenia productos, anadimos el producto enviado como producto nuevo
          $this->db->select('pvp');
          $this->db->from('producto');
          $this->db->where('id', $productoId);
          $result = $this->db->get()->row();
          $productoPvp = $result->pvp;
          $productoCarrito = array('producto' => $productoId, 'pvp' => $productoPvp, 'cantidad' => $cantidadProducto);
          array_push($carritoSesion['productos'], $productoCarrito);
        }
      }

      // Calculamos subtotal del carrito temporal y lo actualizamos
      $subtotalCarrito = 0;
      foreach ($carritoSesion['productos'] as $index => $productoCarrito) {
        $subtotalProducto = $productoCarrito['cantidad'] * $productoCarrito['pvp'];
        $subtotalCarrito += $subtotalProducto;
      }
      $carritoSesion['subtotal'] = $subtotalCarrito;

      // Reemplazamos el carrito temporal que habia en sesion por el nuevo
      $data_user = array(
          "carritoSesion" => $carritoSesion
      );
      $this->session->set_userdata($data_user);
    }
    redirect('carrito');
  }

  public function eliminarProducto()
  {
    // Obtenemos los datos del producto enviados por POST
    $productoId = $this->input->post('productoId');

    // Validamos si hay un usuario logueado
    if ($this->loginCheck()) {
      // Si hay un usuario logueado obtenemos el ID de su carrito de la sesion
      $carritoSesionId = $this->session->carritoId;

      // Traemos el carrito de la DB
      $carritoDB = new CarritoDeCompras();
      $carritoDB->getCarritoPorId($carritoSesionId);
      if ($carritoDB->eliminarProducto($productoId)) {
        $carritoDB->actualizarCarrito();
      }
    } else {
      // Traemos el carrito temporal de la sesion
      $carritoSesion = $this->session->carritoSesion;

      // Recorremos el carrito temporal para buscar el producto solicitado
      foreach ($carritoSesion['productos'] as $index => $producto) {
        if ($producto['producto'] == $productoId) {
          $carritoSesion['subtotal'] -= $producto['pvp'];
          unset($carritoSesion['productos'][$index]);
          $this->session->set_userdata('carritoSesion', $carritoSesion);
        }
      }
    }
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
