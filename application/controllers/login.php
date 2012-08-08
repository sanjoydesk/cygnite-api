<?php

class login extends myFramework{

    private $fw;

    function __construct(){
            parent::__construct();
            $this->fw = $this->load->model("DBClass");
    }
    function index() {
        $this->view("login");
    }
      public function loginUser() {
          $data = array();
          $data = $this->fw->chkLoginBYUser($_POST);

                if($data == "error_msg") {
                        $msg = "<span style='color:red;'>"."Please Check Login Credentials!!"."</span>";
                        echo $msg;
                } else {
                        session_start();
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['password'] = $data['password'];
                        $_SESSION['email'] = $data['email'];
                        $_SESSION['usertype'] = $data['usertype'];
                        $id =session_id();
                        redirect("userdetails/index/".$id);
                }
       }
        //Logout from User Session
       public static function logout() {
            session_destroy();
            $status_msg = LoadGlobalCofig::flashMsg("Successfully Logged out !!");
            redirect("login/index");
       }
}
