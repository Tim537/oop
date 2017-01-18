<?php include("includes/header.php"); ?>
<?php
//Check for login
if (!$session->is_signed_in()) {
    redirect('login.php');
}

$message = "";
// Check for form submission
if(isset($_POST['submit'])){
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['file_upload']);

    if($photo->save()){
        $message = "Photo uploaded successfully";
    }else{
        $message = join("<br>", $photo->errors);
    }
}
?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <?php require_once('includes/top_nav.php'); ?>


        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php require_once('includes/side_nav.php'); ?>
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Upload
                    </h1>
                    <div class="col-md-6">
                        <?php echo $message; ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="file" name="file_upload">
                            </div>
                            <input type="submit" name="submit" value="Submit">

                        </form>
                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>