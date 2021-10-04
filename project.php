<?php include "./includes/db.php" ?>
<?php 

    if (isset($_GET['product'])) {
        $id = $_GET['product'];

        $product = getProductBySlug($id);

        $images = isset($product) ? getProductImages($product['id']) : [];
        $mainImage = isset($product) ? getMainImages($product['id']) : [];
        $main_image = '';

        if(count($mainImage) > 0) {
            $main_image = $mainImage[0]['image'];
        }

    }

?>


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

    <div class="project-container">
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

    <div class="projects">
        <a href="./work.php" class="back-to-work">
            <img src="./images/icons/arrow.svg" alt="">
            <p>Back to work</p>
        </a>

        <h1 class="h1-work"><?php echo isset($product['name']) ? $product['name'] : ''; ?></h1>

        <div class="detail-content">
            <img src="./images/products/<?php echo $main_image; ?>" alt="" class="project-image">
    
            <div class="product-description">
                <h5><?php echo isset($product['description']) ? 'Description' : 'This product does not exist!'; ?></h5>
                <p><?php echo isset($product['description']) ? $product['description'] : ''; ?></p>
            </div>

            <?php if(isset($images)) : ?>
                <?php foreach($images as $key => $image ): ?>
                    <img src="./images/products/<?php echo $image['image']; ?>" alt="" class="project-image">
                <?php endforeach; ?>
            <?php endif; ?>
    
            <?php if(!empty($product['youtube'])) : ?>
            <div class="video">
                <iframe width="100%" height="100%" src="<?php echo $product['youtube'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="embedded-video"></iframe>
            </div> 
            <?php endif; ?>
        </div>


        <?php if(isset($product['id'])) : ?>
        <div class="back-to-work-bottom">
            <a href="./work.php" class="back-to-work-under">
                <img src="./images/icons/arrow.svg" alt="">
                <p>Back to work</p>
            </a>
            <div class="share">
                <p>SHARE</p>
                <a href="#"><img src="./images/icons/facebook-icon.svg" alt=""></a>
                <a href="#"><img src="./images/icons/instagram-icon.svg" alt=""></a>
                <a href="#"><img src="./images/icons/twitter-icon.svg" alt=""></a>
            </div>
        </div>
        <?php endif; ?>

    </div>

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

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./scripts/scripts.js"></script>
    
</body>

</html>