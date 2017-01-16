<?php include("includes/header.php"); ?>
<?php
//Check for login
if (!$session->is_signed_in()) {
    redirect('login.php');
}

if(isset($_POST['update'])){

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
                        Photos
                        <small>Subheading</small>
                    </h1>
                    <form action="" method="post">
                        <div class="col-md-8">

                            <div class="form-group">
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="caption">Caption</label>
                                <input type="text" name="caption" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="caption">Alternate Text</label>
                                <input type="text" name="alternate_text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="caption">Description</label>
                                <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="photo-info-box">
                                <div class="info-box-header">
                                    <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span>
                                    </h4>
                                </div>
                                <div class="inside">
                                    <div class="box-inner">
                                        <p class="text">
                                            <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22,
                                            2030 @
                                            5:26
                                        </p>
                                        <p class="text ">
                                            Photo Id: <span class="data photo_id_box">34</span>
                                        </p>
                                        <p class="text">
                                            Filename: <span class="data">image.jpg</span>
                                        </p>
                                        <p class="text">
                                            File Type: <span class="data">JPG</span>
                                        </p>
                                        <p class="text">
                                            File Size: <span class="data">3245345</span>
                                        </p>
                                    </div>
                                    <div class="info-box-footer clearfix">
                                        <div class="info-box-delete pull-left">
                                            <a href="delete_photo.php?id=<?php echo $photo->id; ?>"
                                               class="btn btn-danger btn-lg ">Delete</a>
                                        </div>
                                        <div class="info-box-update pull-right ">
                                            <input type="submit" name="update" value="Update"
                                                   class="btn btn-primary btn-lg ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>