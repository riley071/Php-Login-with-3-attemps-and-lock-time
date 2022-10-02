
<?php 
    session_start();
    require './assets/classes/user.php';


    //intializing the users class 
    $users = new users();

    // initializing attempts variable
    if(isset($_SESSION['attempts'])){
        //
    }
    else{
        $_SESSION['attempts'] = 0;
        
    }

    // checking the difference between the locked time and the actual time

    if(isset($_SESSION['Time_Locked'])){
        $Locked_time = time() - $_SESSION['Time_Locked'];
        if($Locked_time > 60){

            // unsetting session variables
            unset($_SESSION['Time_Locked']);
            $_SESSION['attempts'] = 0;
            if(isset($_SESSION['User_Locked'])){
                $users->updatetLockedOutStatus($_SESSION['User_Locked']);
            }
           
        }
    }

   //checking the submitted POST data from the form
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {

    $username = $_POST['username'];
    $password = $_POST['password'];

     $results = $users->loginAuthentication($username,$password);
     
     // checking the number of rows returned from the query
        if(mysqli_num_rows($results) > 0){

            $lockStatus = $users->getProfileData($username);

            $row = mysqli_fetch_assoc($lockStatus);

            //checking the account lock status
            if($row['Status'] == 0){
                header('Location:profile.php');
                
                $_SESSION['id'] = $username;
            }
            else if($row['Status'] == 1){
                $_SESSION['attempts'] = 3;
                $_SESSION['locked_id'] = $username;
            }
        }
        // incrementing attempts upon login failure
        else{
            $_SESSION['attempts'] += 1;
            $_SESSION['errorMsg'] = 'Incorrect Username or Password';
           
        }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=c305caef9853c9ccaee9ff7f273bf729">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <title>HGE - Sign in</title>

</head>
<body>

    <section>
        <div class="container">
            
            <form method="POST" class="login-email">
            
                <h2 class="text-center"><strong>Log in</strong></h2>
                <div class="form-group"><input type="text" class="form-control" name="username" placeholder="Enter Username" required/></div>
                <div class="form-group"><input type="password" class="form-control" name="password" placeholder="Enter Password"  required/></div>
                <div class="form-group" style="color: red; font-weight:500">
                
                <?php
                // displaying error messages
                     if(isset($_SESSION['errorMsg'])){
                         echo $_SESSION['errorMsg'];
                         unset($_SESSION['errorMsg']);
                         $_SESSION['User_Locked'] = $username;
                     }      
                ?></div>
                
                <div style="color: red; font-weight:500" class="form-group">
                <?php 
                // checking the number of failed login attempts
                    if($_SESSION['attempts'] > 2){
                        $_SESSION['Time_Locked'] = time();

                        if (isset( $_SESSION['Time_Locked'])){
                           
                            $users->setLockedOutStatus( $_SESSION['User_Locked']);
                        }
                       
                       echo '<p id="timer" >Sorry you have been Locked out please wait for <span style="color:red; font-weight:500;" >10 mins</span><span style="color:red; font-weight:500;" ></span> and try again.</p>';
                       
                   }
                   else{
                       // hiding the submit button 
                ?>
                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
               
                </div>
                <a class="already" href="Sign up.php">Don't have an account? Create one here.</a>  <?php } ?>
            </form>
        </div>
    </section>
     <script>
         

            // Set the date we're counting down to
            var countDownDate = new Date("Nov 10, 2021 15:10:00").getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
          
            var minutes = Math.floor((distance % (1000 * 60 * 10)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("locked_minutes").innerHTML = minutes;
            document.getElementById("locked_seconds").innerHTML = seconds;

            // If the count down is finished, write some text
            if (minutes < 0) {
                clearInterval(x);
                distance = new Date().getTime();
            }
            });
    </script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/script.min.js?h=f79f07d57e29993a7bb88b05adbc616d"></script>
</body>
</html>