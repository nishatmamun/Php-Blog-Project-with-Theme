<?php include 'inc/header.php'; ?>

<?php
$pageid = mysqli_real_escape_string($db->link, $_GET['pageid']);
if (!isset($pageid) || $pageid == NULL) {          //GET PAGE ID
    header("Location: 404.php");
} else {
    $pageid = $pageid;
    $query = "select * from page where id = $pageid";
    $page = $db->select($query);
}
?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <?php                                                     //Fetch_value
            if ($page) {
                while ($result = $page->fetch_assoc()) {
            ?>
            <h2><?php echo $result['name'] ?></h2>

            <?php echo $result['body'] ?>
        </div>
        <?php
                }
            } else {
                header("Location: 404.php");
            }
?>

    </div>
    <?php include 'inc/sidebar.php'; ?>
</div>
<?php include 'inc/footer.php'; ?>