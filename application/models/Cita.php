<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* Transaccion
	*/
	class Cita extends CI_Model
	{
		private $id;
		private $usuario;
		private $estado;
		private $fechaInicio;
		private $fechaFin;
		private $asunto;
		private $mensajes;
		private $fechaCreacion;

		function __construct()
		{
			parent::__construct();
            // Helpers
            $this->load->database();

            // Modelos Requeridos
            $this->load->model('ShopUser');
            $this->load->model('Tecnico');
		}

		public function getCitaRep($usuario, $fecha)
		{						;
			$hora = -1;
			$fechai = date("Y-m-d H:i:s", strtotime($fecha)-3600);
			$fechaf = date("Y-m-d H:i:s", strtotime($fecha)+3600);			
			$citaDB = $this->db->get_where('cita', array(
				'usuario' => $usuario,
				'fechaInicio >= ' => $fechai,
				'fechaInicio <= ' => $fechaf,
				));
			return $citaDB;
		}

		public function getCitasRep($fecha)
		{
			$cita_data = array(
				'fechaInicio >= ' => $fecha,
				'fechaFin <= ' => $fecha,
				'estado > ' => 0
				);
			$citaDB = $this->db->get_where('cita', $cita_data);
			return $citaDB;
		}

		public function AgendarCita($usuario, $fecha, $asunto)
		{
			$hora = date("H:i", strtotime($fecha));
			$dia = date("N", strtotime($fecha));
			$Horario = $this->Tecnico->getHorarioTecnico($dia, $hora);
			if ($Horario->num_rows()==0) {
				$message = array(
					'message'	=> "Horario no valido.",
					'hora'		=> $hora,
					'dia'		=> $dia,
					'fecha'		=> $fecha,
					'result'	=> false);
				return $message;
			}
			$citaUser = $this->getCitaRep($usuario, $fecha);
			if ($citaUser->num_rows()>0) {
				$message = array(
					'message'	=> "Ya tiene citas planeadas.",
					'result'	=> false);
				return $message;
			}
			$citas = $this->getCitasRep($fecha);
			if ($citas->num_rows() < $Horario->num_rows()) {
				$cita = array(
					'fechaInicio'	=> $fecha, 
					'asunto'		=> $asunto,
					'estado'		=> 0,
					'usuario'		=> $usuario,
					);
				$insert = $this->db->insert('cita', $cita);
				if ($insert) {
					$cita["id"] = $this->db->insert_id();
					$message = array(
						'message'	=> "Cita Ingresada. Confirmacion Pendiente",
						'cita'		=> $cita,
						'result'	=> true,
						'error'		=> false,
						'fechai'	=> date("Y-m-d H:i:s", strtotime($fecha)-3600),
						'fechaf'	=> date("Y-m-d H:i:s", strtotime($fecha)+3600),
						'citaDB'	=> $citaUser,
						'citas'		=> $citas,
						);
					return $message;
				}
				else{
					$message = array(
						'message'	=> "Error al ingresar datos.",
						'result'	=> true,
						'error'		=> true);
					return $message;
				}

			}
			else{
				$message = array(
					'message'	=> "No hay Técnicos disponibles.",
					'result'	=> false);
				return $message;
			}

		}
	}