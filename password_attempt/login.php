<?php

    session_start();

    $host ="localhost"; //server
    $dbusername="root"; // username
    $dbpassword=""; 
    $database=""; // database name

    $con = mysqli_connect($host,$dbusername,$dbpassword,$database) or die(mysqli_error($con));

    $email = mysqli_escape_string($con,$email); // login values
    $password = mysqli_escape_string($con,$password); // login values

    $query = "SELECT Email, Password FROM Users WHERE Email= '$email' AND Password = '$password'"; // query
    $results= mysqli_query($con,$query) or die(mysqli_error($con));

    if(mysqli_num_rows($results) > 0){

        // Login true code

        $_SESSION['id'] = $email; // setting a user session ID
    }
    else{
        //login false code
    }
?>