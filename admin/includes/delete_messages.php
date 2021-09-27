<?php include "../../includes/db.php";?>

<?php
    // DELETE QUERY
    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        deleteMessage($id);
    }

?>