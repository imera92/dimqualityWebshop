<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* Transaccion
	*/
	class Transaccion extends CI_Model
	{
		private $id;
		private $fechaCompra;
		private $fechaPago;
		private $fechaEntrega;
		private $usuario;
		private $total;
		private $estado;
		private $formaPago;
		private $nombreFactura;
		private $cedulaFactura;
		private $direccionFactura;
		private $entregaDomicilio;
		private $nombreEntrega;
		private $direccionEntrega;
		private $productosTransaccion
		
		function __construct()
		{
			parent::__construct();
            // Helpers
            $this->load->database();
            $this->load->library('session');

            // Modelos Requeridos
            $this->load->model('ShopUser');
            $this->load->model('Producto');
            $this->load->model('ProductoTransaccion');
            
		}

		/*
		Getters
		*/
		public function getId()
		{
			return $this->$id;
		}

		public function getFechaCompra()
		{
			return $this->$fechaPago;
		}

		public function getFechaPago()
		{
			return $this->$fechaPago;
		}

		public function getFechaEntrega()
		{
			return $this->$fechaEntrega;
		}

		public function getUsuario()
		{
			return $this->$usuario;
		}

		public function getTotal()
		{
			return $this->$total;
		}

		public function getEstado()
		{
			return $this->$estado;
		}

		public function getFormaPago()
		{
			return $this->$formaPago;
		}

		public function getNombreFactura()
		{
			return $this->$nombreFactura;
		}

		public function getCedulaFactura()
		{
			return $this->$cedulaFactura;
		}

		public function getDireccionFactura()
		{
			return $this->$direccionFactura;
		}

		public function getEntregaDomicilio()
		{
			return $this->$entregaDomicilio;
		}

		public function getNombreEntrega()
		{
			return $this->$nombreEntrega;
		}

		public function getDireccionEntrega()
		{
			return $this->$direccionEntrega;
		}



		/*
		Setters
		*/
		public function setId($id)
		{
			$this->$id = $id;
		}

		public function setFechaCompra($fechaCompra)
		{
			$this->$fechaPago = $fechaCompra;
		}

		public function setFechaPago($fechaPago)
		{
			$this->$fechaPago = $fechaPago;
		}

		public function setFechaEntrega($fechaEntrega)
		{
			$this->$fechaEntrega = $fechaEntrega;
		}

		public function setUsuario($usuario)
		{
			$this->$usuario = $usuario;
		}

		public function setTotal($total)
		{
			$this->$total = $total;
		}

		public function setEstado($estado)
		{
			$this->$estado = $estado;
		}

		public function setFormaPago($formaPago)
		{
			$this->$formaPago = $formaPago;
		}

		public function setNombreFactura($nombreFactura)
		{
			$this->$nombreFactura = $nombreFactura;
		}

		public function setCedulaFactura($cedulaFactura)
		{
			$this->$cedulaFactura = $cedulaFactura;
		}

		public function setDireccionFactura($direccionFactura)
		{
			$this->$direccionFactura = $direccionFactura;
		}

		public function setEntregaDomicilio($entregaDomicilio)
		{
			$this->$entregaDomicilio = $entregaDomicilio;
		}

		public function setNombreEntrega($nombreEntrega)
		{
			$this->$nombreEntrega = $nombreEntrega;
		}

		public function setDireccionEntrega($direccionEntrega)
		{
			$this->$direccionEntrega = $direccionEntrega;
		}

		/*
		Metodos
		*/
		
	}
?>