<!--
 * Copyright (C) 2019 Lucas Olson. All rights reserved.
 * This software was developed for a class
 * at Regis University. Regis has informed us
 * as students that they retain the rights to our
 * work. Regis University must explicitly authorize 
 * the use of any part of this software outside of their
 * academia. 
 */
-->
 <!DOCTYPE html>
<?php
require_once("Includes/funDa.php");
session_start();

$goodUser = false;
// verify username availability  
if(filter_input(INPUT_POST, 'userCheck'))
{    
    $goodUser = (UserDB::getInstance()->
            check_for_user(filter_input(INPUT_POST, 'userCheck')));
    if($goodUser)
    {
        echo ("Username Good");
    }
    else
    {
        echo ("Username is taken, try again!");
    }
}