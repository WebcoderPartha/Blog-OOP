<?php include "config/config.php"; ?>
<?php include "lib/Database.php"; ?>
<?php include "helpers/Format.php";
    $db = new Database();
    $fm = new Format();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        if (isset($_GET['pageid'])){
            $pageid = $_GET['pageid'];
            $query = "SELECT * FROM pages WHERE id = '$pageid'";
            $pages = $db->select($query);

            if ($pages){
                $page = mysqli_fetch_assoc($pages);
            ?>
                <title><?php echo $page['name'] ?> | <?php echo title; ?></title>
          <?php  } }elseif(isset($_GET['id'])){
                $id = $_GET['id'];
                $query = "SELECT * FROM posts WHERE id = '$id'";
                $posts = $db->select($query);
                if ($posts){
                    $post = mysqli_fetch_assoc($posts); ?>
                    <title><?php echo $post['title'] ?> | <?php echo title; ?></title>
                <?php } }else{ ?>
            <title><?php echo $fm->title(); ?> | <?php echo title; ?></title>
      <?php  } ?>

    <meta name="language" content="English">
    <meta name="description" content="It is a website about education">
    <meta name="keywords" content="blog,cms blog">
    <meta name="author" content="Delowar">
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider({
                effect:'random',
                slices:10,
                animSpeed:500,
                pauseTime:5000,
                startSlide:0, //Set starting Slide (0 index)
                directionNav:false,
                directionNavHide:false, //Only show on hover
                controlNav:false, //1,2,3...
                controlNavThumbs:false, //Use thumbnails for Control Nav
                pauseOnHover:true, //Stop animation while hovering
                manualAdvance:false, //Force manual transitions
                captionOpacity:0.8, //Universal caption opacity
                beforeChange: function(){},
                afterChange: function(){},
                slideshowEnd: function(){} //Triggers after all slides have been shown
            });
        });
    </script>
</head>

<body>
<div class="headersection templete clear">
    <?php
        $query = "SELECT * FROM slogan WHERE id = '1'";
        $getData = $db->select($query);
        $result = mysqli_fetch_assoc($getData);
    ?>
    <a href="#">
        <div class="logo">
            <img src="admin/<?php echo $result['logo'] ?>" alt="Logo"/>
            <h2><?php echo $result['site_title'] ?></h2>
            <p><?php echo $result['site_desc'] ?></p>
        </div>
    </a>
    <?php
        $query = "SELECT * FROM social_media WHERE id= '1' ";
        $media = $db->select($query);
        $link = mysqli_fetch_assoc($media);
    ?>
    <div class="social clear">
        <div class="icon clear">
            <a href="<?php echo $link['facebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="<?php echo $link['twitter']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="<?php echo $link['linkedin']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
            <a href="<?php echo $link['gplus']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
        </div>
        <div class="searchbtn clear">
            <form action="search.php" method="post">
                <input type="text" name="search" placeholder="Search keyword..."/>
                <input type="submit" name="submit" value="Search"/>
            </form>
        </div>
    </div>
</div>
<div class="navsection templete">
    <?php
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
    ?>
    <ul>
        <li><a
             <?php
                if ($title == 'index'){
                    echo 'id="active"';
                }

            ?> href="index.php">Home</a></li>
        <?php


            $query = "SELECT * FROM pages ORDER BY id DESC";
            $result = $db->select($query);
            if ($result){
                foreach ($result as $page){
        ?>
        <li><a
                <?php
                if (isset($pageid) && $_GET['pageid'] == $page['id']){
                    echo 'id="active"';
                }
               ?>
                    href="page.php?pageid=<?php echo $page['id'] ?>"><?php echo $page['name'] ?></a></li>
        <?php } }else{ ?>
                <li><a id="active" href="">NO Page</li>
        <?php } ?>
        <li><a
            <?php
            if ($title == 'contact_us'){
                echo 'id="active"';
            }
            ?> href="contact_us.php">Contact</a></li>
    </ul>
</div>
