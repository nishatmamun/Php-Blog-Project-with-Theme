<?php
include 'inc/header.php';
?>
<?php
$category = mysqli_real_escape_string($db->link, $_GET['category']);
if (!isset($category) || $category == null) {
    header("Location: 404.php");
} else {
    $cat = $category;
}
?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <?php
        $query = "select * from post where cat=$cat";
        $post = $db->select($query);
        if ($post) {
            foreach ($post as $value) {
        ?>
        <div class="samepost clear">
            <h2><a href="post.php?id=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a></h2>
            <h4><?php echo $fm->formateDate($value['date']) ?>, By <a href="#"><?php echo $value['author'] ?></a></h4>
            <a href="post.php?id=<?php echo $value['id'] ?>"><img src="admin/<?php echo $value['image'] ?>"
                    alt="post image" /></a>
            <p>
                <?php echo $fm->textShorten($value['body']) ?>
            </p>
            <div class="readmore clear">
                <a href="post.php?id=<?php echo $value['id'] ?>">Read More</a>
            </div>
        </div>
        <?php
            }
        } else { ?>
        <h3>No Post Available on this Category!</h3>
        <?php
        }
        ?>

    </div>
    <?php include 'inc/sidebar.php'; ?>
</div>

<?php include 'inc/footer.php'; ?>