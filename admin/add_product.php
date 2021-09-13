<?php include "./includes/admin_header.php";?>
<?php
        $query = "SELECT * FROM categories";
        $select_all_categories_query = mysqli_query($connection, $query);
        $categories = mysqli_fetch_all($select_all_categories_query, MYSQLI_ASSOC);


        $query = "SELECT * FROM materials";
        $select_all_materials_query = mysqli_query($connection, $query);
        $materials = mysqli_fetch_all($select_all_materials_query, MYSQLI_ASSOC);

        $errors = [];

        $product_name = '';
        $product_title = '';
        $product_description = '';
        $product_short_description = '';
        $product_categories = '';
        $product_categories_select2 = [];
        $product_materials = '';
        $product_materials_select2 = [];
        $newFileName = '';
        $is_featured = 0;
        $youtube = '';
        

    function uploadImageAndGetPath($image) {
        if (isset($image)) {
            if($image['size'] == 0) {
                return null;
            }
            // get details of the uploaded file
            $fileTmpPath = $image['tmp_name'];
            $fileName = $image['name'];
            $fileSize = $image['size'];
            $fileType = $image['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $fileNameForConcat = strlen($fileNameCmps[0]) > 30 ? substr($fileNameCmps[0],0,30) : $fileNameCmps[0];

            // sanitize file-name
            $newFileName = md5(time() . $fileName) . '-' . $fileNameForConcat . '.' . $fileExtension;
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
                return null;
            }
            return $newFileName;
        }
    }

    if(isset($_POST['submit'])) {
        // add product to database

        $product_name = $_POST['product_name'];
        if(empty($product_name)) {
            $errors['product_name'] = 'Product name cannot be empty!';
        } elseif(strlen($product_name) > 25) {
            $errors['product_name'] = 'Product name must be less than 25 characters!';
        }

        $product_title = $_POST['product_title'];
        if(empty($product_title)) {
            $errors['product_title'] = 'Product title cannot be empty!';
        } elseif(strlen($product_title) > 25) {
            $errors['product_title'] = 'Product title must be less than 25 characters!';
        }

        $product_description = $_POST['product_description'];
        if(strlen($product_description) > 4000) {
            $errors['product_description'] = 'Product description must be less than 4000 characters!';
        }

        $product_short_description = $_POST['product_short_description'];
        if(strlen($product_short_description) > 150) {
            $errors['product_short_description'] = 'Short description must be less than 150 characters!';
        }

        if(!empty($_POST['category'])) {
            $product_categories = implode(',', $_POST['category']);
        }
        if(empty($_POST['category'])) {
            $errors['product_categories'] = 'Please select a category!';
        }

        if(!empty($_POST['material'])) {
            $product_materials = implode(',', $_POST['material']);
        }
        if(empty($_POST['material'])) {
            $errors['product_materials'] = 'Please select a material!';
        }

        if(!empty($_POST['is_featured'])) {
            $is_featured = $_POST['is_featured'];
        }

        $youtube = $_POST['youtube'];
        if(strlen($youtube) > 150) {
            $errors['YouTube'] = 'YouTube URL must be less than 150 characters!';
        }

        if (isset($_FILES['featured_image'])) {
            $newFileName = uploadImageAndGetPath($_FILES['featured_image']);
        }

        if(empty($errors)) {
            insert_product($product_name, $product_title, $product_description, $product_short_description, $product_categories, $product_materials, $newFileName, $is_featured, $youtube);
            $productId = json_decode(selectLastAddedProduct())[0]->id;
            if($_FILES['main_image']) {
                $image = uploadImageAndGetPath($_FILES['main_image']);
                insertProductImage($productId, $image, 1);
            }
            for($i = 1; $i < 7; $i++) {
                if(isset($_FILES['other_image_' . $i])) {
                    $image = uploadImageAndGetPath($_FILES['other_image_' . $i]);
                    if($image != null){
                        insertProductImage($productId, $image, 0);
                    }     
                }  
            }
            $success_message = "It worked";
        } 
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
                            Trial and Error Makers
                            <small>Admin</small>
                        </h1>

                        <!-- Add product form -->
                        <div class="col-sm-6">

                            <?php if(isset($success_message)) : ?>
                                <div class="alert alert-success" role="alert">Product successfully added</div>
                            <?php endif; ?>

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="product_name">Product name</label>
                                    <input class="form-control" type="text" name="product_name" value="<?php echo(isset($product_name) ? $product_name :''); ?>">

                                    <?php if(isset($errors['product_name'])): ?>
                                    <p class="text-danger"><?php echo($errors['product_name']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="product_title">Product title</label>
                                    <input class="form-control" type="text" name="product_title" value="<?php echo(isset($product_title) ? $product_title :''); ?>">

                                    <?php if(isset($errors['product_title'])): ?>
                                    <p class="text-danger"><?php echo($errors['product_title']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="product_description">Product description</label>
                                    <textarea style="resize:none" rows=10 class="form-control" type="text" name="product_description"><?php echo(isset($product_description) ? $product_description :''); ?></textarea>

                                    <?php if(isset($errors['product_description'])): ?>
                                    <p class="text-danger"><?php echo($errors['product_description']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="product_short_description">Product short description</label>
                                    <input class="form-control" type="text" name="product_short_description" value="<?php echo(isset($product_short_description) ? $product_short_description :''); ?>">

                                    <?php if(isset($errors['product_short_description'])): ?>
                                    <p class="text-danger"><?php echo($errors['product_short_description']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="id_label_multiple">Category</label>
                                    <select name="category[]" multiple="multiple" class="js-example-basic-multiple js-states form-control js-example-basic-hide-search-multi" value="<?php echo $product_categories_select2; ?>">
                                        <?php foreach($categories as $key => $category ): ?>
                                            <option <?php echo in_array($category['id'], $product_categories_select2) ? 'selected' : ''?> value="<?php echo $category['id']; ?>"> <?php echo $category['name']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <?php if(isset($errors['product_categories'])): ?>
                                    <p class="text-danger"><?php echo($errors['product_categories']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Materials</label>
                                    <select name="material[]" multiple="multiple" class="js-example-basic-multiple js-states form-control js-example-basic-hide-search-multi" value="<?php echo(isset($product_materials) ? $product_materials :''); ?>">
                                        <?php foreach($materials as $key => $material ): ?>
                                            <option value="<?php echo $material['id']; ?>"> <?php echo $material['name']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <?php if(isset($errors['product_materials'])): ?>
                                    <p class="text-danger"><?php echo($errors['product_materials']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Featured</label>
                                    <select name="is_featured" class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="youtube">YouTube URL</label>
                                    <input class="form-control" type="text" name="youtube" value="<?php echo(isset($youtube) ? $youtube :''); ?>">

                                    <?php if(isset($errors['youtube'])): ?>
                                    <p class="text-danger"><?php echo($errors['youtube']); ?></p>
                                    <?php endif; ?>
                                </div>


                                <div class="form-group">
                                    <label>Main image (Product page)</label>
                                    <div class="img-container">
                                        <div class="img-wrapper">
                                            <div class="img-image">
                                                <img class="img-img display-none">
                                            </div>
                                            <div class="img-content">
                                                <div class="img-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                                <div class="img-text">No file chosen, yet!</div>
                                            </div>
                                            <div id="cancel-btn" class="cancel-btn"><i class="fas fa-times"></i></div>
                                            <div class="file-name"></div>
                                        </div>
                                        <input id="main_image" type="file" name="main_image" class="default-btn">
                                        <label for="main_image" id="custom-btn" class="custom-btn">Choose a file</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="img-container">
                                        <label>Featured Image</label>
                                        <div class="img-wrapper">
                                            <div class="img-image">
                                                <img class="img-img display-none">
                                            </div>
                                            <div class="img-content">
                                                <div class="img-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                                <div class="img-text">No file chosen, yet!</div>
                                            </div>
                                            <div id="cancel-btn" class="cancel-btn"><i class="fas fa-times"></i></div>
                                            <div class="file-name"></div>
                                        </div>
                                        <input id="featured_image" type="file" name="featured_image" class="default-btn">
                                        <label for="featured_image" id="custom-btn" class="custom-btn">Choose a file</label>
                                    </div>
                                </div>






                                <div id="images" class="images">

                                    <div class="form-group">
                                        <div class="img-container">
                                            <label>Picture 1</label>
                                            <div class="img-wrapper">
                                                <div class="img-image">
                                                    <img class="img-img display-none">
                                                </div>
                                                <div class="img-content">
                                                    <div class="img-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                                    <div class="img-text">No file chosen, yet!</div>
                                                </div>
                                                <div id="cancel-btn" class="cancel-btn"><i class="fas fa-times"></i></div>
                                                <div class="file-name"></div>
                                            </div>
                                            <input id="other_image_1" type="file" name="other_image_1" class="default-btn">
                                            <label for="other_image_1" id="custom-btn" class="custom-btn">Choose a file</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xs-12" style="padding-left: 0px; margin-bottom: 15px;">
                                    <button id="add-image" type="button" class="btn btn-info col-xs-6">Add Image</button>
                                </div>


                                

                                <div class="form-group">
                                    <input class="btn btn-primary col-xs-12" type="submit" name="submit" value="Add Product">
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

<script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({multiple: true, placeholder: "Please select value"});
            $('.js-example-basic-hide-search-multi').on('select2:opening select2:closing', function( event ) {
                var $searchfield = $(this).parent().find('.select2-search__field');
                $searchfield.prop('disabled', true);});

            let currentImageIndex = 2;
            let maxIndex = 6;

            $('#add-image').on('click', function(e) {

                e.preventDefault();

                if (currentImageIndex > maxIndex) {
                    return false;
                } 
                $("#images").append(`<div class="form-group">
                                        <div class="img-container">
                                            <label>Picture ${currentImageIndex}</label>
                                            <div class="img-wrapper">
                                                <div class="img-image">
                                                    <img class="img-img display-none">
                                                </div>
                                                <div class="img-content">
                                                    <div class="img-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                                    <div class="img-text">No file chosen, yet!</div>
                                                </div>
                                                <div id="cancel-btn" class="cancel-btn"><i class="fas fa-times"></i></div>
                                                <div class="file-name"></div>
                                            </div>
                                            <input id="other_image_${currentImageIndex}" type="file" name="other_image_${currentImageIndex}" class="default-btn">
                                            <label for="other_image_${currentImageIndex}" id="custom-btn" class="custom-btn">Choose a file</label>
                                        </div>
                                    </div>`);


                                

                    if (currentImageIndex == maxIndex) {
                        $('#add-image').prop('disabled', true);
                    }
                currentImageIndex++;
            });

            $('#page-wrapper').on('change', '.default-btn', function(e){
                let file = e.target.files[0];
                let imgContainer = $(this).parent();
                let cancelBtn = imgContainer.find(".cancel-btn");
                imgContainer.find(".img-img").attr('src', URL.createObjectURL(file));
                imgContainer.addClass("has-image");

                imgContainer.find('.file-name').html(file.name);

                cancelBtn.on('click', function(ev){
                    imgContainer.removeClass("has-image");
                });
            });
        });


</script>

<?php include "./includes/admin_footer.php";?>

