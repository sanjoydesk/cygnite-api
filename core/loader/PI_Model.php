<?php

class load {
     function model($modelname=""){
        echo $modelname."dgd";exit;
        $directory = $_SERVER['DOCUMENT_ROOT']."smarty/application/spark/model/";
        if(file_exists($directory.$modelname.".php")) {
             require($directory.$modelname.".php");
             //return $this->$modelname =new $modelname();
        } else {
            echo "Model File Doesn't exists!!";
        }
   }

     function view($viewname=""){

           $directory = $_SERVER['DOCUMENT_ROOT']."smarty/application/spark/view/";
        if(file_exists($directory.$viewname.".php")) {
             require($directory.$viewname.".php");
        } else {
            echo "View File Doesn't exists!!";
        }
    }
}
