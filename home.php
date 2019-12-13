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

//Input a username after creation
if($_SESSION['cmd'])
{
    //echo ("HOME: " .$_SESSION['cmd']);
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == "POST") 
{
    /*******************TODO**********************/
    //Logic for site navigation from header options
    if (filter_input(INPUT_POST, 'new')) 
    {
        //TODO: either new page or function call TBD
        $_SESSION['cmd'] = 'new';
        $_SESSION['title'] = filter_input(INPUT_POST, 'title');
        $_SESSION['text'] = filter_input(INPUT_POST, 'text');
        $_SESSION['data'] = filter_input(INPUT_POST, 'data');
        header('Location: new.php');
        exit;
    } 
    else if (filter_input(INPUT_POST, 'delete')) 
    {
        //TODO: either new page or function call TBD
        $_SESSION['cmd'] = 'delete';
        $_SESSION['title'] = filter_input(INPUT_POST, 'title');
        $_SESSION['text'] = filter_input(INPUT_POST, 'text');
        $_SESSION['data'] = filter_input(INPUT_POST, 'data');
        header('Location: delete.php');
        exit;
    } 
        //TODO: either new page or function call TBD
    else if (filter_input(INPUT_POST, 'update')) 
    {
        //TODO: either new page or function call TBD
        $_SESSION['cmd'] = 'update';
        $_SESSION['title'] = filter_input(INPUT_POST, 'title');
        $_SESSION['text'] = filter_input(INPUT_POST, 'text');
        $_SESSION['data'] = filter_input(INPUT_POST, 'data');
        header('Location: update.php');
        exit;
    }  
    else
    {
        //TODO: either new page or function call TBD
        $_SESSION['cmd'] = 'account';
        $_SESSION['title'] = filter_input(INPUT_POST, 'title');
        $_SESSION['text'] = filter_input(INPUT_POST, 'text');
        $_SESSION['data'] = filter_input(INPUT_POST, 'data');
        header('Location: boxview.php');
        exit;
    }  
}
echo <<<_END
 
_END;
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
                            <li onclick="javascript:menuNav('account')">Account</li><!--******FIX-->
                            <li><a href="newBox.php">New</a></li><!--******FIX-->
                            <li><a href="edit.php">Update</a></li><!--******FIX-->
                            <li><a href="boxes.php">Delete</a></li><!--******FIX-->
                        </menu>
                    </div>
                </div>
            </div>
        </header>
        <div class="dividLine"/>
        <textarea id="titleArea">
 This is where the Location Title will go!   
        </textarea>
        <div>
            <div class="pos">

                <div class="bin">
                    <div class="big" onclick="javascript:nav()">
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