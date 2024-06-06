<?php
// starts/resumes an existing session, used to track and store 
// user-specific data across different pages
session_start();

//allows for common code reuse (database connection)
include "dbFunction.php";

//retrieves the value of the session variable $_SESSION['userId']
$userID = $_SESSION['userId']; 

//MySQL DELETE query is constructed to delete a user account from the "users" table based on the user's ID
$queryDelete = "DELETE FROM users WHERE userId=$userID";

//query is executed using the mysqli_query function. If there's an error during execution, the script will terminate using die(mysqli_error($link))
$status = mysqli_query($link, $queryDelete) or die(mysqli_error($link)); 

//code checks the value of $status, which holds the result of the query execution. 
//If the query was successful ($status is true), it assigns the message "Account has been deleted." 
//to the $msg variable. Additionally, the session is destroyed using session_destroy(), 
//effectively logging out the user and clearing their session data
if($status) { 
    $msg = "Account has been deleted.";
    session_destroy();
} 
else { 
    $msg = "Failed to delete account, try again!";    
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
            p{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <?php include "navbar1.php" ?>
        <!--div creates a card-like container for organizing content-->
        <div class="card" style="width: 450px; margin: 0px auto; float: none ; margin-bottom: 5px; margin-top: 10px; background-color: whitesmoke">
            <!--div contains the main content of the card.
Inline styles are used to set the text color to black-->
            <div class="card-body" style="color: black">
                <!--Displays the message stored in the $msg variable. This message could be "Account has been deleted." or "Failed to delete account, try again!" -->
                <!--element displays the text "Go Back to" followed by a link that points to the "login.php" page-->
                <p class="card-title"> <?php echo $msg; ?></p>
                <p>Go Back to <a href="login.php">Login</a> page</p>
            </div>
        </div>
    </body>
</html>
