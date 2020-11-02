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
                        $cat = $fm->validation($_POST['cat']);
                        $body = $fm->validation($_POST['body']);
                        $tags = $fm->validation($_POST['tags']);
                        $author = $fm->validation($_POST['author']);
                        $title = mysqli_real_escape_string($db->link, $title);
                        $cat = mysqli_real_escape_string($db->link, $cat);
                        $body = mysqli_real_escape_string($db->link, $body);
                        $tags = mysqli_real_escape_string($db->link, $tags);
                        $author = mysqli_real_escape_string($db->link, $author);

                        if ($title == '' || $cat == '' || $body == '' || $tags == '' || $author == ''){
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
                        if(!empty($file_name)) {
                            if ($file_size > 1234567) {
                                echo "<span style='color:red'>Image size should be less then 1 KB!</span>";
                            } elseif (in_array($extension, $permited) === false) {
                                echo "<span style='color:red'>You can upload only" . implode(',', $permited) . "</span>";
                            } else {
                                $file = $post['image'];
                                if (file_exists($file)) {
                                    unlink($file);
                                }
                                move_uploaded_file($file_tmp, $upload_image);
                                $query = "UPDATE posts SET cat = '$cat', title = '$title', body = '$body', image = '$upload_image', author = '$author', tags = '$tags' WHERE id = '$id'";
                                $result = $db->update($query);

                                if ($result) {
                                    echo "<span style='color:green'>Data Updated successfully</span>";
                                } else {
                                    echo "<span style='color:red'>Data not Updated</span>";
                                }
                            }
                        }else{
                            move_uploaded_file($file_tmp, $upload_image);
                            $query = "UPDATE posts SET cat = '$cat', title = '$title', body = '$body', author = '$author', tags = '$tags' WHERE id = '$id'";
                            $result = $db->update($query);

                            if ($result) {
                                echo "<span style='color:green'>Data Updated successfully</span>";
                            } else {
                                echo "<span style='color:red'>Data not Updated</span>";
                            }
                        }

                    }
                    ?>
                    <?php
                    if (isset($_GET['id']) || $_GET == NULL){
                        $id = $_GET['id'];
                        $query = "SELECT posts.*, categories.name FROM posts INNER JOIN categories ON posts.cat = categories.id WHERE posts.id = '$id' ";
                        $posts = $db->select($query);
                        $post = mysqli_fetch_array($posts);

                    }
                    ?>
                 <form action="editpost.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">

                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $post['title'] ?>" placeholder="Enter Post Title..." class="medium" />
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
                                    <option value="<?php echo $category['id']; ?>"
                                        <?php
                                            if ($post['cat'] == $category['id'])
                                                echo "selected";
                                        ?>
                                    ><?php echo $category['name']; ?>
                                    </option>
                                    <?php  } } ?>
                                </select>
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
                                <img src="<?php echo $post['image'] ?>" width="50" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $post['body'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $post['tags'] ?>" placeholder="Enter tags" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo Session::get('name') ?>" name="author" placeholder="Enter author name..." class="medium" />
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