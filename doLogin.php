<?php
// starts/resumes an existing session, used to track and store 
// user-specific data across different pages
session_start();

//allows for common code reuse (database connection)
include "dbFunction.php";

//retrieves username from text field
$input_username = $_POST['username'];
//retrieves password from password field
$input_password = $_POST['password'];

//used to store msg that will be displayed to user
$message = "";

//selects all rows from user table
//where username matches value provided by the user
$querySelect = "SELECT * FROM users WHERE username = '$input_username' AND password = '$input_password'";

//executes the SQL query using the mysqli_query function. If there's an error during execution, the script will terminate and display the error message 'error querying database'
$result = mysqli_query($link, $querySelect) or die(mysqli_error($link));

//conditional staement to check if query returns any rows
// if have rows, user exist in databse
// user exists -> fetched row data is stored in $_SESSION, $message is updated to 
// display login user info + includes a link to showmovies.php
// user does not exist -> $message is updated with error message + link to go back to login page
if (mysqli_num_rows($result) == true) {
    $row = mysqli_fetch_array($result);
    $_SESSION['userId'] = $row['userId'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['dob'] = $row['dob'];
    $_SESSION['email'] = $row['email'];

    //if user clicks on remember me, cookie will store username
    // cookie -> used to identify user, small file that server embeds on user computer
    //isset -> checks whether a variable is set, which means that it has to 
    //be declared and is not NULL
    // return true if variable exist and is not Null, else returns false
    if (isset($_POST['remember'])) {
        setcookie('username', $input_username, time() + 86400);
    } else {
        setcookie("username", "");
    }

    $message = "<p><i>You are logged in as " . $_SESSION['username'] . "</p>";
    $message .= "Name: " . $_SESSION['name'] . "<br>";
    $message .= "Date of Birth: " . $_SESSION['dob'] . "<br>";
    $message .= "Email: " . $_SESSION['email'] . "<br>";
    $message .= "<p>Proceed to view <a href='showmovies.php'>Movies</a></p>";
} else {
    $message = "<p>Sorry, you need to enter a valid username and password to login</p>";
    $message .= "<p><a href='login.php'>Go back to login page</a></p>";
}
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
        <!-- Creates a card-like container for organizing content-->
        <div class="card" style="width: 450px; margin: 0px auto; float: none ; margin-bottom: 10px; margin-top: 10px; background-color: whitesmoke">
            <!--  contains the main content of the card-->
            <div class="card-body" style="">
                <!--contains the message stored in the $message variable -->
                <p class="card-title" style="text-align: center"> <?php echo $message; ?></p>
            </div>
        </div>
    </body>
</html>
