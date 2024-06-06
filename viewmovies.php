<?php
// starts/resumes an existing session, used to track and store 
// user-specific data across different pages
session_start();

//allows for common code reuse (database connection)
include "dbFunction.php";

//retrieving the value of the userId parameter from the URL's query string using the $_GET superglobal
$theID = $_GET['movieId'];

$query = "SELECT * FROM movies WHERE movieId =$theID";

//query is executed using the mysqli_query function. If there's an error during execution, the script will terminate using die(mysqli_error($link))
$result = mysqli_query($link, $query) or die(mysqli_errno($link));

$row = mysqli_fetch_array($result);
if (!empty($row)) {
    $movietitle = $row['movieTitle'];
    $moviegenre = $row['movieGenre'];
    $movietime = $row['runningTime'];
    $movielanguage = $row['language'];
    $moviepicture = $row['picture'];
    $moviedirector = $row['director'];
    $moviecast = $row['cast'];
    $moviesypnosis = $row['synopsis'];
    $movieTrailerId = $row['youtubeTrailerId'];
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
        <title></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            /* Header styling */
            header {
                background-color: #e52d27;
                color: #fff;
                text-align: center;
                padding: 15px;
            }

            /* Container styling for the main content */
            .container {
                max-width: 900px;
                margin: 20px auto;
                background-color: #fff;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 5px;
                padding: 20px;
            }

            /* Styling for the movie information section */
            .movie-info-container {
                display: flex;
                margin-bottom: 30px;
            }

            /* Styling for the movie image */
            .movie-image {
                flex: 1;
                max-width: 300px;
                margin-right: 20px;
            }

            /* Styling for the movie image itself */
            .movie-image img {
                width: 100%;
                display: block;
                border-radius: 5px;
            }

            /* Styling for the movie information */
            .movie-info {
                flex: 2;
                padding: 10px;
                color: black;
            }

            /* Styling for the movie title */
            .movie-info h2 {
                color: #e52d27;
                font-size: 24px;
                margin: 10px 0;
            }

            /* Styling for emphasized text */
            .movie-info b {
                color: #555;
                font-weight: 600;
            }

            /* Styling for the movie title (centered) */
            .movie-title {
                text-align: center;
                margin: 20px 0;
            }

            /* Styling for the trailer button */
            .trailer-btn {
                text-align: left;
                margin-top: 20px;
            }

            /* Styling for the trailer button link */
            .trailer-btn a {
                color: #fff;
                text-decoration: none;
                padding: 10px 20px;
                background-color: #e52d27;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            /* Styling for the reviews button */
            .reviews-btn {
                text-align: center;
                margin-top: 20px;
            }

            /* Styling for the reviews button link */
            .reviews-btn a {
                color: #fff;
                text-decoration: none;
                padding: 10px 20px;
                background-color: #e52d27;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            /* Styling for the reviews button link on hover */
            .reviews-btn a:hover {
                background-color: #c8191e;
            }
        </style>

    </head>
    <body>
        <?php include "navbar1.php" ?>
        <div class="container">
            <?php if (isset($_SESSION['username'])) : ?>
                <p style="text-align: right; color: black; padding-top: 10px; padding-right: 10px;"><?php echo $welcome ?></p>
            <?php endif; ?>

            <h1 class="movie-title" style="text-align: center; color: black">Movie Information</h1>

            <div class="movie-info-container">
                <div class="movie-image">
                    <img src="images/<?php echo $moviepicture ?>" alt="<?php echo $movietitle ?>" />
                </div>
                <div class="movie-info">
                    <h2><?php echo $movietitle ?></h2>
                    <b>Genre:</b> <?php echo $moviegenre ?><br>
                    <b>Duration:</b> <?php echo $movietime ?><br>
                    <b>Language:</b> <?php echo $movielanguage ?><br>
                    <b>Director:</b> <?php echo $moviedirector ?><br>
                    <b>Cast:</b> <?php echo $moviecast ?><br>
                    <b>Synopsis:</b> <?php echo $moviesypnosis ?><br>
                    <div class="reviews-btn">
                        <a href="movieReview.php?movieId=<?php echo $theID; ?>">See Reviews</a>
                    </div>
                </div>
            </div>
            <div class="trailer-btn">
                <a href="trailerPage.php?movieTrailerId=<?php echo $movieTrailerId; ?>" target="_blank">Trailer</a>
            </div>
        </div>
        <br><br>
    </body>
</html>