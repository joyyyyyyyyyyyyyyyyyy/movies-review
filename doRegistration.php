<?php
//allows for common code reuse (database connection)
include "dbFunction.php";

//retrieves username from text field
$username = $_POST['username'];
//retrieves password from text field
$password = $_POST['password'];
//retrieves name from text field
$name = $_POST['name'];
$dob = $_POST['dob'];
//retrieves email from text field
$email = $_POST['email'];

//selects all rows from user table
//check if the username exist in the database
$querySelect = "SELECT username FROM users WHERE username = '$username' ";
$result = mysqli_query($link, $querySelect);

//conditional staement to check if query returns any rows
// username exist -> $status set to false
//username does not exist -> code inserts data into database
// password hashed using SHA1
// inserted result stored as variable in $status
if (mysqli_num_rows($result) == 1) {
    $status = false;
} else {
    $query = "INSERT INTO users (username, password, name, dob, email)VALUES"
            . "('$username',('$password') ,'$name',
           '$dob', '$email')";
    $status = mysqli_query($link, $query);
}

//if $status is true, successfully msg will be display
//$status is false, error message is displayed indicating username exist in database
if ($status) {
    $message = "<p>Your account has been successfully created.<br> 
                You are now ready to <a href='login.php'>login</a>.</p>";
} else {
    $message = "Username " . $username . " already exists.";
    $message .= "<br>Please<a href='registration.php'> try again!</a>";
}

//close connection
mysqli_close($link);
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
        <title></title>
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
        <div class="card" style="width: 450px; margin: 0px auto; float: none ; margin-bottom: 10px; margin-top: 10px; background-color: whitesmoke">
            <div class="card-body" style="">
                <p class="card-title" style="text-align: center"> <?php echo $message; ?></p>
            </div>
        </div>
    </body>
</html>
