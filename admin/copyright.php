<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    $fb = new Format();

?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit']){
                            $copyright = $fb->validation($_POST['copyright_text']);
                            $copyright = mysqli_real_escape_string($db->link, $copyright);

                            if ($copyright == ''){
                                echo '<span style="color:red">Field must not be empty!</span>';
                            }else {
                                $query = "UPDATE copyright SET copyright_text = '$copyright' WHERE id = '1' ";
                                $update = $db->update($query);
                                if ($update) {
                                    echo '<span style="color:green">Copyright text updated successfully</span>';
                                } else {
                                    echo '<span style="color:red">Copyright text not updated<span>';
                                }
                            }
                        }
                    ?>
                    <?php
                    $query = "SELECT * FROM copyright where id = '1' ";
                    $text = $db->select($query);
                    $copyright = mysqli_fetch_assoc($text);
                    ?>
                 <form method="POST" action="copyright.php">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Copyright Text..." value="<?php echo $copyright['copyright_text'] ?>" name="copyright_text" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include "inc/footer.php"; ?>