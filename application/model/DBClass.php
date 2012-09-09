<?php

 class DBClass extends PI_Model {

                 function __construct() {
                       parent::__construct();
//                       $db1= $this->db->load_db('test','root','','mysql');
//                       $products = $this->db->find("*")->get_details("products",$db1);
//                       var_dump($products);
                }

                public function chkLoginBYUser($submitArray = array()) {


                         $username = $submitArray['txtUsername'];
                         $password = md5($submitArray['txtPassword']);
                         $whereDetails = array(
                                                        'username' => $username,
                                                        'password' => $password,
                        );                         
                         $loginCreadential = $this->db->find("*")->where($whereDetails)->get_details(" userdetails ");
                                 if(count($loginCreadential) > 0) {
                                      return $loginCreadential[0];
                                 } else {
                                      return "error_msg";
                                 }
                }

                public function getUserComments() {

                        $data = array();
                        $data = $this->db->find("id,Name,EntryDate,Comment")->get_details("guestbook");
                        $this->db->close_connection();
                        return $data;
                }

                function insertdetails($data) {
                        $this->db->insert("guestbook",$data,"submit");
                }

                function updateUserDetails($data=array(),$userId="") {
                        $tableName ="guestbook";
                        $this->db->where("id",$userId)->update($tableName,$data);
                }

                function deleteUser($id) {
                    if(!empty($id)) {
                        $details = $this->db->where("id",$id)->delete("guestbook");
                        return count($details);
                    }
                }

                 public function selectquery($build_query) {
                        $data = array();
                        $resultArray = mysql_query($build_query);
                                        while($row = mysql_fetch_array($resultArray,MYSQL_ASSOC))  {
                                             $data[] = $row;
                                        }
                         return $data;
                }
        }

        