<?php
// starts/resumes an existing session, used to track and store 
// user-specific data across different pages
session_start();

//allows for common code reuse (database connection)
include "dbFunction.php";

// code checks if the session variable $_SESSION['userId'] is set. 
// If it's not set, it means the user is not logged in, and they are redirected to the "login.php" page
if (!isset($_SESSION['userId'])) {
    header("location: login.php"); // auto redirect to login.php
}

//obtained from url parameter $_GET['userId']
$userID = $_GET['userId'];

//query is executed sing the mysqli_query function.
//If there's an error during execution, the script will terminate using die(mysqli_error($link));
$queryReview = "SELECT * FROM users "
        . "WHERE users.userId=$userID";

$resultReview = mysqli_query($link, $queryReview) or
        die(mysqli_error($link));

//result of the query is fetched into an associative array named $rowReview using mysqli_fetch_array
$rowReview = mysqli_fetch_array($resultReview);

//if username is not set,value of $message will be assigned as a link 
//to login/register
if (!isset($_SESSION['username'])) {
    $message = "<a href='login.php'>Login/Register</a>";
} else {
    //if username is set, value of $message will be assigned the link logout
    //$welcome will be assigned the value 'welcome, (username)'
    $message = "<a href='logout.php'>Logout</a>";
    $welcome = "Welcome, " . $_SESSION['username'] . "";
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
        <title>delete user info</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            .card-title, i {
                color: black;
            }
        </style>
    </head>
    <body>
        <?php include "navbar1.php"?>
        <!-- displays the value of the $welcome variable -->
        <p style="text-align: right ; padding-top: 10px; padding-right: 10px;"><?php echo $welcome ?></p>
        <!-- creates a card-like container for organizing content -->
        <div class="card" style="width: 450px; margin: 0px auto; float: none ; margin-bottom: 10px; margin-top: 10px; background-color: whitesmoke">
            <div class="card-body" style="">
                 <!-- Displays the title "Delete Account" at the center of the card -->
                <h1 class="card-title" style="text-align: center; color: black">Delete Account</h1>

                <!-- Used to italicize the content that follows -->
                <!-- Each piece of information is fetched from the $rowReview array 
                data is displayed in a formatted manner-->
                <i><b>Username:</b>
                    <?php echo $rowReview['username'] ?><br>

                    <b>Password:</b>
                    <?php echo $rowReview['password']; ?><br>

                    <b>Name:</b>
                    <?php echo $rowReview['name']; ?><br>

                    <b>Date of Birth:</b>
                    <?php echo $rowReview['dob']; ?><br>

                    <b>Email:</b>
                    <?php echo $rowReview['email']; ?><br><br></i>

                <!-- The first link with the text "Go Back" directs the user to the "userInfo.php" page, passing the user's ID as a URL parameter (userId)
                The second link with the text "Confirm Delete" directs the user to the "doDeleteUserInfo.php" page, passing the user's ID as a URL parameter (userId)-->
                <center><a style="margin-right: 20px;" href="userInfo.php?userId=<?php echo $_SESSION['userId']; ?>">Go Back</a>
                    <a style="margin-right: 10px;" href="doDeleteUserInfo.php?userId=<?php echo $_SESSION['userId']; ?>">Confirm Delete</a></center>

            </div>
        </div>
    </body>
</html>
