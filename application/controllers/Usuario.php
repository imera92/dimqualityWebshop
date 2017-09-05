<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->library('session');
        $this->load->model('CarritoDeCompras');
        $this->load->model('ShopUser');
        $this->load->model('Producto');
		$this->load->model('Categoria');
        $this->load->model('Subastas');
        date_default_timezone_set("America/Guayaquil");
	}

  public function login ($mensaje=0) {
    if($this->ShopUser->securityCheckUser()) {
      redirect("web/index");
    } else {
      $titulo = 'Dimquality - Login';
      $dataHeader['titlePage'] = $titulo;
      $dataBody= Array();
      if ($mensaje==1){
          $dataBody['mensaje']='La contraseña se ha actualizado sastifactoriamente';
      }
      $this->load->view('web/header', $dataHeader);
      $this->load->view('web/login', $dataBody);
      $this->load->view('web/footer');
    }
  }

  public function auth() {
    $user = $this->input->post("user");
    $password = $this->input->post("password");

    $securityUser = new ShopUser();
    $securityUser->login_user($user, $password);

    if($this->session->userdata('user') != ""){
      redirect("web/index");//debe redigir a la pagina principal de usuario logeado
    }else{
      redirect("usuario/login");//debe redirigir a la pagina de login de usuario
    }
  }

  public function logout() {
    if($this->securityCheck()){
      $securityUser = new ShopUser();
      $securityUser->logout();
      redirect("web/index");
    }else{
      redirect("usuario/login");
    }
  }

  public function crearUsuario(){
    $data = array();
    $userData = array();
    if($this->input->post('submit')){
      $this->form_validation->set_rules('usuario', 'Usuario', 'required|callback_user_check');
      $this->form_validation->set_rules('nombre', 'Nombre', 'required');
      // $this->form_validation->set_rules('apellido', 'Apellido', 'required');
      $this->form_validation->set_rules('correo', 'Email', 'required|valid_email|callback_email_check');
      $this->form_validation->set_rules('clave', 'password', 'required');
      $this->form_validation->set_rules('conf_clave', 'confirmar clave', 'required|matches[clave]');
      $this->form_validation->set_rules('cedula', 'Cédula', 'required|callback_cedula_check');
      // $this->form_validation->set_rules('pais', 'País');
      $this->form_validation->set_rules('direccion', 'Direccion');
      $this->form_validation->set_rules('telefono', 'Teléfono');


      if($this->form_validation->run() == true){
        // Creamos un carrito de compras vacio, que le sera asignado al usuario
        $nuevoCarrito = new CarritoDeCompras();

        // Verificamos si existe un carrito temporal en sesion
        $carritoSesion = $this->session->carritoSesion;
        if (!is_null($carritoSesion)) {
          $nuevoCarrito->crearNuevoCarrito();
          foreach ($carritoSesion['productos'] as $index => $producto) {
            $nuevoCarrito->guardarProducto($producto['producto'], $producto['cantidad']);
          }
          $nuevoCarrito->guardarNuevoCarrito();
        } else {
          $nuevoCarrito->crearNuevoCarrito();
          $nuevoCarrito->guardarNuevoCarrito();
        }

        // Borramos exceso de espacios vacios en el username
        $userInput = $this->input->post('usuario');
        $userInput = trim($userInput);
        $userInput = preg_replace('/\s+/', '', $userInput);

        // Borramos exceso de espacios vacios en el nombre
        $nombreInput = strip_tags($this->input->post('nombre'));
        $nombreInput = trim($nombreInput);
        $nombreInput = preg_replace('/\s+/', ' ', $nombreInput);

        // Borramos exceso de espacios vacios en la direccion
        $direccionInput = strip_tags($this->input->post('direccion'));
        $direccionInput = trim($direccionInput);
        $direccionInput = preg_replace('/\s+/', ' ', $direccionInput);

        // Verificamos si se envia apellido y borramos exceso de espacios vacios
        if (!is_null($this->input->post('apellido'))) {
          $apellidoInput = strip_tags($this->input->post('apellido'));
          $apellidoInput = trim($apellidoInput);
          $apellidoInput = preg_replace('/\s+/', ' ', $apellidoInput);
        } else {
          $apellidoInput = '';
        }

        $userData = array(
          'user' => $userInput,
          'nombre' => $nombreInput,
          'apellido' => $apellidoInput,
          'email' => strip_tags($this->input->post('correo')),
          'password' => md5($this->input->post('clave')),
          'cedula' => strip_tags($this->input->post('cedula')),
          // 'pais' => strip_tags($this->input->post('pais')),
          'direccion' => $direccionInput,
          'telefono' => strip_tags($this->input->post('telefono')),
          'carrito' => $nuevoCarrito->getId()
        );
        $insert = $this->ShopUser->insert($userData);
        if($insert){
          $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
          redirect('usuario/login');
        }else{
          $data['error_msg'] = 'Some problems occured, please try again.';
        }
      }
    }

    $data['user'] = $userData;
    $titulo = "Dimquality - Crear cuenta nueva";
    $dataHeader['titlePage'] = $titulo;

    $this->load->view('web/header', $dataHeader);
    $this->load->view('web/crearUsuario', $data);
    $this->load->view('web/footer');
  }

  /*
   * Existing email check during validation
   */
  public function email_check($str){
    $con['returnType'] = 'count';
    $con['conditions'] = array('email'=>$str);
    $checkEmail = $this->ShopUser->getRows($con);
    if($checkEmail > 0){
      $this->form_validation->set_message('email_check', 'El correo ya está registrado.');
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function user_check($str){
    $con['returnType'] = 'count';
    $con['conditions'] = array('user'=>$str);
    $checkUser = $this->ShopUser->getRows($con);
    if($checkUser > 0){
      $this->form_validation->set_message('user_check', 'El usuario ya está registrado.');
      return FALSE;
    } else {
      return TRUE;
    }
  }


  public function cedula_check($str){
    if (strlen($str)!=10 && strlen($str)!=13) {
      $this->form_validation->set_message('cedula_check', 'Formato de cédula no valido (10 o 13 digitos).');
      return false;
    }
    if (!is_numeric($str)){
      $this->form_validation->set_message('cedula_check', 'Formato de cédula no valido (10 o 13 digitos).');
      return false;
    }
    $con['returnType'] = 'count';
    $con['conditions'] = array('cedula'=>$str);
    $checkCedula = $this->ShopUser->getRows($con);
    if($checkCedula > 0){
      $this->form_validation->set_message('cedula_check', 'La cédula ya está registrada.');
      return FALSE;
    } else {
      return TRUE;
    }
  }

  private function securityCheck() {
    $securityUser = new ShopUser();
    $usuario = $this->session->userdata('user');
    if($usuario == ""){
      return false;
    }else{
      return true;
    }
  }

  public function actualizarUsuario(){
    if ($this->securityCheck()) {
      $data = array();
      $userData = array();
      if($this->input->post('submit')){
        $this->form_validation->set_rules('usuario', 'Usuario', 'required|callback_user_update_check');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        // $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_rules('correo', 'Email', 'required|valid_email|callback_email_update_check');
        //$this->form_validation->set_rules('clave', 'password', 'required');
        //$this->form_validation->set_rules('conf_clave', 'confirmar clave', 'required|matches[clave]');
        $this->form_validation->set_rules('cedula', 'Cédula', 'required|callback_cedula_update_check');
        // $this->form_validation->set_rules('pais', 'País');
        $this->form_validation->set_rules('direccion', 'Direccion');
        $this->form_validation->set_rules('telefono', 'Teléfono');


        if($this->form_validation->run() == true){
          // Borramos exceso de espacios vacios en el username
          $userInput = $this->input->post('usuario');
          $userInput = trim($userInput);
          $userInput = preg_replace('/\s+/', '', $userInput);

          // Borramos exceso de espacios vacios en el nombre
          $nombreInput = strip_tags($this->input->post('nombre'));
          $nombreInput = trim($nombreInput);
          $nombreInput = preg_replace('/\s+/', ' ', $nombreInput);

          // Borramos exceso de espacios vacios en la direccion
          $direccionInput = strip_tags($this->input->post('direccion'));
          $direccionInput = trim($direccionInput);
          $direccionInput = preg_replace('/\s+/', ' ', $direccionInput);

          // Verificamos si se envia apellido y borramos exceso de espacios vacios
          if (!is_null($this->input->post('apellido'))) {
            $apellidoInput = strip_tags($this->input->post('apellido'));
            $apellidoInput = trim($apellidoInput);
            $apellidoInput = preg_replace('/\s+/', ' ', $apellidoInput);
          } else {
            $apellidoInput = '';
          }
          $userData = array(
            'user' => $userInput,
            'nombre' => $nombreInput,
            'apellido' => $apellidoInput,
            'email' => strip_tags($this->input->post('correo')),
            //'password' => md5($this->input->post('clave')),
            'cedula' => strip_tags($this->input->post('cedula')),
            // 'pais' => strip_tags($this->input->post('pais')),
            'direccion' => $direccionInput,
            'telefono' => strip_tags($this->input->post('telefono')),
            //'carrito' => $nuevoCarrito->getId()
          );

          $update = $this->ShopUser->update($this->session->userdata('id'), $userData);
          if($update){
            // Actualizamos datos en sesion
            $this->session->set_userdata('user', $userInput);
            $this->session->set_userdata('nombre', $nombreInput);
            $this->session->set_userdata('apellido', $apellidoInput);
            $this->session->set_userdata('correo', strip_tags($this->input->post('correo')));
            $this->session->set_userdata('cedula', strip_tags($this->input->post('cedula')));
            $this->session->set_userdata('direccion', $direccionInput);
            $this->session->set_userdata('telefono', strip_tags($this->input->post('telefono')));

            $data['msg'] = 'Su informacion ha sido actualizada con exito.';
            redirect('web/index');
          }else{
            $data['msg'] = 'No se han cambiado datos.';
          }
        } else {
          $userData = array(
            'user' => $this->session->userdata('user'),
            'nombre' => $this->session->userdata('nombre'),
            'apellido' => $this->session->userdata('apellido'),
            'email' => $this->session->userdata('correo'),
            //'password' => md5($this->input->post('clave')),
            'cedula' => $this->session->userdata('cedula'),
            // 'pais' => strip_tags($this->input->post('pais')),
            'direccion' => $this->session->userdata('direccion'),
            'telefono' => $this->session->userdata('telefono')
            //'carrito' => $nuevoCarrito->getId())
          );
        }
      }
      else{
        $userData = array(
          'user' => $this->session->userdata('user'),
          'nombre' => $this->session->userdata('nombre'),
          'apellido' => $this->session->userdata('apellido'),
          'email' => $this->session->userdata('correo'),
          //'password' => md5($this->input->post('clave')),
          'cedula' => $this->session->userdata('cedula'),
          // 'pais' => strip_tags($this->input->post('pais')),
          'direccion' => $this->session->userdata('direccion'),
          'telefono' => $this->session->userdata('telefono')
          //'carrito' => $nuevoCarrito->getId())
        );
      }

      $data['user'] = $userData;
      $titulo = "Dimquality - Actualizar datos de usuario";
      $dataHeader['titlePage'] = $titulo;

      $this->load->view('web/header', $dataHeader);
      $this->load->view('web/actualizarUsuario', $data);
      $this->load->view('web/footer');
    }
    else{
      redirect('user/login');
    }
  }

  public function email_update_check($str){
    if ($str == $this->session->userdata('correo')) {
      return TRUE;
    }
    $con['returnType'] = 'count';
    $con['conditions'] = array('email'=>$str);
    $checkEmail = $this->ShopUser->getRows($con);
    if($checkEmail > 0){
      $this->form_validation->set_message('email_update_check', 'El correo ya está registrado.');
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function user_update_check($str){
    if ($str == $this->session->userData('user')) {
      return true;
    }
    $con['returnType'] = 'count';
    $con['conditions'] = array('user'=>$str);
    $checkUser = $this->ShopUser->getRows($con);
    if($checkUser > 0){
      $this->form_validation->set_message('user_update_check', 'El usuario ya está registrado.');
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function cedula_update_check($str){
    if ($str == $this->session->userData('cedula')) {
      return true;
    }
    if (strlen($str)!=10 && strlen($str)!=13) {
      $this->form_validation->set_message('cedula_update_check', 'Su número de cédula debe tener 10 dígitos y su RUC debe tener 13 dígitos.');
      return false;
    }
    if (!is_numeric($str)){
      $this->form_validation->set_message('cedula_update_check', 'Su número de cédula debe tener 10 dígitos y su RUC debe tener 13 dígitos.');
      return false;
    }
    $con['returnType'] = 'count';
    $con['conditions'] = array('cedula'=>$str);
    $checkCedula = $this->ShopUser->getRows($con);
    if($checkCedula > 0){
      $this->form_validation->set_message('cedula_update_check', 'La cédula ya está registrada.');
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function subastas($pagina = FALSE)
  {
	  $inicio = 0;
	  $limite = 5;

	  if ($pagina){
		  $inicio = ($pagina -1) * $limite; //corrige elemento repetido en ultima página
	  }

	  $subasta = new Subastas();
	  $titulo = "Subastas";
	  $dataHeader['titlePage'] = 'Dimquality - Subastas';

	  $this->load->library('pagination');

	  $config['base_url'] = base_url().'usuario/subastas';
	  $config['total_rows'] = $subasta->num_subastas();
	  $config['per_page'] = $limite;

	  $config['full_tag_open'] = '<ul class="pagination">';
	  $config['full_tag_close'] = '</ul>';
	  $config['first_link'] = false;
	  $config['last_link'] = false;
	  $config['first_tag_open'] = '<li>';
	  $config['first_tag_close'] = '</li>';
	  $config['prev_link'] = '&laquo';
	  $config['prev_tag_open'] = '<li class="prev">';
	  $config['prev_tag_close'] = '</li>';
	  $config['next_link'] = '&raquo';
	  $config['next_tag_open'] = '<li>';
	  $config['next_tag_close'] = '</li>';
	  $config['last_tag_open'] = '<li>';
	  $config['last_tag_close'] = '</li>';
	  $config['cur_tag_open'] = '<li class="active"><a href="#">';
	  $config['cur_tag_close'] = '</a></li>';
	  $config['num_tag_open'] = '<li>';
	  $config['num_tag_close'] = '</li>';

	  $this->pagination->initialize($config);

	  $result = $subasta->obtener_paginacion($inicio, $limite);

	  $data['consulta'] = $result;
	  $data['pagination'] = $this->pagination->create_links();
	  $data['actuales'] = $subasta->obtenerSubastas();
	  $data['num_subastas'] = $subasta->num_subastas();

	  $this->load->view('web/header', $dataHeader);
	  $this->load->view('web/subastas', $data);
	  $this->load->view('web/footer');

  }
}
