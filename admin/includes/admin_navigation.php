        <?php 
        function getPageName() {
            $array = explode("/", $_SERVER['REQUEST_URI']);
            $array = array_reverse($array);

            return $array[0];
        }
        ?>
        
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">TAEM Admin</a>
                <a class="navbar-brand" href="../">TAEM Main Site</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts-dropdown" aria-expanded="true"><i class="fa fa-fw fa-cubes"></i> Products <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts-dropdown" class="collapse in" aria-expanded="true">
                            <li class="<?php echo getPageName() == "products.php" ? "sub-active" : "" ?>">
                                <a href="./products.php">View All Products</a>
                            </li>
                            <li class="<?php echo getPageName() == "add_product.php" ? "sub-active" : "" ?>">
                                <a href="./add_product.php">Add Product</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo getPageName() == "categories.php" ? "active" : "" ?>">
                        <a href="categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                    <li class="<?php echo getPageName() == "materials.php" ? "active" : "" ?>">
                        <a href="materials.php"><i class="fa fa-fw fa-book"></i> Materials</a>
                    </li>
                    <li>
                        <a href="blank-page.html"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>