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
        public function getCategoriaPorId($categoriaId)
        {
            if (!is_null($categoriaId)) {
                // Validamos que el Id de categoria proporcionado sea valido
                if ($this->categoriaIdExists($categoriaId)) {
                    // Obtener instancia de CodeIgniter para manejo de la DB
                    $instanciaCI =& get_instance();

                    // Obtentemos la categoria de la DB
                    $categoriaDB = $instanciaCI->db->get_where('categoriaproducto', array('id' => $categoriaId))->last_row();

                    // Guardamos en la instancia los datos de producto traidos de la DB
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

        // Funcion para comprobar si un Id de marca existe en la DB
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

        // Metodo para obtener la ultima categoria anadida a la DB
        public function getLastCategoria()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            $instanciaCI->db->select('*');
            $instanciaCI->db->from('categoriaproducto');
            $instanciaCI->db->order_by('id', 'DESC');
            $instanciaCI->db->limit(1);
            $categoriaDB = $instanciaCI->db->get()->row();
            if (!is_null($categoriaDB)) {
                $this->id = $categoriaDB->id;
                $this->nombre = $categoriaDB->nombre;

                return true;
            } else {
                return false;
            }
        }

        // Metodo par obtener el ID de la ultima categoria anadida a la DB
        // Retorna el ID si la operacion fue exitosa, NULL si no encontro categorias en la DB
        public function getLastCategoriaId()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            $instanciaCI->db->select('id');
            $instanciaCI->db->from('categoriaproducto');
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

        // Metodo para guardar una nueva categoria en la DB
        // Retorna TRUE si la operacion fue exitosa, FALSE si hubo algun error
        public function guardarNuevaCategoria()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            $this->setId($this->getLastCategoriaId() + 1);

            // Guardamos los datos de la nueva marca
            $resultado = $instanciaCI->db->insert('categoriaproducto', array(
                'id' => $this->id,
                'nombre' => $this->nombre
            ));

            return $resultado;
        }

        // Metodo que devuelve un array con todas las marcas existentes en la DB
        public static function categoriasArray()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            $instanciaCI->db->select('*');
            $instanciaCI->db->from('categoriaproducto');
            $result = $instanciaCI->db->get()->result();

            $categoriasArray = Array();
            if (!empty($result)) {
                foreach ($result as $row) {
                    $categoria = new Categoria();
                    $categoria->setId($row->id);
                    $categoria->setNombre($row->nombre);
                    array_push($categoriasArray, $categoria);
                }
            }

            return $categoriasArray;
        }

        // Metodo que devuelve un array con todas las marcas existentes en la DB que tienen productos disponibles
        public static function get_categorias_activas_array()
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instancia_CI =& get_instance();

            // Obtenemos los ID de las categorias de productos activos
            $instancia_CI->db->select('categoria');
            $instancia_CI->db->from('producto');
            $instancia_CI->db->distinct();
            $instancia_CI->db->where(array(
                'estado' => 1,
                'stock>' => 0
            ));
            $result = $instancia_CI->db->get()->result();

            /*$instanciaCI->db->select('*');
            $instanciaCI->db->from('categoriaproducto');
            $result = $instanciaCI->db->get()->result();*/

            $categorias_array = Array();
            if (!empty($result)) {
                foreach ($result as $row) {
                    $categoria = new Categoria();
                    $categoria->getCategoriaPorId($row->categoria);
                    array_push($categorias_array, $categoria);
                }
            }
            
            return $categorias_array;
        }

        public static function getCategoriasArrayPorNombre($nombre)
        {
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            $instanciaCI->db->select('id');
            $instanciaCI->db->from('categoriaproducto');
            $instanciaCI->db->like('nombre', $nombre);
            $result = $instanciaCI->db->get()->result();

            $categoriasArray = Array();
            if (!empty($result)) {
                foreach ($result as $row) {
                    $categoria = new Categoria();
                    $categoria->getCategoriaPorId($row->id);
                    array_push($categoriasArray, $categoria);
                }
            }

            return $categoriasArray;
        }
	}
?>