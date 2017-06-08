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
            $crud->columns('codigo','categoria','imagen','costo','pvp','descripcion','stock','estado');
            $crud->required_fields('codigo','categoria','imagen','costo','pvp','descripcion','stock','estado');
            $crud->field_type('localizacion', 'dropdown', array(
                '0' => 'Inactivo',
                '1' => 'Activo'
            ));
            $crud->display_as('codigo', 'Código');
            $crud->display_as('categoria', 'Categoría');
            $crud->display_as('pvp', 'PVP');
            $crud->display_as('descripcion', 'Descripción');
            $crud->unset_export();
            $crud->unset_print();
            $crud->set_language("spanish");
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

            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'xlsx';
            $config['max_size'] = 200;
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile')) {
                $titulo = "Dimquality::Admin - Actualizar Catalogo";
                $dataHeader['titlePage'] = $titulo;

                $this->load->view('admin/header', $dataHeader);
                $this->load->view('admin/lat-menu');
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/catalogo', $error);
                $this->load->view('admin/footer');
            } else {
                $this->load->library('phpexcel');
                $this->load->library('PHPExcel/iofactory');
                $this->load->library('PHPExcel/autoloader');
                $this->load->helper("file");
                
                $fileName = $this->upload->data()['file_name'];
                $filePath = FCPATH."assets\uploads\\".$fileName;
                $excelReader = IOFactory::createReaderForFile($filePath);

                $excelReader->setReadDataOnly();
                $excelObj = $excelReader->load($filePath);
                // Establecer la hoja activa del documento por su nombre
                $excelObj->setActiveSheetIndexByName('Hoja1');
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
                $result = $this->db->get()->result_array();

                // Validamos que hayan marcas existentes en la DB, caso contrario mostramos mensaje de error
                if (empty($result)) {
                    unlink($filePath);

                    $titulo = "Dimquality::Admin - Actualizar Catalogo";
                    $dataHeader['titlePage'] = $titulo;
                    $this->load->view('admin/header', $dataHeader);
                    $this->load->view('admin/lat-menu');
                    $this->load->view('admin/catalogo', array('success' => 0, 'message' => 'Error. No existen marcas existentes en la base de datos.'));
                    $this->load->view('admin/footer');
                } else {
                    foreach ($result as $index => $row) {
                        $marcasArray[] = $row['nombre'];
                    }
                    foreach ($return as $key1 => $row) {
                        // Empezamos a validar los datos del archivo
                        if (in_array($return[$key1]['A'], $marcasArray)) {
                            $marca = $return[$key1]['A'];
                        }elseif (in_array($return[$key1]['A'], array('LAVADORAS', 'SECADORAS DE ROPA', 'REFRIGERADORAS', 'AIRES ACONDICIONADOS', 'MICROONDAS', 'AUDIO', 'TELEVISORES', 'TABLETS'))) {
                            $categoria = $return[$key1]['A'];
                        }else{
                            $code = current($return[$key1]);
                            $desc = next($return[$key1]);
                            // Hay que preguntar si vamos a guardar el precio con tarjeta de credito o no
                            next($return[$key1]);
                            $pvp = next($return[$key1]);
                            $cost = next($return[$key1]);
                            $stock = next($return[$key1]);
                            $existingProduct = $this->db->get_where('producto', array('codigo' => $code))->result_array();
                            if (empty($existingProduct)) {
                                $datosProducto = array(
                                    'nombre' => '',
                                    'marca' => $marca,
                                    'categoria' => $categoria,
                                    'codigo' => $code,
                                    'imagen' => '',
                                    'modelo' => '',
                                    'costo' => $cost,
                                    'pvp' => $pvp,
                                    'descripcion' => $desc,
                                    'estado' => 1,
                                    'stock' => $stock
                                );
                                $this->db->insert('producto', $datosProducto);
                            } else {
                                $datosProducto = array(
                                    'nombre' => '',
                                    'marca' => $marca,
                                    'categoria' => $categoria,
                                    'imagen' => '',
                                    'modelo' => '',
                                    'costo' => $cost,
                                    'pvp' => $pvp,
                                    'descripcion' => $desc,
                                    'estado' => 1,
                                    'stock' => $stock
                                );
                                $this->db->set($datosProducto);
                                $this->db->where('codigo', $code);
                                $this->db->update('producto');
                            }
                        }
                    }
                    // Una vez que el archivo ha sido procesado, y la DB actualizada, el archivo se borra
                    unlink($filePath);
                    $titulo = "Dimquality::Admin - Actualizar Catalogo";
                    $dataHeader['titlePage'] = $titulo;
                    $this->load->view('admin/header', $dataHeader);
                    $this->load->view('admin/lat-menu');
                    $this->load->view('admin/catalogo', array('success' => 1));
                    $this->load->view('admin/footer');
                }
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