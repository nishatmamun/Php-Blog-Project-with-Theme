<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    header("Location: catlist.php");
} else {
    $catid = $_GET['catid'];
    $query = "select * from post where id = $catid";
    $category = $db->select($query);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category</h2>
        <div class="block copyblock">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);
                if (empty($name)) {
                    echo "<span class='error'> Field Must not be empty! </span>";
                } else {
                    $upquery = "update category set name = '$name' where id = '$catid'";
                    $updatecat = $db->update($upquery);
                    if ($updatecat) {
                        echo "<span class='success'> Category Updated Successfully ! </span>";
                    } else {
                        echo "<span class='error'> Category Interrupted to Update ! </span>";
                    }
                }
            }
            ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <?php
                        foreach ($category as $value) {
                        ?>
                        <td>
                            <input type="text" name="name" value="<?php echo $value['name'] ?>" class="medium" />
                        </td>
                        <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>