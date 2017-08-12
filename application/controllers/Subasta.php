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

    function Guardar(){
        $FechaHoraInicio=$this->input->post('Fhi');
        $FechaHoraFin=$this->input->post('Fhf');
        $precioBase=$this->input->post('PreBa');
        $producto=$this->input->post('product');
        if($producto != null && $FechaHoraFin != null && $precioBase != null && $FechaHoraInicio!= null){
            if (strtotime($FechaHoraInicio) < time())
            {   
                echo 'Ha ocurrido un error. La Fecha de inicio no puede ser menor a la hora actual';
            }else{
                if (strtotime($FechaHoraFin) < time())
                {   
                    $activa=0;
                }
                else{ $activa=1;}
                $FechaHoraInicio=date("Y-m-d H:i:s", strtotime($FechaHoraInicio));
                $FechaHoraFin=date("Y-m-d H:i:s", strtotime($FechaHoraFin));
                $now=new DateTime("now");
                $data = array(
                'fechaInicio' => $FechaHoraInicio,
                'fechaFin' =>$FechaHoraFin,
                'producto' => $producto,
                'precioBase' => $precioBase,
                'estado' => $activa
                );
                $this->db->insert('subasta', $data);
                echo 'La subasta se ha creado exitosamente';
            }
        }else{
            echo 'Ha ocurrido un error. Todos los campos son requeridos.';
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

