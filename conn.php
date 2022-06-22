<?php
//connect mysql database
$host = "localhost";
$user = "root";
$pass = "";
$db = "goal_pp";
$conn = mysqli_connect($host, $user, $pass, $db) or die("Error " . mysqli_error($conn));
mysqli_query($conn, 'SET NAMES UTF8');
