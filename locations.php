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

?>
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
                            <?php navBuild('locations.php'); ?>
                        </menu>
                    </div>
                </div>
            </div>
        </header>
        <div class="dividLine"/>
        <textarea id="titleArea">
 This is where the Location Title will go!   
        </textarea>
        <input type="hidden" id="id" value="4"/>
        <div>
            <div class="pos">

                <div class="bin">
                    <div class="big" onclick="<?php $_SESSION['id'] = 4 ?>;javascript:nav('boxes.php')">
                        <img class="sel" id="selectedImage" src="image/location.jpeg">
                    </div>

                </div>

            </div>

            <textarea id="textArea" class="pos">
This is where the text description for the storage location. You would go into greater detail of the pictured box and the storage location and you can also search these words later to find things. This area is big enough for some serious typing.
            </textarea>
        </div>
        <div class="dividLine"/>
        <section> <!--------------- TODO ------------------------- 
                  THIS WILL BE BUILT BY PHP, ONLY EXAMPLE CURRENTLY -->
            <div class="rt-container">
                <div class="horizontalScroll">
                    <div class="item" onclick="javascript:selectImage('image/location.jpeg')">
                        <div class="bg">
                            <img src="image/location.jpeg">
                        </div>
                    </div>
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
                    </div>                    
                </div>
            </div>
        </section>
        <script src="Includes/jsFuncs.js"></script>
    </body>
</html>
