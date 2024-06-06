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

//retrieves the userID from the session variable $_SESSION['userId']
$userID = $_SESSION['userId'];

//retrieves the review rating value from a form submission using the HTTP POST method
$reviewRating = $_POST['rating'];
//retrieves the review description or content from a form submission using the HTTP POST method
$reviewDescription = $_POST['review'];
//etrieves the movie ID from a form submission using the HTTP POST method
$movieID = $_POST['movieId'];

//variable holds an SQL query string that inserts a new review into the "reviews" table. It uses the values obtained from the form submissions to insert the review content, rating, associated movie ID, user ID, and the current date and time using the NOW() function
$sql = "INSERT INTO reviews (movieId, userId, review, rating, datePosted) "
        . "VALUES ('$movieID', $userID, '$reviewDescription', $reviewRating, NOW())"; // Use NOW() to insert the current date and time

//executes the SQL query using the mysqli_query function. If there's an error during execution, the script will terminate and display the error message 'error querying database'
$status = mysqli_query($link, $sql) or die('error querying database');

// If the query was successful ($status is true), it assigns the message "Review added successfully." to the $msg variable. Otherwise, if the query was not successful, it assigns the message "Failed to add review, try again!" to the $msg variable
if ($status) {
    $msg = "Review added successfully.";
} else {
    $msg = "Failed to add review,try again!";
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
    </head>
    <body>
        <?php include "navbar1.php" ?>
        <!--div creates a card-like container for organizing content-->
        <div class="card" style="width: 450px; margin: 0px auto; float: none ; margin-bottom: 10px; margin-top: 10px; background-color: whitesmoke">
            <!-- contains the main content of the card-->
            <div class="card-body" style="">
                <!--Displays the message stored in the $msg variable-->
                <p class="card-title" style="color: black"> <?php echo $msg; ?></p>
                <!--Displays  the text "Go Back to" followed by a link that points to the "movieReview.php" page. The link includes a URL parameter movieId, which is obtained from the PHP variable $movieID-->
                <p style="color: black">Go Back to <a href="movieReview.php?movieId=<?php echo $movieID; ?>">Review</a> page</p>
            </div>
        </div>
    </body>
</html>
