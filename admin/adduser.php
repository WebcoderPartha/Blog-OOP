<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    if (!Session::get('role') == 0){ ?>
        <script>window.location = 'index.php';</script>
    <?php } ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add User</h2>
        <div class="block copyblock">
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
                    $username = $fm->validation($_POST['username']);
                    $username = mysqli_real_escape_string($db->link, $username);
                    $email = $fm->validation($_POST['email']);
                    $email = mysqli_real_escape_string($db->link, $email);
                    $password = $fm->validation(md5($_POST['password']));
                    $password = mysqli_real_escape_string($db->link, $password);
                    $role     = $fm->validation($_POST['role']);
                    $role     = mysqli_real_escape_string($db->link, $role);

                    if (empty($username) || empty($email) || empty($password) || empty($role)){
                        echo "<span style='color: red; font-weight: bold;'>Field must not be empty!<br></span>";
                    }

                        $emailquery = "SELECT * FROM users WHERE email = '$email' limit 1";
                        $mailCheck = $db->select($emailquery);
                        $username_query = "SELECT * FROM users WHERE username = '$username' limit 1";
                        $username_check = $db->select($username_query);
                        if ($username_check !== false) {
                            echo "<span style='color: red; font-weight: bold;'>Username already exist!<br></span>";
                        }
                        if ($mailCheck !== false){
                            echo "<span style='color: red; font-weight: bold;'>Email already exist!</span>";
                        }else {
                            $query = "INSERT INTO users(username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
                            $userrole = $db->insert($query);
                            if ($userrole) {
                                echo "<span style='color: green; font-weight: bold;'>User created successfully.</span>";
                            } else {
                                echo "<span style='color: red; font-weight: bold;'>Something went wrong!</span>";
                            }
                        }

                }
            ?>
            <form action="adduser.php" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label for="">Username:</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter username" class="medium"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Email Address:</label>
                        </td>
                        <td>
                            <input type="email" name="email" placeholder="Enter email address" class="medium"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Password:</label>
                        </td>
                        <td>
                            <input type="password" name="password" placeholder="Enter password" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">User Role:</label>
                        </td>
                        <td>
                            <select name="role" id="select">
                                <option>Select Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                                <option value="3">Subscriber</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Add" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>
