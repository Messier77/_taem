<?php include "./includes/admin_header.php";?>

<?php 

session_start(); 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

?>

    <div id="wrapper">

    <?php include "./includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                        Categories
                        </h1>

                        <!-- Add category form -->
                        <div class="col-xs-4">

                            <?php
                            if(isset($_POST['submit'])) {
                                $name = $_POST['name'];

                                if($name == "" || empty($name)) {
                                    echo '<p class="text-danger">This field should not be empty</p>';
                                } else {
                                    $query = "INSERT INTO categories(name) ";
                                    $query .= "VALUE('{$name}')";

                                    $create_category_query = mysqli_query($connection, $query);

                                    header("Location: categories");

                                    if (!$create_category_query) {
                                        die('QUERY FAILED' . mysqli_error($connection));
                                    }
                                }
                            }
                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="name">Add Category</label>
                                    <input class="form-control" type="text" name="name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            <?php
                            if(isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];

                                include "./includes/update_categories.php";
                            }
                            ?>
                        </div>

                        <div class="col-xs-8">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                // SELECT ALL CATEGORIES
                                $query = "SELECT * FROM categories";
                                $select_categories = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($select_categories)) {
                                    $id = $row['id'];
                                    $name = $row['name'];

                                    echo "<tr>";
                                    echo "<td>{$id}</td>";
                                    echo "<td>{$name}</td>";
                                    echo "<td class='action-buttons'>
                                        <button type='button' class='btn btn-secondary edit-btn' id='edit-btn-{$id}' data-id='{$id}' data-name='{$name}'>Edit</button>
                                        <button type='button' class='btn btn-danger delete-btn' id='delete-btn-{$id}' data-id='{$id}' data-name='{$name}'>Delete</button>
                                        </td>";
                                    echo "</tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


        <script>

            $(document).ready(function() {
                $('.delete-btn').click(function() {
                    var el = this;
                    var deleteId = $(this).data('id');
                    var deleteName = $(this).data('name');

                    bootbox.confirm({
                        message: "This action will permanently delete this category: " + "<h4 style='color:#d9534f'>" + deleteName + "</h4>", 
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
                                    url: 'includes/delete_categories.php',
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

                $('.edit-btn').click(function() {
                    var el = this;
                    var editName = $(this).data('name');
                    var editId = $(this).data('id');

                    bootbox.prompt({
                        title: 'Change name for this category',
                        value: editName,
                        buttons: {
                            confirm: {
                                label: 'Update category!',
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
                                    url: 'includes/update_categories.php',
                                    type: 'POST',
                                    data: {name: results, id: editId},
                                });
                                
                                $(el).closest('tr').css('background', '#CBA25F');

                                bootbox.alert({
                                    message: "The category has been updated!",
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

<?php include "./includes/admin_footer.php";?>