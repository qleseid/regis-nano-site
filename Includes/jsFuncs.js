/*
 * Copyright (C) 2019 Lucas Olson. All rights reserved.
 * This software was developed for a class
 * at Regis University. Regis has informed us
 * as students that they retain the rights to our
 * work. Regis University must explicitly authorize 
 * the use of any part of this software outside of their
 * academia. 
 */

//AJAX USERNAME CHECK
function checkTheUser()
{
    var usser = document.getElementById("user").value;
    params = "userCheck=" + usser;
    request = new ajaxRequest();
    request.open("POST", "newUserCheck.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //request.setRequestHeader("Content-length", params.length);
    //request.setRequestHeader("Connection", "close");
    //document.getElementById('divPassMess').innerHTML = "Hello";
    
    request.onreadystatechange = function()
    {
        if (this.readyState === 4)
        {
            if (this.status === 200)
            {
                if (this.responseText !== null)
                {
                    document.getElementById('divUserMess').innerHTML =
                            this.responseText;
                    checkUserMess();
                }
                else alert("Ajax error: No data received");
            }
            else alert( "Ajax error: " + this.statusText);
        }
    };
    request.send(params);
}
            
//CHECK THAT PASSWORDS MATCH
function checkPasswordMatch() 
{
    var password = document.getElementById("pword").value;
    var confirmPassword = document.getElementById("cword").value;
    
    if (password !== confirmPassword)
    {
        document.getElementById("divPassMess").innerHTML =
                "Passwords do not match!";
        document.getElementById("createBtn").style.visibility = "hidden";
    }
    else
    {
        document.getElementById("divPassMess").innerHTML = "Passwords match";
        document.getElementById("createBtn").style.visibility = "visible";
    }
}

//GET THE PROPER AJAX REQUEST
function ajaxRequest()
{
    try
    {
        var request = new XMLHttpRequest();
    }
    catch(e1)
    {
        try
        {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e2)
        {
            try
            {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e3)
            {
                request = false;
            }
        }
    }
    return request;
}

//HIDE CREATE BUTTON IF USERNAME IS TAKEN
function checkUserMess()
{
    var m = String(document.getElementById("divUserMess").innerText);
    if("Username Good" !== m)
    {
        document.getElementById("createBtn").style.visibility = "hidden";
        document.getElementById("user").value = "";
        document.getElementById("user").focus();
        document.getElementById("user").select();
    }
    else
    {
        document.getElementById("createBtn").style.visibility = "visible";
    }
}

//HOME SELECT IMAGE
function selectImage(id, owner, title, image, des)
{    
    document.getElementById("selectedImage").src = image;
    document.getElementById("titleArea").value = title;
    document.getElementById("id").value = id;
    document.getElementById("owner").value = owner;
    document.getElementById("textArea").value = des;
}

//NAVIGATION TO NEXT PAGE
function nav(page)
    {
        window.location.href = page;
    }

//METHOD TO CREATE A PHP POST
function post(action, name, elemt)
    {
        //document.getElementById("titleArea").value = "In Post!";
        const form = document.createElement('form');
        var fields = ['titleArea', 'textArea', 'cmd', 'id', 'owner'];
        form.method = 'POST';
        form.action = action;

        for (var x of fields)
        {
            const hiddenField = document.createElement(elemt);
            hiddenField.type = 'hidden';
            hiddenField.name = x;

            if (x !== 'cmd')
            {
                hiddenField.value = document.getElementById(x).value;
            }
            else
            {
                hiddenField.value = name;
            }
            form.appendChild(hiddenField);
        }
        document.body.appendChild(form);
        form.submit();
    }
