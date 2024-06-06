<?php
// starts/resumes an existing session, used to track and store 
// user-specific data across different pages
session_start();

//allows for common code reuse (database connection)
include "dbFunction.php";

//checks if the session variable $_SESSION['username'] is set. If it is set, it means the user is logged in
if (isset($_SESSION['username'])) {
    //If the user is logged in, this line destroys the current session, effectively logging the user out
    session_destroy();
}

//assigned HTML code that will display a message indicating that the user has been logged out,  includes a link to login page
$message = "<p>You have logged out.<br/><br/>"
        . "<a href='login.php'>Go back to login page</a></>"
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
        <title>Logout</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            .card-body {
                color: black;
            }
        </style>
    </head>
    <body>
        <?php include "navbar1.php" ?>
        <!-- Creates a card-like container for organizing content-->
        <div class="card" style="width: 450px; margin: 0px auto; float: none ; margin-bottom: 10px; margin-top: 10px; background-color: whitesmoke">
            <div class="card-body" style="">
                <!-- Displays the message stored in the $message variable. The message will indicate that the user has been logged out and provides a link to the login page-->
                <p class="card-title" style="text-align: center"> <?php echo $message; ?></p>
            </div>
        </div>
    </body>
</html>
