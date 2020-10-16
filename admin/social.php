<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php";
$fm = new Format();
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['update']){
                $facebook = $fm->validation($_POST['facebook']);
                $facebook = mysqli_real_escape_string($db->link, $facebook);
                $twitter = $fm->validation($_POST['twitter']);
                $twitter = mysqli_real_escape_string($db->link, $twitter);
                $linkedin = $fm->validation($_POST['linkedin']);
                $linkedin = mysqli_real_escape_string($db->link, $linkedin);
                $gplus = $fm->validation($_POST['gplus']);
                $gplus = mysqli_real_escape_string($db->link, $gplus);

                if ($facebook == '' || $twitter == '' || $linkedin == '' || $gplus == ''){
                    echo '<span style="color:red">Field must not be empty!</span>';
                }else{

                    $query = "UPDATE social_media SET facebook = '$facebook', twitter = '$twitter', linkedin = '$linkedin', gplus = '$gplus' WHERE id = '1'";
                    $update = $db->update($query);
                    if ($update){
                        echo '<span style="color:green">Social Media updated successfully</span>';
                    }else{
                        echo '<span style="color:green">Social Media not updated!</span>';
                    }

                }
            }
        ?>
        <?php
        $query = "SELECT * FROM social_media WHERE id = '1'";
        $socials = $db->select($query);
        $links = mysqli_fetch_assoc($socials);
        ?>

        <div class="block">
         <form method="POST" action="social.php">
            <table class="form">
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="facebook" value="<?php echo $links['facebook']; ?>" placeholder="Facebook link.." class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="twitter" value="<?php echo $links['twitter']; ?>" placeholder="Twitter link.." class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="linkedin" value="<?php echo $links['linkedin']; ?>" placeholder="LinkedIn link.." class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" name="gplus" value="<?php echo $links['gplus']; ?>" placeholder="Google Plus link.." class="medium" />
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
<?php include "inc/footer.php"; ?>