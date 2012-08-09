<?php if ( ! defined('PI_BASEPATH')) exit('No direct script access allowed');

class welcome extends PI_Controller {
        
            private $model = NULL;

           function __construct() {
               parent::__construct();           
               $this->model = $this->load->model('DBClass');
               $this->library = $this->load->load_library('encrypt');
               $this->profiler = $this->load->load_library('profiler');
               $this->profiler->start_profiling();
          }

        public function index() {
            $data['userdetails']= $this->model->getUserComments();        
            $encryt= $this->library->PI_encrypt("admin");
            $this->library->PI_decrypt($encryt);

           // $this->clearAllVars();
                //$this->unset_all_vars($this);
            $data['values'] = "Sanjay";
           // var_dump($this); 
            
            $obj_var  =  $this->load->_loaded_obj();
            var_dump($obj_var);
            
            $this->load->presenter("welcome",$data);
            $this->profiler->end_profiling();
        }
         public function clearAllVars() 
       { 
          $vars = get_object_vars($this); 
          echo "<pre>";
          print_r($vars);
          //exit;
          foreach($vars as $key => $val) 
          { 
            // $this->$key = null; 
             // unset($this->$key);
          } 
       }

       function unset_all_vars($a)
      {
           foreach($a as $key => $val)
         { 
               unset($GLOBALS[$key]);
        }
                    return serialize($a);
      }



        function test() {
            echo "<br>test"."<br>";        
        }
    
//        function __destruct() {
//       //parent::__destruct();
//            unset($this);
//   }
        
}

/*
class MyDestructableClass {
   function __construct() {
       print "In constructor\n";
       $this->name = "MyDestructableClass";
   }

   function __destruct() {
       //parent::__destruct();
       print "Destroying " . $this->name . "\n";
   }
}

$obj = new MyDestructableClass();
 
 */