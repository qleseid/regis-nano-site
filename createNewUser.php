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

$goodCreate = false;
//******************** TODO ****************
// verify username available and password then store or reject
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") 
{
    $goodCreate = (UserDB::getInstance()->create_user(
            filter_input(INPUT_POST, 'user'), 
            password_hash(filter_input(INPUT_POST, 'userpassword'), PASSWORD_BCRYPT),
            filter_input(INPUT_POST, 'email')));
    if ($goodCreate == true) 
    {
        $_SESSION['name'] = filter_input(INPUT_POST, 'user') ;
        header('Location: login.php');
        exit;
    }
}
?>
 <html>
     <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <link href="css/newuser.css" type="text/css" rel="stylesheet" media="all" />
         <title>New User</title>
     </head>
     <body>   
         <div class="body">
             <div class="logon">
                 <form name="logon" action="createNewUser.php" method="POST">
                     Username <input type="text" id="user" name="user"
                                     onchange="checkTheUser()"
                                     required/></br>
                     <div class="error" id="divUserMess"></div>
                     Password <input type="password" id="pword" name="userpassword"                                         onchange="javascript:checkPasswordMatch()" 
                                       required/></br>
                     Confirm Password <input type="password" id="cword" name="cpassword"
                                            onchange="javascript:checkPasswordMatch()"/></br>
                     <div class="error" id="divPassMess"></div>
                     Email<br/> 
                     <input type="email" name="email" required/></br>            
                     <input type="submit" id="createBtn" value="Create">
                 </form>
             </div>
         </div>
         <script src="Includes/jsFuncs.js"></script>
     </body>
 </html>
