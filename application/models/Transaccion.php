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
		private $tipoEntrega;
		private $recibe;
		private $direccionEntrega;
		private $itemsTransaccion;
		
		function __construct()
		{
			parent::__construct();
            // Helpers
            $this->load->database();
            $this->load->library('session');

            // Modelos Requeridos
            $this->load->model('ShopUser');
            $this->load->model('Producto');
            $this->load->model('ItemTransaccion');
            $this->load->model('CarritoDeCompras');
            $this->load->model('ProductoCarrito');
            
		}

		/*
		Getters
		*/
		public function getId()
		{
			return $this->id;
		}

		public function getFechaCompra()
		{
			return $this->fechaCompra;
		}

		public function getFechaPago()
		{
			return $this->fechaPago;
		}

		public function getFechaEntrega()
		{
			return $this->fechaEntrega;
		}

		public function getUsuario()
		{
			return $this->usuario;
		}

		public function getTotal()
		{
			return $this->total;
		}

		public function getEstado()
		{
			return $this->estado;
		}

		public function getFormaPago()
		{
			return $this->formaPago;
		}

		public function getNombreFactura()
		{
			return $this->nombreFactura;
		}

		public function getCedulaFactura()
		{
			return $this->cedulaFactura;
		}

		public function getDireccionFactura()
		{
			return $this->direccionFactura;
		}

		public function getTipoEntrega()
		{
			return $this->tipoEntrega;
		}

		public function getRecibe()
		{
			return $this->recibe;
		}

		public function getDireccionEntrega()
		{
			return $this->direccionEntrega;
		}

		public function getItemsTransaccion()
		{
			return $this->itemsTransaccion;
		}



		/*
		Setters
		*/
		public function setId($id)
		{
			$this->id = $id;
		}

		public function setFechaCompra($fechaCompra)
		{
			$this->fechaCompra = $fechaCompra;
		}

		public function setFechaPago($fechaPago)
		{
			$this->fechaPago = $fechaPago;
		}

		public function setFechaEntrega($fechaEntrega)
		{
			$this->fechaEntrega = $fechaEntrega;
		}

		public function setUsuario($usuario)
		{
			$this->usuario = $usuario;
		}

		public function setTotal($total)
		{
			$this->total = $total;
		}

		public function setEstado($estado)
		{
			$this->estado = $estado;
		}

		public function setFormaPago($formaPago)
		{
			$this->formaPago = $formaPago;
		}

		public function setNombreFactura($nombreFactura)
		{
			$this->nombreFactura = $nombreFactura;
		}

		public function setCedulaFactura($cedulaFactura)
		{
			$this->cedulaFactura = $cedulaFactura;
		}

		public function setDireccionFactura($direccionFactura)
		{
			$this->direccionFactura = $direccionFactura;
		}

		public function setTipoEntrega($tipoEntrega)
		{
			$this->tipoEntrega = $tipoEntrega;
		}

		public function setRecibe($recibe)
		{
			$this->recibe = $recibe;
		}

		public function setDireccionEntrega($direccionEntrega)
		{
			$this->direccionEntrega = $direccionEntrega;
		}

		///////////////////////////////////
		// Métodos
		///////////////////////////////////
		// Funcion para recuperar una transaccion de la DB usando el ID
		public function getTransaccionPorId($transaccionId)
		{	
			// Obtener instancia de CodeIgniter para manejo de la DB
			$instanciaCI =& get_instance();

		    if (!is_null($transaccionId)) {
		        // Validamos que el Id de transaccion proporcionado sea valido
		        if ($this->transaccionIdExists($transaccionId)) {
		            // Obtentemos la transaccion de la DB
		            $transaccionDB = $instanciaCI->db->get_where('transaccion', array('id' => $transaccionId))->last_row();
		            $itemsTransaccionDB = $instanciaCI->db->get_where('itemtransaccion', array('transaccion' => $transaccionId))->result();

		            // Guardamos en la instancia los datos de transaccion traidos de la DB
		            $this->id = $transaccionDB->id;
		            $fechaCompra = ($transaccionDB->fechaCompra != '') ? new DateTime($transaccionDB->fechaCompra) : '';
		            $this->fechaCompra = $fechaCompra;
		            $fechaPago = ($transaccionDB->fechaPago != '') ? new DateTime($transaccionDB->fechaPago) : '';
		            $this->fechaPago = $fechaPago;
		            $fechaEntrega = ($transaccionDB->fechaEntrega != '') ? new DateTime($transaccionDB->fechaEntrega) : '';
		            $this->fechaEntrega = $fechaEntrega;
		            $this->usuario = $transaccionDB->usuario;
		            $this->total = $transaccionDB->total;
		            $this->estado = $transaccionDB->estado;
		            $this->formaPago = $transaccionDB->formaPago;
		            $this->nombreFactura = $transaccionDB->nombreFactura;
		            $this->cedulaFactura = $transaccionDB->cedulaFactura;
		            $this->direccionFactura = $transaccionDB->direccionFactura;
		            $this->tipoEntrega = $transaccionDB->tipoEntrega;
		            $this->recibe = $transaccionDB->recibe;
		            $this->direccionEntrega = $transaccionDB->direccionEntrega;
	                $this->itemsTransaccion = array();

		            if (!is_null($itemsTransaccionDB)) {
		                foreach ($itemsTransaccionDB as $row) {
		                    $productoDB = new Producto();
		                    if ($productoDB->getProductoPorId($row->producto)) {
		                        $itemTransaccion = new ItemTransaccion();
		                        $itemTransaccion->setProducto($productoDB);
		                        $itemTransaccion->setCantidad($row->cantidad);
		                        $itemTransaccion->setTransaccion($row->transaccion);
		                        $itemTransaccion->setSubtotal($row->subtotal);
		                        array_push($this->itemsTransaccion, $itemTransaccion);
		                    }
		                }
		            }
		            
		            return true;
		        } else {
		            return false;
		        }
		    } else {
		        return false;
		    }
		}

		// Funcion para comprobar si un Id de marca existe en la DB
        public function transaccionIdExists($transaccionId)
        {
    		// Obtener instancia de CodeIgniter para manejo de la DB
    		$instanciaCI =& get_instance();

            if (!is_null($transaccionId)) {
                // Intentamos obtener la marca de la DB
                $transaccionDB = $instanciaCI->db->get_where('transaccion', array('id' => $transaccionId))->last_row();
                if (!is_null($transaccionDB)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

		public function loadCarrito($carrito)
		{
			$this->itemsTransaccion = array();
			$prodsCarrito = $carrito->getProductosCarrito();
			foreach ($prodsCarrito as $prodC) {
				$itemT = new ItemTransaccion();
				$itemT->setProducto($prodC->getProducto());
				$itemT->setCantidad($prodC->getCantidad());
				$itemT->setSubtotal($prodC->getCosto());
				array_push($this->itemsTransaccion, $itemT);
			}
		}

		public function insertarDB()
		{
			$data=array(
				'fechaCompra' => $this->fechaCompra,
				'fechaPago' => $this->fechaPago,
				'fechaEntrega' => $this->fechaEntrega,
				'usuario' => $this->usuario,
				'total' => $this->total,
				'estado' => $this->estado,
				'formaPago' => $this->formaPago,
				'nombreFactura' => $this->nombreFactura,
				'cedulaFactura' => $this->cedulaFactura,
				'direccionFactura' => $this->direccionFactura,
				'tipoEntrega' => $this->tipoEntrega,
				'recibe' => $this->recibe,
				'direccionEntrega' => $this->direccionEntrega
			);
			$this->db->trans_begin();
			$insert = $this->db->insert('transaccion', $data);
			if ($insert) {
				$this->id = $this->db->insert_id();
				foreach ($this->itemsTransaccion as $itemT) {
					$itemT->setTransaccion($this->id);
					$insertT = $itemT->guardarItemTransaccionDB();
					if (!$insertT) {
						$this->db->trans_rollback();
						return false;
					}
				}
				$this->db->trans_commit();
				return true;
			}
			$this->db->trans_rollback();
			return false;		
		}

		// Metodo que devuelve un array con todas las transacciones de un usuario
		public static function getTransaccionesArrayPorUsuario($usuarioId)
		{
			// Obtener instancia de CodeIgniter para manejo de la DB
			$instanciaCI =& get_instance();

			$result = $instanciaCI->db->get_where('transaccion', array('usuario' => $usuarioId))->result();

			$transaccionesArray = Array();
			if (!empty($result)) {
				foreach ($result as $row) {
					$transaccion = new Transaccion();
					$transaccion->getTransaccionPorId($row->id);
					array_push($transaccionesArray, $transaccion);
				}
			}

			return $transaccionesArray;
		}
	}
?>