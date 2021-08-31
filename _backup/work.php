<?php include "../includes/db.php" ?>

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
                <li><a href="#" class="menu-active">Work</a></li>
                <li><a href="#">YouTube Channel</a></li>
                <li><a href="../contact/contact.php">Meet us</a></li>
                <li class="header-icon-mobile burger-toggle"><img src="../images/icons/burger-menu.svg" alt=""></li>
                <li class="header-icon-mobile burger-toggle" id="burger-close"><img src="../images/icons/burger-menu-close.svg" alt=""></li>
            </ul>
        </div>
    </nav>
    <div class="mobile-nav inactive-menu">
        <ul>
            <li><a href="#">Work</a></li>
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

    <!-- Our work - Homepage -->
    <section class="projects">
        <div class="section-title">
            <h1 class="h1-work">Work</h1>
        </div>

        <div class="filters">
            <div class="category-filter">
                <p>Category</p>
                <img src="../images/icons/down-arrow-fill.svg" alt="">
                <div class="select-filters" id="categories">

                </div>
            </div>
            <div class="category-filter">
                <p>Material</p>
                <img src="../images/icons/down-arrow-fill.svg" alt="">
                <div class="select-filters" id="materials">

                </div>
            </div>
        </div>

        <div class="line"></div>

        <div class="added-filters">
            <?php 
            
            $query = "SELECT * FROM categories";
            $select_all_categories_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $category_id = $row['category_id'];
                    $category_name = $row['category_name'];
            ?>
            <div class="added-filter <?php echo $category_name ?>">
                <img src="../images/icons/close-filter.svg" alt="">
                <p><?php echo $category_name ?></p>
            </div>
            <?php } ?>
            <?php 
                        
            $query = "SELECT * FROM materials";
            $select_all_materials_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_materials_query)) {
                    $material_id = $row['material_id'];
                    $material_name = $row['material_name'];
            ?>
            <div class="added-filter <?php echo $material_name ?>">
                <img src="../images/icons/close-filter.svg" alt="">
                <p><?php echo $material_name ?></p>
            </div>
            <?php } ?>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js"></script>
    <script src="../scripts/scripts.js"></script>

    <?php 
        $products = get_products();
        $categories = get_categories();
        $materials = get_materials();
        var_dump($products);
        var_dump($categories);
        var_dump($materials);
    ?>

    <script>
        let products = <?php echo json_encode($products); ?>;
        let categories = <?php echo json_encode($categories); ?>;
        let materials = <?php echo json_encode($materials); ?>;

        products = JSON.parse(products);
        categories = JSON.parse(categories);
        materials = JSON.parse(materials);

        console.log(products);

        myApp.productListFull = products;
        myApp.productList = products;
        myApp.categoryListFull = categories;
        myApp.categoryList = categories;
        myApp.materialListFull = materials;
        myApp.materialList = materials;
        
        myApp.printProducts();
        myApp.printMaterials();
        myApp.printCategories();
        console.log(myApp);
    </script>

</body>

</html>