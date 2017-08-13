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
        $this->load->model('Subastas');
		$this->load->model('Producto');
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

		//$config['num_links'] = 2;

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

	function eliminar()
	{
		
	}


}
