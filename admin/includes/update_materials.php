<form action="" method="post">
    <div class="form-group">
        <label for="material_name">Edit Material</label>

        <?php
        if(isset($_GET['edit'])) {
            $material_id = $_GET['edit'];

        $query = "SELECT * FROM materials WHERE material_id = $material_id";
        $select_materials_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_materials_id)) {
            $material_id = $row['material_id'];
            $material_name = $row['material_name'];
        ?>

        <input value="<?php if(isset($material_name)){echo $material_name;} ?>" class="form-control" type="text" name="material_name">

        <?php }} ?>

        <?php
        // UPDATE QUERY
        if(isset($_POST['update_material'])) {
            $the_material_name = $_POST['material_name'];
            $query = "UPDATE materials SET material_name = '{$the_material_name}' WHERE material_id = {$material_id} ";
            $update_query = mysqli_query($connection, $query);

            if (!$update_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
            header("Location: materials.php");
        }
        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_material" value="Update Material">
    </div>
</form>