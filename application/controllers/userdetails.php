<?php
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');

class userdetails extends myFramework{

        private $fw;

        function __construct(){
            parent::__construct();
            $this->fw = $this->load->model("DBClass");
       }
        public function index($userId="",$usertype="") {
            $data['details'] =$this->fw->getUserComments();
            $data['viewpage'] = 'user_details_view';
           $this->load->view("template",$data);
        }
        function userInfo() {

             $name = $this->postValue('txtName');
             $comment = $this->postValue('txtComments');
             $submit = $this->postValue('txtSubmit');
             if(isset($submit)) {
                 $postValues = array('Name' => $name,'EntryDate' => date("Y-m-d"),'Comment' => $comment);
                 $this->fw->insertdetails($postValues);
             }

             $data['viewpage'] = 'v_adduser_details';
             $this->load->view("template",$data);
             /*$data = array(
                                'Name' => 'Ashish Kumar',
                                'EntryDate' => date("Y-m-d"),
                                'Comment' => 'Hi !!! How r You all ??'
                           );*/
        }

        function updateUserInfo() {
             $data = array(
                                'Name' => 'Nikhil',
                                'EntryDate' => date("Y-m-d"),
                                'Comment' => 'Hi !!! All. I am in leave for Few days ??'
                           );
             $userid = $_SESSION['username'];
             $this->fw->updateUserDetails($data,$userId = '11');
        }

        function deleteUserInfo() {
             $deletedID ="";
             $mystring = $_POST['deleteId'];
             $userId = explode('_', $mystring, 2);
             $id = $userId[1];
             $deletedID = $this->fw->deleteUser($id);
             echo $deletedID;exit;
        }
}

