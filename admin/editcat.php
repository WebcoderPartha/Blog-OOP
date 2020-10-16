<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
                <div class="block copyblock">

                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['update']){
                            if (isset($_GET['catid'])){
                                $id = $_GET['catid'];
                                $cat_name = $fm->validation($_POST['name']);
                                $cat_name = mysqli_real_escape_string($db->link, $cat_name);
                                $query = "UPDATE categories SET name = '$cat_name'  WHERE id = '$id'";
                                $result = $db->update($query);
                                if ($result){
                                    echo "<span style='color: green'>".$cat_name." Category updated successfully</span>";
                                }else{
                                    echo "<span style='color: red'>Category not updated.</span>";
                                }
                            }

                        }
                    ?>
                    <?php
                    if (isset($_GET['catid'])){
                        $id = $_GET['catid'];
                        $query = "SELECT * From categories WHERE id = '$id'";
                        $result = $db->select($query);
                        $category = mysqli_fetch_array($result);
                    }
                    ?>
                     <form action="editcat.php?catid=<?php echo $id;  ?>" method="POST">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" name="name" value="<?php echo $category['name']; ?>" placeholder="Enter Category Name..." class="medium" />
                                </td>
                            </tr>
                            <tr>
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
