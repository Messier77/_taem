<?php include "../includes/db.php" ?>
<?php 

    if (isset($_GET['product'])) {
        $id = $_GET['product'];
        echo 'id ' . $id;


        $query = "SELECT * FROM products WHERE product_id = $id";
        $select_all_products_query = mysqli_query($connection, $query);

        $myArray = mysqli_fetch_all($select_all_products_query, MYSQLI_ASSOC);
        $product = $myArray[0];

        // echo '<pre>' , var_dump($product) , '</pre>';    pretty print 
    }



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="shortcut icon" href="../images/icons/Logo-simbol-black.svg" type="image/x-icon">
    <title>Trial and Error Makers | Crafting and shit</title>
</head>

<body>
    <!-- This is the navigation menu -->
    <nav>
        <!-- Social icons in the header -->
        <div class="social-header">
            <ul>
                <li><a href="#"><img src="../images/icons/youtube-icon.svg" alt=""></a></li>
                <li><a href="#"><img src="../images/icons/facebook-icon.svg" alt=""></a></li>
                <li><a href="#"><img src="../images/icons/instagram-icon.svg" alt=""></a></li>
                <li><a href="#"><img src="../images/icons/twitter-icon.svg" alt=""></a></li>
                <li class="header-icon-mobile"><a href="#"><img src="../images/icons/youtube-icon-header-mobile.svg" alt=""></a></li>
            </ul>
        </div>

        <!-- Logo -->
        <div class="logo">
            <a href="../index.php"><img src="../images/icons/Logo-and-bg.svg" alt=""></a>
        </div>

        <!-- Navigation menu -->
        <div class="nav-menu">
            <ul>
                <li><a href="../work/work.php">Work</a></li>
                <li><a href="#">YouTube Channel</a></li>
                <li><a href="../contact/contact.php">Meet us</a></li>
                <li class="header-icon-mobile burger-toggle"><img src="../images/icons/burger-menu.svg" alt=""></li>
                <li class="header-icon-mobile burger-toggle" id="burger-close"><img src="../images/icons/burger-menu-close.svg" alt=""></li>
            </ul>
        </div>
    </nav>
    <div class="mobile-nav inactive-menu">
        <ul>
            <li><a href="../work/work.php">Work</a></li>
            <li><a href="#">YouTube Channel</a></li>
            <li><a href="../contact/contact.php">Meet us</a></li>
        </ul>

        <ul class="burger-social">
            <li><a href="#"><img src="../images/icons/youtube-icon.svg" alt=""></a></li>
            <li><a href="#"><img src="../images/icons/facebook-icon.svg" alt=""></a></li>
            <li><a href="#"><img src="../images/icons/instagram-icon.svg" alt=""></a></li>
            <li><a href="#"><img src="../images/icons/twitter-icon.svg" alt=""></a></li>
        </ul>
    </div>

    <div class="projects">
        <a href="../work/work.php" class="back-to-work">
            <img src="../images/icons/arrow.svg" alt="">
            <p>Back to work</p>
        </a>

        <h1 class="h1-work"><?php echo $product['product_name'] ?></h1>

        <div class="detail-content">
            <img src="../images/products/broken-lamp/1-broken-lamp-facebook@2x.png" alt="" class="project-image">
    
            <div class="product-description">
                <h5>Description</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta tempore veritatis deleniti modi voluptates minima? Commodi eaque repellat doloribus, quaerat numquam sequi minus necessitatibus error? Quas ipsam nulla nobis eum qui maiores dicta fugiat iure quos? Accusamus impedit sit, quod non harum ex? Adipisci, fuga beatae? Recusandae et doloremque explicabo perferendis sed quas maxime tempore consequatur dolore inventore ullam, minus, quia consequuntur corrupti eveniet quis beatae aut quam iste labore?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum, expedita ullam id animi, optio culpa voluptates atque ab delectus suscipit doloribus dicta sit architecto maxime doloremque iusto fugiat itaque laborum provident. Libero accusamus distinctio sapiente, impedit odio voluptatem esse architecto facilis deleniti necessitatibus exercitationem fugit assumenda velit iure voluptas, molestiae hic quisquam? Officiis facere adipisci quae consequuntur dolor similique obcaecati!</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates magni dolore reprehenderit, necessitatibus praesentium ut quos ad incidunt explicabo exercitationem.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut consectetur rem eius alias architecto rerum vel perspiciatis obcaecati, consequuntur voluptatum ducimus inventore nostrum optio. Sed quod, explicabo possimus non excepturi eum repellat quibusdam accusamus ad ex, voluptatibus veniam? Nobis, esse?</p>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Distinctio, totam cupiditate reiciendis officiis ducimus omnis repellendus deserunt quos quibusdam in, doloremque placeat a laboriosam voluptatum minus. Harum modi rem deleniti.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta tempore veritatis deleniti modi voluptates minima? Commodi eaque repellat doloribus, quaerat numquam sequi minus necessitatibus error? Quas ipsam nulla nobis eum qui maiores dicta fugiat iure quos? Accusamus impedit sit, quod non harum ex? Adipisci, fuga beatae? Recusandae et doloremque explicabo perferendis sed quas maxime tempore consequatur dolore inventore ullam, minus, quia consequuntur corrupti eveniet quis beatae aut quam iste labore?</p>
            </div>
    
            <img src="../images/products/broken-lamp/2-broken-lamp-facebook@2x.png" alt="" class="project-image">
    
            <img src="../images/products/broken-lamp/3-broken-lamp-facebook@2x.png" alt="" class="project-image">
    
            <img src="../images/products/broken-lamp/4-broken-lamp-facebook@2x.png" alt="" class="project-image">
    
            <div class="video">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/he0rBYfptfo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="embedded-video"></iframe>
            </div>
        </div>

        <div class="back-to-work-bottom">
            <a href="../work/work.php" class="back-to-work-under">
                <img src="../images/icons/arrow.svg" alt="">
                <p>Back to work</p>
            </a>
            <div class="share">
                <p>SHARE</p>
                <a href="#"><img src="../images/icons/facebook-icon.svg" alt=""></a>
                <a href="#"><img src="../images/icons/instagram-icon.svg" alt=""></a>
                <a href="#"><img src="../images/icons/twitter-icon.svg" alt=""></a>
            </div>
        </div>

    </div>

    <!-- This is the footer -->
    <div class="footer">
        <div class="info-footer">
            <p>&copy; 2020 <span>Trial And Error Makers</span></p>
        </div>

        <div class="footer-logo">
            <a href="../index.php"><img src="../images/icons//Footer-logo.svg" alt=""></a>
        </div>

        <div class="social-footer">
            <ul>
                <li><a href="#"><img src="../images/icons/youtube-icon-white.svg" alt=""></a></li>
                <li><a href="#"><img src="../images/icons/facebook-icon-white.svg" alt=""></a></li>
                <li><a href="#"><img src="../images/icons/instagram-icon-white.svg" alt=""></a></li>
                <li><a href="#"><img src="../images/icons/twitter-icon-white.svg" alt=""></a></li>
            </ul>
        </div>
    </div>

    <script src="../scripts/scripts.js"></script>
</body>

</html>