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

//Input debug info
if($_SESSION['cmd'])
{
    //echo ("HOME: " .$_SESSION['cmd']);
}

navHeader('locations');

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
                        <h1>Storage Box: <h2>Locations</h2></h1>
                        <menu>
_END;
                            navBuild('locations.php');
echo <<<_END
                        </menu>
                    </div>
                </div>
            </div>
        </header>
_END;

    $locations = (UserDB::getInstance()->
            get_items_by_owner($_SESSION['userId'],'locations'));
    if (!$locations) {die ("Database access failed");}
    
    $id;
    $owner;
    $title;
    $filePath;
    $description;
    //echo("PHP MARKER");
    if($locations->num_rows > 0)
    {
        $row = $locations->fetch_row();
        $id = $row[0];
        $owner = $row[1];
        $title = htmlspecialchars($row[2]);
        $filePath = $row[3];
        $description = htmlspecialchars($row[4]);
        
        //Reset result to beginning
        $locations->data_seek(0);
        //echo("PHP MARKER WITH ROWS");
    }
    else
    {
        $id = 0;
        $owner = $_SESSION['userId'];
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
            $_SESSION['loca'] = $id; 
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
        <section> <!--------------- TODO ------------------------- 
                  THIS WILL BE BUILT BY PHP, ONLY EXAMPLE CURRENTLY -->
            <div class="rt-container">
                <div class="horizontalScroll">
_END;
   
   while($row = $locations->fetch_row())
   {
        echo"<div class='item' onclick=\"javascript:selectImage('$row')\">";
        echo'<div class="bg">';
        echo '<img src="'. base64_encode_image($row[3]).'"/>';
        echo "</div></div>";  
   }                        
                            /*
                                                 <div class="item" onclick="javascript:selectImage('image/location1.jpeg')">
                        <div class="bg">
                            <img src="image/location1.jpeg">
                        </div>
                    </div>
                    <div class="item" onclick="javascript:selectImage('image/location2.jpeg')">
                        <div class="bg">
                            <img src="image/location2.jpeg">
                        </div>
                    </div>
                    <div class="item" onclick="javascript:selectImage('image/location3.jpeg')">
                        <div class="bg">
                            <img src="image/location3.jpeg">
                        </div>
                    </div>
                    <div class="item" onclick="javascript:selectImage('image/location4.jpeg')">
                        <div class="bg">
                            <img src="image/location4.jpeg">
                        </div>
                    </div>
                    <div class="item">
                        <div class="bg">
                            <img src="image/location5.jpeg" onclick="javascript:selectImage('image/location5.jpeg')">
                        </div>
                    </div>*/
echo <<<_END
                </div>
            </div>
        </section>
        <script src="Includes/jsFuncs.js"></script>
    </body>
</html>
_END;

?>