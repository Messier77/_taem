<?php include "../../includes/db.php";?>

<?php

        if (isset($_POST['name']) && $_POST['id']) {

            $name = $_POST['name'];
            $id = $_POST['id'];

            updateCategories($id, $name);
            
            echo json_encode(array('success' => 1));
        } else {
            echo json_encode(array('success' => 0));
        }
?>