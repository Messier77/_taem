<?php include "../../includes/db.php";?>

<?php
    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        $existingImages = getAllProductImages($id);
        foreach ($existingImages as $key => $image) {
            unlink("../../images/products/" . $image['image']);
        }
        $current_product = getCurrentProduct($id);
        $product_image = $current_product['featured_image'];
        unlink("../../images/products/" . $product_image);

        deleteImages($id);
        deleteProduct($id);
    }

?>