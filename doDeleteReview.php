<?php
// starts/resumes an existing session, used to track and store 
// user-specific data across different pages
session_start();

//allows for common code reuse (database connection)
include "dbFunction.php";

//checks if the session variable $_SESSION['userId'] is set. If it's not set, it means the user is not logged in, and they are redirected to the "login.php" page using the header("location: login.php")
if (!isset($_SESSION['userId'])) {
    header("location: login.php"); // auto redirect to login.php
}

//obtained from url parameter $_GET['reviewId']
$reviewID = $_GET['reviewId'];

//MySQL DELETE query is constructed to delete a review from the "reviews" table based on the provided review ID.
$queryDelete = "DELETE FROM reviews WHERE reviewId=$reviewID";

//query is executed using the mysqli_query function. If there's an error during execution, the script will terminate using die(mysqli_error($link))
$status = mysqli_query($link, $queryDelete) or die(mysqli_error($link));

//code checks the value of $status, which holds the result of the query execution. 
//If the query was successful ($status is true), it assigns the message 
//"Review has been deleted." to the $msg variable. Otherwise, if the query was not successful, 
//it assigns the message "Failed to delete review, try again!" to the $msg variable
if ($status) {
    $msg = "Review has been deleted.";
} else {
    $msg = "Failed to delete review, try again!";
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
        <title>do delete review</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <body>
        <?php include "navbar1.php"?>
        <!--creates a card-like container for organizing content-->
        <div class="card" style="width: 450px; margin: 0px auto; float: none ; margin-bottom: 10px; margin-top: 10px; background-color: whitesmoke">
            <!--contains the main content of the card.
Inline styles are used to align the text in the card's body to the center and set the text color to black-->
            <div class="card-body" style="text-align: center; color: black">
                <!--Displays the message stored in the $msg variable-->
                <p class="card-title"> <?php echo $msg; ?></p>
                <!--displays the text "Go Back to" followed by a link that points to the "showmovies.php" page-->
                <p>Go Back to <a href="showmovies.php">Movie</a> page</p>
            </div>
        </div>
    </body>
</html>
