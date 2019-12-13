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
$userId;
$userName;
$userEmail;
$goodUpdate;

//Check that user is authenticated
if(!$_SESSION['user'])
{
    //echo("Inside Authenticate: ". $_SESSION['user']);
    header('Location: login.php');
    exit;
}
else //Get logged in user info
{
    $userName = $_SESSION['user'];
    
    $goodUpdate = (UserDB::getInstance()->get_user_info_by_name($userName));
    
    if (count($goodUpdate) > 0) 
    {
        $userId = $goodUpdate[0];
        $userEmail = $goodUpdate[1];
    }
}

//Handle account updates
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") 
{
    $updateSuccess = (UserDB::getInstance()->update_user(
            filter_input(INPUT_POST, 'id'),
            filter_input(INPUT_POST, 'nemail')));
    
    if ($updateSuccess == true) 
    {
        header('Location: home.php');
        exit;
    }
    else
    {
        echo("UPDATE FAILURE!");
    }
}
?>
 
 <html>
     <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <link href="css/newuser.css" type="text/css" rel="stylesheet" media="all" />
         <title>Account</title>
     </head>
     <body>   
         <div class="body">
             <div class="logon">
                 <form name="account" action="account.php" method="POST">
                     Username <input type="text" id="user" name="user" 
                                     value="<?php echo$userName;?>"
                                     readonly="readonly"/></br>
                     <div class="error" id="divUserMess"></div>
                     <div class="error" id="divPassMess"></div>
                     Email<br/> 
                     <input type="text" name="email" 
                            value="<?php echo$userEmail;?>"
                            readonly="readonly"/></br> 
                     New Email<br/> 
                     <input type="email" name="nemail" required/></br>
                     <input type="hidden" name="id" value="<?php echo$userId;?>"/>
                     <input type="submit" id="createBtn" value="Update">
                 </form>
                 <form name="cancelAccount" action="home.php" method="GET">
                     <input type="submit" id="cancelBtn" value="Cancel">
                 </form>
             </div>
         </div>
         <script src="Includes/jsFuncs.js"></script>
     </body>
 </html>
