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
		$this->load->model('Producto');
        $this->load->model('Subastas');
        $this->load->model('ShopUser');
        date_default_timezone_set("America/Guayaquil");
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
        $dataHeader['titlePage'] = 'Dimquality::Admin - Subastas';

		$this->load->library('pagination');

		$config['base_url'] = base_url().'subasta/subastas';
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

        $this->load->view('admin/header', $dataHeader);
        $this->load->view('admin/lat-menu');
		$this->load->view('admin/subastas', $data);
        $this->load->view('admin/footer');

    }

	public function eliminar()
	{
		$subasta = new Subastas();
		$id_subasta = $this->uri->segment(3);
		//echo $id_subasta;
		$subasta->eliminarSubasta($id_subasta);
		redirect('subasta/subastas');

	}
    
    //Funcion para vista crear/Editar subastas
    function crear($mensaje=0){
        if ($this->securityCheckAdmin()) {
            $dataBody['categorias'] = $this->Categoria->categoriasArray();

            if($mensaje==1){
                $dataBody['mensaje']="La subasta se ha creado exitosamente";
            }elseif($mensaje==2){
                $dataBody['mensaje']="La subasta se ha actualizado exitosamente";
            }
            
    		$titulo = "Dimquality::Admin - Subasta";
    		$dataHeader['titlePage'] = $titulo;
            $dataBody['Accion']='Crear';
    		$this->load->view('admin/header', $dataHeader);
    		$this->load->view('admin/lat-menu');
    		$this->load->view('admin/crearEditar', $dataBody);
    		$this->load->view('admin/footer');
    	} else {
    		redirect("admin/login");
    	}
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
        $this->db->from('producto');
        $this->db->where('categoria', $categoria);
        $this->db->where('marca',$marca);
        $this->db->select('nombre,id');
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
                echo 'Ha ocurrido un error. La Fecha de fin de subasta no puede ser menos a la hora actual';
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
                echo "subasta/crear/1";
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
                echo "subasta/crear/2";
            }
        }else{
            echo 'Ha ocurrido un error. Todos los campos son requeridos ';
        }
    }
    
    //funcion que carga la vista de actualizar subasta a partir de un id 
    function Actualizar(){
         if ($this->securityCheckAdmin()) {
            $id=$this->input->get('id');

            /*$this->db->from('subasta');
            $this->db->where('id', $id);
            $this->db->select('*');
            $subasta=$this->db->get()->row();*/
            $subasta = new Subastas();
            $subasta->getSubastaPorId($id);
            $dataBody['subasta'] = $subasta;

            /*$this->db->from('producto');
            $this->db->where('id',$subasta->producto);
            $this->db->select('*');
            $dataBody['producto']= $this->db->get()->row();*/
            $producto = new Producto();
            $producto->getProductoPorId($subasta->getProducto());

            $categoria = new Categoria();
            $categoria->getCategoriaPorId($producto->getCategoria());
            $producto->SetCategoria($categoria);

            $marca = new Marca();
            $marca->getMarcaPorId($producto->getMarca());
            $producto->setMarca($marca);

            $dataBody['producto']= $producto;
            
            $dataBody['Accion']='Editar';

            /*$this->db->from('producto');
            $this->db->select('categoria');
            $this->db->distinct();
            $dataBody['categorias']=$this->db->get()->result();*/
            $dataBody['categorias'] = $this->Categoria->categoriasArray();

    		$titulo = "Dimquality::Admin - Subasta";
    		$dataHeader['titlePage'] = $titulo;
    		$this->load->view('admin/header', $dataHeader);
    		$this->load->view('admin/lat-menu');
    		$this->load->view('admin/crearEditar', $dataBody);
    		$this->load->view('admin/footer');
    	} else {
    		redirect("admin/login");
    	}
    }

    //vista para que el usuario oferte en una subasta
    function OfertarSubasta(){
       // if ($this->loginCheck()) {
            $id = $this->input->get('id');

            /*$this->db->from('subasta');
            $this->db->where('id', $id);
            $this->db->select('*');
            $subasta=$this->db->get()->row();*/
            $subasta = new Subastas();
            $subasta->getSubastaPorId($id);

            $dataBody=array();

            if($subasta != null){
                /*$this->db->from('producto');
                $this->db->where('id', $subasta->producto);
                $this->db->select('*');
                $producto= $this->db->get()->row();*/
                $producto = new Producto();
                $producto->getProductoPorId($subasta->getProducto());

                $this->db->from('ofertasubasta');
                $this->db->where('subasta', $subasta->getId());
                $this->db->select('*');
                $ofertas=$this->db->get()->result();

                $this->db->select_max('monto');
                $this->db->from('ofertasubasta');

                $dataBody['mayor']=$this->db->get()->row();
                $dataBody['ofertas']=$ofertas;
                $dataBody['subasta']=$subasta;
                $dataBody['producto']=$producto;
            }

            $titulo = "Dimquality::WebShop -Ofertar Subasta";
            $dataHeader['titlePage'] = $titulo;
            $this->load->view('web/header', $dataHeader);
            $this->load->view('web/ofertarsubasta', $dataBody);
            $this->load->view('web/footer');
       /* }else{
            redirect("usuario/login");
        }*/
    }
    
    function guardarOferta(){
        $resultado = array();
        $valor=$this->input->post('valor');
        if ($valor !=0){
            $this->db->select_max('monto');
            $this->db->from('ofertasubasta');
            $mayorOferta=$this->db->get()->row();

            if ( $valor > $mayorOferta->monto) {
                $subasta=$this->input->post('id');
                $usuario = $this->session->id;
                $fecha=date("Y-m-d")." ".date("H:i:s");
                $data = array(
                    'fecha' => $fecha,
                    'subasta' =>$subasta,
                    'monto' => $valor,
                    'usuario' => $usuario
                );
                $this->db->insert('ofertasubasta', $data);
                $cadena = str_replace(' ', '',"subasta/ofertarsubasta?id=".$subasta);

                array_push($resultado, array(
                    'success' => 1,
                    'url' => $cadena
                ));
            } else {
                array_push($resultado, array(
                    'success' => 0,
                    'msg' => 'El valor ingresado debe ser mayor al de la mayor oferta.'
                ));
            }
        }else if($valor=""){
            array_push($resultado, array(
                'success' => 0,
                'msg' => 'Es necesario que ingrese un valor.'
            ));
        }else{
            array_push($resultado, array(
                'success' => 0,
                'msg' => 'El valor de la oferta debe ser mayor a 0.'
            ));
        }

        header('Content-Type: application/json');
        echo json_encode($resultado);
    }

    //Aseguhar que el Administrador este logeado
     function securityCheckAdmin()
     {
        $securityUser = new SecurityUser();
        $usuario = $this->session->userdata('user');
        if($usuario == ""){
            return false;
        }else{
            if ($this->session->userdata('tipo') == "admin") {
                return true;
            }else{
                $securityUser->logout();
                return false;
            }
        }
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

    public function cambiarEstado()
    {
        $result = $this->db->get_where('subasta', array('estado' => 1))->result();

        foreach ($result as $row) {
            $fechaSubasta = new DateTime($row->fechaFin);
            $fechaActual = new DateTime(date('Y-m-d H:i:s'));
            if ($fechaSubasta <= $fechaActual) {
                $this->db->where('id', $row->id);
                $this->db->update('subasta', array('estado' => 2));

                $this->db->select_max('monto');
                $this->db->from('ofertasubasta');
                $this->db->where('subasta', $row->id);
                $userId = $this->db->get()->last_row();

                $this->db->select('email');
                $this->db->from('usuario');
                $this->db->where('id', $userId);
                $correoUser = $this->db->get()->result();

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
                $this->email->to($correoUser->correo);
                $this->email->subject('GANO LA SUBASTA');
                $this->email->message($mensaje);

                if(!$this->email->send()) {
                  show_error($this->email->print_debugger());
                }
            }
        }
    }
}
