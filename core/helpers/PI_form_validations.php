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
		if(!function_exists('validate_fields()')) {
			function validate_fields($required_fields = array(),$required,$submit) {
								
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
						
						if (isset($_POST[$submit])) {
								if(empty($_POST[$key])) {
									$errors_arr[]="<span style='color:#D8000C;'>$val is a required field.</span>";
									$errors++;
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
		if(!function_exists('error_holder()')) {
                
			function error_holder($error_msg) {
					$images_url ="";
					echo "<table border=0 cellpadding=1 cellspacing=0>\n";
					if (is_array($error_msg)) {
								foreach ($error_msg as $key=>$val) {
										echo "<tr>\n<td><!--<img src=\"$images_url/warning_red.png\" border=0>--></td><td> $val</td>\n</tr>\n";
								}
					} else {
								echo "<tr>\n<td><!--<img src=\"$images_url/warning_red.png\" border=0>--></td><td> $error_msg</td>\n</tr>\n";
					}
					echo "</table>\n";
			return;
			}
        }
		*/

