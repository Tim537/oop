<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>

            <?php

            $sql = "SELECT * FROM users ";
            $result = $database->query($sql);
            while ($user_found = mysqli_fetch_array($result)) {
                echo $user_found['username'] . "<br>";
            }


            ?>


        </div>
    </div>
    <!-- /.row -->

</div>
