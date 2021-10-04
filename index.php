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
                <li><a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank"><img src="./images/icons/youtube-icon.svg" alt=""></a></li>
                <li><a href="https://www.facebook.com/TrialAndErrorMakers/" target="_blank"><img src="./images/icons/facebook-icon.svg" alt=""></a></li>
                <li><a href="https://www.instagram.com/trialanderrormakers/" target="_blank"><img src="./images/icons/instagram-icon.svg" alt=""></a></li>
                <li><a href="https://twitter.com/taemakers/" target="_blank"><img src="./images/icons/twitter-icon.svg" alt=""></a></li>
                <li class="header-icon-mobile"><a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank"><img src="./images/icons/youtube-icon-header-mobile.svg" alt=""></a></li>
            </ul>
        </div>

        <!-- Logo -->
        <a href="./"><div class="logo">
        </div>
        <div class="logo2">
        </div></a>

        <!-- Navigation menu -->
        <div class="nav-menu">
            <ul>
                <li><a href="./work.php">Work</a></li>
                <li><a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank">YouTube Channel</a></li>
                <li><a href="./contact.php">Meet us</a></li>
                <li class="header-icon-mobile"><img class="burger-image" src="./images/icons/burger-menu.svg" alt=""></li>
            </ul>
        </div>
    </nav>
    <div class="mobile-nav">
        <ul>
            <li><a href="./work.php">Work</a></li>
            <li><a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank">YouTube Channel</a></li>
            <li><a href="./contact.php">Meet us</a></li>
        </ul>

        <ul class="burger-social">
            <li><a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank"><img src="./images/icons/youtube-icon.svg" alt=""></a></li>
            <li><a href="https://www.facebook.com/TrialAndErrorMakers/" target="_blank"><img src="./images/icons/facebook-icon.svg" alt=""></a></li>
            <li><a href="https://www.instagram.com/trialanderrormakers/" target="_blank"><img src="./images/icons/instagram-icon.svg" alt=""></a></li>
            <li><a href="https://twitter.com/taemakers/" target="_blank"><img src="./images/icons/twitter-icon.svg" alt=""></a></li>
        </ul>
    </div>

    <!-- Our work - Homepage -->
    <section class="projects">
        <div class="section-title">
            <h1>Hello! We are Dragos and Teo and these are some of the things we love to create in our small shop.</h1>
        </div>
        <div class="projects-center">

            <?php 
                
            $query = "SELECT * FROM products WHERE is_featured = true";
            $select_all_products_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_products_query)) {
                    $product_id = $row['id'];
                    $product_name = $row['name'];
                    $product_short_description = $row['short_description'];
                    $featured_image = $row['featured_image'];
                    $slug = $row['slug'];
            ?>

            <!-- Single project -->
            <a href="./project.php?product=<?php echo $slug ?>" class="all-projects">
                <div class="project">


                    <?php if(strlen($featured_image) < 1) : ?>
                        <img src="./images/contact/default.jpg" alt="" class="project-img" />
                    <?php endif; ?>

                    <?php if(strlen($featured_image) > 1) : ?>
                        <img src="./images/products/<?php echo $featured_image ?>" alt="" class="project-img" />
                    <?php endif; ?>


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
            <a href="./"><img src="./images/icons//Footer-logo.svg" alt=""></a>
        </div>

        <div class="social-footer">
            <ul>
                <li><a href="https://www.youtube.com/c/TrialandErrorMakers" target="_blank"><img src="./images/icons/youtube-icon-white.svg" alt=""></a></li>
                <li><a href="https://www.facebook.com/TrialAndErrorMakers/" target="_blank"><img src="./images/icons/facebook-icon-white.svg" alt=""></a></li>
                <li><a href="https://www.instagram.com/trialanderrormakers/" target="_blank"><img src="./images/icons/instagram-icon-white.svg" alt=""></a></li>
                <li><a href="https://twitter.com/taemakers/" target="_blank"><img src="./images/icons/twitter-icon-white.svg" alt=""></a></li>
            </ul>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./scripts/scripts.js"></script>
</body>

</html>