<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
if (!isset($_GET['viewid']) || $_GET['viewid'] == NULL) {
    header("Location: postlist.php");
} else {
    $postid = $_GET['viewid'];
    $query = "select * from post where id = $postid";
    $post = $db->select($query);
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script>window.location = 'postlist.php';</script>";
        }
        ?>
        <div class="block">
            <?php
            foreach ($post as $pvalue) {
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input readonly type="text" name="title" value="<?php echo $pvalue['title'] ?>"
                                class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select readonly id="select" name="cat">
                                <option>Select Category</option>
                                <?php
                                    $query = "select * from category";
                                    $category = $db->select($query);
                                    if ($category) {
                                        foreach ($category as $value) {
                                    ?>
                                <option <?php
                                                    if ($pvalue['cat'] == $value['id']) { ?> selected="selected"
                                    <?php } ?> value="<?php echo $value['id'] ?>">
                                    <?php echo $value['name'] ?>
                                </option>
                                <?php
                                        }
                                    }
                                    ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: middle;">
                            <label>Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $pvalue['image'] ?>" height="100px" width="200px" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea readonly rows="10" cols="50" name="body"><?php echo $pvalue['body'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input readonly type="text" name="tags" value="<?php echo $pvalue['tags'] ?>"
                                class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input readonly type="text" name="author" value="<?php echo $pvalue['author'] ?>"
                                class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Back" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>