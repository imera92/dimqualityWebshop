<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificacion extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('email');
        $this->load->database();

    }

    public function notificarACliente(){

        /*
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

        // se obtiene de sesion el correo del usuario
        //$email_usuario = $this->session->userdata('correo');
        //$email_usuario = 'wjvelez@espol.edu.ec';
        $this->email->to('saludprimero.2016@gmail.com'); //email que recibe
        $this->email->subject('Notificación de Pedidos Realizados');


        // se obtienen los productos comprados por el usuario

        $transaccion = $this->db->get_where('transaccion', array('usuario' => $email_usuario));
        if ($transaccion->num_rows()>0) {
            $this->db->select('producto, cantidad, subtotal, fechaCompra');
            $this->db->from('itemtransaccion');
            $this->db->join('transaccion', 'transaccion.id = itemtransaccion.transaccion');
            $query = $this->db->get();
        }

        $this->email->message('Productos comprados');

        $envio = $this->email->send();
        if ($envio){
            echo "Correo enviado";
        }else{
            echo "Correo NO enviado";
            echo $this->email->print_debugger();
        }
        */

        //$para  = $this->session->userdata['correo'];
        $para  = 'wjvelez@espol.edu.ec';
        // Asunto
        $titulo = 'Notificación de Productos comprados';

        // Mensaje
        $mensaje = '
        <html>
        <head>
        <title>Notificación de Productos comprados</title>
        </head>
        <body>
        <p>Sr(a) '
        $mensaje .= $this->session->userdata['user']
        $mensaje .= ' Usted ha realizado la compra de los siguiente artículos </p>'
        $mensaje .= '
        </body>
        </html>
        ';

        // Cabecera que especifica que es un HMTL
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Cabeceras adicionales
        $cabeceras .= 'From: Recordatorio <tarifas@example.com>' . "\r\n";
        $cabeceras .= 'Cc: archivotarifas@example.com' . "\r\n";
        $cabeceras .= 'Bcc: copiaoculta@example.com' . "\r\n";

        // enviamos el correo!
        mail($para, $titulo, $mensaje, $cabeceras);

        }
}

?>
