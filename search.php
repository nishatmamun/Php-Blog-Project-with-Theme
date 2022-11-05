<?php
include 'inc/header.php';
?>
<?php
if (!isset($_GET['search']) || $_GET['search'] == null) {
    header("Location: /blog ");
} else {
    $search = $_GET['search'];
}
?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <?php
        $query = "select * from post where title like '%$search%' or body like '%$search%'";
        $post = $db->select($query);
        if ($post) {
            foreach ($post as $value) {
        ?>
        <div class="samepost clear">
            <h2><a href="post.php?id=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a></h2>
            <h4><?php echo $fm->formateDate($value['date']) ?>, By <a href="#"><?php echo $value['author'] ?></a></h4>
            <a href="post.php?id=<?php echo $value['id'] ?>"><img src="admin/upload/<?php echo $value['image'] ?>"
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
        <p>Your search query not found!</p>
        <?php
        }
        ?>


    </div>
    <?php include 'inc/sidebar.php'; ?>
</div>

<?php include 'inc/footer.php'; ?>