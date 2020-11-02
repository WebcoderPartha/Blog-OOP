<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    $id = Session::get('id');
    $role_id = Session::get('role');
?>
<div class="grid_10">
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
            $name       = $fm->validation($_POST['name']);
            $name       = mysqli_real_escape_string($db->link, $name);
            $username   = $fm->validation($_POST['username']);
            $username   = mysqli_real_escape_string($db->link, $username);
            $email      = $fm->validation($_POST['email']);
            $email      = mysqli_real_escape_string($db->link, $email);
            $details    = $fm->validation($_POST['details']);
            $details    = mysqli_real_escape_string($db->link, $details);

            if (empty($name) || empty($username) || empty($email) || empty($details)){
                echo "<span style='color:red;font-size: 18px'>Field must not be empty!</span>";
            }else{
                $query = "UPDATE users SET name = '$name', username = '$username', email = '$email', details = '$details' WHERE id = '$id' AND role = '$role_id'";
                $update = $db->update($query);
                if ($update){
                    $update_message = "<span style='color:green;font-size: 18px'>Profile updated successfully</span>";
                }else{
                    $update_message = "<span style='color:red;font-size: 18px'>Something went wrong!</span>";
                }
            }
        }
    ?>
    <div class="box round first grid">
        <h2>Profile Page</h2>
        <div class="block">
            <?php
                if (isset($update_message)){
                    echo $update_message;
                }
            ?>
            <form action="profile.php" method="POST">
                <table class="form">
                <?php
                    $query = "SELECT * FROM users WHERE id = '$id'";
                    $getuser = $db->select($query);
                    $result = mysqli_fetch_assoc($getuser);
                ?>
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $result['name'] ?>" placeholder="Enter your name.." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text"  name="username" value="<?php echo $result['username'] ?>" placeholder="Enter username" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email Address</label>
                        </td>
                        <td>
                            <input type="email"  name="email" value="<?php echo $result['email'] ?>" placeholder="Enter email address" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="details"><?php echo $result['details'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="update" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include "inc/footer.php"; ?>