<?php include "./includes/admin_header.php";?>


<?php

        $query = "SELECT * FROM categories";
        $select_all_categories_query = mysqli_query($connection, $query);
        $categories = mysqli_fetch_all($select_all_categories_query, MYSQLI_ASSOC);


        $query = "SELECT * FROM materials";
        $select_all_materials_query = mysqli_query($connection, $query);
        $materials = mysqli_fetch_all($select_all_materials_query, MYSQLI_ASSOC);


    if(isset($_POST['submit'])) {
        // add product to database

        if(!empty($_POST['product_name'])) {
            $product_name = $_POST['product_name'];
            pr('You have chosen the product_name: ' . $product_name);
        }

        if(!empty($_POST['product_title'])) {
            $product_title = $_POST['product_title'];
            pr('You have chosen the product_title: ' . $product_title);
        }

        if(!empty($_POST['product_description'])) {
            $product_description = $_POST['product_description'];
            pr('You have chosen the product_description: ' . $product_description);
        }

        $product_short_description = 'short desc';
        if(!empty($_POST['product_short_description'])) {
            $product_short_description = $_POST['product_short_description'];
            pr('You have chosen the product_short_description: ' . $product_short_description);
        }

        $product_categories = '';
        if(!empty($_POST['category'])) {
            $product_categories = implode(',', $_POST['category']);
            pr('You have chosen the category: ' . $product_categories);
        }

        $product_materials = '';
        if(!empty($_POST['material'])) {
            $product_materials = implode(',', $_POST['material']);
            pr('You have chosen the material: ' . $product_materials);
        }

        $is_featured = 0;
        if(!empty($_POST['is_featured'])) {
            $is_featured = $_POST['is_featured'];
        }

        $newFileName = '';
        if (isset($_FILES['featured_image'])) {
            // get details of the uploaded file
            $fileTmpPath = $_FILES['featured_image']['tmp_name'];
            $fileName = $_FILES['featured_image']['name'];
            $fileSize = $_FILES['featured_image']['size'];
            $fileType = $_FILES['featured_image']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // sanitize file-name
            $newFileName = md5(time() . $fileName) . '-' . $fileName . '.' . $fileExtension;

            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

            if (in_array($fileExtension, $allowedfileExtensions)) {
                // directory in which the uploaded file will be moved
                $uploadFileDir = '../images/products/';
                $dest_path = $uploadFileDir . $newFileName;

                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                    $message ='File is successfully uploaded. path: '  . $dest_path;
                }
                else {
                    $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
            } else {
                $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
            }
        }

        insert_product($product_name, $product_title, $product_description, $product_short_description, $product_categories, $product_materials, $newFileName, $is_featured);

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
                            Welcome to Admin
                            <small>Author</small>
                        </h1>

                        <!-- Add product form -->
                        <div class="col-sm-6">

                            

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="product_name">Product name</label>
                                    <input class="form-control" type="text" name="product_name">
                                </div>

                                <div class="form-group">
                                    <label for="product_title">Product title</label>
                                    <input class="form-control" type="text" name="product_title">
                                </div>

                                <div class="form-group">
                                    <label for="product_description">Product description</label>
                                    <textarea style="resize:none" rows=10 class="form-control" type="text" name="product_description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="product_short_description">Product short description</label>
                                    <input class="form-control" type="text" name="product_short_description">
                                </div>

                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category[]" multiple="multiple" class="form-control js-example-basic-multiple">
                                        <?php foreach($categories as $key => $category ): ?>
                                            <option value="<?php echo $category['id']; ?>"> <?php echo $category['name']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Material</label>
                                    <select name="material[]" multiple="multiple" class="form-control js-example-basic-multiple">
                                        <?php foreach($materials as $key => $material ): ?>
                                            <option value="<?php echo $material['id']; ?>"> <?php echo $material['name']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Featured</label>
                                    <select name="is_featured" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                    </select>
                                </div>

                                <div class="form-group col-xs-6">
                                    <label for="featured_image">Featured image (Home and Work pages)</label>
                                    <input type="file" id="featured_image" name="featured_image"> 
                                    <p class="help-block">Upload feature image.</p>
                                </div>

                                <div class="form-group col-xs-6">
                                    <label for="product_main_photo">Main image (Product page)</label>
                                    <input type="file" id="product_main_photo" name="product_main_photo"> 
                                    <p class="help-block">Upload main image.</p>
                                </div>

                                <div class="form-group col-xs-4">
                                    <label for="product_picture_1">Picture 1</label>
                                    <input type="file" id="product_picture_1" name="product_picture_1"> 
                                    <p class="help-block">Upload image 1</p>
                                </div>

                                <div class="form-group col-xs-4">
                                    <label for="product_picture_2">Picture 2</label>
                                    <input type="file" id="product_picture_2" name="product_picture_2"> 
                                    <p class="help-block">Upload image 2</p>
                                </div>

                                <div class="form-group col-xs-4">
                                    <label for="product_picture_3">Picture 3</label>
                                    <input type="file" id="product_picture_3" name="product_picture_3"> 
                                    <p class="help-block">Upload image 3</p>
                                </div>

                                <div class="form-group col-xs-4">
                                    <label for="product_picture_4">Picture 4</label>
                                    <input type="file" id="product_picture_4" name="product_picture_4"> 
                                    <p class="help-block">Upload image 4</p>
                                </div>

                                <div class="form-group col-xs-4">
                                    <label for="product_picture_5">Picture 5</label>
                                    <input type="file" id="product_picture_5" name="product_picture_5"> 
                                    <p class="help-block">Upload image 5</p>
                                </div>

                                <div class="form-group col-xs-4">
                                    <label for="product_picture_6">Picture 6</label>
                                    <input type="file" id="product_picture_6" name="product_picture_6"> 
                                    <p class="help-block">Upload image 6</p>
                                </div>


                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Product">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "./includes/admin_footer.php";?>