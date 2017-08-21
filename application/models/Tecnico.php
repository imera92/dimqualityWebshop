<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* Transaccion
	*/
	class Tecnico extends CI_Model
	{
		private $id;
		private $horario;

		function __construct()
		{
			parent::__construct();
            // Helpers
            $this->load->database();

            // Modelos Requeridos
            
		}

		public function getHorarioTecnico($dia, $hora)
		{
			$horariotecnicoDB = $this->db->get_where('horariotecnico', array('horaInicio <= ' => $hora, 'horaFin >= ' => $hora,'dia' => $dia));
			return $horariotecnicoDB;
		}
	}