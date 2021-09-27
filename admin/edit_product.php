<?php include "./includes/admin_header.php";?>
<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

        $query = "SELECT * FROM categories";
        $select_all_categories_query = mysqli_query($connection, $query);
        $categories = mysqli_fetch_all($select_all_categories_query, MYSQLI_ASSOC);

        $query = "SELECT * FROM materials";
        $select_all_materials_query = mysqli_query($connection, $query);
        $materials = mysqli_fetch_all($select_all_materials_query, MYSQLI_ASSOC);

        $errors = [];

        $currentProduct = getCurrentProduct($_GET['id']);

        if(!isset($currentProduct)) {
            header("Location: products");
        }

        $id = $_GET['id'];

        $images = getProductImages($id);
        $mainImage = getMainImages($id);
        $main_image = '';
        $main_image_id = '';


        if(count($mainImage) > 0) {
            $main_image = $mainImage[0]['image'];
            $main_image_id = $mainImage[0]['id'];
        }


        $product_name = $currentProduct['name'];
        $product_title = $currentProduct['title'];
        $product_description = $currentProduct['description'];
        $product_short_description = $currentProduct['short_description'];
        $product_categories = $currentProduct['product_categories'];
        $product_categories_select2 = explode(',', $product_categories);
        $product_materials = $currentProduct['product_materials'];
        $product_materials_select2 = explode(',', $product_materials);
        $product_image = $currentProduct['featured_image'];
        $is_featured = $currentProduct['is_featured'];
        $youtube = $currentProduct['youtube'];


        $product_images = $images;

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
            $newFileName = md5(microtime() . $fileName) . '-' . $fileNameForConcat . '.' . $fileExtension;
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
            $errors['product_description'] = 'Product description must be less than 150 characters!';
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

        $is_featured = $_POST['is_featured'];

        $youtube = $_POST['youtube'];
        if(strlen($youtube) > 150) {
            $errors['youtube'] = 'YouTube URL must be less than 150 characters!';
        }

        if ($_POST['should_delete_featured_image'] == 1) {
            unlink("../images/products/" . $product_image);
            $product_image = '';
        }
        
        if ($_FILES['featured_image']['name'] != '' && $_POST['should_delete_featured_image'] == 0) {
            if (strlen($product_image) > 1) {
                unlink("../images/products/" . $product_image);
            }
            $product_image = uploadImageAndGetPath($_FILES['featured_image']);
        }

        if(empty($errors)) {
            update_product($currentProduct['id'], $product_name, $product_title, $product_description, $product_short_description, $product_categories, $product_materials, $product_image, $is_featured, $youtube);

            if ($_POST['should_delete_main_image'] == 1) {
                unlink("../images/products/" . $main_image);
                deleteSingleImage($_GET['id'], $main_image); 
            }
            
            if ($_FILES['main_image']['name'] != '' && $_POST['should_delete_main_image'] == 0) {
                
                $image = uploadImageAndGetPath($_FILES['main_image']);
                if(strlen($main_image) > 1) {
                    unlink("../images/products/" . $main_image);
                    // deleteSingleImage($_GET['id'], $main_image);
                    updateProductImage($main_image_id, $image);
                    $main_image = $image;
                } else {
                    insertProductImage($_GET['id'], $image, 1);
                    $main_image = $image;
                }
                
            }
            for($i = 1; $i < 7; $i++) {
                if (isset($_POST['should_delete_other_image_' . $i]) && $_POST['should_delete_other_image_' . $i] == 1) {
                    unlink("../images/products/" . $product_images[$i - 1]['image']);
                    deleteSingleImage($_GET['id'], $product_images[$i - 1]['image']);
                }

                if(isset($_FILES['other_image_' . $i]['name']) && $_FILES['other_image_' . $i]['name'] != '' && $_POST['should_delete_other_image_' . $i] == 0) {
                    $image = uploadImageAndGetPath($_FILES['other_image_' . $i]);
                    if($image != null){

                        if(count($product_images) > $i) {
                            updateProductImage($product_images[$i - 1]['id'], $image);
                            // $product_images[$i - 1]['image'] = $image;
                            
                        } else {
                            insertProductImage($_GET['id'], $image, 0);
                            // $product_images[$i - 1]['image'] = $image;
                        }   
                    }
                }  
            }
            
            header("Location: edit_product?id=" . $_GET['id']); 
            $_SESSION['success_update'] = 'Product successfully updated';

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
                            Editing product: 
                            <small><?php echo $product_name; ?></small>
                        </h1>

                        <!-- Add product form -->
                        <div class="col-sm-6">

                        <?php if(!empty($_SESSION['success_update'])) : ?>

                            <div class="alert alert-success" role="alert"><?php echo $_SESSION['success_update']; ?></div>

                        <?php endif; ?>

                        <?php $_SESSION['success_update'] = null; ?>


                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="product_name">Product name</label>
                                    <input class="form-control" type="text" autocomplete="off" name="product_name" value="<?php echo(isset($product_name) ? $product_name :''); ?>">

                                    <?php if(isset($errors['product_name'])): ?>
                                    <p class="text-danger"><?php echo($errors['product_name']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="product_title">Product title</label>
                                    <input class="form-control" type="text" autocomplete="off" name="product_title" value="<?php echo(isset($product_title) ? $product_title :''); ?>">

                                    <?php if(isset($errors['product_title'])): ?>
                                    <p class="text-danger"><?php echo($errors['product_title']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="product_description">Product description</label>
                                    <textarea style="resize:none" rows=10 class="form-control" type="text" autocomplete="off" name="product_description"><?php echo(isset($product_description) ? $product_description :''); ?></textarea>

                                    <?php if(isset($errors['product_description'])): ?>
                                    <p class="text-danger"><?php echo($errors['product_description']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="product_short_description">Product short description</label>
                                    <input class="form-control" type="text" autocomplete="off" name="product_short_description" value="<?php echo(isset($product_short_description) ? $product_short_description :''); ?>">

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
                                    <select name="material[]" multiple="multiple" class="js-example-basic-multiple js-states form-control js-example-basic-hide-search-multi" value="<?php echo $product_materials_select2; ?>">
                                        <?php foreach($materials as $key => $material ): ?>
                                            <option <?php echo in_array($material['id'], $product_materials_select2) ? 'selected' : ''?> value="<?php echo $material['id']; ?>"> <?php echo $material['name']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <?php if(isset($errors['product_materials'])): ?>
                                    <p class="text-danger"><?php echo($errors['product_materials']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label>Featured</label>
                                    <select name="is_featured" class="form-control">
                                        <option value="1" <?php echo $is_featured == 1 ? 'selected' : ''?>>Yes</option>
                                        <option value="0" <?php echo $is_featured == 0 ? 'selected' : ''?>>No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="youtube">YouTube URL</label>
                                    <input class="form-control" type="text" name="youtube" value="<?php echo(isset($youtube) ? $youtube :''); ?>">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="should_delete_featured_image" value="0" />

                                    <div class="img-container col-xs-12 col-m-6 <?php echo strlen($product_image) > 1 ? 'has-image' : ''; ?>">
                                        <div class="img-wrapper">
                                            <div class="img-image">
                                                <img class="img-img <?php echo strlen($product_image) < 1 ? 'display-none' : ''; ?>" 
                                                    src="<?php echo strlen($product_image) > 2 ? '../images/products/' . $product_image : ''; ?>" alt="">
                                            </div>
                                            <div class="img-content">
                                                <div class="img-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                                <div class="img-text">No file chosen, yet!</div>
                                            </div>
                                            <div class="cancel-btn" data-image-name="featured_image"><i class="fas fa-times"></i></div>
                                        </div>
                                        <input id="featured_image" type="file" name="featured_image" class="default-btn">
                                        <label for="featured_image" id="custom-btn" class="custom-btn">FEATURED IMAGE</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="should_delete_main_image" value="0" />
                                    <div class="img-container col-xs-12 col-m-6 <?php echo strlen($main_image) > 1 ? 'has-image' : ''; ?>">
                                        <div class="img-wrapper">
                                            <div class="img-image">
                                                <img class="img-img <?php echo strlen($main_image) < 1 ? 'display-none' : ''; ?>" 
                                                    src="../images/products/<?php echo $main_image; ?>" alt="">
                                            </div>
                                            <div class="img-content">
                                                <div class="img-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                                <div class="img-text">No file chosen, yet!</div>
                                            </div>
                                            <div class="cancel-btn" data-image-name="main_image"><i class="fas fa-times"></i></div>
                                        </div>
                                        <input id="main_image" type="file" name="main_image" class="default-btn">
                                        <label for="main_image" id="custom-btn" class="custom-btn">MAIN IMAGE</label>
                                    </div>
                                </div>

                                <div id="images" class="images">

                                    <?php foreach($images as $key => $image ): ?>

                                        <?php $idx = $key + 1; ?>

                                        <div class="form-group">
                                            <input type="hidden" name="should_delete_other_image_<?php echo $idx; ?>" value="0" />
                                            <div class="img-container col-xs-12 col-m-6 <?php echo strlen($image['image']) > 1 ? 'has-image' : ''; ?>">
                                                <div class="img-wrapper">
                                                    <div class="img-image">
                                                        <img class="img-img <?php echo strlen($image['image']) < 1 ? 'display-none' : ''; ?>" 
                                                        alt="" src="../images/products/<?php echo $image['image']; ?>">
                                                    </div>
                                                    <div class="img-content">
                                                        <div class="img-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                                        <div class="img-text">No file chosen, yet!</div>
                                                    </div>
                                                    <div id="cancel-btn" data-image-name="other_image_<?php echo $idx; ?>" class="cancel-btn"><i class="fas fa-times"></i></div>
                                                </div>
                                                <input id="other_image_<?php echo $idx; ?>" type="file" name="other_image_<?php echo $idx; ?>" class="default-btn">
                                                <label for="other_image_<?php echo $idx; ?>" id="custom-btn" class="custom-btn">Picture <?php echo $idx; ?></label>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>

                                </div>    

                                <div class="col-xs-12" style="padding-left: 0px; margin-bottom: 15px;">
                                    <button id="add-image" type="button" class="button-margin-top btn btn-info col-xs-6">Add Image</button>
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary col-xs-12" type="submit" name="submit" value="Update Product">
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
            $('.js-example-basic-multiple').select2({
                multiple: true, 
                placeholder: "Please select value",
                width: '100%'});  
            // $('.js-example-basic-hide-search-multi').on('select2:opening select2:closing', function( event ) {
            //     var $searchfield = $(this).parent().find('.select2-search__field');
            //     $searchfield.prop('disabled', true);});

            let currentImageIndex = <?php echo count($images) + 1; ?>;
            let maxIndex = 6;


            $('#add-image').on('click', function(e) {

            e.preventDefault();

            if (currentImageIndex > maxIndex) {
                return false;
            } 
            $("#images").append(`<div class="form-group">
                                    <div class="img-container col-xs-12 col-m-6">
                                        <div class="img-wrapper">
                                            <div class="img-image">
                                                <img class="img-img display-none" src="" alt="">
                                            </div>
                                            <div class="img-content">
                                                <div class="img-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                                <div class="img-text">No file chosen, yet!</div>
                                            </div>
                                            <div id="cancel-btn" class="cancel-btn"><i class="fas fa-times"></i></div>
                                            <div class="file-name"></div>
                                        </div>
                                        <input id="other_image_${currentImageIndex}" type="file" name="other_image_${currentImageIndex}" class="default-btn">
                                        <label for="other_image_${currentImageIndex}" id="custom-btn" class="custom-btn">Picture ${currentImageIndex}</label>
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


                let currentImageName = cancelBtn.attr('data-image-name');
                let shouldDeleteField = $(`[name='should_delete_${currentImageName}']`);
                shouldDeleteField.val('0');
                console.log(currentImageName);
                console.log(shouldDeleteField);


                cancelBtn.on('click', function(ev){
                    imgContainer.removeClass("has-image");
                    imgContainer.find(".img-img").attr('src', '');
                });
            });

            $('#page-wrapper').on('click', '.cancel-btn', function(e){
                let imgContainer = $(this).parent();
                imgContainer.find(".img-img").attr('src', '').addClass("display-none");
                $(this).parent().parent().removeClass("has-image");
                $(this).parent().parent().find("input").val('');
                let currentImageName = $(this).attr('data-image-name');
                let shouldDeleteField = $(`[name='should_delete_${currentImageName}']`);
                shouldDeleteField.val('1');
            });
        });
</script>

<?php include "./includes/admin_footer.php";?>

