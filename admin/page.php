<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<?php
if (isset($_GET['action']) == "delete") {          //Deletion
    $pageid = $_GET['delid'];
    $query = "delete from page where id = '$pageid'";
    $delete = $db->delete($query);
    if ($delete) {
        echo "<script>alert('Page Deleted Successfully ! ')</script>";
        echo "<script>window.location = 'index.php';</script>";
    } else {
        echo "<span class='error'> Page Interrupted to Delete ! </span>";
    }
}
?>

<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {          //GET PAGE ID
    header("Location: index.php");
} else {
    $pageid = $_GET['pageid'];
    $query = "select * from page where id = $pageid";
    $page = $db->select($query);
}
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Edit Page</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {                 //Update Page
            $name = $_POST['name'];
            $body = $_POST['body'];
            $name = mysqli_real_escape_string($db->link, $name);
            $body = mysqli_real_escape_string($db->link, $body);
            if (empty($name) || empty($body)) {
                echo "<span class='error'>Any Field Must not be empty! </span>";
            } else {
                $query = "update page set name = '$name', body = '$body' where id = '$pageid'";
                $uppage = $db->update($query);
                if ($uppage) {
                    echo "<span class='success'> Page Updated Successfully ! </span>";
                } else {
                    echo "<span class='error'> Page Interrupted to Update ! </span>";
                }
            }
        }
        ?>
        <div class="block">
            <?php                                                     //Fetch_value
            if ($page) {
                while ($result = $page->fetch_assoc()) {
            ?>
            <form action="" method="POST">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $result['name'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea rows="15" cols="70" class="tinymce"
                                name="body"><?php echo $result['body'] ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                            <a class="submit" onclick="return confirm('Are you sure to Delete this Page?')"
                                href="?action=delete&delid=<?php echo $result['id'] ?>">Delete</a>
                        </td>
                    </tr>
                </table>
            </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>