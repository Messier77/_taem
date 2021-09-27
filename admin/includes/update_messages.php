<?php include "../../includes/db.php";?>

<?php

        if (isset($_POST['id'])) {

            $id = $_POST['id'];

            updateMessages($id, $name);
            
            echo json_encode(array('success' => 1));
        } else {
            echo json_encode(array('success' => 0));
        }
?>