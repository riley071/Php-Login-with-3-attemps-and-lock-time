<?php
      session_start();

            $host ="localhost";
            $dbusername="root";
            $dbpassword="";
            $database="DriverlessDB";

             // Create connection
            $con = mysqli_connect($host,$dbusername,$dbpassword) or die(mysqli_error($con));
           
            // Check connection
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error($con));
                }
               
            // Creating Database
            
            $sql = "CREATE DATABASE DriverlessDB";
            if (mysqli_query($con, $sql)) {
                } else {
                 echo die (mysqli_error($con));
                }

            mysqli_close($con);
            
              // creating User table
            $con = mysqli_connect($host,$dbusername,$dbpassword,$database) or die(mysqli_error($con));
            $query = "CREATE TABLE Users (
                Username varchar(30),
                Firstname varchar(30),
                Lastname varchar(30),
                Password varchar(10),
                Email Varchar(30),
                 Status int NOT NULL DEFAULT '0',
                PRIMARY KEY (Username)
            )";
          $result= mysqli_query($con,$query) or die("Table Creation Failed");

          
          if($res == true){
              header('Location:Sign in.php');
          }
    ?>