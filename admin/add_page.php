<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

    <div class="grid_10">

        <div class="box round first grid">
            <h2>Add New Post</h2>
            <div class="block">
                <?php

                    if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['submit']){
                        $name = $fm->validation($_POST['name']);
                        $content = $fm->validation($_POST['content']);
                        $name = mysqli_real_escape_string($db->link, $name);
                        $content = mysqli_real_escape_string($db->link, $content);
                        if (empty($name) || empty($content)){
                            echo "<span style='color: red'>Field must not be empty.</span>";
                        }else{
                            $query = "INSERT INTO pages (name, content) VALUES ('$name', '$content')";
                            $result = $db->insert($query);
                            if ($result){
                                echo "<span style='color: green'>".$name. " page created successfully</span>";
                            }else{
                                echo "<span style='color: red'>Pages not inserted.</span>";
                            }
                        }

                    }

                ?>
                <form action="add_page.php" method="POST">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Page Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter page name..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="content"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                            </td>
                            <td>
                                <input type="submit" name="submit" value="Create">
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