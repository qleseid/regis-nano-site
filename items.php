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

navHeader('items');

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
                        <h1>Storage Box: <h2>Box View</h2></h1>
                        <menu>
                            <?php navBuild('items.php'); ?>
                        </menu>
                    </div>
                </div>
            </div>
        </header>
        <div class="dividLine"/>
        <textarea id="titleArea">
 This is where the Title will go!   
        </textarea>
        <input type="hidden" id="id" value="1"/>
        <div>
            <div class="pos">

                <div class="bin">
                    <div class="big">
                        <img class="sel" id="selectedImage" src="image/bin.jpg">
                    </div>

                </div>

            </div>

            <textarea id="textArea" class="pos">
This is where the text description for the item will go. You would go into greater detail of the pictured item or items so you know exactly what is stored and you can also search these words later to find things. This area is big enough for some serious typing.
            </textarea>
        </div>
        <div class="dividLine"/>
        <section>
            <div class="rt-container">
                <div class="horizontalScroll">
                    <div class="item" onclick="javascript:selectImage('image/cable.jpg')">
                        <div class="bg">
                            <img src="image/cable.jpg">
                        </div>
                    </div>
                    <div class="item" onclick="javascript:selectImage('image/hat.jpg')">
                        <div class="bg">
                            <img src="image/hat.jpg">
                        </div>
                    </div>
                    <div class="item" onclick="javascript:selectImage('image/mug.jpeg')">
                        <div class="bg">
                            <img src="image/mug.jpeg">
                        </div>
                    </div>
                    <div class="item" onclick="javascript:selectImage('image/postit.jpg')">
                        <div class="bg">
                            <img src="image/postit.jpg">
                        </div>
                    </div>
                    <div class="item" onclick="javascript:selectImage('image/tools.jpeg')">
                        <div class="bg">
                            <img src="image/tools.jpeg">
                        </div>
                    </div>
                    <div class="item">
                        <div class="bg">
                            <img src="image/hat.jpg" onclick="javascript:selectImage('image/hat.jpg')">
                        </div>
                    </div>
                    <div class="item">
                        <div class="bg">
                            <img src="image/mug.jpeg">
                        </div>
                    </div>
                    <div class="item">
                        <div class="bg">
                            <img src="image/postit.jpg">
                        </div>
                    </div>
                    <div class="item">
                        <div class="bg">
                            <img src="image/tools.jpeg">
                        </div>
                    </div>
                </div>


            </div>
        </section>
        <script src="Includes/jsFuncs.js"></script>
    </body>
</html>
