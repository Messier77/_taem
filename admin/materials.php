<?php include "./includes/admin_header.php";?>

    <div id="wrapper">

    <?php include "./includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Materials
                        </h1>

                        <!-- Add material form -->
                        <div class="col-xs-4">

                            <?php
                            if(isset($_POST['submit'])) {
                                $name = $_POST['name'];

                                if($name == "" || empty($name)) {
                                    echo '<p class="text-danger">This field should not be empty</p>';
                                } else {
                                    $query = "INSERT INTO materials(name) ";
                                    $query .= "VALUE('{$name}')";

                                    $create_material_query = mysqli_query($connection, $query);

                                    echo '<p class="text-success">The material has been added successfully</p>';

                                    if (!$create_material_query) {
                                        die('QUERY FAILED' . mysqli_error($connection));
                                    }
                                }
                            }
                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="name">Add Material</label>
                                    <input class="form-control" type="text" name="name">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Material">
                                </div>
                            </form>

                            <?php
                            if(isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];

                                include "./includes/update_materials.php";
                            }
                            ?>
                        </div>

                        <div class="col-xs-8">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Material</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                // SELECT ALL MATERIALS
                                $query = "SELECT * FROM materials";
                                $select_materials = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($select_materials)) {
                                    $id = $row['id'];
                                    $name = $row['name'];
                
                                    echo "<tr>";
                                    echo "<td>{$id}</td>";
                                    echo "<td>{$name}</td>";
                                    echo "<td><a href='materials.php?delete={$id}'>Delete</td>";
                                    echo "<td><a href='materials.php?edit={$id}'>Edit</td>";
                                    echo "</tr>";
                                }
                                ?>

                                <?php

                                // DELETE QUERY
                                if(isset($_GET['delete'])) {
                                    $id = $_GET['delete'];
                                    $query = "DELETE FROM materials WHERE id = {$id} ";
                                    $delete_query = mysqli_query($connection, $query);
                                    header("Location: materials.php");
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

<?php include "./includes/admin_footer.php";?>