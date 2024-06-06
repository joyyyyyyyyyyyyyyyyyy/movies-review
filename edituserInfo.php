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

//retrieving the value of the userId parameter from the URL's query string using the $_GET superglobal
$userID = $_GET['userId'];

$queryReview = "SELECT * FROM users WHERE users.userId=$userID";

//query is executed using the mysqli_query function. If there's an error during execution, the script will terminate using die(mysqli_error($link))
$resultReview = mysqli_query($link, $queryReview) or die(mysqli_error($link));

$rowReview = mysqli_fetch_row($resultReview);

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
        <title>edit user info</title>
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
                <h1 class="card-title" style="text-align: center; color: black">Edit Account</h1>

                <form method="post" action="doEditUserInfo.php">
                    <span style="color: black;">Edit Username:</span><br>
                    <input type="text" name="username" value="<?php echo $rowReview['1'] ?>"/><br>
                    <span style="color: black;">Edit Name:</span><br>
                    <input type="text" name="name" value="<?php echo $rowReview['3'] ?>"/><br>
                    <span style="color: black;">Date of Birth:</span><br>
                    <input type="date" name="dob" value="<?php echo $rowReview['4'] ?>" /><br>
                    <span style="color: black;">Edit Password:</span><br>
                    <input type="text" name="password" value="<?php echo $rowReview['2'] ?>"/><br>
                    <span style="color: black;">Edit Email:</span><br>
                    <input type="email" name="email" value="<?php echo $rowReview['5'] ?>"/><br><br>
                    <div class="col text-center">
                        <input type="hidden" name="userId" value="<?php echo $_SESSION['6']; ?>"/>
                        <button class="btn btn-dark bg-dark">Edit Information</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
