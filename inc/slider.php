<div class="slidersection templete clear">
    <div id="slider">
        <?php
                $db = new DB();
                $query = "select * from slider order by id limit 5";
                $slider = $db->select($query);
                if ($slider) {
                        while ($value = $slider->fetch_assoc()) {

                ?>
        <a href="#"><img src="admin/<?php echo $value['image'] ?>" alt="nature 1"
                title="<?php echo $value['title'] ?>" /></a>
        <?php
                        }
                }
                ?>
    </div>

</div>