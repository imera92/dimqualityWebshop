<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            ofertasubasta
        Campos:
			id
			subasta
			usuario
			monto
			fecha

    */

	class Oferta extends CI_Model{
        private $id;
		private $subasta_id;
        private $usuario;
        private $monto;
        private $fecha;
        private $db_table;


        function __construct()
        {
            parent::__construct();

            // Helpers
            $this->load->database();
            $this->db_table = 'ofertasubasta';

            // Modelos
            $this->load->model('ShopUser');
        }

        ///////////////////////////////////
        // Getters
        ///////////////////////////////////
        public function get_id()
        {
            return $this->id;
        }
        public function get_subasta_id()
        {
        	return $this->subasta_id;
        }
        public function get_usuario()
        {
        	return $this->usuario;
        }
        public function get_monto()
        {
        	return $this->monto;
        }
        public function get_fecha()
        {
        	return $this->fecha;
        }

		///////////////////////////////////
        // Métodos
        ///////////////////////////////////
        public function fetch_by_id($oferta_id)
        {   
            if (!is_null($oferta_id)) {
                // Comprobamos si el id de oferta existe en la DB
                if ($this->id_exists($oferta_id)) {
                    // Recuperamos la oferta de la DB
                    $oferta_db = $this->db->get_where($this->db_table, array('id' => $oferta_id))->last_row();
                    $this->id = $oferta_db->id;
                    $this->subasta_id = $oferta_db->subasta;
                    $this->monto = $oferta_db->monto;
                    $this->fecha = $oferta_db->fecha;

                    // Obtenemos la instancia del usuario que realizó la oferta
                    $usuario_db = $this->db->get_where('usuario', array('id' => $oferta_db->usuario))->last_row();
                    $this->usuario = $usuario_db;

                    return true;
                } else {
                    return false;
                }
            } else {
                return null;
            }
        }

		// Método para comprobar si un id de oferta existe en la DB
		public function id_exists($oferta_id)
		{
			if (!is_null($oferta_id)) {
				// Intentamos obtener la oferta de la DB
				$subasta_db = $this->db->get_where($this->db_table, array('id' => $oferta_id))->last_row();

				if (!is_null($subasta_db)) {
					return true;
				} else {
					return false;
				}
			} else {
				return null;
			}
		}

        // Método para obtener el ID de la útlima oferta insertada en la DB
        public function get_last_oferta_id()
        {
            $this->db->select('id');
            $this->db->from($this->db_table);
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $result = $this->db->get()->row();
            if (!is_null($result)) {
                $last_oferta_id = $result->id;
            } else {
                $last_oferta_id = null;
            }

            return $last_oferta_id;
        }

        // Método para crear una nueva instancia de oferta con el ID que le corresponde
        public function create_new_oferta($subasta_id, $usuario_id, $monto)
        {
            // Recuperamos el ID de la última oferta insertada en la DB
            $last_oferta_id = $this->get_last_oferta_id();

            // Obtenemos una instancia del usuario que realizó la oferta
            $usuario_db = $this->db->get_where('usuario', array('id' => $usuario_id))->last_row();

            $this->id = $last_oferta_id + 1;
            $this->subasta_id = $subasta_id;
            $this->usuario = $usuario_db;
            $this->monto = $monto;
            $this->fecha = date('Y-m-d') . ' ' . date('H:i:s');
        }

        // RECORDAR: la instancia de Oferta es una interfaz entre la aplicacion y la DB.
        // Primero modificamos la instancia, y luego utilizamos sus métodos para propagar los cambios a la DB.
        public function save_new_oferta()
        {
            if ($this->id != null && $this->subasta_id != null && $this->usuario != null && $this->monto != null && $this->fecha != null) {
                // Guardamos los datos de la nueva oferta
                $this->db->insert($this->db_table, array(
                    'id' => $this->id,
                    'subasta' => $this->subasta_id,
                    'usuario' =>$this->usuario->id,
                    'monto' => $this->monto,
                    'fecha' => $this->fecha
                ));
            }
        }
	}
?>
