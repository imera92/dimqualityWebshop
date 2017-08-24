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
        $this->load->model('ShopUser');
        date_default_timezone_set("America/Guayaquil");
	}
    
    //Funcion para vista crear/Editar subastas
    function Crear($mensaje=0){
        if ($this->securityCheckAdmin()) {
            $this->db->from('producto');
            $this->db->select('categoria');
            $this->db->distinct();
            $dataBody['categorias']=$this->db->get()->result();
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
        $this->db->from('producto');
        $this->db->select('marca');
        $this->db->distinct();
        $this->db->where('categoria', $categoria);
        $restaurar=$this->db->get()->result_array();
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
        $id=$this->input->get('id');
        $this->db->from('subasta');
        $this->db->where('id', $id);
        $this->db->select('*');
        $subasta=$this->db->get()->row();
        $dataBody['subasta']=$subasta;
        $this->db->from('producto');
        $this->db->where('id',$subasta->producto);
        $this->db->select('*');
        $dataBody['producto']= $this->db->get()->row();
        $dataBody['Accion']='Editar';
         if ($this->securityCheckAdmin()) {
            $this->db->from('producto');
            $this->db->select('categoria');
            $this->db->distinct();
            $dataBody['categorias']=$this->db->get()->result();
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
            $id=$this->input->get('id');
            $this->db->from('subasta');
            $this->db->where('id', $id);
            $this->db->select('*');
            $subasta=$this->db->get()->row();
            $dataBody=array();
            if($subasta !=null){
                $this->db->from('producto');
                $this->db->where('id', $subasta->producto);
                $this->db->select('*');
                $producto= $this->db->get()->row();
                $this->db->from('ofertasubasta');
                $this->db->where('subasta', $subasta->id);
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
        $valor=$this->input->post('valor');
        if ($valor !=0){
            $subasta=$this->input->post('id');
            //$usuario = $this->session->userdata('user');
            $fecha=date("Y-m-d")." ".date("H:i:s");
            $data = array(
                'fecha' => $fecha,
                'subasta' =>$subasta,
                'monto' => $valor,
                'usuario'=>2
            );
            $this->db->insert('ofertasubasta', $data);
            $cadena = str_replace(' ', '',"subasta/ofertarsubasta?id=".$subasta);
            echo $cadena;
        }else if($valor=" "){
            echo "error2";
        }else{
            echo "error1";
        }        
        
    }
    //Aseguhar que el Administrador este logeado
     function securityCheckAdmin() {
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
?>

