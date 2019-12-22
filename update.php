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
$image = base64_encode_image($_SESSION['file']);

    echo $_SESSION['id'] . ": ID</br>";
    echo $_SESSION['owner'] . ": OWNER</br>";
    echo $_SESSION['userId'] . ": USERID</br>";
    echo $_SESSION['cmd'] . ": CMD</br>";
    echo $_SESSION['page'] . ": PAGE</br>";

$goodCreate = false;
//******************** TODO ****************
// Create a new item
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") 
{    
    $goodCreate = (UserDB::getInstance()->update_item(
            $_SESSION['page'],
            $_SESSION['id'], 
            filter_input(INPUT_POST, 'titleArea'),
            filter_input(INPUT_POST, 'textArea')));
    if ($goodCreate) 
    {
        header('Location:'. $_SESSION['page'].'.php');
        exit;
    }
    else
    {
        echo("UPDATE FAILURE!". $_SESSION['page'] . $_SESSION['id']);
    }
}
?>
 <html>
     <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <link href="css/new.css" type="text/css" rel="stylesheet" media="all" />
         <title>Update</title>
     </head>
     <body>   
         <div class="body">
             <div class="newItem">
                 <form name="update" action="update.php" method="POST" 
                       enctype='multipart/form-data'>
                     Title </br><textarea id="titleArea" name="titleArea"
                                          required/><?php echo ($_SESSION['titleArea']); ?></textarea></br>
                     <div class="error" id="divUserMess"></div>
                     Description </br><textarea id="textArea" name="textArea"/><?php echo ($_SESSION['textArea']); ?>
                     </textarea></br>
                     <input type="file" name="item" size="30"
                            accept=".png, .gif, .jpg, .jpeg, .webp"
                            onchange="document.getElementById('preview').src
                          = window.URL.createObjectURL(this.files[0])"></br>
                     <input type="submit" id="createBtn" value="Update">
                 </form>
                 <form name="cancelAccount" action="
                     <?php echo $_SESSION['page'].".php"?>" 
                     method="GET">
                     <input type="submit" id="cancelBtn" value="Cancel">
                 </form>
             </div>
             <div class="previewImage">
                 <img id="preview" src="<?php echo $image ?>" alt="preview image"/>
             </div>                 
         </div>
         <script src="Includes/jsFuncs.js"></script>
     </body>
 </html>
