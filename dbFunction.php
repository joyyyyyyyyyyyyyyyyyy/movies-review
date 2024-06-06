<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$host = "localhost";
$username = "root";
$password = "";
$db = "c203_moviereviewdb";

$link = mysqli_connect($host, $username, $password, $db) or die(mysqli_connect_error());

?>
