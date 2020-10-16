<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">
                    <?php
                        if (isset($_GET['del'])) {
                            $catid = $_GET['del'];
                            $query = "DELETE FROM categories where id = '$catid'";
                            $delcate = $db->delete($query);
                            if ($delcate) {
                                echo "<span style='color: green'>Category deleted successfully</span>";
                            } else {
                                echo "<span style='color: red'>Category not delete</span>";
                            }
                        }
                    ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        $query = "SELECT * FROM categories ORDER BY id DESC";
                        $categories = $db->select($query);
                        if ($categories){
                            foreach ($categories as $key => $category){
                    ?>
						<tr class="odd gradeX">
							<td><?php echo $key + 1  ?></td>
							<td><?php echo $category['name'] ?></td>
							<td><a href="editcat.php?catid=<?php echo $category['id'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?del=<?php echo $category['id']; ?>">Delete</a></td>
						</tr>
                    <?php } }else{ ?>
                            <p>No Categories Found</p>
                        <?php } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">

    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>
 <?php include "inc/footer.php"; ?>