<?php include 'inc/header.php' ?>
<?php
    $postid = mysqli_real_escape_string($db->link, $_GET['id']);
    if (!isset($postid) || $postid == NULL ){
        echo '<script>window.location = "index.php";</script>';
    }else{
        $postId = $postid;
    }
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
                <?php
                    $db = new Database();
                    $query = "SELECT * FROM posts where id = $postId";
                    $post = $db->select($query);
                    $result = $post->fetch_assoc();
//                    print_r($result);
                ?>
                <?php if($post) { ?>
				<h2><?php echo $result['title']; ?></h2>
				<h4><?php $fm = new Format();  echo $fm->dateFormat($result['date']) ?>, By <?php echo $result['author'] ?></h4>
				<img src="admin/<?php echo $result['image'] ?>" alt="MyImage"/>
				<?php echo $result['body'] ?>


				<div class="relatedpost clear">
                    <?php
                        $catId = $result['cat'];
                        $query = "SELECT * FROM posts where cat = $catId ORDER BY RAND ()   LIMIT 6";
                        $reletedPost = $db->select($query);
                        if ($result){
                            while ($rrpost =$reletedPost->fetch_assoc()){
                    ?>
					<h2>Related articles</h2>
					<a href="post.php?id=<?php echo $rrpost['id']; ?>"><img src="admin/<?php echo $rrpost['image'] ?>" alt="post image"/></a>
				</div>
                <?php } } ?>
                <?php  }else { header("Location: 404.php"); ?>
                <?php } ?>
	</div>
        </div>
        <?php include 'inc/sidebar.php' ?>
	</div>

<?php include 'inc/footer.php' ?>