<?php if ( ! defined('PI_BASEPATH')) exit('No direct script access allowed');

class WelcomeApplicationController extends PI_Controller {
        
        private $library = NULL,$profiler = NULL; //$session = NULL,

            function __construct() 
            {
                parent::__construct(); 
               //$this->session = PI_Controller::storeObject('session', 'PI_SecureSession');
               //$this->session->set('name','PI Session');
               //echo $this->session->get('name');  
                
               $this->profiler = $this->load->library('profiler');
               $this->profiler->start_profiling();
               $this->load->model('DBClass'); 
               $this->library = $this->load->library('encrypt');
            }

        public function index() 
        {
                // $this->model = $this->load->model('DBClass');  $data['userdetails']= $this->model->getdetails();
                $data['userdetails']=  PI_AppLoader::$_model->getdetails(); 
                
                $this->load->helper('form_validations');
                $required_fields = array(
                                                            "name"=>"User Name",
                                                            "country"=>"Country Name",
                                                            "txtemail" => array(
                                                                                 "email"=>"Email Address",
                                                                                 "check_email_validity" =>"TRUE"
                                                            )   
                                                );	
                $data['errors']  = validate_require_fields($required_fields,'required','txtSubmit');
                $data['email']= is_valid_email("email","Email Address","required","checkvalid");
               
                $encryt= $this->library->PI_encrypt("sanjoy");
                $this->library->PI_decrypt($encryt);
                $data['values'] = "Sanjay";            
                $data1 = PI_AppLoader::$_model->getProducts();
			
                var_dump($data['userdetails']);
                
                
                $this->load->presenter("welcome",$data); 
                $this->profiler->end_profiling();
        }
		
        public function clearAllVars() 
        { 
          $vars = get_object_vars($this); 
          echo "<pre>";
         // print_r($vars);
          foreach($vars as $key => $val) { 
            // $this->$key = null; 
             // unset($this->$key);
          } 
        }

        function unset_all_vars($a)
        {
                foreach($a as $key => $val) { 
                    unset($GLOBALS[$key]);
                }
            return serialize($a);
        }
     
        function __destruct() {
                //parent::__destruct();
                unset($this->model);
                unset($this->library);
                unset($this->profiler);
                unset($this);
                gc_collect_cycles();      
       }        
}