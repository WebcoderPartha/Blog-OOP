<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Themes</h2>
        <div class="block copyblock">

            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['update']){
                $name = $fm->validation($_POST['name']);
                $name  = mysqli_real_escape_string($db->link, $name);
                $query = "UPDATE themes SET name = '$name' WHERE id = '1'";
                $update = $db->update($query);
                if ($update){
                    echo "<span style='color: green; font-weight: bold;'>Theme changed successfully.</span>";
                }else{
                    echo "<span style='color: red; font-weight: bold;'>Something went wrong!</span>";
                }
            }
            ?>

            <form action="theme.php" method="POST">
                <table class="form">
                    <?php
                        $query = "SELECT * FROM themes WHERE id = '1'";
                        $themes = $db->select($query);
                        $result = $themes->fetch_assoc();
                    ?>
                    <tr>
                        <td>
                            <input type="radio" <?php if ($result['name'] == 'default'){ echo 'checked'; }  ?> value="default" name="name"> Default
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <input type="radio" value="green" <?php if ($result['name'] == 'green'){ echo 'checked'; }  ?> name="name"> Green
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" value="red" <?php if ($result['name'] == 'red') { echo 'checked'; }  ?> name="name"> Red
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="update" Value="Change" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>
