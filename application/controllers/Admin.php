<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('grocery_CRUD');
        $this->load->model('SecurityUser');
        date_default_timezone_set("America/Guayaquil");
	}

	public function login() {
        if($this->securityCheckAdmin()){
            redirect("admin/index");
        }else{
            $titulo = "Dimquality::Admin";
            $dataHeader['titlePage'] = $titulo;

            $this->load->view('admin/header', $dataHeader);
            $this->load->view('admin/login');
            $this->load->view('admin/footer');
        }
    }

    public function index() {
    	if ($this->securityCheckAdmin()) {
    		$titulo = "Dimquality::Admin - Inicio";

    		$dataHeader['titlePage'] = $titulo;

    		$this->load->view('admin/header', $dataHeader);
    		$this->load->view('admin/lat-menu');
    		$this->load->view('admin/index');
    		$this->load->view('admin/footer');
    	} else {
    		redirect("admin/login");
    	}
    }

	public function logout() {
        if($this->securityCheckAdmin()){
            $securityUser = new SecurityUser();
            $securityUser->logout();
            redirect("admin/login");
        }else{
            redirect("admin/login");
        }
    }

	public function auth() {
        $user = $this->input->post("user");
        $password = $this->input->post("password");

        $securityUser = new SecurityUser();
        $securityUser->login_admin($user, $password);

        if($this->session->userdata('user') != "" && $this->session->userdata('tipo') == "admin"){
            redirect("admin/index");
        }else{
            redirect("admin/login");
        }
    }

    public function productos() {
        if ($this->securityCheckAdmin()) {
            $titulo = "Productos";

            $crud=new grocery_CRUD();
            $crud->set_subject($titulo);
            $crud->set_table('producto');
            $crud->columns('nombre','marca','categoria','codigo','imagen','pvp','descripcion','estado','stock','destacado');
            $crud->required_fields('nombre','marca','categoria','codigo','pvp','estado','stock','destacado');
            $crud->field_type('estado', 'dropdown', array(
                '1' => 'Activo',
                '2' => 'Inactivo'
            ));
            $crud->field_type('destacado','dropdown', array(
                '1' => 'Destacado',
                '2' => 'No Destacado'
            ));
            $crud->field_type('stock','integer');
            $crud->field_type('fechaCreacion', 'invisible');
            $crud->set_rules('estado', 'Estado', 'callback_estado_check');
            $crud->set_rules('destacado', 'Destacado', 'callback_destacado_check');
            $crud->set_field_upload('imagen', 'assets/uploads/images/productos');
            $crud->display_as('codigo', 'Código');
            $crud->display_as('categoria', 'Categoría');
            $crud->display_as('pvp', 'PVP');
            $crud->display_as('descripcion', 'Descripción');
            $crud->unset_export();
            $crud->unset_print();
            // $crud->unset_texteditor('descripcion','full_text');
            $crud->field_type('descripcion', 'text');
            $crud->set_language('spanish');
            $crud->callback_before_insert(array($this,'know_date'));
            $output=$crud->render();
            $dataHeader['titlePage'] = 'Dimquality::Admin - Productos';
            $dataHeader['titleCRUD'] = $titulo;
            $dataHeader['css_files']=$output->css_files;
            $dataFooter['js_files']=$output->js_files;
            $this->load->view('admin/header', $dataHeader);
            $this->load->view('admin/lat-menu');
            $this->load->view('admin/blank',(array)$output);
            $this->load->view('admin/footer-gc', $dataFooter);
        } else {
            redirect("admin/login");
        }
    }

    public function estado_check($estado){
        if ($estado == 1) {
            if ($this->input->post('stock') > 0) {
                return TRUE;
            } else {
                $this->form_validation->set_message('estado_check', 'El producto tiene stock igual a 0. No puede estar como activo.');
                return FALSE;
            }
        }
    }

    public function destacado_check($destacado){
        if($destacado == 1){
            if ($this->input->post('stock') > 0) {
                if ($this->input->post('estado') == 1) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('destacado_check', 'El producto está inactivo. No se puede destacar.');
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('destacado_check', 'El producto tiene stock igual a 0. No se puede destacar.');
                return FALSE;
            }
        }
    }

    public function know_date($post_array){
        $post_array['fechaCreacion'] = date("Y-m-d");
        return $post_array;
    }  

    public function actualizarCatalogo() {
        if ($this->securityCheckAdmin()) {
            $titulo = "Dimquality::Admin - Actualizar Catalogo";

            $dataHeader['titlePage'] = $titulo;

            $this->load->view('admin/header', $dataHeader);
            $this->load->view('admin/lat-menu');
            $this->load->view('admin/catalogo');
            $this->load->view('admin/footer');
        } else {
            redirect("admin/login");
        }
    }

    public function subirExcel() {
        // RECORDAR: ES NECESARIO QUE LOS VALORES SUPERIORES A 999 NO TENGAN SEPARADOR DE MILES
        if ($this->securityCheckAdmin()) {

            $config['upload_path'] = './assets/uploads/excel';
            $config['allowed_types'] = 'xlsx';
            $config['max_size'] = 200;
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile')) {
                $titulo = "Dimquality::Admin - Actualizar Catalogo";
                $dataHeader['titlePage'] = $titulo;

                $this->load->view('admin/header', $dataHeader);
                $this->load->view('admin/lat-menu');
                $dataBody = array('success' => 0, 'message' => 'No seleccionó un archivo para actualizar el catálogo.');
                $this->load->view('admin/catalogo', $dataBody);
                $this->load->view('admin/footer');
            } else {
                $this->load->library('phpexcel');
                $this->load->library('PHPExcel/iofactory');
                $this->load->library('PHPExcel/autoloader');
                $this->load->helper("file");
                
                $fileName = $this->upload->data()['file_name'];
                $path = FCPATH."assets\uploads\\excel";
                $filePath = FCPATH."assets\uploads\\excel\\".$fileName;
                $excelReader = IOFactory::createReaderForFile($filePath);

                $excelReader->setReadDataOnly();
                $excelObj = $excelReader->load($filePath);

                // Establecer la hoja activa del documento por su nombre
                // $excelObj->setActiveSheetIndexByName('Hoja1');
                $excelObj->setActiveSheetIndex(0);

                // Crear un arreglo asociativo con las filas y columnas del documento y su contenido
                $return = $excelObj->getActiveSheet()->toArray(null, true,true,true);
                
                // Eliminamos las celdas vacias
                foreach ($return as $key1 => $row) {
                    foreach ($row as $key2 => $col) {
                        if ($col === null) {
                            unset($return[$key1][$key2]);
                        }
                    }
                }

                // Eliminamos las celdas con contenido basura
                foreach ($return as $key1 => $row) {
                    foreach ($row as $key2 => $col) {
                        if ($col === 'PRECIOS INCLUYEN IVA' || $col === 'DIMQUALITY' || $col === 'GENERAL' || $col === 'PRECIO CON TARJETA DE CREDITO' || $col === 'PRECIO EFECTIVO' || $col === 'PRECIO NEGOCIO' || $col === 'INV. GYE' || $col === 'INV. TOTAL' || $col === 'MODELOS ' || $col === 'CARACTERÍSTICAS ') {
                            unset($return[$key1][$key2]);
                        }
                    }
                }

                // Eliminamos las filas en las que todas las celdas estan vacias
                foreach ($return as $key1 => $row) {
                    if (Admin::checkEmptyAsocArray($return[$key1])) {
                        unset($return[$key1]);
                    }
                }

                // Obtenemos todas las marcas de la DB y las guardamos en un array
                $this->db->select('nombre');
                $this->db->from('marca');
                $marcasDB = $this->db->get()->result_array();

                // Obtenemos todas las categorias de la DB y las guaradmos en un array
                $this->db->select('nombre');
                $this->db->from('categoriaproducto');
                $categoriasDB = $this->db->get()->result_array();

                if (!empty($marcasDB)) {
                    foreach ($marcasDB as $index => $row) {
                        $marcasArray[] = $row['nombre'];
                    }                    
                } else {
                    $marcasArray = array();
                }

                if (!empty($categoriasDB)) {
                    foreach ($categoriasDB as $index => $row) {
                        $categoriasArray[] = $row['nombre'];
                    }                    
                } else {
                    $categoriasArray = array();
                }

                /*header('Content-type: application/json');
                echo json_encode($return);
                delete_files($path);
                die();*/


                // Inicializamos las variables para evitar errores durance el proceso
                $marca = '';
                $categoria = '';
                $flag = 0;

                foreach ($return as $key1 => $row) {
                    if ($key1 > 1) {
                        if ((count($row) == 1)) {
                            $flag = 1;
                        } else {
                            $flag = 2;
                        }
                    }

                    // Empezamos a validar los datos del archivo
                    if ($flag == 0) {
                        $marca = $return[$key1]['A'];
                        if (!in_array($marca, $marcasArray)) {
                            $data = array(
                                    'nombre' => $marca
                            );

                            $this->db->insert('marca', $data);
                        }
                        $flag++;
                    } elseif ($flag == 1) {
                        $categoria = $return[$key1]['A'];
                        if (!in_array($categoria, $categoriasArray)) {
                            $data = array(
                                    'nombre' => $categoria
                            );

                            $this->db->insert('categoriaproducto', $data);
                        }
                    } elseif ($flag == 2) {
                        $codigoProducto = current($return[$key1]);
                        $nombreProducto = next($return[$key1]);

                        next($return[$key1]);
                        $pvpProducto = next($return[$key1]);
                        next($return[$key1]);
                        $stockProducto = next($return[$key1]);
                        $productoExistente = $this->db->get_where('producto', array('codigo' => $codigoProducto))->result_array();
                        $fechaActual = date('Y-m-d');
                        if (empty($productoExistente)) {
                            $datosProducto = array(
                                'nombre' => $nombreProducto,
                                'marca' => $marca,
                                'categoria' => $categoria,
                                'codigo' => $codigoProducto,
                                'imagen' => '',
                                'pvp' => $pvpProducto,
                                'descripcion' => '',
                                'estado' => ($stockProducto > 0) ? 1 : 2,
                                'stock' => $stockProducto,
                                'destacado' => 2,
                                'fechaCreacion' => $fechaActual = date('Y-m-d')
                            );
                            $this->db->insert('producto', $datosProducto);
                        } else {
                            $datosProducto = array(
                                'nombre' => $nombreProducto,
                                'marca' => $marca,
                                'categoria' => $categoria,
                                'imagen' => '',
                                'pvp' => $pvpProducto,
                                'descripcion' => '',
                                'estado' => ($stockProducto > 0) ? 1 : 2,
                                'stock' => $stockProducto,
                                'destacado' => 2,
                            );
                            $this->db->set($datosProducto);
                            $this->db->where('codigo', $codigoProducto);
                            $this->db->update('producto');
                        }
                    }
                }

                // Una vez que el archivo ha sido procesado, y la DB actualizada, el archivo se borra
                delete_files($path);
                $titulo = "Dimquality::Admin - Actualizar Catalogo";
                $dataHeader['titlePage'] = $titulo;
                $this->load->view('admin/header', $dataHeader);
                $this->load->view('admin/lat-menu');
                $this->load->view('admin/catalogo', array('success' => 1, 'message' => 'El catalogo se actualizó exitosamente.'));
                $this->load->view('admin/footer');
            }
        } else {
            redirect("admin/login");
        }
    }

    function securityCheckAdmin() {
        $securityUser = new SecurityUser();
        $usuario = $this->session->userdata('user');
        if($usuario == ""){
            return false;
        }else{
            if ($this->session->userdata('tipo') == "admin") {
                return true;
            }else{
                $securityUser->logout();
                return false;
            }
        }
    }

    private function checkEmptyAsocArray($asocArray)
    {   
        $arraySize = count($asocArray);
        $emptyCount = 0;
        $isEmpty = false;
        foreach ($asocArray as $key => $value)
        {
            if(!isset($value))
            {
                $emptyCount++;
            }
        }
        if($emptyCount == $arraySize){
            $isEmpty = true;
        }
        return $isEmpty;
    }
}