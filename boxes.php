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
        $_SESSION['cmd'] = 'home';
        $_SESSION['title'] = filter_input(INPUT_POST, 'title');
        $_SESSION['text'] = filter_input(INPUT_POST, 'text');
        $_SESSION['data'] = filter_input(INPUT_POST, 'data');
        header('Location: home.php');
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
                        <h1>Storage Box: <h2>Boxes</h2></h1>
                        <menu>
                            <li onclick="javascript:menuNav('home')">Home</li>
                            <li><a href="newBox.php">New</a></li>
                            <li><a href="edit.php">Update</a></li>
                            <li><a href="delete.php">Delete</a></li>
                        </menu>
                    </div>
                </div>
            </div>
        </header>
        <div class="dividLine"/>
        <textarea id="titleArea">
 This is where the Box Title will go!   
        </textarea>
        <div>
            <div class="pos">

                <div class="bin">
                    <div class="big" onclick="javascript:nav()">
                        <img class="sel" id="selectedImage" src="image/bin.jpg">
                    </div>

                </div>

            </div>

            <textarea id="textArea" class="pos">
This is where the text description for the selected storage box. You would go into greater detail of the pictured box and the storage location and you can also search these words later to find things. This area is big enough for some serious typing.
            </textarea>
        </div>
        <div class="dividLine"/>
        <section><!--------------- TODO ------------------------- 
                  THIS WILL BE BUILT BY PHP, ONLY EXAMPLE CURRENTLY -->
            <div class="rt-container">
                <div class="horizontalScroll">
                    <div class="item" onclick="javascript:selectImage('image/bin.jpg')">
                        <div class="bg">
                            <img src="image/bin.jpg">
                        </div>
                    </div>
                    <div class="item" onclick="javascript:selectImage('image/bin1.jpg')">
                        <div class="bg">
                            <img src="image/bin1.jpg">
                        </div>
                    </div>
                    <div class="item" onclick="javascript:selectImage('image/bin2.jpeg')">
                        <div class="bg">
                            <img src="image/bin2.jpeg">
                        </div>
                    </div>
                    <div class="item" onclick="javascript:selectImage('image/bin3.jpeg')">
                        <div class="bg">
                            <img src="image/bin3.jpeg">
                        </div>
                    </div>
                    <div class="item" onclick="javascript:selectImage('image/bin4.jpeg')">
                        <div class="bg">
                            <img src="image/bin4.jpeg">
                        </div>
                    </div>
                    <div class="item">
                        <div class="bg">
                            <img src="image/bin5.jpeg" onclick="javascript:selectImage('image/bin5.jpeg')">
                        </div>
                    </div>                    
                </div>


            </div>
        </section>
        <script>
            function selectImage(image)
            {
                document.getElementById("selectedImage").src = image;
            }
            function nav()
            {
                window.location.href = "boxview.php";
            }
            function menuNav(nav)
            {
                //document.getElementById("titleArea").value = "In menuNav!";
                switch(nav)
                {
                    case 'home':
                        post('home');
                        break;
                    case 'update':
                        post('update');
                        break;
                    case 'delete':
                        post('delete');
                        break;
                    case 'new':
                        post('new');
                        break; 
                    default:
                        break;
                }                
            }
            function post(path)
            {
                //document.getElementById("titleArea").value = "In Post!";
                const form = document.createElement('form');
                var fields = ['titleArea', 'textArea', path];
                form.method = 'POST';
                form.action = 'boxview.php';
                
                for(x of fields)
                {
                    const hiddenField = document.createElement('input');
                    hiddenField.type = 'hidden';
                    hiddenField.name = x;
                    
                    if(x !== path)
                    {
                        hiddenField.value = document.getElementById(x).value;
                    }               
                    form.appendChild(hiddenField);
                }                
                document.body.appendChild(form);
                form.submit();
            }
        </script>
    </body>
</html>
