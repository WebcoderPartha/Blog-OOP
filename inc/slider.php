<div class="slidersection templete clear">
    <div id="slider">

        <?php
            $query = "SELECT * FROM slider ORDER BY id DESC";
            $sliders = $db->select($query);
            if ($sliders){
                foreach ($sliders as $slider){ ?>

                    <a href="<?php echo $slider['link'] ?>"><img src="admin/<?php echo $slider['image'] ?>" alt="nature 1" title="<?php echo $slider['title'] ?>" /></a>

           <?php     }
            }
        ?>

    </div>
</div>