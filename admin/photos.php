<?php include("includes/header.php"); ?>
<?php
//Check for login
if (!$session->is_signed_in()) {
    redirect('login.php');
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

                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Id</th>
                                <th>File Name</th>
                                <th>Title</th>
                                <th>Size</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $photos = Photo::find_all();

                            foreach ($photos as $obj) : ?>
                                <tr>
                                <td><img src="<?php echo $obj->picture_path(); ?>" alt="" width="150">
                                <div class="pictures_link">
                                    <a href="delete_photo.php?id=<?php echo $obj->id; ?>">Delete</a>
                                    <a href="#">Edit</a>
                                    <a href="#">View</a>
                                </div>
                                </td>
                                <td><?php echo $obj->id; ?></td>
                                <td><?php echo $obj->filename; ?></td>
                                <td><?php echo $obj->title; ?></td>
                                <td><?php echo $obj->size; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>