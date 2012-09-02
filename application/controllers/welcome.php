<?php if ( ! defined('PI_BASEPATH')) exit('No direct script access allowed');

class welcome extends PI_Controller {
        
        private $model = NULL,$library = NULL,$profiler = NULL;

		function __construct() 
		{
		   parent::__construct();           
		   $this->profiler = $this->load->load_library('profiler');
		   $this->profiler->start_profiling();
		   $this->model = $this->load->model('DBClass');
		   $this->library = $this->load->load_library('encrypt');
		   
		}

        public function index() 
        {
			$data['userdetails']= $this->model->getUserComments();
			$this->load->load_helper('form_validations');
			$required_fields=array("name"=>"User Name","country"=>"Country Name");	//,'txtSubmit'			
			$data['errors'] = validate_fields($required_fields,'required','txtSubmit');
			
			$encryt= $this->library->PI_encrypt("admin");
			$this->library->PI_decrypt($encryt);
			$data['values'] = "Sanjay";            
			$this->load->presenter("welcome",$data); 
			$this->profiler->end_profiling();
        }
		
        public function clearAllVars() 
        { 
          $vars = get_object_vars($this); 
          echo "<pre>";
          print_r($vars);
          //exit;
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



        function test() {
            echo "<br>test"."<br>";                 
        }
      
        function __destruct() {
       //parent::__destruct();
            unset($this);
            echo gc_collect_cycles();      
   }
        
}
