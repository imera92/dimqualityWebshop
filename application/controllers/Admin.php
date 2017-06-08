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

    public function do_upload() {
        $this->load->library('upload', $config);

        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size'] = 100;

        if ( ! $this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('admin/catalogo', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('admin/catalogo', $data);
        }
    }

    public function excelReader()
    {
        $this->load->library('phpexcel');
        $this->load->library('PHPExcel/iofactory');
        $this->load->library('PHPExcel/autoloader');

        $fileName = FCPATH."assets\uploads\sample.xlsx";
        $excelReader = IOFactory::createReaderForFile($fileName);

        $excelReader->setReadDataOnly();
        $excelObj = $excelReader->load($fileName);
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

        // header('Content-Type: application/json');
        // echo json_encode($return);

        foreach ($return as $key1 => $row) {
            if ($return[$key1]['A'] === 'LG') {
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
                        'marca' => $marca
                        // Continuara...
                    );
                    $this->db->insert('producto', $datosProducto);
                }
            }
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