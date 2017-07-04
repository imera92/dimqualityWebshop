<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');
	  $this->load->helper('form');
	  $this->load->library('session');
	  date_default_timezone_set("America/Guayaquil");
  }

  public function getProducto($codProducto = 0)
  {
	$titulo = "Dimquality - Lo mejor en Tecnología y Electrodomésticos";
	$dataHeader['titlePage'] = $titulo;

	// Obtenemos el id del último producto
	$this->db->select('id');
	$this->db->from('producto');
	$this->db->order_by('id', 'DESC');
	$this->db->limit(1);
	$result = $this->db->get()->result_array();
	$idUltimoProducto = $result[0]['id'];

	// Tratamos de obtener del producto asociado al id enviado
	$result = $this->db->get_where('producto', array('id' => $codProducto))->result_array();
	if (!empty($result)) {
		$producto = $result[0];		
	}

	// Validamos que no se solicite un producto inexistente
	if (($codProducto > $idUltimoProducto) || ($codProducto < 0) || empty($producto)) {
	  $dataBody['mensaje'] = 'No hay productos para mostrar. Utilice un código de producto válido.';
	} else {
	  $dataBody['producto'] = $producto;
	}

	$this->load->view('web/header', $dataHeader);
	$this->load->view('web/producto', $dataBody);
	$this->load->view('web/footer');
	}

}