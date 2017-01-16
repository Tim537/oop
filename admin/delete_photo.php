<?php include("includes/init.php"); ?>
<?php
//Check for login
if(!$session->is_signed_in()){
    redirect('login.php');
}


