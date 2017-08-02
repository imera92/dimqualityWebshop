<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
      $this->load->database();
      $this->load->helper('url');
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->library('session');
      $this->load->library('encrypt');
      $this->load->model('ShopUser');
      $this->load->model('CarritoDeCompras');
      $this->load->model('Producto');
      $this->load->model('Transaccion');
      date_default_timezone_set("America/Guayaquil");
	}


  public function index() {
    $titulo = "Dimquality - Lo mejor en Tecnología y Electrodomésticos";
    $destacado=1;
    $fechaActual= date("Y-m-d");
    $fechaAnterior = strtotime ( '-5 day' , strtotime ( $fechaActual ) ) ;
    $fechaAnterior = date ( 'Y-m-j' , $fechaAnterior);
    $dataHeader['titlePage'] = $titulo;
    $this->db->where('destacado',$destacado);
    $query=$this->db->get('producto');
    $query2 = $this->db->query("SELECT * FROM producto where fechaCreacion BETWEEN '$fechaAnterior' AND '$fechaActual';");
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
    $dataBody = Array();

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
      if (is_null($carritoSesion) || empty($carritoSesion['productos'])) {
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

    // Validamos si hay un usuario logueado
    if ($this->loginCheck()) {
      if($this->input->post('submit')){
        $this->form_validation->set_rules('formaPago', 'Forma de Pago', 'required');
        $this->form_validation->set_rules('datosEntrega', 'Datos de Entrega', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre de Facturación', 'required');
        $this->form_validation->set_rules('cedula', 'Cedula de Facturación', 'required');
        $this->form_validation->set_rules('direccion', 'Direccion de Facturación', 'required');
        $this->form_validation->set_rules('nombreEntrega', 'Nombre Entrega', 'required');
        $this->form_validation->set_rules('direccionEntrega', 'Direccion de Entrega', 'required');
        if ($this->form_validation->run() == true) {
          $carritoId = $this->session->userdata('carritoId');
          $carritoDB = new CarritoDeCompras();
          $carritoDB->getCarritoPorId($carritoId);
          $compraIns = new Transaccion();
          $compraIns->loadCarrito($carritoDB);
          $compraIns->setFechaCompra(date(DATE_ATOM));
          $compraIns->setUsuario($this->session->userdata('id'));
          $compraIns->setTotal($carritoDB->getSubtotal());
          $compraIns->setEstado(0);
          $compraIns->setFormaPago($this->input->post('formaPago'));
          $compraIns->setNombreFactura($this->input->post('nombre'));
          $compraIns->setCedulaFactura($this->input->post('cedula'));
          $compraIns->setDireccionFactura($this->input->post('direccion'));
          $compraIns->setEntregaDomicilio($this->input->post('datosEntrega') == '');
          $compraIns->setNombreEntrega($this->input->post('nombreEntrega'));
          $compraIns->setDireccionEntrega($this->input->post('direccionEntrega'));
          $compraExito = $compraIns->insertarDB();
          if ($compraExito) {
            $carritoDB->vaciarCarrito();
            $carritoDB->actualizarCarrito();
            redirect('exito');
          }
          else
          {
             $dataBody['mensaje'] = 'Ocurrió un error al procesar su compra. Por favor vuelva a intentar mas tarde.';
          }          
        }
        
      }
      // Obtenemos el ID del carrito perteneciente al usuario logueado
      $carritoId = $this->session->userdata('carritoId');
      $carritoDB = new CarritoDeCompras();
      $carritoDB->getCarritoPorId($carritoId);

      // Verificamos si el carrito tiene productos
      if (empty($carritoDB->getProductosCarrito())) {
      // Si no productos en el carrito, regresamos al carrito
        redirect("carrito");
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
        $dataBody['user'] = $this->session->userdata;
      }
    } else {
      redirect("login");
    }
    $user = $this->session->userdata;
    $this->load->view('web/header', $dataHeader);
    $this->load->view('web/comprarProductos', $dataBody);
    $this->load->view('web/footer');
  }

  public function compraExitosa()
  {
    $titulo = "Dimquality::WebShop - Comprar Exitosa";    
    $dataHeader['titlePage'] = $titulo; 
    $this->load->view('web/header', $dataHeader);
    $this->load->view('web/compraExitosa');
    $this->load->view('web/footer');
  }

  public function buscarProductos()
  {
    $titulo = "Dimquality::WebShop - Búsqueda de Productos";
    $dataHeader['titlePage'] = $titulo;

    // Guardaremos los parametros de filtrado en un array para enviarlos al frontend y poder formar las URls de los filtros
    $parametros = array();

    // t   = Termino de busqueda
    // cat = Categoria
    // m   = Marca
    // r   = Rango de precio
    $termino = $this->input->get('t');
    $parametros['termino'] = '?t=' . $termino;
    if ($this->input->get('cat') != null) {
      $categoriaInput = $this->input->get('cat');
    } else {
      $categoriaInput = '';
    }
    $parametros['categoria'] = '&cat=' . $categoriaInput;
    if ($this->input->get('m') != null) {
      $marcaInput = $this->input->get('m');
    } else {
      $marcaInput = '';
    }
    $parametros['marca'] = '&m=' . $marcaInput;
    if ($this->input->get('r') != null) {
      $rangoInput = $this->input->get('r');
    } else {
      $rangoInput = '';
    }
    $parametros['rangoPrecio'] = '&r=' . $rangoInput;

    if (!is_null($termino) && preg_match('/^\s.*$/', $termino) != 1 && preg_match('/^.*\s$/', $termino) != 1) {
      $productosEncontrados = $this->Producto->buscarProducto($termino, $categoriaInput, $marcaInput, $rangoInput);
      
      // Identificamos las categorias presentes en el array de productos
      $categoriasFront = array();
      foreach ($productosEncontrados as $index => $producto) {
        // Validamos si el array de categorias por enviar esta vacio
        if (empty($categoriasFront)) {
          // Si el array de categorias por enviar esta vacio, le anadimos una categoria nueva
          array_push($categoriasFront, array('nombre' => $producto->getCategoria(), 'cantidad' => 1));
        } else {
          // Si el array de categorias por enviar no esta vacio, validamos si la categoria del producto de la actual iteracion esta presente
          $flag = false;
          $foundIndex = null;
          foreach ($categoriasFront as $index1 => $categoria) {
            if ($categoria['nombre'] == $producto->getCategoria()) {
              $flag = true;
              $foundIndex = $index1;
            }
          }
          if ($flag) {
            // Si la categoria del producto de la actual iteracion esta presente, aumentamos su cantidad
            $categoriasFront[$foundIndex]['cantidad']++;
          } else {
            // Si la categoria del producto de la actual iteracion no esta presente, la anadimos
            array_push($categoriasFront, array('nombre' => $producto->getCategoria(), 'cantidad' => 1));
          }
        }
      }

      // Identificamos las marcas presentes en el array de productos
      $marcasFront = array();
      foreach ($productosEncontrados as $index => $producto) {
        // Validamos si el array de categorias por enviar esta vacio
        if (empty($marcasFront)) {
          // Si el array de marcas por enviar esta vacio, le anadimos una marca nueva
          array_push($marcasFront, array('nombre' => $producto->getMarca(), 'cantidad' => 1));
        } else {
          // Si el array de marcas por enviar no esta vacio, validamos si la marca del producto de la actual iteracion esta presente
          $flag = false;
          $foundIndex = null;
          foreach ($marcasFront as $index1 => $marca) {
            if ($marca['nombre'] == $producto->getMarca()) {
              $flag = true;
              $foundIndex = $index1;
            }
          }
          if ($flag) {
            // Si la marca del producto de la actual iteracion esta presente, aumentamos su cantidad
            $marcasFront[$foundIndex]['cantidad']++;
          } else {
            // Si la marca del producto de la actual iteracion no esta presente, la anadimos
            array_push($marcasFront, array('nombre' => $producto->getMarca(), 'cantidad' => 1));
          }
        }
      }

      // Identificamos los rangos de precios
      // Cada rango de precio sera almacenado como un arreglo asociativo con su minimo, maximo y cantidad de productos
      $rangoPrecio = array('min' => 0, 'max' => 49, 'cantidad' => 0);
      $rangoPrecioFront = array();
      $exitFlag = false;
      $productosRevisados = 0;
      while ($exitFlag == false) {
        foreach ($productosEncontrados as $index => $producto) {
          if ($producto->getPVP() >= $rangoPrecio['min'] && $producto->getPVP() <= $rangoPrecio['max'] ) {
            $rangoPrecio['cantidad']++;
          }
        }
        if ($rangoPrecio['cantidad'] > 0) {
          array_push($rangoPrecioFront, $rangoPrecio);
        }
        $rangoPrecio['min'] += 50;
        $rangoPrecio['max'] += 50;
        $rangoPrecio['cantidad'] = 0;
        if (!empty($rangoPrecioFront)) {
          foreach ($rangoPrecioFront as $index => $value) {
            $productosRevisados += $value['cantidad'];
          }
        }
        if ($productosRevisados == count($productosEncontrados)) {
          $exitFlag = true;
        } else {
          $productosRevisados = 0;
        }
      }

      if (count($productosEncontrados) > 0) {
        // $dataBody['termino'] = $termino;
        $dataBody['parametros'] = $parametros;
        $dataBody['mensaje'] = 'Resultados de búsqueda para: "' . $termino . '"';
        $dataBody['productosEncontrados'] = $productosEncontrados;
        $dataBody['categorias'] = $categoriasFront;
        $dataBody['marcas'] = $marcasFront;
        $dataBody['rangosPrecio'] = $rangoPrecioFront;
      } else {
        $dataBody['mensaje'] = 'El término de búsqueda ingresado no generó resultados.';
      }
    } elseif (!is_null($termino) && (preg_match('/^\s.*/', $termino) == 1 || preg_match('/^.*\s/', $termino) == 1)){
      $dataBody['mensaje'] = 'Error. El término de búsqueda no puede contener espacios vacios ni al princpio ni al final.';
    } else {
      $dataBody['mensaje'] = 'Error. Debe escribir al menos una palabra para realizar la búsqueda.';
    }
    
    $this->load->view('web/header', $dataHeader);
    $this->load->view('web/busqueda', $dataBody);
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

  public function recuperarContrasena(){
      $titulo = "Dimquality::WebShop -Recuperar tu contraseña";
      $dataHeader['titlePage'] = $titulo;
      $this->load->view('web/header', $dataHeader);
      $this->load->view('web/recuperarContrasena');
      $this->load->view('web/footer');
  }

    public function ChangePassword(){
      $token=$this->input->get('token');
      $usuario= $this->input->get('idusuario');
      $this->db->from('restaurarcontraseña');
      $this->db->select('*');
      $this->db->where('token', $token);
      $restaurar= $this->db->get()->row();
      if( $restaurar != null )
      {
        if ($usuario== sha1($restaurar->userId) && $token==$restaurar->token){
          $titulo = "Dimquality::WebShop -Recuperar tu contraseña";
          $dataBody['id']=$usuario;
          $dataBody['token']=$token;
          $dataHeader['titlePage'] = $titulo;
          $this->load->view('web/header', $dataHeader);
          $this->load->view('web/ChangePassword',$dataBody);
          $this->load->view('web/footer');
        }
      }
  }
  public function ActualizarContrasena(){
    $token=$this->input->post('t');//token
    $user=$this->input->post('us');//user
    $nuevaContraseña= $this->input->post('contrasena');
    $VerificarContraseña= $this->input->post('vContraseña');
     $this->db->from('restaurarcontraseña');
      $this->db->select('*');
      $this->db->where('token', $token);
      $restaurar= $this->db->get()->row();
      if( $restaurar != null )
      { 
        if(sha1($restaurar->userId)==$user){
          if ( $nuevaContraseña ==$VerificarContraseña){
              $data= array('password'=> $nuevaContraseña);
              $this->db->where('id', $restaurar->userId);
              $this->db->update('usuario',$data);
              $this->db->where('token', $token);
              $this->db->delete('restaurarcontraseña');
              header('Location: http://localhost/dimqualityWebshop/login ');
              
          }else{
            echo "contraseña no coincide";
          }
        }else{
           echo "no coincide los usuarios";
        }
      }else{
         echo "no hay";
      }

  }
  //funcion para generar un token para que el usuario pueda cambiar la contraseña
  public function GenerarToken($usuario)
  { 
          $cadena=$usuario->nombre.$usuario->id.rand(1,9999999).date('Y-m-d');
          $token=sha1($cadena);
          $data = array(  
            'userId' => $usuario->id,
            'fecha' =>  date('Y-m-d'),
            'token' => $token
          );
          $resultado=$this->db->insert('restaurarcontraseña', $data);
          if($resultado){
            $enlace=$_SERVER["SERVER_NAME"].'/dimqualityWebshop/web/ChangePassword?idusuario='.sha1($usuario->id).'&token='.$token;
            return $enlace;
          }else{ 
             return False;
          }
  }

  public function verificarCorreo(){
      $email = $this->input->post('email');
      if ($email != ""){
        $this->db->from('usuario');
        $this->db->select('*');
        $this->db->where('email', $email);
        $usuario = $this->db->get()->row();
        if( $usuario != null){
            $enlace= $this->GenerarToken($usuario);
            //$this->enviarEmail($usuario->email,$enlace);
            echo $enlace;
        }else{
              $mensaje= 'este correo no registra ninguna cuenta';
              echo $mensaje;
        }
      }else {
          echo "ingrese un correo electronico";
      }
  }



  // funcion para enviar el correo al usuario 
    function enviarEmail( $email, $enlace ){
          $mensaje = '<html>
            <head>
                <title>Restablece tu contraseña</title>
            </head>
            <body>
              <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
              <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
              <p>
                <strong>Enlace para restablecer tu contraseña</strong><br>
                <a href="'.$enlace.'"> Restablecer contraseña </a>
              </p>
            </body>
            </html>';
        
          $cabeceras = 'MIME-Version: 1.0' . "\r\n";
          $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          $cabeceras .= 'From: Dimquality <mimail@codedrinks.com>' . "\r\n";
          //Se envia el correo al usuario
          mail($email, "Recuperar contraseña", $mensaje, $cabeceras);
    }
    
    public function passwordReset(){
          $titulo = "Dimquality::WebShop -Recuperar tu contraseña";
          $dataHeader['titlePage'] = $titulo;
          //$this->load->view('web/password_reset', $dataHeader);
    }
  
}

