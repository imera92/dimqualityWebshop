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
        $this->load->model('Marca');
        $this->load->model('Categoria');
        date_default_timezone_set("America/Guayaquil");
	}

	public function login()
    {
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

    public function index()
    {
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

	public function logout()
    {
        if($this->securityCheckAdmin()){
            $securityUser = new SecurityUser();
            $securityUser->logout();
            redirect("admin/login");
        }else{
            redirect("admin/login");
        }
    }

    public function productos()
    {
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
            $crud->set_relation('marca','marca','nombre');
            $crud->set_relation('categoria','categoriaproducto','nombre');
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

    public function actualizarCatalogo()
    {
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

    public function subirExcel()
    {
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
                $this->load->library('PHPExcel');
                $this->load->library('PHPExcel/IOFactory');
                $this->load->library('PHPExcel/Autoloader');
                $this->load->helper("file");
                
                $fileName = $this->upload->data()['file_name'];
                $path = FCPATH."assets/uploads/excel";
                $filePath = FCPATH."assets/uploads/excel/".$fileName;
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
                $marcasDB = Marca::marcasArray();

                // Obtenemos todas las categorias de la DB y las guaradmos en un array
                $categoriasDB = Categoria::categoriasArray();


                // Inicializamos las variables para evitar errores durance el proceso
                $marcaExcel = '';
                $categoriaExcel = '';
                $flag = 0;
                // 0 = estamos en la celda que contiene la marca
                // 1 = estamos en la celda que contiene la categoria
                // 2 = estamos en la celda que contiene los datos del producto
                $mensaje = '';
                $success = 1;
                
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
                        $marcaExcel = $return[$key1]['A'];

                        // Validamos que haya marcas guardadas en la DB
                        if (!empty($marcasDB)) {
                            // Validamos si la marca actual se encuentra en la DB
                            $encontradoFlag = false;
                            foreach ($marcasDB as $marcaDB) {
                                if ($marcaDB->getNombre() == $marcaExcel) {
                                    $marcaActual = $marcaDB;
                                    $flag++;
                                    $encontradoFlag = true;
                                    break;
                                }
                            }

                            // Si no encontramos la marca actual en la DB, la creamos
                            if ($encontradoFlag == false) {
                                $marcaActual = new Marca();
                                $marcaActual->setNombre($marcaExcel);

                                // Validamos si hubo error al intentar guardar la marca
                                if ($marcaActual->guardarNuevaMarca()) {
                                    // Si se guardo la marca con exito, aumentamos el flag para continuar con el proceso
                                    $flag++;
                                } else {
                                    // Si hubo error al intentar guardar la marca, creamos un mensaje de error y borramos el archivo
                                    delete_files($path);
                                    $success = 0;
                                    $error = 1;
                                    break;
                                }
                            }
                        } else {
                            // Si no hay marcas guardadas en la DB, creamos una nueva
                            $marcaActual = new Marca();
                            $marcaActual->setNombre($marcaExcel);

                            // Validamos si hubo error al intentar guardar la marca
                            if ($marcaActual->guardarNuevaMarca()) {
                                // Si se guardo la marca con exito, aumentamos el flag para continuar con el proceso
                                $flag++;
                            } else {
                                // Si hubo error al intentar guardar la marca, creamos un mensaje de error y borramos el archivo
                                delete_files($path);
                                $success = 0;
                                $error = 1;
                                break;
                            }
                        }
                    } elseif ($flag == 1) {
                        $categoriaExcel = $return[$key1]['A'];

                        // Validamos que haya categorias guardadas en la DB
                        if (!empty($categoriasDB)) {
                            // Validamos si la categoria actual se encuentra en la DB
                            $encontradoFlag = false;
                            foreach ($categoriasDB as $categoriaDB) {
                                if ($categoriaDB->getNombre() == $categoriaExcel) {
                                    $categoriaActual = $categoriaDB;
                                    $encontradoFlag = true;
                                    break;
                                }
                            }

                            // Si la categoria actual no se encuentra en la DB, la creamos
                            if ($encontradoFlag == false) {
                                $categoriaActual = new Categoria();
                                $categoriaActual->setNombre($categoriaExcel);

                                // Validamos si hubo error al intentar guardar la categoria
                                if (!$categoriaActual->guardarNuevaCategoria()) {
                                    // Si hubo error al intentar guardar la categoria, creamos un mensaje de error y borramos el archivo
                                    delete_files($path);
                                    $success = 0;
                                    $error = 2;
                                    break;
                                }
                            }
                        } else {
                            // Si no hay categorias guardadas en la DB, creamos una nueva
                            $categoriaActual = new Categoria();
                            $categoriaActual->setNombre($categoriaExcel);

                            // Validamos si hubo error al intentar guardar la categoria
                            if (!$categoriaActual->guardarNuevaCategoria()) {
                                // Si hubo error al intentar guardar la categoria, creamos un mensaje de error y borramos el archivo
                                delete_files($path);
                                $success = 0;
                                $error = 2;
                                break;
                            }
                        }
                    } elseif ($flag == 2) {
                        $codigoProducto = current($return[$key1]);
                        $nombreProducto = next($return[$key1]);

                        next($return[$key1]);
                        $pvpProductoString = str_replace(',', '', next($return[$key1]));
                        $pvpProducto = floatval($pvpProductoString);
                        next($return[$key1]);
                        $stockProducto = next($return[$key1]);
                        $productoExistente = $this->db->get_where('producto', array('codigo' => $codigoProducto))->result_array();
                        $fechaActual = date('Y-m-d');
                        if (empty($productoExistente)) {
                            $datosProducto = array(
                                'nombre' => $nombreProducto,
                                'marca' => $marcaActual->getId(),
                                'categoria' => $categoriaActual->getId(),
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
                                'marca' => $marcaActual->getId(),
                                'categoria' => $categoriaActual->getId(),
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

                // Una vez que el archivo ha sido procesado, y la DB actualizada, el archivo se borra y se creamos un mensaje de exito
                delete_files($path);

                // Generamos un mensaje de exito o error dependiendo del resultado del proceso
                switch ($success) {
                    case 1:
                        $mensaje = 'El catalogo se actualizó exitosamente.';
                        break;
                    
                    default:
                        switch ($error) {
                            case 1:
                                $mensaje = 'Error. Hubo un problema al intentar guardar la marca. Revise el log de errores.';
                                break;
                            
                            case 2:
                                $mensaje = 'Error. Hubo un problema al intentar guardar una categoria. Revise el log de errores.';
                                break;
                        }
                        break;
                }

                $titulo = 'Dimquality::Admin - Actualizar Catalogo';
                $dataHeader['titlePage'] = $titulo;
                $this->load->view('admin/header', $dataHeader);
                $this->load->view('admin/lat-menu');
                $this->load->view('admin/catalogo', array('success' => $success, 'message' => $mensaje));
                $this->load->view('admin/footer');
            }
        } else {
            redirect("admin/login");
        }
    }

    public function transacciones()
    {
        if ($this->securityCheckAdmin()) {
            $titulo = 'Transacciones';

            $crud=new grocery_CRUD();
            $crud->set_subject($titulo);
            $crud->set_table('transaccion');
            $crud->columns('id', 'estado', 'fechaCompra', 'usuario', 'total', 'fechaPago', 'formaPago', 'fechaEntrega', 'tipoEntrega', 'nombreFactura', 'cedulaFactura', 'direccionFactura', 'recibe', 'direccionEntrega');
            $crud->required_fields('estado', 'formaPago', 'tipoEntrega', 'nombreFactura', 'cedulaFactura', 'direccionFactura', 'recibe');
            $crud->edit_fields('estado', 'fechaPago', 'formaPago', 'fechaEntrega', 'tipoEntrega', 'nombreFactura', 'cedulaFactura', 'direccionFactura', 'recibe', 'direccionEntrega');
            $crud->set_relation('estado','estado_transaccion','estado');
            $crud->set_relation('formaPago','forma_pago','nombre');
            $crud->set_relation('tipoEntrega','tipo_entrega','nombre');
            $crud->callback_column('usuario', array($this, '_callback_nombreTransaccion'));
            $crud->display_as('id', 'Código');
            $crud->display_as('fechaCompra', 'Fecha de Compra');
            $crud->display_as('fechaCompra', 'Fecha de Pago');
            $crud->display_as('fechaEntrega', 'Fecha de Entrega');
            $crud->display_as('formaPago', 'Forma de Pago');
            $crud->display_as('nombreFactura', 'Nombre (Factura)');
            $crud->display_as('cedulaFactura', 'Cédula o RUC (Factura)');
            $crud->display_as('direccionFactura', 'Dirección (Factura)');
            $crud->display_as('tipoEntrega', 'Tipo de Entrega');
            $crud->display_as('recibe', 'Recibe');
            $crud->display_as('direccionEntrega', 'Dirección de Entrega');   
            $crud->unset_add();         
            $crud->unset_export();
            $crud->unset_print();
            $crud->set_language('spanish');
            // $crud->callback_before_insert(array($this,'know_date'));
            $output=$crud->render();

            $dataHeader['titlePage'] = 'Dimquality::Admin - Transacciones';
            $dataHeader['titleCRUD'] = $titulo;
            $dataHeader['css_files']=$output->css_files;
            $dataFooter['js_files']=$output->js_files;
            $this->load->view('admin/header', $dataHeader);
            $this->load->view('admin/lat-menu');
            $this->load->view('admin/blank',(array)$output);
            $this->load->view('admin/footer-gc', $dataFooter);
        } else {
            redirect('admin/login');
        }
    }

    public function _callback_nombreTransaccion($value, $row)
    {
        $nombre = '';

        $this->db->select('nombre');
        $this->db->from('usuario');
        $this->db->where('id', $value);
        $resultado = $this->db->get()->first_row();

        if (!is_null($resultado)) {
            $nombre .= $resultado->nombre;
        }

        $this->db->select('apellido');
        $this->db->from('usuario');
        $this->db->where('id', $value);
        $resultado = $this->db->get()->first_row();

        if (!is_null($resultado)) {
            $nombre .= ' ';
            $nombre .= $resultado->apellido;
        }

        return $nombre;
    }

    function securityCheckAdmin() {
        $securityUser = new SecurityUser();
        $usuario = $this->session->userdata('user');
        if($usuario == ""){
            return false;
        }else{
            if ($this->session->userdata('tipo') == 'admin') {
                return true;
            }else{
                $securityUser->logout();
                return false;
            }
        }
    }

    public function auth()
    {
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