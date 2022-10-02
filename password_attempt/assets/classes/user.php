<?php
     
    class users{

        // Database connection
        
        function dbConnection(){

            $host ="localhost";
            $dbusername="root";
            $dbpassword="";
            $database="DriverlessDB";

            $con = mysqli_connect($host,$dbusername,$dbpassword,$database) or die(mysqli_error($con));

            return $con;

          }
          

        // registration script method

        function registerUsers($username,$firstname, $lastname,  $email, $password)
        {
            $con = $this->dbConnection();
    
            // Sanitizing input 

            $username = mysqli_escape_string($con,$username);
            $firstname = mysqli_escape_string($con,$firstname);
            $lastname = mysqli_escape_string($con,$lastname);
            $email = mysqli_escape_string($con,$email);
            $password = mysqli_escape_string($con,$password);
        
            
            $query = "INSERT INTO Users (Username, Firstname,Lastname,Password,Email) VALUES( \"$username\",
                \"$firstname\",\"$lastname\",'$password','$email'
            )";
            $res= mysqli_query($con,$query) or die(mysqli_error($con));

            return $res;
    
        }

        //login authentication script method
        function loginAuthentication($username, $password)
        { 
            $con = $this->dbConnection();

            $username = mysqli_escape_string($con,$username);
            $password = mysqli_escape_string($con,$password);

            $query = "SELECT Username, Password FROM Users WHERE Username= '$username' AND Password = '$password'";
            $results= mysqli_query($con,$query) or die(mysqli_error($con));
            return $results;
        }

        // fetching profile data

        function getProfileData($id){
            $con = $this->dbConnection();
            $id = mysqli_escape_string($con,$id);

            $query = "SELECT * FROM users WHERE Username='$id'";
            $results =  mysqli_query($con,$query) or die(mysqli_error($con));
            return $results;

        }

          // updating profile data
        function updateProfileInformation($username,$email, $firstname, $lastname, $Dob, $address, $postal, $id){

            $con = $this->dbConnection();

            $username = mysqli_escape_string($con,$username);
            $firstname = mysqli_escape_string($con,$firstname);
            $lastname = mysqli_escape_string($con,$lastname);
            $email = mysqli_escape_string($con,$email);
            $id = mysqli_escape_string($con,$id);

            $query = "UPDATE Users SET Username ='$username', Firstname ='$firstname', Lastname = '$lastname', Email = '$email' WHERE Username='$id'";
            $results =  mysqli_query($con,$query) or die(mysqli_error($con));
            return $results;
        }

        // updating Password

        function updatePassword($new_password, $id){

            $con = $this->dbConnection();

            $new_password = mysqli_escape_string($con,$new_password);
            $id = mysqli_escape_string($con,$id);

            $query = "UPDATE Users SET Password='$new_password' WHERE Username='$id'";
            $results =  mysqli_query($con,$query) or die(mysqli_error($con));
            return $results;
    
        }

        // setting lockedout status

        function setLockedOutStatus($id){

            $con = $this->dbConnection();
            $id = mysqli_escape_string($con,$id);

            $query = "UPDATE Users SET Status= 1 WHERE Username='$id'";
            $results =  mysqli_query($con,$query) or die(mysqli_error($con));
            return $results;
        }

         // updating lockedout status

         function updatetLockedOutStatus($id){

            $con = $this->dbConnection();
            $id = mysqli_escape_string($con,$id);

            $query = "UPDATE Users SET Status = 0 WHERE Username='$id'";
            $results =  mysqli_query($con,$query) or die(mysqli_error($con));
            return $results;
        }

    }
   
?>