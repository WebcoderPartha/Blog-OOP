<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
    <?php
        if (!isset($_GET['id']) || $_GET['id']  == NULL){
            header('Location: userlist.php');
        }else{
            $userid = $_GET['id'];
        }
    ?>
    <div class="grid_10">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           echo "<script>window.location = 'userlist.php';</script>";
        }
        ?>
        <div class="box round first grid">
            <h2>View User Profile Page</h2>
            <div class="block">
                <?php
                $query = "SELECT * FROM users WHERE id = '$userid'";
                $getuser = $db->select($query);
                $result = mysqli_fetch_assoc($getuser);
                ?>
                <form method="POST" action="">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['name'] ?>" placeholder="Enter your name.." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text"  readonly value="<?php echo $result['username'] ?>" placeholder="Enter username" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email Address</label>
                            </td>
                            <td>
                                <input type="email"  readonly value="<?php echo $result['email'] ?>" placeholder="Enter email address" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" readonly><?php echo $result['details'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="update" Value="Ok" />
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