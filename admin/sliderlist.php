<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

<?php
if (isset($_GET['del'])){
    $id = $_GET['del'];
    $image_query = "SELECT * FROM slider WHERE id = '$id' ";
    $getimage = $db->select($image_query);
    $exist_image = mysqli_fetch_assoc($getimage);
    $has_image = $exist_image['image'];
    if ($has_image){
        unlink($has_image);
    }
    $query = "DELETE FROM slider WHERE id = '$id'";
    $delete = $db->delete($query);
    if ($delete) {
        echo "<span style='color: green'>Slider deleted successfully</span>";
    } else {
        echo "<span style='color: red'>Slider not delete</span>";
    }

}
?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Post List</h2>
            <div class="block">
                <table class="table data display datatable">
                    <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Slider Title</th>
                        <th>Link</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM slider ORDER BY id DESC";
                    $sliders = $db->select($query);
                    if ($sliders){
                        foreach ($sliders as $key => $slider){
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $slider['title']; ?></td>
                                <td><?php echo $slider['link'] ?></td>
                                <td><img src="<?php echo $slider['image'] ?>" width="60" height="40" alt=""></td>
                                <td>
                                    <a href="editslider.php?id=<?php echo $slider['id'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this post?')" href="?del=<?php echo $slider['id'] ?>">Delete</a>

                                </td>
                            </tr>
                        <?php } }else{ ?>
                        <h2>No slider found</h2>

                    <?php } ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.datatable').dataTable();
        });
    </script>
<?php include "inc/footer.php"; ?>