<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

    <div class="grid_10">


        <div class="box round first grid">
            <h2>Edit Page</h2>
            <div class="block">

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit']){
                    if (isset($_GET['pageid'])){
                        $id = $_GET['pageid'];
                    }
                    $name = $fm->validation($_POST['name']);
                    $name = mysqli_real_escape_string($db->link,$name);
                    $content = $fm->validation($_POST['content']);
                    $content = mysqli_real_escape_string($db->link,$content);

                    if (empty($name) || empty($content)){
                        echo "<span style='color: red'>Field must not be empty.</span>";
                    }else{
                        $query = "UPDATE pages SET name = '$name', content = '$content' WHERE id = '$id'";
                        $result = $db->update($query);
                        if ($result){
                            echo $update = "<span style='color: green'>Post updated successfully.</span>";
                        }else{
                            echo $update = "<span style='color: red'>Post not updated.</span>";
                        }
                    }
                }
                ?>

                <?php
                if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL){
                    header("Location: 404.php");
                }else{
                    $id = $_GET['pageid'];
                    $query = "SELECT * FROM pages WHERE id = '$id' ";
                    $result = $db->select($query);
                    $page = mysqli_fetch_assoc($result);
                }
                ?>
                <form action="page.php?pageid=<?php echo $page['id']; ?>" method="POST">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Page Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $page['name']; ?>" placeholder="Enter page name..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="content"><?php echo $page['content']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                            </td>
                            <td>
                                <input type="submit" name="submit" value="Update">
                                <span><a onclick="return confirm('Are you sure to delete this page?')" style="background: #ddd;padding: 7px 10px;" href="delpage.php?delpage=<?php echo $page['id']; ?>">Delete</a></span>
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