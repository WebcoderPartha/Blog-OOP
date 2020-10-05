<?php include "config/config.php"; ?>
<?php include "lib/Database.php"; ?>
<?php include "helpers/Format.php"; ?>
<?php include "inc/header.php"; ?>
<?php include "inc/slider.php"; ?>
<?php
    $db = new Database();
    $format = new Format();

?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
            <?php
            //    pagination
            $per_page = 3;
            if (isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = 1;
            }
            $star_from = ($page-1) *$per_page;
            ?>

            <?php
                $query = "SELECT * FROM posts LIMIT  $star_from, $per_page";
                $posts = $db->select($query);
                if ($posts) {
                    while ($result= $posts->fetch_assoc()){
            ?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id'] ?>"><?php echo $result['title'] ?></a></h2>
				<h4><?php echo $format->dateFormat($result['date']); ?>, By <a href="#"><?php echo $result['author'] ?></a></h4>
				 <a href="#"><img src="admin/upload/<?php echo $result['image'] ?>" alt="post image"/></a>

                    <?php echo $format->textShorten($result['body'], 200); ?>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id'] ?>">Read More</a>
				</div>
			</div>
                    <?php } ?>
                    <!-- while end -->
                    <!-- Pagination -->
                    <?php
                    $query = "SELECT * FROM posts";
                    $result = $db->select($query);
                    $total_rows = mysqli_num_rows($result);
                    $total_pages = ceil($total_rows/$per_page);
                    echo "<span class='pagination'><a href='index.php?page=1'>".'First Page'."</a>";
                        for ($i = 1; $i <= $total_pages; $i++){
                            echo "<a href='index.php?page=$i'>".$i."</a>";
                        }
                    echo "<a href='index.php?page=$total_pages'>".'Last Page'."</a></span>" ?>
                    <!-- Pagination end -->
<?php }else { header('Location: 404.php'); } ?>

		</div>
        <?php include 'inc/sidebar.php' ?>
	</div>

<?php include 'inc/footer.php'; ?>