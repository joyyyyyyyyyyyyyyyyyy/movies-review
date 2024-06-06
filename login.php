<?php
//initialise with empty string
$rememberusername = "";
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            
            input{
                width:410px;
                display:block;
                border: 1px solid graytext;
                border-radius: 5px;
                height: 30px;
                text-indent: 5px;
            }
            p{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <?php include "navbar1.php"?>
        <!-- creates a card-like container for organizing content-->
        <div class="card" style="width: 450px; margin: 0px auto; float: none; margin-bottom: 10px; margin-top: 10px; background-color: whitesmoke">
            <!--  specifies that when the user submits the form, the data will be sent to the "doLogin.php" script using the POST method-->
            <form method="post" action="doLogin.php">
                <div class="card-body">
                    <!--Displays the text "Login" in a large heading style -->
                    <h1 style="text-align: center; color: black">Login</h1>
                    <!-- Display labels "Username:" and "Password:" in black color-->
                    <span style="color: black;">Username:</span><br>
                    <!--allow the user to enter their username and password. They have attributes like name (used to identify the input in form submissions), placeholder (provides a hint for what to enter), and required (indicates that the field must be filled out before submitting the form) -->
                    <input type="text" name="username" placeholder="Enter username" required="required"/><br>
                    <!-- Display labels "Username:" and "Password:" in black color-->
                    <span style="color: black;">Password:</span><br>
                    <!--allow the user to enter their username and password. They have attributes like name (used to identify the input in form submissions), placeholder (provides a hint for what to enter), and required (indicates that the field must be filled out before submitting the form) -->
                    <input type="password" name="password" placeholder="Enter password" required="required"/><br>
                    <!-- contains a checkbox input and its label for the "Remember Me" option-->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="remember">
                        <label style="color: black" class="form-check-label" for="flexCheckDefault">Remember Me
                        </label>
                    </div>
                </div>
                <!-- used for a row layout-->
                 <div class="row">
                            <div class="col text-center" style="margin-bottom: 10px">
                                <button class="btn btn-dark bg-dark">Submit</button>
                            </div>
                </div>
            </form>
        </div>
        <!-- displays the text "Not a member yet? Register now!" and provides a link to the "registration.php" page-->
        <p id="register" style="text-align: center">Not a member yet? <a href="registration.php"> Register </a>now!</p>
    </body>
</html>
