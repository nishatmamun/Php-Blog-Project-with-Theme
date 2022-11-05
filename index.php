<?php
include 'inc/header.php';
include 'inc/slider.php';
?>

<!-- Pagination -->
<?php
$per_page = 3;
if (isset($_GET["page"])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $per_page;
?>
<!-- Pagination -->

<?php
$db = new DB();
$fm = new format();
$sql = "select * from post limit $start_from, $per_page";
$post = $db->select($sql);
?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">

        <?php
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
        <?php } ?>

        <!-- Pagination -->
        <?php
            $sql = "select * from post";
            $post = $db->select($sql);
            $total_rows = mysqli_num_rows($post);
            $total_page = ceil($total_rows / $per_page);
            echo "<span class='pagination'><a href='index.php?page=1'>" . 'First Page' . "</a>";
            for ($i = 1; $i <= $total_page; $i++) {
                echo "<a href='index.php?page=" . $i . "'>" . $i . "</a>";
            }
            echo "<a href='index.php?page=$total_page'>" . 'Last Page' . "</a></span>" ?>
        <!-- Pagination -->

        <?php
        } else {
            header("Location:404.php");
        }
        ?>


    </div>
    <?php include 'inc/sidebar.php'; ?>
</div>

<?php include 'inc/footer.php'; ?>