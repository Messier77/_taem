<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Title</th>
            <th>Description</th>
            <th>Short Description</th>
            <th>Category</th>
            <th>Material</th>
            <th>Photo</th>
            <th>Featured</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM products";
            $select_products = mysqli_query($connection, $query);
    
            while($row = mysqli_fetch_assoc($select_products)) {
                $id = $row['id'];
                $name = $row['name'];
                $title = $row['title'];
                $description = $row['description'];
                $short_description = $row['short_description'];
                $category_id = $row['product_categories'];
                $material_id = $row['product_materials'];
                $featured_image = $row['featured_image'];
                $is_featured = $row['is_featured'];

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<td>$title</td>";
            echo "<td>$description</td>";
            echo "<td>$short_description</td>";
            echo "<td>$category_id</td>";
            echo "<td>$material_id</td>";
            echo "<td><img style='width: 100%; max-width: 100px' src='../images/products/$id/$featured_image'></td>";
            echo "<td>$is_featured</td>";
            echo "</tr>";
            }
        ?>
    </tbody>
</table>