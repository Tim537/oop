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

            echo "<h3>Get User By Id:</h3>";
            $found_user = User::find_user_by_id(2);

            echo $found_user->username;


            ?>


        </div>
    </div>
    <!-- /.row -->

</div>
