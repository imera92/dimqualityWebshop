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
