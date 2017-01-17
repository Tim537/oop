<?php include("includes/init.php"); ?>
<?php
//Check for login
if (!$session->is_signed_in()) {
    redirect('login.php');
}

if (empty($_GET['id'])) {
    redirect('comments.php');
}

$comment = Comment::find_by_id($_GET['id']);

if ($comment) {
    $comment->delete();
    redirect("comment_photo.php?id={$comment->photo_id}");
} else {
    redirect("comment_photo.php?id={$comment->photo_id}");
}
