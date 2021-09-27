<?php include "./includes/admin_header.php";?>

<?php

session_start(); 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

?>

    <div id="wrapper">

    <?php include "./includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Trial and Error Makers
                            <small>Admin</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php";?>