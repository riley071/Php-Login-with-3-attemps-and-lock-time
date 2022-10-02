<?php   
    // setting site session
    
    if(empty($_SESSION['id'])){
        header('Location:Sign in.php');
    }
    if(isset($_SESSION['id'])){
        return true;
    }
?>