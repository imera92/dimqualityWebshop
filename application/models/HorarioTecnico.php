<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* Transaccion
	*/
	class Tecnico extends CI_Model
	{
		private $id;
		private $tecnico;
		private $horaInicio;
		private $horaFin;
		private $disponible;

		function __construct()
		{
			parent::__construct();
            // Helpers
            $this->load->database();

            // Modelos Requeridos
            $this->load->model('ShopUser');
            
		}
	}