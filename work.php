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
                <li><a href="./work.php" class="menu-active">Work</a></li>
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
            <h1 class="h1-work">Work</h1>
        </div>

        <div class="filters">
            <div class="category-filter">
                <p>Category</p>
                <img src="./images/icons/down-arrow-fill.svg" alt="">
                <div class="select-filters" id="categories">

                </div>
            </div>
            <div class="category-filter">
                <p>Material</p>
                <img src="./images/icons/down-arrow-fill.svg" alt="">
                <div class="select-filters" id="materials">

                </div>
            </div>
        </div>

        <div class="line"></div>


        <!-- <div class="added-filters" id="results"> -->

        </div>

        <div class="added-filters" id="added-filters">
        </div>

        <div id="project-center-new" class="projects-center">

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

    <?php 
        $products = get_all_products();
        $categories = get_categories();
        $materials = get_materials();
    ?>

    <script>
        let products = <?php echo json_encode($products); ?>;
        let categories = <?php echo json_encode($categories); ?>;
        let materials = <?php echo json_encode($materials); ?>;

        products = JSON.parse(products);
        categories = JSON.parse(categories);
        materials = JSON.parse(materials);

        myApp.init(products, categories, materials);

    </script>

</body>

</html>