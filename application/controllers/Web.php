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
      $this->load->model('CarritoDeCompras');
      $this->load->model('Categoria');
      $this->load->model('Marca');
      $this->load->model('Producto');
      $this->load->model('ShopUser');
      $this->load->model('Transaccion');
      date_default_timezone_set("America/Guayaquil");
	}


  public function index()
  {
    $titulo = "Dimquality - Lo mejor en Tecnología y Electrodomésticos";
    $dataHeader['titlePage'] = $titulo;
    $productosRecientes = $this->Producto->productosRecientes(4);
    $productosDestacados = $this->Producto->productosDestacados();
    $dataBody['productosRecientes'] = $productosRecientes;
    $dataBody['productosDestacados'] = $productosDestacados;
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
  
  public function comprarProductos()
  {
    $titulo = "Dimquality - Comprar Productos";    
    $dataHeader['titlePage'] = $titulo; 

    // Validamos si hay un usuario logueado
    if ($this->loginCheck()) {
      if($this->input->post('submit')) {
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
          $compraIns->setEstado(1); // 1 = Pendiente, 2 = Pagado
          $compraIns->setFormaPago($this->input->post('formaPago'));
          $compraIns->setNombreFactura($this->input->post('nombre'));
          $compraIns->setCedulaFactura($this->input->post('cedula'));
          $compraIns->setDireccionFactura($this->input->post('direccion'));
          $compraIns->setTipoEntrega($this->input->post('datosEntrega'));
          $compraIns->setRecibe($this->input->post('nombreEntrega'));
          $compraIns->setDireccionEntrega(($this->input->post('datosEntrega') == 1) ? '' : $this->input->post('direccionEntrega'));
          $compraExito = $compraIns->insertarDB();
          if ($compraExito) {
            $carritoDB->vaciarCarrito();
            $carritoDB->actualizarCarrito();

            // Preparamos el envio del correo
            $config = array();
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://bh-27.webhostbox.net';
            $config['smtp_port'] = '465';
            $config['smtp_user'] = '_mainaccount@dimquality.com.ec';
            $config['smtp_pass'] = 'dimQ2016';
            $config['mailtype'] = 'html';
            $config['charset']  = 'utf-8';
            $config['newline']  = "\r\n";
            $config['wordwrap'] = TRUE;

            $mensaje = '<html>
                         <head>
                             <title>Compra exitosa</title>
                        </head>
                        <body>
                          <p>Hemos guardado tu transaccion. Ponte en contacto con el administrador</p>
                        </body>
                        </html>';

            $this->load->library('email');
            $this->email->initialize($config);
            $this->email->from('info@dimquality.com.ec','Your name');
            $this->email->to($this->session->correo);
            $this->email->subject('Dimquality - Compra');
            $this->email->message($mensaje);

            if(!$this->email->send()) {
              show_error($this->email->print_debugger());
            }

            redirect('exito');
          }
          else {
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
        foreach ($carritoDB->getProductosCarrito() as $productoCarrito) {
            array_push($productosCarrito, $productoCarrito);
        }
        $dataBody['subtotal'] = $carritoDB->getSubtotal();
        $dataBody['productosCarrito'] = $productosCarrito;
        $dataBody['user'] = $this->session->userdata;
      }
    } else {
      redirect("login");
    }
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
      $categoriaInput = 0;
    }
    $parametros['categoria'] = '&cat=' . $categoriaInput;
    if ($this->input->get('m') != null) {
      $marcaInput = $this->input->get('m');
    } else {
      $marcaInput = 0;
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
      foreach ($productosEncontrados as $producto) {
        // Validamos si el array de categorias por enviar esta vacio
        if (empty($categoriasFront)) {
          // Si el array de categorias por enviar esta vacio, le anadimos una categoria nueva
          $categoria = new Categoria();
          $categoria->getCategoriaPorId($producto->getCategoria());
          array_push($categoriasFront, array('categoria' => $categoria, 'cantidad' => 1));
        } else {
          // Si el array de categorias por enviar no esta vacio, validamos si la categoria del producto de la actual iteracion esta presente
          $flag = false;
          $foundIndex = null;
          foreach ($categoriasFront as $index1 => $categoriaFront) {
            if ($categoriaFront['categoria']->getId() == $producto->getCategoria()) {
              $flag = true;
              $foundIndex = $index1;
            }
          }
          if ($flag) {
            // Si la categoria del producto de la actual iteracion esta presente, aumentamos su cantidad
            $categoriasFront[$foundIndex]['cantidad']++;
          } else {
            // Si la categoria del producto de la actual iteracion no esta presente, la anadimos
            $categoria = new Categoria();
            $categoria->getCategoriaPorId($producto->getCategoria());
            array_push($categoriasFront, array('categoria' => $categoria, 'cantidad' => 1));
          }
        }
      }

      // Identificamos las marcas presentes en el array de productos
      $marcasFront = array();
      foreach ($productosEncontrados as $producto) {
        // Validamos si el array de categorias por enviar esta vacio
        if (empty($marcasFront)) {
          // Si el array de marcas por enviar esta vacio, le anadimos una marca nueva
          $marca = new Marca();
          $marca->getMarcaPorId($producto->getMarca());
          array_push($marcasFront, array('marca' => $marca, 'cantidad' => 1));
        } else {
          // Si el array de marcas por enviar no esta vacio, validamos si la marca del producto de la actual iteracion esta presente
          $flag = false;
          $foundIndex = null;
          foreach ($marcasFront as $index1 => $marcaFront) {
            if ($marcaFront['marca']->getId() == $producto->getMarca()) {
              $flag = true;
              $foundIndex = $index1;
            }
          }
          if ($flag) {
            // Si la marca del producto de la actual iteracion esta presente, aumentamos su cantidad
            $marcasFront[$foundIndex]['cantidad']++;
          } else {
            // Si la marca del producto de la actual iteracion no esta presente, la anadimos
            $marca = new Marca();
            $marca->getMarcaPorId($producto->getMarca());
            array_push($marcasFront, array('marca' => $marca, 'cantidad' => 1));
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

  private function loginCheck()
  {
    $securityUser = new ShopUser();
    $usuario = $this->session->userdata('user');
    if($usuario == ""){
      return false;
    }else{
      return true;
    }
  }

  public function recuperarContrasena()
  {
    $titulo = "Dimquality::WebShop -Recuperar tu contraseña";
    $dataHeader['titlePage'] = $titulo;
    $this->load->view('web/header', $dataHeader);
    $this->load->view('web/recuperarContrasena');
    $this->load->view('web/footer');
  }

  public function ChangePassword($mensaje=0)
  {
    $token=$this->input->get('token');
    $usuario= $this->input->get('idusuario');
    $this->db->from('restaurarcontraseña');
    $this->db->select('*');
    $this->db->where('token', $token);
    $restaurar= $this->db->get()->row();
    if( $restaurar != null ) {
      if ($usuario== sha1($restaurar->userId) && $token==$restaurar->token) {
        $titulo = "Dimquality::WebShop -Recuperar tu contraseña";
        $dataBody['id']=$usuario;
        $dataBody['token']=$token;
        $dataHeader['titlePage'] = $titulo;
        $this->load->view('web/header', $dataHeader);
        $this->load->view('web/ChangePassword',$dataBody);
        $this->load->view('web/footer');
      }
    }else{
       redirect('cambiarContrasena');
    }
  }

  public function ActualizarContrasena(){
    $token=$this->input->post('t');//token
    $user=$this->input->post('us');//user
    $nuevaContraseña= $this->input->post('contrasena');
    $VerificarContraseña= $this->input->post('vContraseña');
    if($nuevaContraseña != '' || $VerificarContraseña !=''){
      $this->db->from('restaurarcontraseña');
        $this->db->select('*');
        $this->db->where('token', $token);
        $restaurar= $this->db->get()->row();
          if( $restaurar != null && sha1($restaurar->userId)==$user){ 
              if( strlen($nuevaContraseña)>5 && strlen($VerificarContraseña)>5){
                  if ( $nuevaContraseña ==$VerificarContraseña){
                      $data= array('password'=> md5($nuevaContraseña));
                      $this->db->where('id', $restaurar->userId);
                      $this->db->update('usuario',$data);
                      $this->db->where('token', $token);
                      $this->db->delete('restaurarcontraseña');
                      echo 'usuario/login/1';
                  }       
              }else{
                echo "Hubo un error al procesar su requerimiento.La nueva contraseña debe tener minimo 6 caracteres";
              }
          }else{
               redirect('cambiarContrasena');
          }
    }else{
        echo "Hubo un error al procesar su requerimiento.La contraseña no puede ser vacia";
        
    }

  }
  
  public function mensaje($mensaje){
    $titulo = "Dimquality::WebShop -Recuperar tu contraseña";
    $dataBody['titlePage'] = $titulo;
    $dataBody['msg'] ="Su contraseña ha sido cambiado con exito";
    $this->load->view('web/password_reset', $dataBody);
  }
  
  //funcion para generar un token para que el usuario pueda cambiar la contraseña
  public function GenerarToken($usuario){ 
    $cadena=$usuario->nombre.$usuario->id.rand(1,9999999).date('Y-m-d');
    $token=sha1($cadena);
    $data = array(  
      'userId' => $usuario->id,
      'fecha' =>  date('Y-m-d'),
      'token' => $token
    );
    $resultado=$this->db->insert('restaurarcontraseña', $data);
    if($resultado){
      $enlace=$enlace=base_url('/web/ChangePassword?idusuario='.sha1($usuario->id).'&token='.$token);
      return $enlace;
    }else{ 
       return False;
    }
  }

  public function verificarCorreo()
  {
    $email = $this->input->post('email');
    $emailRegexResult = preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $email);
    if ($email != "" && $emailRegexResult){
      $this->db->from('usuario');
      $this->db->select('*');
      $this->db->where('email', $email);
      $usuario = $this->db->get()->row();
      if( $usuario != null){
            $this->db->from('restaurarcontraseña');
            $this->db->select('*');
            $this->db->where('userId', $usuario->id);
            $restaurar= $this->db->get()->row();
            if( $restaurar == null )
            { 
              $enlace= $this->GenerarToken($usuario);
              $this->enviarEmail($usuario->email,$enlace);
            }else{
              $this->db->where('userId', $usuario->id);
              $this->db->delete('restaurarcontraseña');
              $enlace= $this->GenerarToken($usuario);
              $this->enviarEmail($usuario->email,$enlace);
            }
            echo 'Se le ha enviado un mensaje a su correo';
      }else
      {
            echo 'La dirección de correo proporcionada no está vinculada a ninguna cuenta de usuario';
      }
    }else {
        echo "Es necesario que ingrese un dirección de correo para recuperar su contraseña";
    }
  }

  public function verEstadoTransacciones()
  {
    $titulo = 'Dimquality - Lo mejor en Tecnología y Electrodomésticos';
    $dataHeader['titlePage'] = $titulo;

    if ($this->loginCheck()) {
      $transacciones = $this->Transaccion->getTransaccionesArrayPorUsuario($this->session->id);
      if (empty($transacciones)) {
        $dataBody['mensaje'] = 'No hay datos para mostrar.';
      } else {
        $dataBody['transacciones'] = $transacciones;
      }
      
      $this->load->view('web/header', $dataHeader);
      $this->load->view('web/transacciones', $dataBody);
      $this->load->view('web/footer');
    } else {
      redirect('login');
    }
  }

  function enviarEmail($email, $enlace){
    $config = array();
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://bh-27.webhostbox.net';
    $config['smtp_port'] = '465';
    $config['smtp_user'] = '_mainaccount@dimquality.com.ec';
    $config['smtp_pass'] = 'dimQ2016';
    $config['mailtype'] = 'html';
    $config['charset']  = 'utf-8';
    $config['newline']  = "\r\n";
    $config['wordwrap'] = TRUE;

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
    $this->load->library('email');
    $this->email->initialize($config);
    $this->email->from('info@dimquality.com.ec','Dimquality - Lo mejor en tecnología');
    $this->email->to($email);
    $this->email->subject('Cambio de Contraseña');
    $this->email->message($mensaje);

    if(!$this->email->send()) {
      show_error($this->email->print_debugger());
    }
  }
    
    
}

