<?php
// starts/resumes an existing session, used to track and store 
// user-specific data across different pages
session_start();

//allows for common code reuse (database connection)
include "dbFunction.php";

$querySelect = "SELECT * FROM movies";

//query is executed using the mysqli_query function. If there's an error during execution, the script will terminate using die(mysqli_error($link))
$result = mysqli_query($link, $querySelect) or die('error querying database');

//fetches each row from the query using 
//'mysqli_fetch_array' & assigns it to $row variable
//loop continues until there are no more rows left
while ($row = mysqli_fetch_array($result)) {
    $arrResult[] = $row;
}

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
        <title>View Movies</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- <link href="stylesheet/stylesheet.css" rel="stylesheet" type="text/css"/> -->
        <style>
            .card {
                border: none;
            }
        </style>
    </head>
    <body>
        <?php include "navbar1.php" ?>
        <?php if (isset($_SESSION['username'])) : ?>
            <p style="text-align: right; padding-top: 10px; padding-right: 10px;"><?php echo $welcome ?></p>
        <?php endif; ?>
        <h1 style="text-align: center;">Movies List</h1>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($arrResult as $movie) : ?>
                    <!-- Start a column for each movie card -->
                    <div class="col-md-4 col-sm-6 ">
                        <div class="card">
                            <!-- Display the movie image -->
                            <img src="images/<?php echo $movie['picture']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <!-- Display the movie title -->
                                <h5 style="color: black" class="card-title"><?php echo $movie['movieTitle']; ?></h5>
                                <!-- Display the movie genre -->
                                <p style="color: black" class="card-text"><b>Genre: </b><?php echo $movie['movieGenre']; ?></p>
                                <!-- Link to view more details about the movie -->
                                <a href="viewmovies.php?movieId=<?php echo $movie['movieId']; ?>">See more</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        <br><br>

    </body>
</html>
