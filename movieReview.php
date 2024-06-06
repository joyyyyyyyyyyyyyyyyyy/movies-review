<?php
// starts/resumes an existing session, used to track and store 
// user-specific data across different pages
session_start();

//allows for common code reuse (database connection)
include "dbFunction.php";

//retrieving the value of the userId parameter from the URL's query string using the $_GET superglobal
$movieID = $_GET['movieId'];

// Constructing a query to retrieve reviews, movies, and users data based on the given movieId
$query = "SELECT * FROM reviews "
        . "INNER JOIN movies ON reviews.movieId=movies.movieId "
        . "INNER JOIN users ON reviews.userId=users.userId "
        . "WHERE movies.movieId=$movieID";

// Execute the query and handle errors
$result = mysqli_query($link, $query) or die(mysqli_errno($link));

$arrContent = [];

// Fetching rows and storing them in the $arrContent array
while ($row = mysqli_fetch_array($result)) {
    $arrContent[] = $row;
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
    <!-- Meta information and external resources -->
    <meta charset="UTF-8">
    <title>Movie Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- CSS styles for dark and light mode -->
    <style>
        /* CSS variables for dark and light mode colors */
        :root {
            /* Dark mode table background color and text color */
            --table-background-dark: #333;
            --table-color-dark: #fff;
            /* Light mode table background color and text color */
            --table-background-light: #fff;
            --table-color-light: #333;
        }

        /* Dark mode styles */
        .dark-mode table {
            background-color: var(--table-background-dark);
            border: 1px solid #fff; /* White border in dark mode */
        }

        .dark-mode th {
            color: white;
        }

        .dark-mode tr,
        .dark-mode td {
            color: var(--table-color-dark);
        }

        /* Light mode styles */
        .light-mode table {
            background-color: var(--table-background-light);
            color: var(--table-color-light);
            border: 1px solid #000; /* Black border in light mode */
        }

        /* Default table styles */
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid var(--table-color-dark); /* Default border color for dark mode */
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid var(--table-color-dark);
            background-color: var(--table-background-dark);
            color: var(--table-color-light);
        }

        th {
            background-color: var(--table-color-dark);
            color: var(--table-background-dark);
        }
    </style>

    <!-- JavaScript function for toggling dark mode -->
    <script>
        function toggleDarkMode() {
            const body = document.querySelector('body');
            body.classList.toggle('dark-mode');
            body.classList.toggle('light-mode');
        }
    </script>
</head>
<body>
    <!-- Including the navigation bar -->
    <?php include "navbar1.php" ?>
    
    <!-- Displaying a welcome message if the user is logged in -->
    <?php if (isset($_SESSION['username'])) : ?>
        <p style="text-align: right; padding-top: 10px; padding-right: 10px;"><?php echo $welcome ?></p>
    <?php endif; ?>
    
    <!-- Heading for the page -->
    <h1 style="text-align: center;">View Reviews</h1>
    
    <!-- Link to add a new review -->
    <p style="text-align: center">Go add a <a href="insertReview.php?movieId=<?php echo $movieID; ?>">Review</a> now!</p>
    
    <!-- Container for the reviews -->
    <div class="container mt-3">           
        <?php if (count($arrContent) > 0) { ?>
            <!-- Display reviews in a table -->
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Review</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Date Posted</th>
                        <th scope="col">Username</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the reviews and display them
                    for ($i = 0; $i < count($arrContent); $i++) {
                        $movieTitle = $arrContent[$i]['movieTitle'];
                        $username = $arrContent[$i]['username'];
                        $reviewID = $arrContent[$i]['reviewId'];
                        $userId = $arrContent[$i]['userId'];
                        $review = $arrContent[$i]['review'];
                        $rating = $arrContent[$i]['rating'];
                        $datePosted = $arrContent[$i]['datePosted'];

                        // Convert MySQL datetime to a readable format
                        $formattedDate = date("M d, Y h:i A", strtotime($datePosted));
                        ?>
                        <!-- Display review information in table rows -->
                        <tr>
                            <td><?php echo $review; ?></td>
                            <td><?php echo $rating; ?></td>
                            <td><?php echo $formattedDate; ?></td>
                            <td><?php echo $username; ?></td>
                            <?php if (isset($_SESSION['username'])): ?>
                                <!-- Display edit and delete links for reviews if user is logged in and review owner -->
                                <td>
                                    <?php if ($_SESSION['username'] == $username): ?>
                                        <a href="editReview.php?reviewId=<?php echo $reviewID; ?>" name="reviewId">Edit</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($_SESSION['username'] == $username): ?>
                                        <form method="post" action="doDeleteReview.php">
                                            <a href="doDeleteReview.php?reviewId=<?php echo $reviewID; ?>" name="reviewId">Delete</a>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            <?php else: ?>
                                <td></td>
                                <td></td>
                            <?php endif; ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table> 
        <?php } else { ?>
            <!-- Display a message if there are no reviews available -->
            <p style="text-align: center">No reviews available for this movie.</p>
        <?php } ?>
        
        <!-- Link to go back to the movie view -->
        <p style="text-align: center"><a href="viewmovies.php?movieId=<?php echo $movieID; ?>">Back</a> to movie</p>
    </div>
</body>
</html>