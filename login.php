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
$userNa = "";

//Input a username after creation
if($_SESSION['name'])
{
    $userNa = $_SESSION['name'];
}

//Input debug info
if($_SESSION['debug'])
{
    echo $_SESSION['debug'];
}

// verify user's credentials
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") 
{
    $logonSuccess = (UserDB::getInstance()->verify_user_credentials(
            filter_input(INPUT_POST, 'user'), 
            filter_input(INPUT_POST, 'userpassword')));
    
    //DEBUG LOGON SUCCESS
    if ($logonSuccess == false)
    {
        $_SESSION['debug'] .= " Logon: " . "FALSE ";
    }else{
        $_SESSION['debug'] .= " Logon: " . "TRUE ";
    }    
    
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
         <link href="css/login.css" type="text/css" rel="stylesheet" media="all" />
         <title>Login</title>
     </head>
     <body>   
         <div class="body">
             <div class="logon">
                 <input type="submit" name="myWishList" value="Hide Storage Box Login" 
                        onclick="javascript:showHideLogonForm()"/>
                 <form name="logon" action="login.php" method="POST" 
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
                     Username <input type="text" name="user" value="<?php echo$userNa;?>"></br>
                     Password <input type="password" name="userpassword"></br>
                     <div class="error">
                         <?php
                         if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST")
                         {
                             if (!$logonSuccess)
                             {
                                 echo "Invalid name and/or password";
                             }
                         }
                         ?>
                     </div>
                     <input type="submit" value="Login">
                 </form>

                 <br>Still don't have a storage box?! <a href="createNewUser.php"></br>Create Now</a>
             </div>
             <div class="showForgot">
                 <input type="submit" name="showPwordForgot" value="Forgot Password?" 
                        onclick="javascript:showHideShowWishListForm()"/>
                 <form name="passReset" action="passReset.php" method="POST" style="visibility:hidden">
                     <input type="text" name="user" value=""/>
                     <input type="submit" value="Go" />

                 </form>
             </div>
             <script>
     function showHideLogonForm() {
         if (document.all.logon.style.visibility === "visible"){
             document.all.logon.style.visibility = "hidden";
             document.all.myWishList.value = "Click to Login to Storage Box";
         } 
         else {
             document.all.logon.style.visibility = "visible";
             document.all.myWishList.value = "Hide Storage Box Login";
         }
     }
     function showHideShowWishListForm() {
         if (document.all.passReset.style.visibility === "visible") {
             document.all.passReset.style.visibility = "hidden";
             document.all.showPwordForgot.value = "Forgot Password?";
         }
         else {
             document.all.passReset.style.visibility = "visible";
             document.all.showPwordForgot.value = "Click to hide";
                     }
                 }
             </script>
         </div>
     </body>
 </html>
