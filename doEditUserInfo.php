<?php
// starts/resumes an existing session, used to track and store 
// user-specific data across different pages
session_start();

//allows for common code reuse (database connection)
include "dbFunction.php";

//retrieves the updated username from a form submission using the HTTP POST method
$updateUsername = $_POST['username'];
//retrieves the updated name from a form submission using the HTTP POST method
$updateName = $_POST['name'];
//checks if the updated date of birth (DOB) is provided in the form submission. 
//If it is, it retrieves the DOB from the form using the HTTP POST method (form field name: "dob"). 
//If it's not provided, an empty string is assigned to $updateDOB
$updateDOB = isset($_POST['dob']) ? $_POST['dob'] : '';
//retrieves the updated email address from a form submission using the HTTP POST method
$updateEmail = $_POST['email'];
//retrieves the updated password from a form submission using the HTTP POST method
$updatePassword = $_POST['password'];
//retrieves the user ID from the session variable $_SESSION['userId'], used to identify user
$userID = $_SESSION['userId'];

//imitialise a empty message used to store the result of the update operation
$msg = "";

//fetches the user's existing information from the database using a SELECT query based on the user's ID
$queryReview = "SELECT * FROM users WHERE users.userId=$userID";
$resultReview = mysqli_query($link, $queryReview) or die(mysqli_error($link));
$rowReview = mysqli_fetch_array($resultReview);

//holds an SQL query string that updates the user's information in the "users" table with the updated values obtained from the form submissions
$queryUpdate = "UPDATE users SET username='$updateUsername', "
        . "name='$updateName', dob='$updateDOB', password='$updatePassword', email='$updateEmail' "
        . "WHERE userId = $userID";

//executes the update query using the mysqli_query function. If there's an error during execution, the script will terminate and display the error message using die(mysqli_error($link))
$resultUpdate = mysqli_query($link, $queryUpdate) or die (mysqli_error($link));

//If the update query was successful ($resultUpdate is true), it assigns the message "Account Information has been successfully updated!" to the $msg variable. Otherwise, if the query was not successful, it assigns the message "Failed to update, try again!" to the $msg variable
if ($resultUpdate) {
    $msg = "<p>Account Information has been successfully updated!</p>";   
} else {
    $msg = "<p>Failed to update, try again!</p> ";
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
        <title>edit user info</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <body>
        <?php include "navbar1.php"?>
        <!--div creates a card-like container for organizing content-->
        <div class="card" style="width: 450px; margin: 0px auto; float: none ; margin-bottom: 10px; margin-top: 10px; background-color: whitesmoke">
            <!-- contains the main content of the card-->
            <div class="card-body" style="color: black">
                <!--  Displays the message stored in the $msg variable
                Text: "Go back to" followed by a link. The link uses an anchor (<a>) element with the text "Account" and a href attribute. 
                The href attribute specifies a URL that includes a URL parameter userId obtained from the session variable $_SESSION['userId']-->
                <p class="card-title"> <?php echo $msg; ?></p>
                Go back to <a href="userInfo.php?userId=<?php echo $_SESSION['userId']; ?>">Account</a> page
            </div>
        </div>
    </body>
</html>
