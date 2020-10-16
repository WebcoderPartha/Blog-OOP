<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php";
    $query = "SELECT * FROM slogan WHERE id = '1'";
    $slogans = $db->select($query);
    $slogan = mysqli_fetch_assoc($slogans);
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock">
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit']){
                    $site_title = $fm->validation($_POST['site_title']);
                    $site_desc = $fm->validation($_POST['site_desc']);
                    $site_title = mysqli_real_escape_string($db->link, $site_title);
                    $site_desc = mysqli_real_escape_string($db->link, $site_desc);

                    if ($site_title == '' || $site_desc == ''){
                        echo "<span style='color: red'>Field must not be empty</span>";
                    }

                    $permited = array('png');
                    $file_name = $_FILES['logo']['name'];
                    $file_size = $_FILES['logo']['size'];
                    $file_tmp = $_FILES['logo']['tmp_name'];
                    $div = explode('.', $file_name);
                    $extension = strtolower(end($div));
                    $img = 'logo'.'.'.$extension;
                    $upload_image = "upload/".$img;
                    if(!empty($file_name)) {
                        if ($file_size > 1234567) {
                            echo "<span style='color:red'>Image size should be less then 1 KB!</span>";
                        } elseif (in_array($extension, $permited) === false) {
                            echo "<span style='color:red'>You can upload only" . implode(',', $permited) . "</span>";
                        } else {

                            move_uploaded_file($file_tmp, $upload_image);
                            $query = "UPDATE slogan SET site_title = '$site_title', site_desc = '$site_desc', logo = '$upload_image' WHERE id = '1'";
                            $result = $db->update($query);

                            if ($result) {
                                echo "<span style='color:green'>Data Updated successfully</span>";
                            } else {
                                echo "<span style='color:red'>Data not Updated</span>";
                            }
                        }
                    }else {
                        $query = "UPDATE slogan SET site_title = '$site_title', site_desc = '$site_desc' WHERE id = '1'";
                        $result = $db->update($query);

                        if ($result) {
                            echo "<span style='color:green'>Data Updated successfully</span>";
                        } else {
                            echo "<span style='color:red'>Data not Updated</span>";
                        }
                    }

                }
            ?>
         <form method="POST" action="titleslogan.php" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Website Title</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Website Title..." value="<?php echo $slogan['site_title']; ?>"  name="site_title" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Website Slogan</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Website Slogan..." value="<?php echo $slogan['site_desc']; ?>" name="site_desc" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Logo</label>
                    </td>
                    <td>
                        <input type="file" name="logo" class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
        <div class="logo_image">
            <img src="<?php echo $slogan['logo']; ?>" alt="">
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>