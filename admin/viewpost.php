<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
    <div class="grid_10">

        <div class="box round first grid">
            <h2>Add New Post</h2>
            <div class="block">

                <?php
                if (!isset($_GET['id']) || $_GET == NULL){
                    echo "<script>window.location = 'postlist.php';</script>";
                }else{
                    $id = $_GET['id'];
                    $query = "SELECT posts.*, categories.name FROM posts INNER JOIN categories ON posts.cat = categories.id WHERE posts.id = '$id' ";
                    $posts = $db->select($query);
                    $post = mysqli_fetch_array($posts);
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">

                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $post['title'] ?>" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" readonly>
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
                                <label>Image</label>
                            </td>
                            <td width="50%">
                                <img src="<?php echo $post['image'] ?>" width="300" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce"><?php echo $post['body'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $post['tags'] ?>" placeholder="Enter tags" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo Session::get('name') ?>" readonly placeholder="Enter author name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="update" value="ok" />
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