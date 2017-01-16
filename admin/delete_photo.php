<?php include("includes/init.php"); ?>
<?php
//Check for login
if (!$session->is_signed_in()) {
    redirect('login.php');
}

if(empty($_GET['id'])){
    redirect('photos.php');
}

$photo = Photo::find_by_id($_GET['id']);

if($photo){
    $photo->delete_photo();
}else{
    redirect('photos.php');
}
