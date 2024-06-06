<?php
// Get the trailer ID from the URL parameter
//retrieves a value from the URL parameter named movieTrailerId using the $_GET superglobal array. 
//It assigns this value to the variable $movieTrailerId
$movieTrailerId = $_GET['movieTrailerId'];
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
        <title>trailer</title>
        <style>
            /* Styling for the entire page */
            body {
                margin: 0;
                padding: 0;
                background-color: #333333; /* Background color of the page */
                display: flex;
                justify-content: center; /* Horizontally center the content */
                align-items: center; /* Vertically center the content */
                height: 100vh; /* Set the height of the page to 100% of the viewport height */
            }

            /* Styling for the embedded iframe */
            iframe {
                width: 100%; /* Take up 100% of the available width */
                max-width: 1000px; /* Limit the maximum width to 1000px */
                height: 600px; /* Set the height of the iframe */
                border: none; /* Remove the border around the iframe */
                border-radius: 5px; /* Add a slight border-radius for a rounded appearance */
            }
        </style>
    </head>
    <body>
        <!-- Embed a YouTube video using an iframe -->
        <iframe src="https://www.youtube.com/embed/<?php echo $movieTrailerId ?>" ></iframe>
    </body>
</html>
