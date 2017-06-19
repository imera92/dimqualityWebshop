<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificacion extends CI_Controller {

  public function __construct()
  {
		parent::__construct();
	}

  public function notificarACliente(){

    $this->load->library('session');
    $this->load->database();
    // se obtiene de sesion el correo del usuario
    //$email_usuario = $this->session->userdata('user_email');
    //$email_usuario = 'wjvelez@espol.edu.ec';
    // se obtienen los productos comprados por el usuario
    /*
    $transaccion = $this->db->get_where('transaccion', array('usuario' => $email_usuario));
    if ($transaccion->num_rows()>0) {
        $this->db->select('producto, cantidad, subtotal, fechaCompra');
        $this->db->from('itemtransaccion');
        $this->db->join('transaccion', 'transaccion.id = itemtransaccion.transaccion');
        $query = $this->db->get();
    }
    */

  }

  public function index(){
    $this->load->library('email');
    //configuraciones para enviar mails
    $configuraciones=array(
      "protocol"      => "smtp",
      "smtp_host"     => "smtp.gmail.com",
      "smtp_port"     => 465,
      "mailpath"      => "C:\\xampp\\sendmail",
      "smtp_user"     => "saludprimero.2016@gmail.com",
      "smtp_pass"     => "",
      "mailtype"      => "html",
      "charset"       => "ISO-8859-1",
      "starttls"      => true,
      "smtp_crypto"   =>"tls",
      "smpt_ssl"      => "auto",
      "send_multipart"=> false
    );

    $this->email->initialize($configuraciones);
    //$this->email->set_newline("\r\n");
    $this->email->from('saludprimero.2016@gmail.com', 'Admin'); //email que envia
    $this->email->to('saludprimero.2016@gmail.com'); //email que recibe
    $this->email->subject('Notificación de Pedidos Realizados');
    $this->email->message('correo de prueba');

    $envio = $this->email->send();
    if ($envio){
      echo "Correo enviado";
    }else{
      echo "Correo NO enviado";
      echo $this->email->print_debugger();
    }
  }
}


?>
