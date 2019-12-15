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

$logonSuccess = false;

//******************** TODO ****************
// verify email, send new password and clear old
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") 
{
    $logonSuccess = (WishDB::getInstance()->verify_wisher_credentials(
            filter_input(INPUT_POST, 'user'), 
            filter_input(INPUT_POST, 'userpassword')));
    if ($logonSuccess == true) 
    {
        $_SESSION['user'] = filter_input(INPUT_POST, 'user') ;
        header('Location: locations.php');
        exit;
    }
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/passreset.css" type="text/css" rel="stylesheet" media="all" />
        <title>Password Reset</title>
    </head>
    <body>   
        <div class="body">
        <div class="logon">
            <form name="logon" action="passReset.php" method="POST" 
              style="visibility:
                <?php 
                if ($logonSuccess) 
                {
                    echo "hidden";
                }
                else
                {
                    echo "visible";
                }
                ?>
                  ">
            Username <input type="text" name="user"></br>
            Email<br/> <input type="email" name="email"></br>
            Confirm Email<br/> <input type="email" name="cemail"></br>
            <div class="error">
            <?php
            //******* TODO *********
            if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") 
            {
                if (!$logonSuccess)
                {
                    echo "Invalid username and/or email";
                }
            }
            ?>
            </div>
            <input type="submit" value="Reset">
        
        </div>
        
        </div>
    </body>
</html>
