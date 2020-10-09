<div class="sidebar clear">
    <div class="samesidebar clear">
        <h2>Categories</h2>
        <ul>
            <?php
            $format = new Format();
                $db = new Database();
                $query = "SELECT * FROM categories";
                $categories = $db->select($query);
                if ($categories){
                    foreach ($categories as $category){
                ?>
                   <li><a href="posts.php?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
            <?php } ?>
            <?php }else{ ?>
                    <li>No category created</li>
            <?php }?>
        </ul>
    </div>

    <div class="samesidebar clear">
        <h2>Latest articles</h2>
        <?php
            $query = "select * from posts limit 4";
            $posts = $db->select($query);
            if ($posts){
                foreach ($posts as $post) {
        ?>
        <div class="popular clear">
            <h3><a href="post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h3>
            <a href="#"><img src="admin/upload/<?php echo $post['image']; ?>" alt="post image"/></a>
            <p><?php echo $format->textShorten($post['body'],150); ?></p>
        </div>
              <?php } ?>
    <?php }else{
                echo "No posts found";
            }?>

    </div>

</div>