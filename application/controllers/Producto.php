<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/insdex
	 *	- or -2
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function crear()
	{
		if (!empty($_POST)){
            $nombre=$this->input->post('nombre');
            $codigo=$this->input->post('codigo');
            $modelo=$this->input->post('modelo');
            $precio=$this->input->post('precio');
            $marca=$this->input->post('marca');
            $ruta=$this->input->post('ruta');
            $descripcion=$this->input->post('descripcion');
            if($nombre &&  $codigo && $modelo && $precio && $marca && $ruta && $descripcion ){
                $this->load->model('producto');
                $data =array(
                    'nombre'=> $nombre,
                    'codigo'=> $codigo,
                    'modelo'=> $modelo,
                    'precio'=> $precio,
                    'marca'=> $marca,
                    'ruta'=> $ruta,
                    'descripcion'=> $descripcion
                );
            }
        }
        $this->load->view('crearProducto');
	}
}
