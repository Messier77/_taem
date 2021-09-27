<table id="products" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Title</th>
                <th>Short Description</th>
                <th>Category</th>
                <th>Material</th>
                <th>Photo</th>
                <th>Featured</th>
                <th>Edit</th>
                <th>Delete</th>
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
                    if(isset($cats[$value])) {
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
                        array_push($res, $mats[$value]);
                    }
                }
                return implode(', ', $res);
            }

            function isFeaturedToStatus($status) {
                if($status == 1) {
                    return 'Featured';
                }
                return '';
            }
            
            $query = "SELECT * FROM products ORDER BY id DESC";
            $select_products = mysqli_query($connection, $query);
    
            while($row = mysqli_fetch_assoc($select_products)) {
                $id = $row['id'];
                $name = $row['name'];
                $title = $row['title'];
                $short_description = $row['short_description'];
                $category_id = categoryIdsToNames($row['product_categories'], $cats);
                $material_id = materialIdsToNames($row['product_materials'], $mats);
                $featured_image = $row['featured_image'];
                $is_featured = isFeaturedToStatus($row['is_featured']);

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<td>$title</td>";
            echo "<td>$short_description</td>";
            echo "<td>$category_id</td>";
            echo "<td>$material_id</td>";
            echo "<td><img style='width: 100%; max-width: 100px' src='../images/products/$featured_image' alt=''></td>";
            echo "<td>$is_featured</td>";
            echo "<td><a class='btn btn-secondary' href='./edit_product?id={$id}'>Edit</a></td>";
            echo "<td><a class='btn btn-danger delete-btn' id='delete-btn-{$id}' data-id='{$id}' data-name='{$name}'>Delete</a></td>";
            echo "</tr>";
            }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Title</th>
                <th>Short Description</th>
                <th>Category</th>
                <th>Material</th>
                <th>Photo</th>
                <th>Featured</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </tfoot>
    </table>

<script>

$(document).ready(function() {
    $('#products').DataTable( {
        "order": [[ 0, "desc" ]]
    } );

    $('.delete-btn').click(function() {
        var el = this;
        var deleteId = $(this).data('id');
        var deleteName = $(this).data('name');

        bootbox.confirm({
            message: "This action will permanently delete this product: " + "<h4 style='color:#d9534f'>" + deleteName + "</h4>", 
            buttons: {
                confirm: {
                    label: 'Yes, delete it!',
                    className: 'btn-secondary'
                },
                cancel: {
                    label: 'Cancel',
                    className: 'btn-danger'
                }
            },

            callback: function(results) {
                if(results) {
                    $.ajax({
                        url: 'includes/delete_products.php',
                        type: 'POST',
                        data: {id: deleteId}
                    });

                    $(el).closest('tr').css('background', '#d9534f');

                    bootbox.alert({
                        message: "This category has been deleted!",
                        callback: function () {
                            location.reload();
                        }
                    });
                }
            }
        })
    });
});

</script>