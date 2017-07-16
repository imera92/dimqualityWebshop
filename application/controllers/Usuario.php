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
        date_default_timezone_set("America/Guayaquil");
	}

  public function login () {
    if($this->ShopUser->securityCheckUser()) {
      redirect("web/index");
    } else {
      $titulo = 'Dimquality - Login';
      $dataHeader['titlePage'] = $titulo;

      $this->load->view('web/header', $dataHeader);
      $this->load->view('web/login');
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

  public function agendarCita(){
	  //$data = array();
	  //$userData = array();
	  $result="";
	  if($this->input->post('submit')){
		  $str_fecha = $this->input->post('fecha');
		  $hora = substr($str_fecha,-5);
		  $asunto = $this->input->post('asunto');
		  if (!empty($asunto) && !empty($str_fecha)){

			  echo '<script>console.log("'.$str_fecha.'")</script>';
			  echo '<script>console.log("'.$hora.'")</script>';
			  $fecha = date("Y-m-d H:i:s", strtotime($str_fecha));
			  /*
			  // para verificar lo ingresado y envidado por post
			  $result = $fecha.' ';
			  $result .= $categoria.' ';
			  $result .= $descripcion;
			  */
			  $usuario = $this->session->userdata('user');
			  if($usuario != ""){
				  echo '<script>console.log("'.'usuario actual: '.$usuario.'")</script>';
			  }else{
				  echo '<script>console.log("'.'no ha iniciado sesión.'.'")</script>';
			  }
			  $citaDB = $this->db->get_where('cita', array('usuario' => $usuario, 'fecha' => $fecha));
			  if ($citaDB->num_rows()==0){
				  $cita_no_repetida = True;
				  echo '<script>console.log("'.'es cita nueva.'.'")</script>';
			  }else{
				  $cita_no_repetida = False;
				  echo '<script>console.log("'.'cita repetida.'.'")</script>';
				  $result='<div id="citarepetida" class="alert alert-danger">Ud. ya tiene un cita en la fecha y hora ingresada</div>';
			  }
			  $horariotecnicoDB = $this->db->get_where('horariotecnico', array('horaInicio' => $hora, 'disponible' => 1));
			  // si no tiene cita repetida y hay tecnicos disponibles
			  if ($horariotecnicoDB->num_rows()>0 && $cita_no_repetida){
				  $id_tecnico = $horariotecnicoDB->row()->tecnico;
				  $id_horariotecnico = $horariotecnicoDB->row()->id;
				  echo '<script>console.log("'.'tecnicos disponibles: '.$horariotecnicoDB->num_rows().'")</script>';
				  echo '<script>console.log("'.'indice del 1er tecnico disponible: '.$id_tecnico.'")</script>';
				  echo '<script>console.log("'.$str_fecha.'")</script>';
				  echo '<script>console.log("'.$fecha.'")</script>';

				  /*
				  INSERT INTO `cita` (`id`, `tecnico`, `fecha`, `asunto`, `estado`) VALUES (NULL, '2', '2017-07-12 08:30:00', 'asasasas', '0');*/
				  $nuevaCita = array(
					  'usuario' => $usuario,
					  'tecnico' => $id_tecnico,
					  'fecha' => $fecha,
					  'asunto' => $asunto
				  );
				  //se agrega registro en la tabla cita
				  $this->db->insert('cita', $nuevaCita);

				  //se actualiza la disponibilidad del tecnico asociado (disponible->0)
				  $disponibilidad = array('disponible' => 0);
				  $this->db->where('id', $id_horariotecnico);
				  $this->db->update('horariotecnico', $disponibilidad);

				  $result = '<div id="citacreada" class="alert alert-success">Se ha registrado su cita con fecha: '.$str_fecha.'</div>';
			  }else{
				  if ($cita_no_repetida){
					  echo '<script>console.log("'.'No hay técnicos disponibles a esta hora'.'")</script>';
					  $result='<div id="nodisponible" class="alert alert-danger">Horario no disponible, por favor elija otro.</div>';
				  }
			  }

		  } else{
			  $result='<div id="nodisponible" class="alert alert-danger">Horario no disponible, por favor elija otro.</div>';
		  }
	  }

	  $data['result'] = $result;
	  $titulo = "Dimquality - agendar cita";
	  $dataHeader['titlePage'] = $titulo;

      $this->load->view('web/header', $dataHeader);
      $this->load->view('web/agendarCita', $data);
      $this->load->view('web/footer');
  }

  public function crearUsuario(){
    $data = array();
    $userData = array();
    if($this->input->post('submit')){
      $this->form_validation->set_rules('usuario', 'Usuario', 'required');
      $this->form_validation->set_rules('nombre', 'Nombre', 'required');
      $this->form_validation->set_rules('apellido', 'Apellido', 'required');
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

        $userData = array(
          'user' => $this->input->post('usuario'),
          'nombre' => strip_tags($this->input->post('nombre')),
          'apellido' => strip_tags($this->input->post('apellido')),
          'email' => strip_tags($this->input->post('correo')),
          'password' => md5($this->input->post('clave')),
          'cedula' => strip_tags($this->input->post('cedula')),
          // 'pais' => strip_tags($this->input->post('pais')),
          'direccion' => strip_tags($this->input->post('direccion')),
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

  public function cedula_check($str){
    $con['returnType'] = 'count';
    $con['conditions'] = array('cedula'=>$str);
    $checkEmail = $this->ShopUser->getRows($con);
    if($checkEmail > 0){
      $this->form_validation->set_message('cedula_check', 'La cédula ya está registrado.');
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
}
