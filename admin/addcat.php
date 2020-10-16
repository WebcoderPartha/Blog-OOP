<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
                <div class="block copyblock">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['submit']){
                            $cat_name = $fm->validation($_POST['name']);
                            $cat_name = mysqli_real_escape_string($db->link, $cat_name);
                            if (empty($cat_name)){
                                echo "<span style='color: red'>Field must not be empty.</span>";
                            }else{
                                $query = "INSERT INTO categories (name) VALUES ('$cat_name')";
                                $result = $db->insert($query);
                                if ($result){
                                    echo "<span style='color: green'>".$cat_name." Category inserted successfully</span>";
                                }else{
                                    echo "<span style='color: red'>Category not inserted.</span>";
                                }
                            }

                        }
                    ?>
                     <form action="addcat.php" method="POST">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                     </form>
                </div>
            </div>
        </div>
<?php include "inc/footer.php"; ?>
