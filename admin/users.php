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
                        Users
                    </h1>
                    <p class="bg-success"><?php echo $session->message(); ?></p>
                    <a class="btn btn-primary" href="add_user.php">Add User</a>

                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $users = User::find_all();

                            foreach ($users as $obj) : ?>
                                <tr>
                                    <td><?php echo $obj->id; ?></td>
                                    <td><img class="user_image" src="<?php echo $obj->image_path_and_placeholder(); ?>"
                                             alt=""></td>
                                    <td><?php echo $obj->username; ?>
                                        <div class="action_links">
                                            <a class="delete_link" href="delete_user.php?id=<?php echo $obj->id; ?>">Delete</a>
                                            <a href="edit_user.php?id=<?php echo $obj->id; ?>">Edit</a>
                                        </div>
                                    </td>
                                    <td><?php echo $obj->first_name; ?></td>
                                    <td><?php echo $obj->last_name; ?></td>
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