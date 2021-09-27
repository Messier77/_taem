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

                <?php if(!empty($_SESSION['success_message'])) : ?>

                    <div class="alert alert-success" role="alert"><?php echo $_SESSION['success_message']; ?></div>

                <?php endif; ?>
                
                <?php $_SESSION['success_message'] = null; ?>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Trial and Error Makers
                            <small>Admin</small>
                        </h1>

                        <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        } else {
                            $source = '';
                        }

                        switch($source){
                            case 'add_product';
                            include 'includes/add_products.php';
                            break;

                            default:
                            include 'includes/view_all_products.php';
                        }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php";?>