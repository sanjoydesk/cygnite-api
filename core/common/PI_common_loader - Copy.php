<?php


$filepath = explode(DS,__FILE__,5);
print_r($filepath);


 function load_class($class, $directory = 'libraries', $prefix = 'PI_') {

     echo $class;exit;

 }

exit;
Abstract class AutoloadClasses {

            public static $classesDir;

            public static function __autoload($class_name) {

            $rootDir = $_SERVER['DOCUMENT_ROOT']."application".DS."configs".DS;
            $rootDirectory = str_replace('/', '\\', $rootDir);
            
            /*
            *  Directories that contain Configuration files
            */
            $classesDir = array(
                                'classses' => $rootDirectory.'classess'.DS,
                                'includes' => $rootDirectory.'includes'.DS
                               );
                       if(is_array($class_name)) {
                              for($i=0;$i<count($class_name['filename']);$i++) {
                                    foreach ($classesDir as $directory) {
                                        if (file_exists($directory . $class_name['filename'][$i].EXT)) {
                                                require_once ($directory . $class_name['filename'][$i] .EXT);
                                        }
                                    }
                              }
                              return;
                       }

                       if(!is_array($class_name)){
                              foreach ($classesDir as $directory) {
                                  if (file_exists($directory . $class_name .EXT)) {
                                      require_once ($directory . $class_name .EXT);
                                      return;
                                  } else {
                                      throw new Exception("Required Class Cannot be Loadded");
                                  }
                              }

                       }
            }

}
