<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "_taem";

foreach($db as $key => $value) {
define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$mysqli_connection = new mysqli($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);

if ($connection) {
    // echo "Connected";
}

function pr($param) {
    echo "<pre>";
        print_r($param);
    echo "</pre>";
}

function get_connection() {
    $db['db_host'] = "localhost";
    $db['db_user'] = "root";
    $db['db_pass'] = "";
    $db['db_name'] = "_taem";

    $mysqli_connection = new mysqli($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);

    return $mysqli_connection;
}

function selectLastAddedProduct() {
    $connection = get_connection();

    $query = "SELECT * FROM products ORDER BY id DESC LIMIT 1";
    $select_last_product = $connection->query($query);
    
    $myArray = $select_last_product->fetch_all(MYSQLI_ASSOC);
    $results = json_encode($myArray);
    $connection->close();
    return $results;    
}

function get_products() {
    $connection = get_connection();

    $query = "select * FROM products WHERE is_featured = 1";
    $select_all_products_query = $connection->query($query);
    
    // $myArray = mysqli_fetch_all($select_all_products_query, MYSQLI_ASSOC);
    $myArray = $select_all_products_query->fetch_all(MYSQLI_ASSOC);
    $results = json_encode($myArray);
    $connection->close();
    return $results;    
}

function insert_product($name, $title, $description, $short_description, $product_categories, $product_materials, $featured_image = '', $is_featured = 0) {
    $connection = get_connection();

    $query = "INSERT INTO products (name, title, description, short_description, active, featured_image, product_categories, product_materials, is_featured) 
    VALUES ('$name', '$title', '$description', '$short_description', 1, '$featured_image', '$product_categories', '$product_materials', '$is_featured')";

    if ($connection->query($query) === TRUE) {
        pr("New record created successfully");
      } else {
       pr("Error: " . $connection->error);
      }
    $connection->close();
}

function insertProductImage($product_id, $image_name) {
    $connection = get_connection();

    $query = "INSERT INTO product_images (product_id, image) VALUES ('$product_id', '$image_name')";

    if ($connection->query($query) === TRUE) {
        pr("New record created successfully");
      } else {
       pr("Error: " . $connection->error);
      }
    $connection->close();
}

function get_materials() {
    $connection = get_connection();

    $query = "SELECT * FROM materials";
    // $select_all_products_query = mysqli_query($connection, $query);
    $select_all_materials_query = $connection->query($query);
    
        // $myArray = mysqli_fetch_all($select_all_products_query, MYSQLI_ASSOC);
        $myArray = $select_all_materials_query->fetch_all(MYSQLI_ASSOC);
        $results = json_encode($myArray);

    $connection->close();
    return $results;    
}
function get_categories() {
    $connection = get_connection();

    $query = "SELECT * FROM categories";
    // $select_all_products_query = mysqli_query($connection, $query);
    $select_all_categories_query = $connection->query($query);
    
        // $myArray = mysqli_fetch_all($select_all_products_query, MYSQLI_ASSOC);
        $myArray = $select_all_categories_query->fetch_all(MYSQLI_ASSOC);
        $results = json_encode($myArray);

    $connection->close();
    return $results;    
}

?>