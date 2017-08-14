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
        date_default_timezone_set("America/Guayaquil");
	}
    
    //Funcion para vista crear/Editar subastas
    function Crear(){
        if ($this->securityCheckAdmin()) {
            $query = $this->db->get('categoriaproducto');
            $dataBody['categorias']=$query->result();
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
        $this->db->select('*');
        $result= $this->db->get()->result_array();
        if ($result==null){
            return true;
        }else{
            return false;
        }
    }
    
    
    
    function Guardar(){
        $FechaHoraInicio=$this->input->post('Fhi');
        $FechaHoraFin=$this->input->post('Fhf');
        $precioBase=$this->input->post('PrecioBase');
        $producto=$this->input->post('product');
        if($producto != null && $FechaHoraFin != null && $precioBase != null && $FechaHoraInicio!= null){
            if (strtotime($FechaHoraInicio) < time() )
            {   
                echo 'Ha ocurrido un error. La Fecha de inicio no puede ser menor a la hora actual';
            }
            elseif(strtotime($FechaHoraFin)< time()){
                echo 'Ha ocurrido un error. La Fecha de fin de subasta no puede ser menos a la hora actual';
            }elseif($this->verificarProducto($producto)){
                echo 'Ha ocurrido un error. Este producto ya esta siendo subastado';
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
                echo 'La subasta se ha creado exitosamente';
            }
        }else{
            if($FechaHoraFin==null){
                echo 'Ha ocurrido un error. La fecha Fin de subasta es obligatoria';
            }elseif($FechaHoraInicio==null){
                echo 'Ha ocurrido un error. La fecha de inicio de subasta es obligatoria';
            }elseif($precioBase==null){
                echo 'Ha ocurrido un error. EL precio base es obligatorio';
            }elseif($producto==null){
                echo 'Ha ocurrido un error. El producto es obligatorio';
            }
        }
    }

    function Actualizar(){
        $id=$this->input->get('id');
        $this->db->from('subasta');
        $this->db->where('id', $id);
        $this->db->select('*');
        $dataBody['subasta']=$this->db->get()->row();
        $dataBody['Accion']='Editar';
         if ($this->securityCheckAdmin()) {
            $query = $this->db->get('categoriaproducto');
            $dataBody['categorias']=$query->result();
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
}
?>

