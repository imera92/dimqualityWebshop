<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/insdex
	 *	- or -2
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
        public function __construct()
    	{
		parent::__construct();
		$this->load->helper('url');
        $this->load->database();
        $this->load->library('grocery_CRUD');
        $this->load->model('SecurityUser');
        date_default_timezone_set("America/Guayaquil");
	    }

       
        public function product() {
    	    if ($this->securityCheckAdmin()) {
    		    $titulo = "Dimquality::Admin - Inicio";
    		    $dataHeader['titlePage'] = $titulo;
				$crud=new grocery_CRUD();
				$crud->columns('nombre','marca','modelo','codigo','imagen');
				$crud->set_table('producto');
				$crud->required_fields('nombre','marca');
				$crud->unset_export();
				$crud->unset_print();
				$crud->set_language("spanish");
				$output=$crud->render();
				$dataHeader['css_files']=$output->css_files;
				$dataHeader['js_files']=$output->js_files;
				$this->load->view('admin/header', $dataHeader);
    			$this->load->view('admin/lat-menu');
    			$this->load->view('admin/crearProducto',(array)$output);
    			$this->load->view('admin/footer');
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


	

}
