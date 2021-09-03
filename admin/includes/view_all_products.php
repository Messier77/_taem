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
            $categories = json_decode(get_categories());
            $materials = json_decode(get_materials());

            $cats = [];
            $mats = [];

            foreach ($categories as $key => $cat) {
                $cats[$cat->id] = $cat->name;
            }

            function categoryIdsToNames($ids, $cats) {
                if(!$ids) {
                    return '';
                }

                $temp_array  = explode(',', $ids);
                $res = [];
                foreach ($temp_array as $value) {
                    if($cats[$value]) {
                        $res[$value] = $cats[$value];
                        array_push($res, $cats[$value]);
                    }
                }
                return implode(', ', $res);
            }

            foreach ($materials as $key => $mat) {
                $mats[$mat->id] = $mat->name;
            }

            function materialIdsToNames($ids, $mats) {
                if(!$ids) {
                    return '';
                }

                $temp_array  = explode(',', $ids);
                $res = [];
                foreach ($temp_array as $value) {
                    if($mats[$value]) {
                        $res[$value] = $mats[$value];
                        array_push($res, $mats[$value]);
                    }
                }
                return implode(', ', $res);
            }

            function isFeaturedToStatus($status) {
                if($status == 1) {
                    return 'Active';
                }
                return 'Inactive';
            }
            
            

            $query = "SELECT * FROM products";
            $select_products = mysqli_query($connection, $query);
    
            while($row = mysqli_fetch_assoc($select_products)) {
                $id = $row['id'];
                $name = $row['name'];
                $title = $row['title'];
                $description = $row['description'];
                $short_description = $row['short_description'];
                $category_id = categoryIdsToNames($row['product_categories'], $cats);
                $material_id = materialIdsToNames($row['product_materials'], $mats);
                $featured_image = $row['featured_image'];
                $is_featured = isFeaturedToStatus($row['is_featured']);

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