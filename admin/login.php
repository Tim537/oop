<?php ob_start(); ?>
<?php require_once('includes/header.php'); ?>

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
    $user_found = User::verify_user($username, $password);


    if($user_found){
        $session->login($user_found);
        redirect('index.php');
    }else{
        $the_message = "Your username or password are incorrect";
    }

}else{
    $username = "";
    $password = "";
    $the_message = "";
}

?>

<div class="col-md-4 col-md-offset-3">

<h4 class="bg-danger"><?php echo $the_message; ?></h4>


<form id="login-id" action="" method="post">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >

    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">

    </div>


    <div class="form-group">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">

    </div>


</form>


</div>