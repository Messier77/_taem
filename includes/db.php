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

function get_connection() {
    $db['db_host'] = "localhost";
    $db['db_user'] = "root";
    $db['db_pass'] = "";
    $db['db_name'] = "_taem";

    $mysqli_connection = new mysqli($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);

    return $mysqli_connection;
}

function get_products() {
    $connection = get_connection();

    $query = "select product.*, material.name as material_name, category.name as category_name from products as product inner join materials as material on material.id = product.id inner join categories as category on category.id = product.id";
    // $select_all_products_query = mysqli_query($connection, $query);
    $select_all_products_query = $connection->query($query);
    
        // $myArray = mysqli_fetch_all($select_all_products_query, MYSQLI_ASSOC);
        $myArray = $select_all_products_query->fetch_all(MYSQLI_ASSOC);
        $results = json_encode($myArray);
    var_dump($results);
    $connection->close();
    return $results;    
}

function insert_product($name, $title, $description, $short_description, $category_id, $material_id, $featured_image, $is_featured) {
    $connection = get_connection();

    $query = "INSERT INTO `products` (`id`, `name`, `title`, `description`, `short_description`, `active`, `category_id`, `material_id`, `featured_image`, `is_featured`) VALUES (NULL, $name, $title, $description, $short_description, 1, $category_id, $material_id, $featured_image, $is_featured);";
    // $select_all_products_query = mysqli_query($connection, $query);
    // $connection->query($query);
    mysqli_query($connection, $query);
    
        // $myArray = mysqli_fetch_all($select_all_products_query, MYSQLI_ASSOC);
        // $myArray = $select_all_products_query->fetch_all(MYSQLI_ASSOC);
        // $results = json_encode($myArray);
    // var_dump($results);
    $connection->close();
    // return $results;    
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