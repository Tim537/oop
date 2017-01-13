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
//            $user->username = 'Randy';
//            $user->password = 123;
//            $user->first_name = 'Randy';
//            $user->last_name = 'Jones';
//
//            $user->save();

            // Modify a User
//                $user = User::find_by_id(8);
//                $user->username = "Fred";
//                $user->first_name = "Fred";
//                $user->last_name = "Zuma";
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
