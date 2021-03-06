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

function getProductImages($productId) {
    $connection = get_connection();

    $query = "select * FROM product_images WHERE product_id = $productId AND type = 0";
    $select_all_images_query = $connection->query($query);

    $myArray = $select_all_images_query->fetch_all(MYSQLI_ASSOC);
    $connection->close();
    return $myArray;    
}

function getMainImages($productId) {
    $connection = get_connection();

    $query = "select * FROM product_images WHERE product_id = $productId AND type = 1";
    $select_all_images_query = $connection->query($query);

    $myArray = $select_all_images_query->fetch_all(MYSQLI_ASSOC);
    $connection->close();
    return $myArray; 
}

function getAllProductImages($productId){
    $connection = get_connection();

    $query = "select * FROM product_images WHERE product_id = $productId";
    $select_all_images_query = $connection->query($query);

    $myArray = $select_all_images_query->fetch_all(MYSQLI_ASSOC);
    $connection->close();
    return $myArray; 
}

function deleteProduct($id) {
    $connection = get_connection();

    $query = "DELETE FROM products WHERE id = $id";

    if ($connection->query($query) === TRUE) {
    } else {
     pr("Error: " . $connection->error);
    }
    $connection->close();
}

function deleteCategory($id) {
    $connection = get_connection();

    $query = "DELETE FROM categories WHERE id = $id";

    if ($connection->query($query) === TRUE) {
    } else {
     pr("Error: " . $connection->error);
    }
    $connection->close();
}

function deleteMaterial($id) {
    $connection = get_connection();

    $query = "DELETE FROM materials WHERE id = $id";

    if ($connection->query($query) === TRUE) {
    } else {
     pr("Error: " . $connection->error);
    }
    $connection->close();
}

function deleteMessage($id) {
    $connection = get_connection();

    $query = "DELETE FROM messages WHERE id = $id";

    if ($connection->query($query) === TRUE) {
    } else {
     pr("Error: " . $connection->error);
    }
    $connection->close();
}

function deleteImages($id) {
    $connection = get_connection();
    $query = "DELETE FROM product_images WHERE product_id = $id";
    if ($connection->query($query) === TRUE) {
    } else {
     pr("Error: " . $connection->error);
    }
    $connection->close();
}

function deleteSingleImage($id, $image) {
    $connection = get_connection();
    $query = "DELETE FROM product_images WHERE product_id = $id AND image = '$image'";
    if ($connection->query($query) === TRUE) {
    } else {
     pr("Error: " . $connection->error);
    }
    $connection->close();
}

function get_all_products() {
    $connection = get_connection();

    $query = "SELECT * FROM products ORDER BY id DESC";
    $select_all_products_query = $connection->query($query);
    
    // $myArray = mysqli_fetch_all($select_all_products_query, MYSQLI_ASSOC);
    $myArray = $select_all_products_query->fetch_all(MYSQLI_ASSOC);
    $results = json_encode($myArray);
    $connection->close();
    return $results;    
}

function get_featured_products() {
    $connection = get_connection();

    $query = "select * FROM products WHERE is_featured = true";
    $select_all_products_query = $connection->query($query);
    
    // $myArray = mysqli_fetch_all($select_all_products_query, MYSQLI_ASSOC);
    $myArray = $select_all_products_query->fetch_all(MYSQLI_ASSOC);
    $results = json_encode($myArray);
    $connection->close();
    return $results;    
}

function insert_product($name, $title, $description, $short_description, $product_categories, $product_materials, $featured_image = '', $is_featured = 0, $youtube, $slug) {
    $connection = get_connection();

    $query = "INSERT INTO products (name, title, description, short_description, active, featured_image, product_categories, product_materials, is_featured, youtube, slug) 
    VALUES ('$name', '$title', '$description', '$short_description', 1, '$featured_image', '$product_categories', '$product_materials', '$is_featured', '$youtube', '$slug')";

    if ($connection->query($query) === TRUE) {
        $connection->close();
        return true;
      } else {
        return $connection->error;
      }
    $connection->close();
}

function insert_message($name, $email, $phone, $message) {
    $connection = get_connection();

    $query = "INSERT INTO messages (name, email, phone, message) 
    VALUES ('$name', '$email', '$phone', '$message')";

    if ($connection->query($query) === TRUE) {
      } else {
       pr("Error: " . $connection->error);
      }
    $connection->close();
}

function update_product($id, $name, $title, $description, $short_description, $product_categories, $product_materials, $featured_image = '', $is_featured, $youtube, $slug) {
    $connection = get_connection();

    $query = "UPDATE products SET name = '$name', title = '$title', description = '$description', short_description = '$short_description', product_categories = '$product_categories', product_materials = '$product_materials', featured_image = '$featured_image', is_featured = '$is_featured', youtube = '$youtube' , slug = '$slug' WHERE id = $id";

    if ($connection->query($query) === TRUE) {
        $connection->close();
        return true;
      } else {
        return $connection->error;
      }
    $connection->close();
}

function updateProductImage($id, $image) {
    $connection = get_connection();

    $query = "UPDATE product_images SET image = '$image' WHERE id = $id";

    if ($connection->query($query) === TRUE) {
      } else {
       pr("Error: " . $connection->error);
      }
    $connection->close();
}

function updateCategories($id, $name) {
    $connection = get_connection();

    $query = "UPDATE categories SET name = '$name' WHERE id = $id";

    if ($connection->query($query) === TRUE) {
        return json_encode(['status' => 'success']);
      } else {
       pr("Error: " . $connection->error);
      }
    $connection->close();
}

function updateMaterials($id, $name) {
    $connection = get_connection();

    $query = "UPDATE materials SET name = '$name' WHERE id = $id";

    if ($connection->query($query) === TRUE) {
        return json_encode(['status' => 'success']);
      } else {
       pr("Error: " . $connection->error);
      }
    $connection->close();
}

function updateMessages($id) {
    $connection = get_connection();

    $query = "UPDATE messages SET status = 'read' WHERE id = $id";

    if ($connection->query($query) === TRUE) {
        return json_encode(['status' => 'success']);
      } else {
       pr("Error: " . $connection->error);
      }
    $connection->close();
}

function insertProductImage($product_id, $image_name, $type) {
    $connection = get_connection();

    $query = "INSERT INTO product_images (product_id, image, type) VALUES ('$product_id', '$image_name', '$type')";

    if ($connection->query($query) === TRUE) {
      } else {
       pr("Error: " . $connection->error);
      }
    $connection->close();
}

function get_materials() {
    $connection = get_connection();

    $query = "SELECT * FROM materials";
    $select_all_materials_query = $connection->query($query);
    
        $myArray = $select_all_materials_query->fetch_all(MYSQLI_ASSOC);
        $results = json_encode($myArray);

    $connection->close();
    return $results;    
}
function get_categories() {
    $connection = get_connection();

    $query = "SELECT * FROM categories";
    $select_all_categories_query = $connection->query($query);
    
        $myArray = $select_all_categories_query->fetch_all(MYSQLI_ASSOC);
        $results = json_encode($myArray);

    $connection->close();
    return $results;    
}

function getCurrentProduct($id) {
    $connection = get_connection();

    $query = "select * FROM products WHERE id = $id";
    $select_all_products_query = $connection->query($query);
    
    $myArray = $select_all_products_query->fetch_all(MYSQLI_ASSOC);
    $connection->close();

    if(count($myArray) > 0) {
        return $myArray[0];
    } else {
        return null;
    }       
} 

function getProductBySlug($slug) {
    $connection = get_connection();

    $query = "select * FROM products WHERE slug = '$slug'";
    $select_all_products_query = $connection->query($query);
    
    if($select_all_products_query) {
        $myArray = $select_all_products_query->fetch_all(MYSQLI_ASSOC);
    }

    $connection->close();

    if(isset($myArray) && count($myArray) > 0) {
        return $myArray[0];
    } else {
        return null;
    }       
} 

function slugify($text, string $divider = '-')
{
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

?>