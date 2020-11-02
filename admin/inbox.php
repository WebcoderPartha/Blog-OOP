<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
if (isset($_GET['seen']) ){
    $id = $_GET['seen'];
    $query = "UPDATE contact SET status = 1 WHERE id = '$id' ";
    $update = $db->update($query);
    if ($update){
        $seens = "seen successfully";
    }
}
?>
<?php
if (isset($_GET['delete']) ){
    $id = $_GET['delete'];
    $query = "DELETE FROM contact WHERE id = '$id'";
    $delete = $db->delete($query);
    if ($delete){
        $seens = "Delete successfully";
    }
}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                    if (isset($seens)){
                        echo $seens;
                    }
                ?>
                <div class="block">        
                    <table class="display datatable">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        $query = "SELECT * FROM contact WHERE status = 0 ORDER BY id DESC";
                        $contacts = $db->select($query);

                        if ($contacts){
                            foreach ($contacts as $key => $contact){
                    ?>
						<tr class="odd gradeX">
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $contact['firstname'].' '.$contact['lastname'] ?></td>
							<td><?php echo $contact['email']; ?></td>
							<td><?php echo $fm->textShorten($contact['message'], 20) ?></td>
							<td>
                                <a href="message.php?view=<?php echo $contact['id']; ?>">View</a> ||
                                <a href="reply.php?id=<?php echo $contact['id']; ?>">Reply</a> ||
                                <a href="?seen=<?php echo $contact['id']; ?>">Seen</a>
                            </td>
						</tr>
                    <?php
                        } }else{
                            echo "<h2>No messages</h2>";
                        }
                    ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Seen Message</h2>
            <div class="block">
                <table class="display datatable">
                    <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "SELECT * FROM contact WHERE status = 1 ORDER BY id DESC";
                        $seen = $db->select($query);
                        if ($seen){
                            foreach ($seen as $key => $result){

                    ?>
                    <tr>
                        <td><?php echo $key + 1 ?></td>
                        <td><?php echo $result['firstname'].' '.$result['lastname']  ?></td>
                        <td><?php echo $result['email'] ?></td>
                        <td><?php echo $result['message'] ?></td>
                        <td><a href="?delete=<?php echo $result['id']; ?>">Delete</a></td>
                    </tr>
                    <?php } }else{ ?>
                           <h2>No seen message</h2>
                      <?php  } ?>
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