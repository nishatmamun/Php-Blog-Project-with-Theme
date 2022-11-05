<?php include 'inc/header.php'; ?>
<?php
$id = mysqli_real_escape_string($db->link, $_GET['id']);
if (!isset($id) || $id == null) {
    header("Location: 404.php");
} else {
    $id = $id;
}
?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <?php
            $query = "select * from post where id=$id";
            $post = $db->select($query);
            if ($post) {
                foreach ($post as $value) {
            ?>
            <h2><?php echo $value['title'] ?></h2>
            <h4><?php echo $fm->formateDate($value['date']) ?>, <a href="#"><?php echo $value['author'] ?></a></h4>
            <img src="admin/<?php echo $value['image'] ?>" alt="MyImage" />

            <p><?php echo $value['body'] ?></p>

            <?php
                }
            } else {
                header("Location: 404.php");
            }
            ?>
            <div class="relatedpost clear">
                <h2>Related articles</h2>
                <?php
                $cid = $value['cat'];
                $cquery = "select * from post where cat=$cid order by rand() limit 6";
                $cpost = $db->select($cquery);
                if ($cpost) {
                    foreach ($cpost as $cvalue) {
                ?>
                <a href="post.php?id=<?php echo $cvalue['id'] ?>"><img src="admin/<?php echo $cvalue['image'] ?>"
                        alt="post image" /></a>
                <?php
                    }
                } else {
                    echo "No Related Post Available";
                }
                ?>
            </div>
        </div>

    </div>
    <?php include 'inc/sidebar.php'; ?>
</div>
<?php include 'inc/footer.php'; ?>