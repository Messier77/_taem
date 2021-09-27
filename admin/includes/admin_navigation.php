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
                <a class="navbar-brand" href="index">TAEM Admin</a>
                <a class="navbar-brand" href="../">TAEM Main Site</a>
            </div>

            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="logout"></i>Log out</a>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts-dropdown" aria-expanded="true"><i class="fa fa-fw fa-cubes"></i> Products <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts-dropdown" class="collapse in" aria-expanded="true">
                            <li class="<?php echo getPageName() == "products" ? "sub-active" : "" ?>">
                                <a href="./products">View All Products</a>
                            </li>
                            <li class="<?php echo getPageName() == "add_product" ? "sub-active" : "" ?>">
                                <a href="./add_product">Add Product</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo getPageName() == "categories" ? "sub-active" : "" ?>">
                        <a href="categories" class="text-white"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                    <li class="<?php echo getPageName() == "materials" ? "sub-active" : "" ?>">
                        <a href="materials"><i class="fa fa-fw fa-book"></i> Materials</a>
                    </li>
                    <li class="<?php echo getPageName() == "messages" ? "sub-active" : "" ?>">
                        <a href="messages"><i class="fa fa-fw fa-envelope"></i> Messages</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>