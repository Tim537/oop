<?php
// Called by ajax from edit_user.php

require_once('init.php');


if (isset($_POST['image_name'])) {
    $image_name = $database->escape_string($_POST['image_name']);
    $user_id = $database->escape_string((int)$_POST['user_id']);
    $user = User::find_by_id($user_id);
    $user->ajax_save_user_image($image_name);
}

if (isset($_POST['photo_id'])) {
    $photo_id = $database->escape_string((int)$_POST['photo_id']);

    echo Photo::display_sidebar_data($photo_id);
}