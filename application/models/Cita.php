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

		public function AgendarCita($usuario, $fecha, $asunto, $categoria)
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
					'categoria' 	=> $categoria,	
					);
				$insert = $this->db->insert('cita', $cita);
				if ($insert) {
					$cita["id"] = $this->db->insert_id();
					$message = array(
						'message'	=> "Cita Ingresada. Confirmacion Pendiente",
						'cita'		=> $cita,
						'result'	=> true,
						'error'		=> false,
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

		public function ModificarCita($usuario, $citaID, $fecha, $asunto, $categoria)
		{
			$oldcita = $this->db->get_where('cita', array('usuario' => $usuario, 'id' => $citaID,))->row();
			if (empty($oldcita)){
				return NULL;
			}
			if ($oldcita->estado == -1) {
				$message = array(
					'message'	=> "La cita fue cancelada agende una nueva cita.",
					'result'	=> false);
				return $message;
			}
			if ($oldcita->estado > 1) {
				$message = array(
					'message'	=> "La cita fue completada agende una nueva cita.",
					'result'	=> false);
				return $message;
			}
			if(strtotime($oldcita->fechaInicio) == strtotime($fecha)){
				$this->db->where('id', $citaID);
				$this->db->update('cita', array('asunto' => $asunto, 'categoria' => $categoria));
				$cita = $this->getCita($usuario, $citaID);
				$message = array(
					'message'	=> "Cita Actualizada.",
					'cita'		=> $cita,
					'result'	=> true,
					'error'		=> false,
					);
				return $message;
			}
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
			if ($citaUser->num_rows()>0  && $citaUser->row()->id!= $citaID) {
				$message = array(
					'message'	=> "Ya tiene citas planeadas.",
					'citas'		=> $citaUser->result_array(),
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
				$this->db->where('id', $citaID);
				$this->db->update('cita', $cita);
				$cita = $this->getCita($usuario, $citaID);
				if ($cita) {
					$message = array(
						'message'	=> "Cita Actualizada. Confirmacion Pendiente",
						'cita'		=> $cita,
						'result'	=> true,
						'error'		=> false,
						);
					return $message;
				}
				else{
					$message = array(
						'message'	=> "Error al actualizar los datos.",
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

		public function getCitas($usuario)
		{
			$citas = $this->db->get_where('cita', array('usuario' => $usuario,));
			$result = array(
				'citas' => $citas->result_array(),
				'usuario' => $usuario,
			 );
			return $result;
		}

		public function getCita($usuario, $citaID)
		{
			$citaDB = $this->db->get_where('cita', array('usuario' => $usuario, 'id' => $citaID,))->row();
			$cita = NULL;
			if ($citaDB) {
				$cita = array(
					'id'=> $citaDB->id,
					'usuario'=> $citaDB->usuario,
					'tecnico'=> $citaDB->tecnico,
					'fechaInicio'=> $citaDB->fechaInicio,
					'asunto'=> $citaDB->asunto,
					'estado'=> $citaDB->estado,
					'fechaFin'=> $citaDB->fechaFin,
					'fechaCreacion'=> $citaDB->fechaCreacion,
					);
				$mensajes = $this->db->get_where('citamensajes', array('cita' => $citaID,))->result_array();
				$cita["mensajes"]=$mensajes;
			}
			return $cita;
		}

		public function getCategoria($catID)
		{
			$catDB = $this->db->get_where('categoriacita', array('id' => $catID,))->row();
			$cat = NULL;
			if ($catDB) {
				$cat = array(
					'id' => $catDB->id,
					'nombre' => $catDB->nombre);
			}
			return $cat;
		}

		public function CancelarCita($usuario, $citaID)
		{
			$cita = $this->getCita($usuario, $citaID);
			if (empty($cita)) {
				return NULL;
			}
			if ($cita['estado'] == -1) {
				$citaCanc = array(
					'result' => false, 
					'message' => 'La cita ya esta cancelada.');
			}
			elseif ($cita['estado'] > 1) {
				$citaCanc = array(
					'result' => false, 
					'message' => 'La cita ya fue completada.');
			}
			else{
				$this->db->where('id', $cita['id']);
				$this->db->update('cita', array('estado' => -1, ));
				$citaCanc = array(
					'result' => true, 
					'message' => 'Cita cancelada.');
			}
			return $citaCanc;
		}

	}