<?php
 class DBClassApplicationModel extends PI_Model {

                 function __construct() {
                       parent::__construct();
                       $data = $this->test->getall('products','ASSOC');
                       //var_dump($data );
                }
                
                function getdetails()
                {
                   // $data =  $this->phpigniter->getall("guestbook",'ASSOC');
                    $data =  $this->phpigniter->where('Name','Sanjay')->fetch_all('guestbook');
                    //$data =  $this->phpigniter->fetch_all_details('guestbook');
                    return $data;
                }
                
                function getUserComments()
                {
                        $query = "SELECT * from guestbook";
                        $stmt = $this->phpigniter->prepare($query);
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        return $data;
                }
                
                function getProducts()
                {
                        $query = "SELECT * from products";
                        $stmt = $this->test->prepare($query);
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        return $data;
                }
}

        