<form action="" method="post">
    <div class="form-group">
        <label for="category_name">Edit Category</label>

        <?php
        if(isset($_GET['edit'])) {
            $category_id = $_GET['edit'];

        $query = "SELECT * FROM categories WHERE category_id = $category_id";
        $select_categories_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories_id)) {
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];
        ?>

        <input value="<?php if(isset($category_name)){echo $category_name;} ?>" class="form-control" type="text" name="category_name">

        <?php }} ?>

        <?php
        // UPDATE QUERY
        if(isset($_POST['update_category'])) {
            $the_category_name = $_POST['category_name'];
            $query = "UPDATE categories SET category_name = '{$the_category_name}' WHERE category_id = {$category_id} ";
            $update_query = mysqli_query($connection, $query);

            if (!$update_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
            header("Location: categories.php");
        }
        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>