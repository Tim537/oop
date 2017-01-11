<?php ob_start(); ?>
<?php require_once('init.php'); ?>

<?php

// See if the user is already signed in
if($session->is_signed_in()){
    redirect('index.php');
}

// Check for the form submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Method to check database user

    if($user_found){
        $session->login($user_found);
        redirect('index.php');
    }else{
        $the_message = "Your username or password are incorrect";
    }

}else{
    $username = "";
    $password = "";
}

