<?php

/*
*---------------------------------------------------------------------------------
* AUTO-LOADER
* --------------------------------------------------------------------------------
* This file is used to specify which files should be loaded by default.
*
*
* Created Date   : 05-07-2012
* Modified Date  : 06-07-2012
*/

$PI_config['autoload'] = array(    
                                                        'helpers' => array('url','encrypt'), /* Autoload Helper Files */
                                                        'libraries' => array('session'), /* Autoload Library Files*/
                                                        'model'    => array()   /* Autoload Model Files*/
);