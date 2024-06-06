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

//retrieves the value of the reviewId parameter from the URL's query string using the $_GET superglobal
$reviewID = $_GET['reviewId'];

//constructs an SQL query to retrieve data from a table named "reviews" based on the provided 
//reviewId. The query is designed to select all columns (*) from the "reviews" table where the 
//reviewId matches the value stored in the $reviewID variable
$queryReview = "SELECT * FROM reviews "
        . "WHERE reviewId=$reviewID";

//xecutes the constructed SQL query using the mysqli_query function. It uses the database 
//connection stored in the $link variable and the query string $queryReview. If the query 
//execution fails, it triggers an error message using die(mysqli_error($link))
$resultReview = mysqli_query($link, $queryReview) or 
        die(mysqli_error($link));

//fetches the result of the executed query and stores the data of the first returned row in an 
//associative array called $rowReview. The mysqli_fetch_array function fetches the next row from the 
//result set
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
        <title>edit review</title>
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
        <?php include "navbar1.php" ?>
        <p style="text-align: right ; padding-top: 10px; padding-right: 10px;"><?php echo $welcome ?></p>
        <div class="card" style="width: 450px; margin: 0px auto; float: none ; margin-bottom: 10px; margin-top: 10px; background-color: whitesmoke">
            <div class="card-body" style="">
                <h1 class="card-title" style="text-align: center; color: black">Review</h1>
                <form method="post" action="doEditReview.php">
                    <span style="color: black;">Edit Rating:</span><br>
                    <input type="number" name="rating" value="<?php echo $rowReview['rating'] ?>" required="required"/><br>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" style="color: black">Edit review here:</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="review"><?php echo $rowReview['review'] ?></textarea>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <input type="hidden" name="movieId" value="<?php echo $rowReview['movieId'] ?>"/>
                                <input type="hidden" name="id" value="<?php echo $rowReview['reviewId'] ?>"/><br>
                                <button class="btn btn-dark bg-dark">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
