<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            marca
        Campos:
            id (Primary Key)
            nombre (varchar)
    */

	class Marca extends CI_Model
    {
        private $id;
        private $nombre;


        function __construct() {
            parent::__construct();
            // Helpers
            $this->load->database();
        }

        ///////////////////////////////////
        // Getters
        ///////////////////////////////////
        public function getId()
        {
            return $this->id;
        }

        public function getNombre()
        {
            return $this->nombre;
        }

        ///////////////////////////////////
        // Setters
        ///////////////////////////////////
        public function setId($id)
        {
            $this->id = $id;
        }

        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }

        ///////////////////////////////////
        // Métodos
        ///////////////////////////////////
        // Funcion para recuperar una marca de la DB usando el ID
        public function getMarcaPorId($marcaId)
        {
            if (!is_null($marcaId)) {
                // Validamos que el Id de marca proporcionado sea valido
                if ($this->marcaIdExists($marcaId)) {
                    // Obtener instancia de CodeIgniter para manejo de la DB
                    $instanciaCI =& get_instance();

                    // Obtentemos la marca de la DB
                    $marcaDB = $instanciaCI->db->get_where('marca', array('id' => $marcaId))->last_row();

                    // Guardamos en la instancia los datos de producto traidos de la DB
                    $this->id = $marcaDB->id;
                    $this->nombre = $marcaDB->nombre;
                    
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Funcion para comprobar si un Id de marca existe en la DB
        public function marcaIdExists($marcaId)
        {
            if (!is_null($marcaId)) {
                // Obtener instancia de CodeIgniter para manejo de la DB
                $instanciaCI =& get_instance();

                // Intentamos obtener la marca de la DB
                $marcaDB = $instanciaCI->db->get_where('marca', array('id' => $marcaId))->last_row();
                if (!is_null($marcaDB)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Metodo para obtener la ultima marca anadida a la DB
        public function getLastMarca()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            $instanciaCI->db->select('*');
            $instanciaCI->db->from('marca');
            $instanciaCI->db->order_by('id', 'DESC');
            $instanciaCI->db->limit(1);
            $marcaDB = $instanciaCI->db->get()->row();
            if (!is_null($marcaDB)) {
                $this->id = $marcaDB->id;
                $this->nombre = $marcaDB->nombre;

                return true;
            } else {
                return false;
            }
        }

        // Metodo par obtener el ID de la ultima marca anadida a la DB
        // Retorna el ID si la operacion fue exitosa, NULL si no encontro marcas en la DB
        public function getLastMarcaId()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            $instanciaCI->db->select('id');
            $instanciaCI->db->from('marca');
            $instanciaCI->db->order_by('id', 'DESC');
            $instanciaCI->db->limit(1);
            $result = $instanciaCI->db->get()->row();
            if (!is_null($result)) {
                $lastId = $result->id;
            } else {
                $lastId = null;
            }

            return $lastId;
        }

        // Metodo para guardar una nueva marca en la DB
        // Retorna TRUE si la operacion fue exitosa, FALSE si hubo algun error
        public function guardarNuevaMarca()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            $this->setId($this->getLastMarcaId() + 1);

            // Guardamos los datos de la nueva marca
            $resultado = $instanciaCI->db->insert('marca', array(
                'id' => $this->id,
                'nombre' => $this->nombre
            ));

            return $resultado;
        }

        // Metodo que devuelve un array con todas las marcas existentes en la DB
        public static function marcasArray()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            $instanciaCI->db->select('*');
            $instanciaCI->db->from('marca');
            $result = $instanciaCI->db->get()->result();

            $marcasArray = Array();
            if (!empty($result)) {
                foreach ($result as $row) {
                    $marca = new Marca();
                    $marca->setId($row->id);
                    $marca->setNombre($row->nombre);
                    array_push($marcasArray, $marca);
                }
            }

            return $marcasArray;
        }

        public static function getMarcasArrayPorNombre($nombre)
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            $instanciaCI->db->select('id');
            $instanciaCI->db->from('marca');
            $instanciaCI->db->like('nombre', $nombre);
            $result = $instanciaCI->db->get()->result();

            $marcasArray = Array();
            if (!empty($result)) {
                foreach ($result as $row) {
                    $marca = new Marca();
                    $marca->getMarcaPorId($row->id);
                    array_push($marcasArray, $marca);
                }
            }

            return $marcasArray;
        }
	}
?>