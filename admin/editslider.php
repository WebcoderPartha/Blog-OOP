<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
    <div class="grid_10">

        <div class="box round first grid">
            <h2>Add New Post</h2>
            <div class="block">


                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['update']){
                    if (isset($_GET['id'])){
                        $id = $_GET['id'];
                    }
                    $title = $fm->validation($_POST['title']);
                    $link = $fm->validation($_POST['link']);
                    $title = mysqli_real_escape_string($db->link, $title);
                    $link = mysqli_real_escape_string($db->link, $link);


                    if ($title == '' || $link == ''){
                        echo "<span style='color: red'>Field must not be empty</span>";
                    }

                    $permited = array('jpg', 'jpeg', 'png', 'gif');
                    $file_name = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_tmp = $_FILES['image']['tmp_name'];
                    $div = explode('.', $file_name);
                    $extension = strtolower(end($div));
                    $img = time().'.'.$extension;
                    $upload_image = "upload/slider/".$img;
                    if(!empty($file_name)) {
                        if ($file_size > 1234567) {
                            echo "<span style='color:red'>Image size should be less then 1 KB!</span>";
                        } elseif (in_array($extension, $permited) === false) {
                            echo "<span style='color:red'>You can upload only" . implode(',', $permited) . "</span>";
                        } else {

                            $query = "SELECT * FROM slider WHERE id = '$id' ";
                            $sliders = $db->select($query);
                            $slider = mysqli_fetch_array($sliders);


                            $file = $slider['image'];
                            if (file_exists($file)) {
                                unlink($file);
                            }
                            move_uploaded_file($file_tmp, $upload_image);
                            $query = "UPDATE slider SET title = '$title', link = '$link', image = '$upload_image' WHERE id = '$id'";
                            $result = $db->update($query);

                            if ($result) {
                                echo "<span style='color:green'>Slider Updated with image successfully</span>";
                            } else {
                                echo "<span style='color:red'>Slider not Updated</span>";
                            }
                        }
                    }else{
                        $query = "UPDATE slider SET title = '$title', link = '$link' WHERE id = '$id'";
                        $result = $db->update($query);

                        if ($result) {
                            echo "<span style='color:green'>Slider Updated without image successfully</span>";
                        } else {
                            echo "<span style='color:red'>Slider not Updated</span>";
                        }
                    }

                }
                ?>
                <?php
                if (isset($_GET['id']) || $_GET == NULL){
                    $id = $_GET['id'];
                    $query = "SELECT * FROM slider WHERE id = '$id' ";
                    $sliders = $db->select($query);
                    $slider = mysqli_fetch_array($sliders);

                }
                ?>
                <form action="editslider.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">

                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $slider['title'] ?>" placeholder="Enter slider Title..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="link" value="<?php echo $slider['link'] ?>" placeholder="Enter slider link..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td width="25%">
                                <label>Upload Image</label>
                            </td>
                            <td width="25%">
                                <input type="file"  name="image"/>
                            </td>
                            <td width="50%">
                                <img src="<?php echo $slider['image'] ?>" width="50" alt="">
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="update" Value="update" />
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