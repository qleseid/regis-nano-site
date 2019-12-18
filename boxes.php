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

//Check that user is authenticated
if(!$_SESSION['user'])
{
    //echo("Inside Authenticate: ". $_SESSION['user']);
    header('Location: login.php');
    exit;
}
/*
    echo $_SESSION['id'] . ": ID</br>";
    echo $_SESSION['owner'] . ": OWNER</br>";
    echo $_SESSION['userId'] . ": USERID</br>";
    echo $_SESSION['cmd'] . ": CMD</br>";
    echo $_SESSION['page'] . ": PAGE</br>";
*/
navHeader('boxes');
//$_SESSION['$page'] = 'boxes';

echo <<<_END
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/boxview.css" />
    </head>
    <body>

        <header class="SiteHeader">
            <div class="hd-container">
                <div class="col-rt-12">
                    <div class="hd-heading">
                        <h1>Storage Box: <h2>Boxes</h2></h1>
                        <menu>
_END;
                            navBuild('boxes.php'); 
echo <<<_END
                        </menu>
                    </div>
                </div>
            </div>
        </header>
_END;

    $boxes = (UserDB::getInstance()->
            get_items_by_owner($_SESSION['owner'],'boxes'));
    if (!$boxes) {die ("Database access failed");}
    
    $id;
    $owner;
    $title;
    $filePath;
    $description;
    //echo("PHP MARKER");
    if($boxes->num_rows > 0)
    {
        $row = $boxes->fetch_row();
        $id = $row[0];
        $owner = $row[1];
        $title = htmlspecialchars($row[2]);
        $filePath = $row[3];
        $description = htmlspecialchars($row[4]);
        
        //Reset result to beginning
        $boxes->data_seek(0);
        //echo("PHP MARKER WITH ROWS");
    }
    else
    {
        $id = 0;
        $owner = $_SESSION['owner'];
        $title = "NOTHING CREATED YET, CLICK 'NEW' ABOVE";
        $filePath = "/home/gangsta/Pictures/uploads/empty.jpg";
        $description = "NO ITEMS, NO DESCRIPTIONS YET, CLICK 'NEW' ABOVE";
    }
    //echo("PHP MARKER END OF IF");
echo <<<_END
        <div class="dividLine"/>
        <textarea id="titleArea">$title</textarea>
        <input type="hidden" id="id" value="$id"/>
        <input type="hidden" id="owner" value="$owner"/>
        <div>
            <div class="pos">
                <div class="bin">
                    <div class='big' onclick="javascript:nav('boxes.php')
_END;
            $_SESSION['next'] = 'items.php'; 
            echo"\">";
            echo '<img class="sel" id="selectedImage" src="'
                . base64_encode_image($filePath).'"/>';
echo <<<_END
                    </div>
                </div>
            </div>
            <textarea id="textArea" class="pos">$description</textarea>
        </div>
        <div class="dividLine"/>
        <section>
            <div class="rt-container">
                <div class="horizontalScroll">
_END;

    while($row = $boxes->fetch_row())
   {
        $row[3] = base64_encode_image($row[3]);
        
        echo"<div class='item' onclick=\"javascript:selectImage('".$row[0]."', "
                . "'".$row[1]."', '".addslashes($row[2])."',"
                . "'".$row[3]."', '".addslashes($row[4])."')\">";
        echo'<div class="bg">';
        echo '<img src="'. $row[3].'"/>';
        echo "</div></div>";  
   }    
echo <<<_END
                </div>
            </div>
        </section>
        <script src="Includes/jsFuncs.js"></script>
    </body>
</html>
_END;

?>