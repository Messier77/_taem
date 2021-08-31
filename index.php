<?php include "./includes/db.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="shortcut icon" href="./images/icons/Logo-simbol-black.svg" type="image/x-icon">
    <title>Trial and Error Makers | Crafting and shit</title>
</head>

<body>
    <!-- This is the navigation menu -->
    <nav>
        <!-- Social icons in the header -->
        <div class="social-header">
            <ul>
                <li><a href="#"><img src="./images/icons/youtube-icon.svg" alt=""></a></li>
                <li><a href="#"><img src="./images/icons/facebook-icon.svg" alt=""></a></li>
                <li><a href="#"><img src="./images/icons/instagram-icon.svg" alt=""></a></li>
                <li><a href="#"><img src="./images/icons/twitter-icon.svg" alt=""></a></li>
                <li class="header-icon-mobile"><a href="#"><img src="./images/icons/youtube-icon-header-mobile.svg" alt=""></a></li>
            </ul>
        </div>

        <!-- Logo -->
        <div class="logo">
            <a href="#"><img src="./images/icons/Logo-and-bg.svg" alt=""></a>
        </div>

        <!-- Navigation menu -->
        <div class="nav-menu">
            <ul>
                <li><a href="./work/work.php">Work</a></li>
                <li><a href="#">YouTube Channel</a></li>
                <li><a href="./contact/contact.php">Meet us</a></li>
                <li class="header-icon-mobile burger-toggle"><img src="./images/icons/burger-menu.svg" alt=""></li>
                <li class="header-icon-mobile burger-toggle" id="burger-close"><img src="./images/icons/burger-menu-close.svg" alt=""></li>
            </ul>
        </div>
    </nav>
    <div class="mobile-nav inactive-menu">
        <ul>
            <li><a href="./work/work.php">Work</a></li>
            <li><a href="#">YouTube Channel</a></li>
            <li><a href="./contact/contact.php">Meet us</a></li>
        </ul>

        <ul class="burger-social">
            <li><a href="#"><img src="./images/icons/youtube-icon.svg" alt=""></a></li>
            <li><a href="#"><img src="./images/icons/facebook-icon.svg" alt=""></a></li>
            <li><a href="#"><img src="./images/icons/instagram-icon.svg" alt=""></a></li>
            <li><a href="#"><img src="./images/icons/twitter-icon.svg" alt=""></a></li>
        </ul>
    </div>

    <!-- Our work - Homepage -->
    <section class="projects">
        <div class="section-title">
            <h1>Hello! We are Dragos and Teo and these are some of the things we love to create in our small shop.</h1>
        </div>
        <div class="projects-center">

            <?php 
                
            $query = "SELECT * FROM products WHERE product_is_featured = true";
            $select_all_products_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_products_query)) {
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $product_short_description = $row['product_short_description'];
                    $product_featured_photo = $row['product_featured_photo'];
            ?>

            <!-- Single project -->
            <a href="#">
                <div class="project">
                    <img src="./images/products/<?php echo $product_id ?>/<?php echo $product_featured_photo ?>" alt="" class="project-img" />
                    <div class="project-info">
                        <h4><?php echo $product_name ?></h4>
                        <p><?php echo $product_short_description ?></p>
                        <img src="./images/icons/arrow.svg" alt="">
                    </div>
                </div>
            </a>
            <!-- End of single project -->
            <?php } ?>
        </div>
    </section>
    <!-- end of projects -->

    <!-- This is the footer -->
    <div class="footer">
        <div class="info-footer">
            <p>&copy; 2020 <span>Trial And Error Makers</span></p>
        </div>

        <div class="footer-logo">
            <a href="#"><img src="./images/icons//Footer-logo.svg" alt=""></a>
        </div>

        <div class="social-footer">
            <ul>
                <li><a href="#"><img src="./images/icons/youtube-icon-white.svg" alt=""></a></li>
                <li><a href="#"><img src="./images/icons/facebook-icon-white.svg" alt=""></a></li>
                <li><a href="#"><img src="./images/icons/instagram-icon-white.svg" alt=""></a></li>
                <li><a href="#"><img src="./images/icons/twitter-icon-white.svg" alt=""></a></li>
            </ul>
        </div>
    </div>

    <script src="./scripts/scripts.js"></script>
</body>

</html>