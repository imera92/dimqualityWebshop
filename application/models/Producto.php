<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /*
        Tabla:
            carrito
        Campos:
            id (Primary Key)
            nombre (varchar)
            marca (varchar)
            categoria (varchar)
            codigo (Unique)(varchar)
            imagen (varchar)
            pvp (varchar)
            descripcion (varchar)
            estado (int)
            stock (int)
            destacado (int)
            fechaCreacion (date)
    */

	class Producto extends CI_Model
    {
        private $id;
        private $nombre;
        private $marca;
        private $categoria;
        private $codigo;
        private $imagen;
        private $pvp;
        private $descripcion;
        private $estado;
        private $stock;
        private $destacado;
        private $fechaCreacion;


        function __construct() {
            parent::__construct();
            // Helpers
            $this->load->database();
            $this->load->library('session');
            $this->load->model('Marca');
            $this->load->model('Categoria');
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

        public function getMarca()
        {
            return $this->marca;
        }

        public function getCategoria()
        {
            return $this->categoria;
        }

        public function getCodigo()
        {
            return $this->codigo;
        }

        public function getImagen()
        {
            return $this->imagen;
        }

        public function getPVP()
        {
            return $this->pvp;
        }

        public function getDescripcion()
        {
            return $this->descripcion;
        }

        public function getEstado()
        {
            return $this->estado;
        }

        public function getStock()
        {
            return $this->stock;
        }

        public function getFechaCreacion()
        {
            return $this->fechaCreacion;
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

        public function setMarca($marca)
        {
            $this->marca = $marca;
        }

        public function setCategoria($categoria)
        {
            $this->categoria = $categoria;
        }

        public function setCodigo($codigo)
        {
            $this->codigo = $codigo;
        }

        public function setImagen($imagen)
        {
            $this->imagen = $imagen;
        }

        public function setPVP($pvp)
        {
            $this->pvp = $pvp;
        }

        public function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }

        public function setEstado($estado)
        {
            $this->estado = $estado;
        }

        public function setStock($stock)
        {
            $this->stock = $stock;
        }

        public function setFechaCreacion($fechaCreacion)
        {
            $this->fechaCreacion = $fechaCreacion;
        }

        ///////////////////////////////////
        // Métodos
        ///////////////////////////////////
        // Funcion para recuperar un producto de la DB usando el ID
        public function getProductoPorId($productoId)
        {
            if (!is_null($productoId)) {
                // Validamos que el Id de producto proporcionado sea valido
                if ($this->productoIdExists($productoId)) {
                    // Obtener instancia de CodeIgniter para manejo de la DB
                    $instanciaCI =& get_instance();

                    // Obtentemos el producto de la DB
                    $productoDB = $instanciaCI->db->get_where('producto', array('id' => $productoId))->last_row();

                    // Guardamos en la instancia los datos de producto traidos de la DB
                    $this->id = $productoDB->id;
                    $this->nombre = $productoDB->nombre;
                    $this->marca = $productoDB->marca;
                    $this->categoria = $productoDB->categoria;
                    $this->codigo = $productoDB->codigo;
                    $this->imagen = $productoDB->imagen;
                    $this->pvp = $productoDB->pvp;
                    $this->descripcion = $productoDB->descripcion;
                    $this->estado = $productoDB->estado;
                    $this->stock = $productoDB->stock;
                    $this->destacado = $productoDB->destacado;
                    $this->fechaCreacion = $productoDB->fechaCreacion; 
                    
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Funcion para recuperar todas las marcas segun la categoria
        public function getMarcasPorCategoria($categoriaId)
        {
            if (!is_null($categoriaId)) {
                $categoria = new Categoria();
                if ($categoria->categoriaIdExists($categoriaId)) {
                    $marcasArray = Array();

                    // Obtener instancia de CodeIgniter para manejo de la DB
                    $instanciaCI =& get_instance();

                    $instanciaCI->db->select('marca');
                    $instanciaCI->db->from('producto');
                    $instanciaCI->db->distinct();
                    $instanciaCI->db->where('categoria', $categoriaId);
                    $resultado = $instanciaCI->db->get()->result();

                    foreach ($resultado as $row) {
                        $marca = new Marca();
                        $marca->getMarcaPorId($row->marca);
                        array_push($marcasArray, $marca);
                    }

                    return $marcasArray;
                }
            }
        }

        // Funcion para comprobar si un producto está destacado
        public function isDestacado()
        {
            if ($this->destacado == 1) {
                return true;
            } else {
                return false;
            }
        }

        // Funcion para comprobar si un Id de producto existe en la DB
        public function productoIdExists($productoId)
        {
            if (!is_null($productoId)) {
                // Obtener instancia de CodeIgniter para manejo de la DB
                $instanciaCI =& get_instance();

                // Intentamos obtener el producto de la DB
                $productoDB = $instanciaCI->db->get_where('producto', array('id' => $productoId))->last_row();
                if (!is_null($productoDB)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function tieneStock()
        {
            if ($this->stock > 0) {
                return true;
            } else {
                return false;
            }
        }

        // Funcion para reducir el stock de un producto
        // Retorna TRUE si la operacion fue exitosa, FALSE si hubo algun error
        public function reducirStock($cantidad=1)
        {
            if (!is_null($cantidad)) {
                if ($this->stock > 0) {
                    // Obtener instancia de CodeIgniter para manejo de la DB
                    $instanciaCI =& get_instance();

                    // Reducimos el stock de la instancia de producto
                    $this->stock = $this->stock - $cantidad;

                    // Guardamos el stock actualizado en la DB
                    $resultado = $instanciaCI->db->update('producto', array('stock' => $this->stock), array('id' => $this->id));

                    return $resultado;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Funcion para buscar productos en base a un termino de busqueda enviado
        static public function buscarProducto($terminoBusqueda, $categoria = 0, $marca = 0, $rango = '')
        {   
            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            // Convertimos el string recibido en un arreglo de keywords
            $keywords = explode(' ', $terminoBusqueda);

            $productosDB = array();
            $productosEncontrados = array();
            // Buscamos coincidencias en los productos de la DB por cada keyword
            foreach ($keywords as $index => $keyword) {
                // Traemos de la DB todos los productos cuyo nombre coincida con el termino de busqueda
                $instanciaCI->db->select('id');
                $instanciaCI->db->from('producto');
                $instanciaCI->db->like('nombre', $keyword);
                $result = $instanciaCI->db->get()->result_array();
                foreach ($result as $index2 => $row) {
                    $producto = new Producto();
                    $producto->getProductoPorId($row['id']);
                    array_push($productosDB, $producto);
                }
                // print_r($productosDB);
                // die();

                // Traemos de la DB todos los productos cuya marca coincida con el termino de busqueda
                $marcasDB = Marca::getMarcasArrayPorNombre($keyword);
                if (!empty($marcasDB)) {
                    foreach ($marcasDB as $marcaDB) {
                        $instanciaCI->db->select('id');
                        $instanciaCI->db->from('producto');
                        $instanciaCI->db->where('marca', $marcaDB->getId());
                        $result = $instanciaCI->db->get()->result();

                        foreach ($result as $row) {
                            $producto = new Producto();
                            if ($producto->getProductoPorId($row->id)) {
                                array_push($productosDB, $producto);
                            }
                        }
                    }                    
                }
                // print_r($productosDB);
                // die();

                // Traemos de la DB todos los productos cuya categoria coincida con el termino de busqueda
                $categoriasDB = Categoria::getCategoriasArrayPorNombre($keyword);
                if (!empty($categoriasDB)) {
                    foreach ($categoriasDB as $categoriaDB) {
                        $instanciaCI->db->select('id');
                        $instanciaCI->db->from('producto');
                        $instanciaCI->db->where('categoria', $categoriaDB->getId());
                        $result = $instanciaCI->db->get()->result();

                        foreach ($result as $row) {
                            $producto = new Producto();
                            if ($producto->getProductoPorId($row->id)) {
                                array_push($productosDB, $producto);
                            }
                        }
                    }
                }
                // print_r($productosDB);
                // die();

                // Traemos de la DB todos los productos cuyo codigo coincida con el termino de busqueda
                $instanciaCI->db->select('id');
                $instanciaCI->db->from('producto');
                $instanciaCI->db->like('codigo', $keyword);
                $result = $instanciaCI->db->get()->result_array();
                foreach ($result as $index2 => $row) {
                    $producto = new Producto();
                    $producto->getProductoPorId($row['id']);
                    array_push($productosDB, $producto);
                }
                // print_r($productosDB);
                // die();

            }

            // Refinamos la busqueda para que no haya productos repetidos
            foreach ($productosDB as $productoDB) {
                if (!empty($productosEncontrados)) {
                    $flag  = false;
                    foreach ($productosEncontrados as $producto) {
                        if ($producto->getId() == $productoDB->getId()) {
                            $flag = true;
                        }
                    }

                    if ($flag == false) {
                        array_push($productosEncontrados, $productoDB);
                    }
                } else {
                    array_push($productosEncontrados, $productoDB);
                }
            }
            // print_r($productosEncontrados);
            // die();

            // FILTRADO DE PRODUCTOS
            // Si recibimos parametros de busqueda, filtramos el array de productos
            // Filtro por categoria
            if ($categoria != 0) {
                foreach ($productosEncontrados as $index => $producto) {
                    if ($producto->getCategoria() != $categoria) {
                        unset($productosEncontrados[$index]);
                    }
                }
            }
            // Filtro por marca
            if ($marca != 0) {
                foreach ($productosEncontrados as $index => $producto) {
                    if ($producto->getMarca() != $marca) {
                        unset($productosEncontrados[$index]);
                    }
                }
            }

            // Filtro por precio
            if ($rango != '') {
                $rango = explode('-', $rango);
                $min = $rango[0];
                $max = $rango[1];
                foreach ($productosEncontrados as $index => $producto) {
                    if ($producto->getPVP() < $min || $producto->getPVP() > $max) {
                        unset($productosEncontrados[$index]);
                    }
                }
            }

            return $productosEncontrados;
        }

        static public function productosRecientes($cantidad = 1)
        {
            $productosArray = Array();

            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            // Traemos de la DB los n productos recientes
            $instanciaCI->db->select('id');
            $instanciaCI->db->from('producto');
            $instanciaCI->db->where('estado', 1);
            $instanciaCI->db->order_by('fechaCreacion', 'DESC');
            $instanciaCI->db->limit($cantidad);
            $productosDB = $instanciaCI->db->get()->result_array();

            // Instanciamos los productos y los guardamos en el arreglo
            foreach ($productosDB as $index => $row) {
                $producto = new Producto();
                $producto->getProductoPorId($row['id']);
                array_push($productosArray, $producto);
            }

            return $productosArray;
        }

        static public function productosDestacados()
        {
            $productosArray = Array();

            // Obtener instancia de CodeIgniter para manejo de la DB
            $instanciaCI =& get_instance();

            // Traemos de la DB los n productos recientes
            $instanciaCI->db->select('id');
            $instanciaCI->db->from('producto');
            $instanciaCI->db->where('estado', 1);
            $instanciaCI->db->where('destacado', 1);
            $instanciaCI->db->order_by('fechaCreacion', 'DESC');
            $productosDB = $instanciaCI->db->get()->result_array();

            // Instanciamos los productos y los guardamos en el arreglo
            foreach ($productosDB as $index => $row) {
                $producto = new Producto();
                $producto->getProductoPorId($row['id']);
                array_push($productosArray, $producto);
            }

            return $productosArray;
        }
	}
?>