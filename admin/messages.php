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
                        Messages
                        </h1>

                        <div class="col-xs-12">

                            <table id="messages" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                // SELECT ALL MESSAGES
                                $query = "SELECT * FROM messages";
                                $select_messages = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($select_messages)) {
                                    $id = $row['id'];
                                    $name = $row['name'];
                                    $email = $row['email'];
                                    $phone = $row['phone'];
                                    $message = $row['message'];
                                    $date = $row['date'];
                                    $status = $row['status'];

                                    echo "<tr class='{$status}'>";
                                    echo "<td>{$id}</td>";
                                    echo "<td>{$name}</td>";
                                    echo "<td>{$email}</td>";
                                    echo "<td>{$phone}</td>";
                                    echo "<td>{$message}</td>";
                                    echo "<td>{$date}</td>";
                                    echo "<td class='action-buttons-messages'>
                                        <button type='button' class='btn btn-secondary mark-btn' id='mark-btn-{$id}' data-id='{$id}' data-name='{$name}'>Mark as read</button>
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
            $('#messages').DataTable( {
                "order": [[ 0, "desc" ]]
            } );

            $(document).ready(function() {
                $('.delete-btn').click(function() {
                    var el = this;
                    var deleteId = $(this).data('id');
                    var deleteName = $(this).data('name');

                    bootbox.confirm({
                        message: "This action will permanently delete the message from: " + "<h4 style='color:#d9534f'>" + deleteName + "</h4>", 
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
                                    url: 'includes/delete_messages.php',
                                    type: 'POST',
                                    data: {id: deleteId}
                                });

                                $(el).closest('tr').css('background', '#d9534f');

                                bootbox.alert({
                                    message: "This message has been deleted!",
                                    callback: function () {
                                        location.reload();
                                    }
                                });
                            }
                        }
                    })
                });

                $('.mark-btn').click(function() {
                    var el = this;
                    var editId = $(this).data('id');

                    bootbox.alert("Message has been marked as read!", function(){ 
                        $.ajax({
                            url: 'includes/update_messages.php',
                            type: 'POST',
                            data: {id: editId},
                            success: function() {   
                                location.reload();
                            }
                        }); 
                    });
                });
            });
        </script>

<?php include "./includes/admin_footer.php";?>