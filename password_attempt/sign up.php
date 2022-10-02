
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driverless - Sign Up</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=c305caef9853c9ccaee9ff7f273bf729">
      <link rel="stylesheet" href="assets/css/styles.css">
    </head>
<body>
    <section >
        <div class="container">
            <form method="post" action="register.php" class="login-email">
                <h2 class="text-center"><strong>Create an account.</strong></h2>
                <div class="form-group"><input type="text" class="form-control" name="username" required placeholder="Username" />
                <p class="pt-2" style="color: red; font-size:small">
                <?php
                    session_start();
                    
                    if(isset($_SESSION['UsernameError'])){
                        echo $_SESSION['UsernameError'];
                        unset($_SESSION['UsernameError']);
                    }
                    else{
                        $_SESSION['UsernameError'] = null;
                    }
                 ?>
            </p>
            </div>
                <div class="form-group"><input type="text" class="form-control" name="Firstname" required placeholder="Firstname" /></div>
                <div class="form-group"><input type="text" class="form-control" name="Lastname" required placeholder="Lastname" /></div>
                <div class="form-group"><input type="email" class="form-control" name="email" required placeholder="Email" /></div>
                <div class="form-group"><input type="password" class="form-control" name="password" placeholder="Password" /></div>
                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" />I agree to the license terms & Conditions.</label></div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Create</button></div>
                <a class="already" href="Sign in.php">You already have an account? Login here.</a>
            </form>
        </div>
    </section>
</body>
</html>