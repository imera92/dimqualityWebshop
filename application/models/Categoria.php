<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            categoriaproducto
        Campos:
            id (Primary Key)
            nombre (varchar)
    */

	class Categoria extends CI_Model
    {
        private $id;
		private $nombre;

        function __construct() {
            parent::__construct();
            // Helpers
            $this->load->database();
            $this->load->library('session');
        }

        ///////////////////////////////////
        // Getters
        ///////////////////////////////////
        public function getId()
        {
            return $this->id;
        }
        public function getNombre(){
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
        // Funcion para recuperar una categoria de la DB usando el ID
        public function getProductoPorId($categoriaId)
        {
            if (!is_null($categoriaId)) {
                // Validamos que el Id de la categoria proporcionado sea valido
                if ($this->categoriaIdExists($categoriaId)) {
                    // Obtener instancia de CodeIgniter para manejo de la DB
                    $instanciaCI =& get_instance();

                    // Obtentemos la categoria de la DB
                    $categoriaDB = $instanciaCI->db->get_where('categoriaproducto', array('id' => $categoriaId))->last_row();

                    // Guardamos en la instancia los datos de la categoria traidos de la DB
                    $this->id = $categoriaDB->id;
                    $this->nombre = $categoriaDB->nombre;
                    
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Funcion para comprobar si un Id de categoria existe en la DB
        public function categoriaIdExists($categoriaId)
        {
            if (!is_null($categoriaId)) {
                // Obtener instancia de CodeIgniter para manejo de la DB
                $instanciaCI =& get_instance();

                // Intentamos obtener la categoria de la DB
                $categoriaDB = $instanciaCI->db->get_where('categoriaproducto', array('id' => $categoriaId))->last_row();
                if (!is_null($categoriaDB)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
	}
?>