<?php
/*
 * ===========================================================================
 *  An open source application development framework for PHP 5.1.6 or newer    
 * 
 * 
 * @access          :  public   
 * @Author          :  Sanjoy Dey
 * @Modified By     :        
 * @Warning         :  Any changes in this file can cause abnormal behaviour of the framework
 * @Developed       :  PHP-ignite Team
 * ===========================================================================
 */

                /*
                * This function is used to validate required fields of user input
                * @param array
                * @param string
                * @return error html
                */
                if(!function_exists('validate_require_fields()')) {
                        function validate_require_fields($required_fields = array(),$required,$submit) {

                                $num_of_args = func_num_args();					
                                if ($num_of_args >= 2) {
                                        if(func_get_arg(1) != 'required')
                                                throw new Exception('Missing second argument required !');
                                }
                                if(empty($submit))
                                    throw new Exception("Argument missing ! Please pass submit button name as third argument to validate_fields() fuction.");
                                
                                
                                
                                if($required == 'required') {
                                        $errors = 0;
                                        $errors_arr = array();

                                        foreach ($required_fields as $key=>$val) { 
                                            $i = 0;
                                                if (isset($_POST[$submit])) {
                                                    
                                                                if(is_array($key)) {
                                                                        foreach($key as $fields => $values){  
                                                                                if(empty($_POST[$key])) {
                                                                                    if(is_array($val)) {
                                                                                           echo $val = $required_fields[$key]["email"];
                                                                                    }
                                                                                        $errors_arr[]="<span style='color:#D8000C;'>$val is a required field.</span>";
                                                                                        if($key[$fields] == "email" || $key["check_email_validity"] == TRUE) {
                                                                                              $val =  is_valid_email($key);
                                                                                               
                                                                                        }
                                                                                        $errors++;
                                                                               } $i++;
                                                                        }
                                                                        
                                                                } else {                                                    
                                                                        if(empty($_POST[$key])) {
                                                                                $errors_arr[]="<span style='color:#D8000C;'>$val is a required field.</span>";
                                                                                $errors++;
                                                                        } 
                                                             }
                                                }							
                                        }
                                        $error = "";
                                        $images_url = "";
                                        if(!empty($errors_arr) || isset($errors)) {

                                                $error .= "<br><div style='background-color:#FDE9EA;border:1px solid #EE2C2C;color:#D8000C;'>";					
                                                $error .="<table border=0 cellpadding=1 cellspacing=0>\n";

                                                        if (is_array($errors_arr)) {

                                                                foreach ($errors_arr as $key=>$val) {
                                                                   $error .="<tr>\n<td><!--<img src=\"$images_url/warning_red.png\" border=0>--></td><td> $val</td>\n</tr>\n";
                                                                }

                                                        } else {
                                                                $error .="<tr>\n<td><!--<img src=\"$images_url/warning_red.png\" border=0>--></td><td> $errors_arr</td>\n</tr>\n";
                                                        }
                                            $error .="</table>\n";			
                                                if(isset($_POST[$submit])) {
                                                $error .= "&nbsp;There ";
                                                                if ($errors > 1) 
                                                                        $error .= "are";
                                                                else 
                                                                        $error .= " is ";
                                                $error .= "<font color=red><b>  ".$errors."</b></font> error";
                                                                if ($errors > 1)
                                                                        $error .= "s";
                                                                $error .= " found.<br>";
                                                $error .= "</div><br>";
                                                return $error;
                                                }


                                        } 
                                }	
                            unset($errors);
                                unset($errors_arr);
                        }
                }
                    
                
                function trim_str($value){
                    $trimed_value = trim($value);
                    return $trimed_value;
                }
            
                if(!function_exists("is_valid_email()")){
                    
                        function is_valid_email($email){             //$fieldname,$is_required,$is_valid
                            $email =  trim_str($email);
                                if(empty($email)){
                                       //throw new Exception($message, $code, $previous);
                                        throw new Exception("Email parameter missing in function !");
                                }
                                if(isset($_POST[$email])) {
                                        $post_email = $_POST[$email];
                                          if(preg_match("/^[a-zA-Z]w+(.w+)*@w+(.[0-9a-zA-Z]+)*.[a-zA-Z]{2,4}$/", $post_email) === 0){
                                               $errEmail = '<font color=red>Email Address not valid: example@example.com</font>';
                                          }
                                        return $errEmail;
                                }  else 
                                       $post_email ="";
                              
                              
                                   
                        }
                }
                
                
