<?php  if ( ! defined('PI_BASEPATH')) exit('No direct script access allowed');


/*===============================================================================
*  An open source application development framework for PHP 5.1.6 or newer    
* 
*  This file is to encrypt string
* @access public
* @Author          :         Sanjoy Dey
* @Modified By :          
* @Warning      :         Any changes in this file can cause abnormal behaviour of the framework
* @Developed   :         PHP-ignite Team
* @Framework Version 1.0
* ================================================================================
*/


    class encrypt {

            private $securekey, $iv;
            /*
             *  Constructor function 
             * @param string - encryption key
             * 
             */
            function __construct($encryptKey="") {
                    if(!empty($encryptKey)) {                    
                                $this->securekey = hash('sha256',$encryptKey,TRUE);
                                $this->iv = mcrypt_create_iv(32);
                    } else {
                                throw new Exception("Encryption key has not been set. Please  set Encryption key inside Config file.");
                    }
            }
            
            /*
             *  This function is to encrypt string
             * @access  public 
             *  @param string
             * @return encrypted hash
             */
            function PI_encrypt($input) {
                     return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->securekey, $input, MCRYPT_MODE_ECB, $this->iv));
            }
            
            /*
             *  This function is to decrypt the encoded string
             * @access  public 
             *  @param string
             * @return decrypted string
             */
            function PI_decrypt($input) {
                    return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->securekey, base64_decode($input), MCRYPT_MODE_ECB, $this->iv));
            }
            
            function __destruct() {
                    unset($securekey);
                    unset($iv);
            }
            
    }
