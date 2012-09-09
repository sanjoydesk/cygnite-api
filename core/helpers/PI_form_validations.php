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
                        function validate_require_fields($required_fields = array(),$isrequired,$submit) 
                        {
                                $num_of_args = func_num_args();					
                                if ($num_of_args >= 2) {
                                        if(func_get_arg(1) != 'required')
                                                throw new Exception('Missing second argument required !');
                                }
                                if(empty($submit))
                                    throw new Exception("Argument missing ! Please pass submit button name as third argument to validate_fields() fuction.");
                                
                                
                                
                                if($isrequired == 'required') {
                                        $errors = 0;
                                        $errors_arr = array();

                                        foreach ($required_fields as $key=>$val) { 
                                           
                                                if (isset($_POST[$submit])) {
                                                                if(is_array($key)) {
                                                                        $errors_arr[]="<span style='color:#D8000C;'>$val is a required field.</span>";
                                                                        $errors++;
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
                    
                /*
                 * This function is used to trim the post values
                 * @param sting
                 */
                if(!function_exists("trim_str()")) { 
                        function trim_str($value)
                        {
                            $trimed_value = trim($value);
                            return $trimed_value;
                        }
                }
            
                if(!function_exists("is_valid_email()")){                    
                        function is_valid_email($email)
                        {             
                            $email =  trim_str($email);
                                if(empty($email)){
                                       //throw new Exception($message, $code, $previous);
                                        throw new Exception("Email parameter missing in function !");
                                }
                                if(isset($_POST[$email])) {
                                        $post_email = $_POST[$email];
                                        //( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE; codeingiter
                                          if(preg_match("/^[a-zA-Z]w+(.w+)*@w+(.[0-9a-zA-Z]+)*.[a-zA-Z]{2,4}$/", $post_email) === 0){
                                               $errEmail = '<font color=red>Email Address not valid: example@example.com</font>';
                                          } else {
                                                    return TRUE;
                                          }
                                }                               
                        }
                }
                
                /*
                 * This function used to check whether the given value is number or not
                 *  @param int
                 * @return boolean TRUE or FALSE
                 */
                if(!function_exists("is_num()")){                        
                        function is_num($value) 
                        {      
                                  if (!is_numeric($value)) 
                                         return FALSE; 
                                  else 
                                      return TRUE;
                        }
                }
                
                /*
                 * This function used to check whether the given array is number or not
                 *  @param int
                 * @return boolean TRUE or FALSE
                 */
                  if(!function_exists("is_numeric_array()")){                        
                        function is_numeric_array($arrayinput = array()) {
                            foreach ($arrayinput as $key => $value) {
                                     if (!is_numeric($value)) return FALSE;
                            }
                            return TRUE;
                        }
                  }      

                  /*
                   *  This function is used to check password strength
                   * @param string
                   * @ return boolean
                   *  Password must be at least 6 characters and must contain at least one lower case letter, one upper case letter and one digit
                   */
                  if(!function_exists("check_pass_strength()")){    
                      function check_pass_strength($password=""){
                             // Password must be strong
                            if(preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/" , $password) === 0) {
                                    return "Password must be at least 6 characters and must contain at least one lower case letter, one upper case letter and one digit";
                            }
                            
                      }
                  }
                  
                  
                  
                /**
                * Integer
                *
                * @param	string
                * @return	boolean value
                */
                if(!function_exists("integer()")) {
                        function integer($str)
                        {
                            return (bool) preg_match('/^[\-+]?[0-9]+$/', $str);
                        }
                }