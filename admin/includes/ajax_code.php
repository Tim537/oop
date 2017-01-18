<?php
// Called by ajax from edit_user.php

require_once ('init.php');


if(isset($_POST['image_name'])){
    $user = User::find_by_id($_POST['user_id']);
    $user->ajax_save_user_image($_POST['image_name']);
}