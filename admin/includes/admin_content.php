<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>

            <?php

            // Create a new user
//            $user = new User();
//            $user->username = 'Tony';
//            $user->password = 123;
//            $user->first_name = 'Tony';
//            $user->last_name = 'Smith';
//
//            $user->save();

            // Modify a User
//                $user = User::find_user_by_id(6);
//                $user->username = "Bob";
//                $user->first_name = "Bob";
//                $user->last_name = "Smith";
//
//                $user->save();

            $users = User::find_all();
            foreach ($users as $user){
                echo $user->username . "<br>";
            }

            ?>


        </div>
    </div>
    <!-- /.row -->

</div>
