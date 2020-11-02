<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <div class="block">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit']){
                            $title = $fm->validation($_POST['title']);
                            $cat = $fm->validation($_POST['cat']);
                            $body = $fm->validation($_POST['body']);
                            $tags = $fm->validation($_POST['tags']);
                            $author = $fm->validation($_POST['author']);
                            $userid = $fm->validation($_POST['userid']);
                            $title = mysqli_real_escape_string($db->link, $title);
                            $cat = mysqli_real_escape_string($db->link, $cat);
                            $body = mysqli_real_escape_string($db->link, $body);
                            $tags = mysqli_real_escape_string($db->link, $tags);
                            $author = mysqli_real_escape_string($db->link, $author);
                            $userid = mysqli_real_escape_string($db->link, $userid);

                            if ($title == '' || $title == '' || $title == '' || $title == '' || $title == ''){
                                echo "<span style='color: red'>Field must not be empty</span>";
                            }

                            $permited = array('jpg', 'jpeg', 'png', 'gif');
                            $file_name = $_FILES['image']['name'];
                            $file_size = $_FILES['image']['size'];
                            $file_tmp = $_FILES['image']['tmp_name'];
                            $div = explode('.', $file_name);
                            $extension = strtolower(end($div));
                            $img = time().'.'.$extension;
                            $upload_image = "upload/".$img;

                            if (empty($file_name)){
                                echo "<span style='color:red'>Please Select any Image!</span>";
                            }elseif($file_size > 1234567){
                                echo "<span style='color:red'>Image size should be less then 1 KB!</span>";
                            }elseif(in_array($extension,$permited) === false){
                                echo "<span style='color:red'>You can upload only".implode(',', $permited)."</span>";
                            }else{

                                move_uploaded_file($file_tmp, $upload_image);
                                $query = "INSERT INTO posts(cat, title, body, image, author, tags, userid) VALUES ('$cat', '$title', '$body', '$upload_image', '$author', '$tags', '$userid')";
                                $result = $db->insert($query);

                                if ($result){
                                    echo "<span style='color:green'>Data inserted successfully</span>";
                                }else{
                                    echo "<span style='color:red'>Image not Inserted</span>";
                                }
                            }


                        }
                    ?>
                 <form action="addpost.php" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option value="">Select Category</option>
                                    <?php
                                        $query = "select * from categories";
                                        $categories = $db->select($query);
                                        if ($categories){
                                            foreach ($categories as $category){
                                    ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php  } } ?>
                                </select>
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
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter tags" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo Session::get('name') ?>" placeholder="Enter author name..." class="medium" />
                                <input type="hidden" value="<?php echo Session::get('id') ?>" name="userid">
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