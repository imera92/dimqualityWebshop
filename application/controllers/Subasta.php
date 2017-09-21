<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subasta extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('grocery_CRUD');
        $this->load->model('SecurityUser');
        $this->load->model('Categoria');
        $this->load->model('Oferta');
		$this->load->model('Producto');
        $this->load->model('Subastas');
        $this->load->model('ShopUser');
        date_default_timezone_set("America/Guayaquil");
	}

    ///////////////////////////////////
    // Métodos para la tienda
    ///////////////////////////////////

    // Metodo para mostrar la vista con el listado de todas las subastas activas
    public function subastas_disponibles($pagina = FALSE)
    {
        // Nos permite determinar el índice del registro en la tabla de subastas
        // a partir del cual recuperaremos las subastas para la paginación
        $inicio = 0;
        // Nos pemrmite determinar la cantidad de subastas que mostraremos por página
        $limite = 5;

        // Si el cliente requiere alguna página en específico, calculamos el índice de inicio
        if ($pagina){
            $inicio = ($pagina -1) * $limite; // corrige elemento repetido en ultima página
        }

        // Obtenemos el número de subastas activas existentes
        $subasta = new Subastas();
        $subastas_activas_num = $subasta->count_subastas_activas();

        // Especificamos la configuración de la paginación
        $this->load->library('pagination');
        $config['base_url'] = base_url('subasta/subastas_disponibles');
        $config['total_rows'] = $subastas_activas_num;
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

        // Obtenemos las instancias de las subastas activas existentes
        $subastas_paginacion = $subasta->fetch_subastas_paginacion($inicio, $limite);

        $dataHeader['titlePage'] = 'Dimquality - Subastas';
        $dataBody['subastas_paginacion'] = $subastas_paginacion;
        $dataBody['pagination'] = $this->pagination->create_links();
        $dataBody['subastas_activas_num'] = $subastas_activas_num;

        $this->load->view('web/header', $dataHeader);
        $this->load->view('web/subastas_disponibles', $dataBody);
        $this->load->view('web/footer');
    }

    // Método para mostrar la vista de una subasta en la que se va a ofertar
    public function ofertar_subasta()
    {
        // Recibimos el ID de la subasta escogida por el usuario
        $subasta_id = $this->input->get('id');

        // Intentamos recuperar la subasta requerida
        $subasta = new Subastas();
        $subasta->getSubastaPorId($subasta_id);

        $data_body = array();
        $data_header = array();

        if ($subasta != null) {
            $data_body['subasta'] = $subasta;
        } else {

        }

        $data_header['titlePage'] = 'Dimquality::WebShop -Ofertar Subasta';
        $this->load->view('web/header', $data_header);
        $this->load->view('web/ofertar_subasta', $data_body);
        $this->load->view('web/footer');
    }

    // Método para recibir y guardar la oferta de un usuario para una subasta
    public function guardar_oferta(){
        // Inicializamos el array que se envía como respuesta al final
        $resultado = array();

        if ($this->user_login_check()) {
            // Recibimos el ID de la subasta escogida por el usuario
            $subasta_id = $this->input->post('subasta_id');

            // Recibimos el monto de la oferta enviada por el usuario
            $oferta_monto = $this->input->post('oferta_monto');

            // Validamos que se haya enviado un ID de subasta
            if (!empty($subasta_id)) {
                // Validamos que se haya enviado un monto
                if (!empty($oferta_monto)) {
                    // Validamos que no se hayan enviado letras
                    if (is_numeric($oferta_monto)) {
                        // Validamos que el monto enviado sea mayor a cero
                        if ($oferta_monto != 0) {
                            // Obtenemos la instancia de la subasta escogida por el usuario
                            $subasta = new Subastas();
                            $id_existe = $subasta->getSubastaPorId($subasta_id);

                            // Validamos que la instancia se haya creado con éxito
                            // es decir, que el ID de subasta sea válido
                            if ($id_existe) {
                                // Validamos si la subasta tiene ofertas existentes
                                if (!empty($subasta->getOfertas())) {
                                    // Si ya se han realizado ofertas, obtenemos el valor de la mayor oferta
                                    $mayor_oferta_monto = $subasta->get_mayor_oferta()->get_monto();
                                } else {
                                    // Si no se han realizado ofertas, obtenemos el precio base de la subasta
                                    $mayor_oferta_monto = $subasta->getPrecioBase();
                                }

                                // Validamos que el monto enviado sea mayor al de la mayor oferta realizada hasta ahora
                                if ($oferta_monto > $mayor_oferta_monto) {
                                    $oferta_new = new Oferta();
                                    $oferta_new->create_new_oferta($subasta->getId(), $this->session->id, $oferta_monto);
                                    $oferta_new->save_new_oferta();

                                    $cadena = str_replace(' ', '','subasta/ofertar_subasta?id=' . $subasta->getId());

                                    array_push($resultado, array(
                                        'success' => 1,
                                        'url' => $cadena
                                    ));
                                } else {
                                    array_push($resultado, array(
                                        'success' => 0,
                                        'msg' => 'El valor ingresado debe ser superior al de la mayor oferta.'
                                    ));
                                }
                            } else {
                                array_push($resultado, array(
                                    'success' => 0,
                                    'msg' => 'Error. El identificador de subasta no es válido. Póngase en contacto con el administrador.'
                                ));
                            }
                        } else {
                            array_push($resultado, array(
                                'success' => 0,
                                'msg' => 'El valor de la oferta debe ser mayor a 0.'
                            ));
                        }
                    } else {
                        array_push($resultado, array(
                            'success' => 0,
                            'msg' => 'El valorde la oferta sólo debe incluir números.'
                        ));
                    }
                } else {
                    array_push($resultado, array(
                        'success' => 0,
                        'msg' => 'Es necesario que ingrese un valor.'
                    ));
                }
            } else {
                array_push($resultado, array(
                    'success' => 0,
                    'msg' => 'Error. No envió un identificador de subasta. Póngase en contacto con el administrador.'
                ));
            }
        } else {
            array_push($resultado, array(
                'success' => 0,
                'msg' => 'Para participar en la subasta debe iniciar sesión con su cuenta de usuario.'
            ));
        }

        header('Content-Type: application/json');
        echo json_encode($resultado);
    }


    ///////////////////////////////////
    // Métodos para el Administrador
    ///////////////////////////////////
    // Metodo para mostrar la vista con el listado de todas las subastas activas para el administrador
	public function administrar_subastas($pagina = FALSE)
	{
		// Nos permite determinar el índice del registro en la tabla de subastas
        // a partir del cual recuperaremos las subastas para la paginación
        $inicio = 0;
        // Nos pemrmite determinar la cantidad de subastas que mostraremos por página
        $limite = 5;

        // Si el administrador requiere alguna página en específico, calculamos el índice de inicio
        if ($pagina){
            $inicio = ($pagina -1) * $limite; // corrige elemento repetido en ultima página
        }

        // Obtenemos el número de subastas activas existentes
        $subasta = new Subastas();
        $subastas_activas_num = $subasta->count_subastas();

        // Especificamos la configuración de la paginación
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'subasta/administrar_subastas';
        $config['total_rows'] = $subastas_activas_num;
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

        // Obtenemos las instancias de las subastas activas existentes
        $subastas_paginacion = $subasta->fetch_subastas_paginacion_admin($inicio, $limite);

        $dataHeader['titlePage'] = 'Dimquality - Administrar Subastas';
        $dataBody['subastas_paginacion'] = $subastas_paginacion;
        $dataBody['pagination'] = $this->pagination->create_links();
        $dataBody['subastas_activas_num'] = $subastas_activas_num;

        $this->load->view('admin/header', $dataHeader);
        $this->load->view('admin/lat-menu');
		$this->load->view('admin/administrar_subastas', $dataBody);
        $this->load->view('admin/footer');
    }

    // Método para mostrar la vista para crear una subasta
    public function create_subasta($mensaje = 0)
    {
        if ($this->securityCheckAdmin()) {
            $dataBody['categorias'] = $this->Categoria->get_categorias_activas_array();

            if ($mensaje==1) {
                $dataBody['mensaje']="La subasta se ha creado exitosamente";
            } elseif($mensaje==2) {
                $dataBody['mensaje']="La subasta se ha actualizado exitosamente";
            }

            $dataHeader['titlePage'] = 'Dimquality::Admin - Subasta';
            $dataBody['accion']='Crear';
            $this->load->view('admin/header', $dataHeader);
            $this->load->view('admin/lat-menu');
            $this->load->view('admin/create_update_subasta', $dataBody);
            $this->load->view('admin/footer');
        } else {
            redirect('admin/login');
        }
    }

    // Método para mostrar la vista con el detalle de una subasta a partir de su ID
    public function read_subasta_data()
    {
        $subasta_id = $this->input->post('subasta_id');
        $subasta = new Subastas();
        $subasta->getSubastaPorId($subasta_id);

        $response = array();
        $start_datetime = new DateTime($subasta->getFechaInicio());
        $finish_datetime = new DateTime($subasta->getFechaFin());
        $response['nombre_producto'] = $subasta->getProducto()->getNombre();
        $response['fecha_inicio'] = $start_datetime->format('Y-m-d') . ' a las ' . $start_datetime->format('H:i');
        $response['fecha_fin'] = $finish_datetime->format('Y-m-d') . ' a las ' . $finish_datetime->format('H:i');
        $response['oferta_mayor'] = (is_null($subasta->get_mayor_oferta())) ? 'Aún no se han hecho ofertas para la subasta' : $subasta->get_mayor_oferta()->get_monto();

        if (!is_null($subasta->get_mayor_oferta())) {
            $subasta_db = $this->db->get_where('subasta', array('id' => $subasta_id))->last_row();
            if ($subasta_db->ganador != 0) {
                $usuario_db = $this->db->get_where('usuario', array('id' => $subasta_db->ganador))->last_row();
                $response['ganador'] = $usuario_db->nombre . ' ' . $usuario_db->apellido;
            } else {
                $response['ganador'] = 'La subasta aún está en curso';
            }
        } else {
            $response['ganador'] = 'Aún no se han hecho ofertas para la subasta';
        }

        $response['ofertas'] = array();
        foreach ($subasta->getOfertas() as $oferta) {
            $subasta_datetime = new DateTime($oferta->get_fecha());
            array_push($response['ofertas'], array(
                'monto' => $oferta->get_monto(),
                'fecha' => $subasta_datetime->format('Y-m-d'),
                'hora' => $subasta_datetime->format('H:i'),
                'usuario_nombre' => $oferta->get_usuario()->nombre . ' ' . $oferta->get_usuario()->apellido,
                'usuario_cedula' => $oferta->get_usuario()->cedula
            ));
        }

        $this->output->set_output(json_encode($response));
    }

    // Método para mostrar la vista para actualizar una subasta a partir de su ID
    public function update_subasta()
    {
        if ($this->securityCheckAdmin()) {
            // Recibimos el ID de la subasta escogida por el usuario
            $subasta_id = $this->input->get('id');

            // Intentamos instanciar la subasta requerida
            $subasta = new Subastas();
            $subasta->getSubastaPorId($subasta_id);

            // Obtenemos la categoría del producto asociado a la subasta
            $categoria = new Categoria();
            $categoria->getCategoriaPorId($subasta->getProducto()->getCategoria());
            $subasta->getProducto()->setCategoria($categoria);

            // Obtenemos la marca del producto asociado a la subasta
            $marca = new Marca();
            $marca->getMarcaPorId($subasta->getProducto()->getMarca());
            $subasta->getProducto()->setMarca($marca);

            $dataBody['subasta'] = $subasta;
            $dataBody['producto'] = $subasta->getProducto();
            $dataBody['accion'] ='Editar';
            $dataBody['categorias'] = $this->Categoria->get_categorias_activas_array();

            $dataHeader['titlePage'] = 'Dimquality::Admin - Subasta';
            $this->load->view('admin/header', $dataHeader);
            $this->load->view('admin/lat-menu');
            $this->load->view('admin/create_update_subasta', $dataBody);
            $this->load->view('admin/footer');
        } else {
            redirect('admin/login');
        }
    }


	public function eliminar()
	{
		$subasta = new Subastas();
		$id_subasta = $this->uri->segment(3);
		$subasta->eliminarSubasta($id_subasta);
		redirect('subasta/administrar_subastas');
	}


    function obtenerMarca(){
        $categoria=$this->input->get('categoria');
        $restaurar = Array();
        $marcasArray = $this->Producto->getMarcasPorCategoria($categoria);
        foreach ($marcasArray as $marca) {
            array_push($restaurar, array('id' => $marca->getId(), 'nombre' => $marca->getNombre()));
        }
        $this->output->set_output(json_encode($restaurar));
    }


    function obtenerProductos(){
        $marca=$this->input->get('marca');
        $categoria=$this->input->get('categoria');
        $this->db->select('nombre,id');
        $this->db->from('producto');
        $this->db->where(array(
            'categoria' => $categoria,
            'marca' => $marca,
            'estado' => 1,
            'stock>' => 0
        ));
        $restaurar=$this->db->get()->result_array();
        $this->output->set_output(json_encode($restaurar));
    }

    //funcion que verifique que ese producto ya no esta siendo subastado
    function verificarProducto($id){
        $this->db->from('subasta');
        $this->db->where('producto',$id);
        $result= $this->db->get()->row();
        if($result != null){
            return TRUE;
        }else{
            return FALSE;
        }
        //$this->output->set_output(json_encode($result));
    }

    function Guardar(){
        $FechaHoraInicio=$this->input->post('Fhi');
        $FechaHoraFin=$this->input->post('Fhf');
        $precioBase=$this->input->post('PrecioBase');
        $producto=$this->input->post('product');
        if($producto != null && $FechaHoraFin != null && $precioBase != null && $FechaHoraInicio!= null){
            if (strtotime($FechaHoraInicio) < time() )
            {
                echo 'Ha ocurrido un error. La fecha y/o hora de inicio no puede ser menor a la fecha y/o hora actual';
            }
            elseif(strtotime($FechaHoraFin)< time()){
                echo 'Ha ocurrido un error. La Fecha de fin de subasta no puede ser menor a la hora actual';
            }elseif($this->verificarProducto($producto)){
                echo 'Ha ocurrido un error. Este producto ya esta siendo subastado';
            }elseif(strtotime($FechaHoraInicio)>strtotime($FechaHoraFin)){
                echo 'Ha ocurrido un error. La fecha de inicio no puede ser mayor a la fecha final de una subasta';
            }
            else{
                $FechaHoraInicio=date("Y-m-d H:i:s", strtotime($FechaHoraInicio));
                $FechaHoraFin=date("Y-m-d H:i:s", strtotime($FechaHoraFin));
                $data = array(
                'fechaInicio' => $FechaHoraInicio,
                'fechaFin' =>$FechaHoraFin,
                'producto' => $producto,
                'precioBase' => $precioBase,
                'estado' => 1
                );
                $this->db->insert('subasta', $data);

                $producto_ins = new Producto();
                $producto_ins->getProductoPorId($producto);
                $producto_ins->reducirStock();
                echo "subasta/create_subasta/1";
            }
        }else{
            if($FechaHoraFin==null){
                echo 'Ha ocurrido un error.Todos los campos son obligatorios';
            }
        }
    }

    //funcion para actualizarr una determinada subasta
    function ActualizarSubasta(){
        $id= $this->input->post('id');
        $FechaHoraInicio=$this->input->post('Fhi');
        $FechaHoraFin=$this->input->post('Fhf');
        $precioBase=$this->input->post('PrecioBase');
        $producto=$this->input->post('product');
        if($producto!=null  && $FechaHoraFin != null && $precioBase != null && $FechaHoraInicio!= null){
            $this->db->from('producto');
            $this->db->where('nombre',$producto);
            $this->db->select('*');
            $product=$this->db->get()->row();
            $id_producto=$product->id;
            if (strtotime($FechaHoraInicio) < time() )
            {
                echo 'Ha ocurrido un error. La Fecha de inicio no puede ser menor a la hora actual';
            }
            elseif(strtotime($FechaHoraFin)< time()){
                echo 'Ha ocurrido un error. La Fecha de fin de subasta no puede ser menor a la hora actual';
            }elseif(strtotime($FechaHoraInicio)>strtotime($FechaHoraFin)){
                echo 'Ha ocurrido un error. La fecha de inicio no puede ser mayor a la fecha final de una subasta';
            }
            else{

                $FechaHoraInicio=date("Y-m-d H:i:s", strtotime($FechaHoraInicio));
                $FechaHoraFin=date("Y-m-d H:i:s", strtotime($FechaHoraFin));
                $data = array(
                    'fechaInicio' => $FechaHoraInicio,
                    'fechaFin' =>$FechaHoraFin,
                    'producto' => $id_producto,
                    'precioBase' => $precioBase,
                    'estado' => 1
                );
                $this->db->where('id',$id);
                $this->db->update('subasta', $data);
                echo "subasta/create_subasta/2";
            }
        }else{
            echo 'Ha ocurrido un error. Todos los campos son requeridos ';
        }
    }

    ///////////////////////////////////////////////////////
    // Método para la actualización automática de subastas
    //////////////////////////////////////////////////////
    public function cambiarEstado()
    {
        $result = $this->db->get_where('subasta', array('estado' => 1))->result();

        foreach ($result as $row) {
            // Obtenemos la fecha de fin de la subasta
            $fechaSubasta = new DateTime($row->fechaFin);

            // Obtenemos la fecha actual
            $fechaActual = new DateTime(date('Y-m-d H:i:s'));

            // Validamos que al fecha de fin de al subasta sea menor a la fecha actual
            if ($fechaSubasta <= $fechaActual) {
                // Actualizamos el estado de la subasta a 'No Disponible'
                $this->db->where('id', $row->id);
                $this->db->update('subasta', array('estado' => 2));

                // Recuperamos de la DB la mayor oferta
                /*$this->db->select_max('*');
                $this->db->from('ofertasubasta');
                $this->db->where('subasta', $row->id);
                $this->db->order_by('monto', 'DESC');
                $mayor_oferta = $this->db->get()->first_row();*/
                $subasta = new Subastas();
                $subasta->getSubastaPorId($row->id);

                $mayor_oferta = $subasta->get_mayor_oferta();

                // Establecemos el usuario ganador de la subasta
                $this->db->where('id', $row->id);
                $this->db->update('subasta', array('ganador' => $mayor_oferta->get_usuario()->id));

                // Recuperamos de la DB el correo electrónico del usuario ganador
                /*$this->db->select('email');
                $this->db->from('usuario');
                $this->db->where('id', $mayor_oferta->get_usuario()->id);
                $correoUser = $this->db->get()->result();*/

                // Envíamos un correo de notificación al usuario ganador
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
                                <p>Acaba de ganar la subasta.</p>
                            </body>
                            </html>';
                $this->load->library('email');
                $this->email->initialize($config);
                $this->email->from('info@dimquality.com.ec','Dimquality - Lo mejor en tecnología');
                $this->email->to($mayor_oferta->get_usuario()->email);
                $this->email->subject('GANO LA SUBASTA');
                $this->email->message($mensaje);

                if(!$this->email->send()) {
                  show_error($this->email->print_debugger());
                }
            }
        }
    }

    ///////////////////////////////////
    // Métodos de seguridad
    ///////////////////////////////////

    // Método para validar si un usuario de la tienda está logueado
    private function user_login_check()
    {
        $session_userdata_user = $this->session->userdata('user');
        if ($session_userdata_user == '') {
            return false;
        } else {
            return true;
        }
    }

    // Método para validar si un usuario administrador está logueado
    private function securityCheckAdmin()
    {
        $security_user = new SecurityUser();
        $session_userdata_user = $this->session->userdata('user');
        $session_userdata_role = $this->session->userdata('tipo');

        if ($session_userdata_user == '') {
            return false;
        } else {
            if ($session_userdata_role == 'admin') {
                return true;
            } else {
                $security_user->logout();
                return false;
            }
        }
    }
}
