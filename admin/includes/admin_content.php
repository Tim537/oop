<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>

            <?php

            echo "<h3>Get all users:</h3>";
            $users = User::find_all_users();

            foreach ($users as $user) {
                echo $user->username . "<br>";
            }
            ?>


        </div>
    </div>
    <!-- /.row -->

</div>
