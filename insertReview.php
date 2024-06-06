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

$movieID = $_GET['movieId'];

$querySelect = "SELECT * FROM reviews "
        . "INNER JOIN movies ON reviews.movieId=movies.movieId "
        . "WHERE movies.movieId=$movieID";

//executes the SQL query using the mysqli_query function. If there's an error during execution, the script will terminate and display the error message 'error querying database'
$result = mysqli_query($link, $querySelect) or die('error querying database');

$row = mysqli_fetch_array($result);

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
        <title>Insert Review</title>
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
        <!-- creates a card-like container for organizing content-->
        <div class="card" style="width: 450px; margin: 0px auto; float: none ; margin-bottom: 20px; margin-top: 10px; background-color: whitesmoke">
            <!-- form tag specifies that when the user submits the form, the data will be sent to the "doInsertReview.php" script using the POST method-->
            <form method="post" action="doInsertReview.php">
                <div class="card-body">
                    <!-- Displays the text "Add A Review" in a large heading style-->
                    <h1 style="text-align: center; color: black">Add A Review</h1>
                    <!--Display labels "Rating:" and "Enter Description:" -->
                    <span style="color: black;">Rating:</span><br>
                    <!--element with type="number": This input field allows the user to enter a review rating -->
                    <input type="number" name="rating" placeholder="Enter Rating (1-5)" min="1" max="5" required="required"/><br>
                    <!--Display labels "Rating:" and "Enter Description:" -->
                    <span style="color: black;">Enter Description:</span><br>
                    <!-- textarea allows the user to enter a review description. It has a class attribute for styling and an id attribute for reference. The name attribute is used to identify the input in form submissions. The number of rows visible is set to 3.-->
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="review"></textarea>
                    <br>
                </div>
<!--                <input type="submit" value="Submit" style="text-align: center; display: block; margin:0 auto; background-color: black; color: white;"/>-->
                <!--hidden input field is used to pass the movieId to the "doInsertReview.php" script. The value of this field is set using PHP to the value of the $movieID variable -->
                <input type="hidden" name="movieId" value="<?php echo $movieID; ?>"/>
                <!-- used for a row layout-->
                <div class="row">
                    <!-- uses the Bootstrap grid system to create a column that is centered in the row layout-->
                    <div class="col text-center">
                        <!-- button is styled with the Bootstrap classes to appear as a dark-colored button-->
                        <button class="btn btn-dark bg-dark" style="margin-bottom: 10px;">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
