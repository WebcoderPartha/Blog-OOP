<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

<?php
if (isset($_GET['del'])){
    $id = $_GET['del'];
    $image_query = "SELECT * FROM posts WHERE id = '$id' ";
    $getimage = $db->select($image_query);
    $exist_image = mysqli_fetch_assoc($getimage);
    $has_image = $exist_image['image'];
    if ($has_image){
        unlink($has_image);
    }
    $query = "DELETE FROM posts WHERE id = '$id'";
    $delete = $db->delete($query);
    if ($delete) {
        echo "<span style='color: green'>Post deleted successfully</span>";
    } else {
        echo "<span style='color: red'>Post not delete</span>";
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
                    <th>Post Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "select posts.*, categories.name from posts inner join categories on posts.cat = categories.id order by posts.id desc";
                $posts = $db->select($query);
                if ($posts){
                    foreach ($posts as $post){
            ?>
                <tr class="odd gradeX">
                    <td><?php echo $post['title']; ?></td>
                    <td><?php echo $fm->textShorten($post['title'], 50) ?></td>

                    <td><?php echo $post['name'] ?></td>
                    <td><img src="<?php echo $post['image'] ?>" width="60" height="40" alt=""></td>
                    <td><?php echo $post['tags'] ?></td>
                    <td><?php echo $post['author'] ?></td>

                    <td>
                        <a href="viewpost.php?id=<?php echo $post['id']; ?>">View</a>
                        <?php  if (Session::get('id') == $post['userid'] || Session::get('role') == 0) { ?>
                        || <a href="editpost.php?id=<?php echo $post['id'] ?>">Edit</a>
                        || <a onclick="return confirm('Are you sure to delete this post?')" href="?del=<?php echo $post['id'] ?>">Delete</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } }else{ ?>
                  <h2>No posts found</h2>

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