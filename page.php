<?php include 'inc/header.php' ?>
<?php
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL){
        header('Location: 404.php');
    }else{
        $id = $_GET['pageid'];

        $query = "SELECT * FROM pages WHERE id = '$id'";
        $result = $db->select($query);
        $page = mysqli_fetch_assoc($result);
    }
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $page['name'] ?></h2>
	
				<p><?php echo  $page['content'] ?></p>

	        </div>
        </div>
        <?php include 'inc/sidebar.php' ?>
	</div>

<?php include 'inc/footer.php' ?>