<?php
//allows for common code reuse (database connection)
include "dbFunction.php";

//defines an SQL query that selects all columns from the "users" table. It retrieves all records from the table
$query = "SELECT * FROM users";
//executes the SQL query using the mysqli_query function. 
//It uses the established database connection $link and the query string $query. 
//The result of the query execution is stored in the $result variable
$result = mysqli_query($link, $query);
////starts a while loop that iterates through each row of the result set obtained from the query. 
//mysqli_fetch_array fetches the next row as an associative array, and the 
//loop continues as long as there are more rows to fetch
while ($row = mysqli_fetch_array($result)) {
    // Inside the loop, the fetched row (associative array) is added to the $arrResult array
    $arrResult[] = $row;
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
        <title>Registration Page</title>
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
        <?php include "navbar1.php"?>
        <!--  creates a card-like container for organizing content-->
        <div class="card" style="width: 450px; margin: 0px auto; float: none; margin-bottom: 10px; margin-top: 10px; background-color: whitesmoke">
            <!-- specifies that when the user submits the form, the data will be sent to the "doRegistration.php" script using the POST method-->
            <form method="post" action="doRegistration.php">
                <div class="card-body">
                    <!--Displays the text "Login" in a large heading style -->
                    <h1 style="text-align: center; color: black">Register</h1>
                    <!-- Display labels for fields like "Username:", "Password:", "Name:", "Date of Birth:", and "Email:"-->
                    <span style="color: black;">Username:</span><br>
                    <!--allow the user to enter their registration information -->
                    <input type="text" name="username" placeholder="Enter username" required="required"/><br>
                    <!-- Display labels for fields like "Username:", "Password:", "Name:", "Date of Birth:", and "Email:"-->
                    <span style="color: black;">Password:</span><br>
                    <!--allow the user to enter their registration information -->
                    <input type="password" name="password" placeholder="Enter password" required="required"/><br>
                    <!-- Display labels for fields like "Username:", "Password:", "Name:", "Date of Birth:", and "Email:"-->
                    <span style="color: black;">Name:</span><br>
                    <!--allow the user to enter their registration information -->
                    <input type="text" name="name" placeholder="Enter name" required="required"/><br>
                    <!-- Display labels for fields like "Username:", "Password:", "Name:", "Date of Birth:", and "Email:"-->
                    <span style="color: black;">Date of Birth:</span><br>
                    <!--allow the user to enter their registration information -->
                    <input type="date" name="dob" placeholder="DD/MM/YYYY" required="required"/><br>
                    <!-- Display labels for fields like "Username:", "Password:", "Name:", "Date of Birth:", and "Email:"-->
                    <span style="color: black;">Email:</span><br>
                    <!--allow the user to enter their registration information -->
                    <input type="email" name="email" placeholder="xyz@gmail.com" required="required"/>
                </div>
                 <div class="row">
                            <div class="col text-center" style="margin-bottom: 10px">
                                <button class="btn btn-dark bg-dark">Submit</button>
                            </div>
                </div>
            </form>
        </div>
        <p style="text-align: center">Already a member? <a href="login.php"> Login </a>now!</p>
    </body>
</html>


