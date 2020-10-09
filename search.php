<?php include "inc/header.php"; ?>
<?php include "inc/slider.php"; ?>
<?php
$db = new Database();
$format = new Format();

if(!isset($_POST['search']) || $_POST['search'] == NULL){
    header('Location: 404.php');
}else{
    $search = $_POST['search'];
}
?>

    <div class="contentsection contemplete clear">
        <div class="maincontent clear">
            <?php
            $query = "select * from posts where title LIKE '%$search%' or body like '%$search%'";
            $posts = $db->select($query);
            if ($posts){
                foreach ($posts as $result) {
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
            <?php }else { ?>
                <p>Your search query not found</p>
                <?php } ?>

        </div>
        <?php include 'inc/sidebar.php' ?>
    </div>

<?php include 'inc/footer.php'; ?>