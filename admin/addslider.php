<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
    <div class="grid_10">

        <div class="box round first grid">
            <h2>Add New Slider</h2>
            <div class="block">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit']){
                    $title = $fm->validation($_POST['title']);
                    $link = $fm->validation($_POST['link']);
                    $title = mysqli_real_escape_string($db->link, $title);
                    $link = mysqli_real_escape_string($db->link, $link);

                    if ($title == '' || $link == ''){
                        echo "<span style='color: red'>Field must not be empty<br></span>";
                    }

                    $permited = array('jpg', 'jpeg', 'png', 'gif');
                    $file_name = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_tmp = $_FILES['image']['tmp_name'];
                    $div = explode('.', $file_name);
                    $extension = strtolower(end($div));
                    $img = time().'.'.$extension;
                    $upload_image = "upload/slider/".$img;

                    if (empty($file_name)){
                        echo "<span style='color:red'>Please Select any Image!<br></span>";
                    }elseif($file_size > 1234567){
                        echo "<span style='color:red'>Image size should be less then 1 KB!</span>";
                    }elseif(in_array($extension,$permited) === false){
                        echo "<span style='color:red'>You can upload only".implode(',', $permited)."</span>";
                    }else{

                        move_uploaded_file($file_tmp, $upload_image);
                        $query = "INSERT INTO slider (title, link, image) VALUES ('$title', '$link', '$upload_image')";
                        $result = $db->insert($query);

                        if ($result){
                            echo "<span style='color:green'>Slider inserted successfully</span>";
                        }else{
                            echo "<span style='color:red'>Slider not Inserted</span>";
                        }
                    }


                }
                ?>
                <form action="addslider.php" method="POST" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Slider Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter slider Title..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Link</label>
                            </td>
                            <td>
                                <input type="text" name="link" placeholder="Enter slider link" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file"  name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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