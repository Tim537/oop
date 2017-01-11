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
            $result_set = User::find_all_users();
            while ($user_found = mysqli_fetch_array($result_set)) {
                echo $user_found['username'] . "<br>";
            }
            echo "<br><br><h3>Get user by id:</h3>";

            $user_result = User::find_user_by_id(2);
            $user = User::instantiation($user_result);
            echo $user->username;
            ?>


        </div>
    </div>
    <!-- /.row -->

</div>
