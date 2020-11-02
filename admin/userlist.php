<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>User List</h2>
            <div class="block">
                <?php
                    if (isset($_GET['del'])){
                        $user_id = $_GET['del'];
                        $query = "DELETE FROM users WHERE id = '$user_id'";
                        $del_user = $db->delete($query);
                        if ($del_user){
                            echo "<span style='color:green;font-size: 18px'>User deleted successfully</span>";
                        }else{
                            echo "<span style='color:red;font-size: 18px'>Something went wrong!</span>";
                        }
                    }
                ?>
                <table class="data display datatable" id="example">
                    <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM users ORDER BY id DESC";
                    $users = $db->select($query);
                    if ($users){
                        foreach ($users as $key => $user){
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $key + 1  ?></td>
                                <td><?php echo $user['name'] ?></td>
                                <td><?php echo $user['username'] ?></td>
                                <td><?php echo $user['email'] ?></td>
                                <td><?php echo $user['details'] ?></td>
                                <td>
                                    <?php
                                        if ($user['role'] == 0){
                                            echo 'Admin';
                                        }elseif($user['role'] == 1){
                                            echo 'Author';
                                        }elseif($user['role'] == 2){
                                            echo 'Editor';
                                        }else{
                                            echo 'Subscriber';
                                        }
                                    ?>
                                </td>
                                <td><a href="viewuser.php?id=<?php echo $user['id']; ?>">View</a>
                                    <?php if (Session::get('role') == 0){  ?>
                                        || <a onclick="return confirm('Are you sure to delete?')" href="?del=<?php echo $user['id']; ?>">Delete</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } }else{ ?>
                        <p>No Users Found</p>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>
<?php include "inc/footer.php"; ?>