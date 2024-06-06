<?php
// starts/resumes an existing session, used to track and store 
// user-specific data across different pages
session_start();

//allows for common code reuse (database connection)
include "dbFunction.php";

// line retrieves the updated review content from a form submission using the HTTP POST method
$updateReview = $_POST['review'];
//line retrieves the updated rating value from a form submission using the HTTP POST method
$updateRating = $_POST['rating'];

// retrieves the review ID from a form submission using the HTTP POST method
$reviewID = $_POST['id'];
//retrieves the movie ID from a form submission using the HTTP POST method
$movieID = $_POST['movieId'];

//imitialise a empty message used to store the result of the update operation
$msg = "";

//contains an SQL query string that is used to update a specific review in the "reviews" table. 
//It uses the values obtained from the form submissions to set the updated review content and rating for the review with the specified review ID
$queryUpdate = "UPDATE reviews "
        . "SET review='$updateReview', rating='$updateRating' "
        . "WHERE reviewId=$reviewID";

//executes the update query using the mysqli_query function. If there's an error during execution, the script will terminate and display the error message using die(mysqli_error($link))
$resultUpdate = mysqli_query($link, $queryUpdate) or die (mysqli_error($link));

//If the update query was successful ($resultUpdate is true), it assigns the message "<p>Review successfully updated.</p>" to the $msg variable. Otherwise, if the query was not successful, it assigns the message "<p>Failed to update review, try again!</p>" to the $msg variable
if ($resultUpdate) {
    $msg = "<p>Review successfully updated.</p>";
} else {
    $msg = "<p>Failed to update review, try again!</p>";
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
        <title>do edit review</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <body>
        <?php include "navbar1.php" ?>
        <!--div creates a card-like container for organizing content-->
        <div class="card" style="width: 450px; margin: 0px auto; float: none ; margin-bottom: 10px; margin-top: 10px; background-color: whitesmoke">
            <!--contains the main content of the card-->
            <div class="card-body" style="color: black; text-align: center">
                <!--Displays the message stored in the $msg variable-->
                <p class="card-title"> <?php echo $msg; ?></p>
                <!--Displays the text "Go Back to" followed by a link that points to the "movieReview.php" page. The link also includes a URL parameter movieId which is obtained from the PHP variable $movieID-->
                <p>Go Back to <a href="movieReview.php?movieId=<?php echo $movieID; ?>">Review</a> page</p>
            </div>
        </div>
</html>
