<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
if (!isset($_GET['editid']) || $_GET['editid'] == NULL) {
    header("Location: postlist.php");
} else {
    $postid = $_GET['editid'];
    $query = "select * from post where id = $postid";
    $post = $db->select($query);
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
            $author = mysqli_real_escape_string($db->link, $_POST['author']);
            $userId = mysqli_real_escape_string($db->link, $_POST['userId']);

            $permited  = array('jpg', 'jpeg', 'png');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/" . $unique_image;

            if (
                $title == "" || $cat == ""
                || $cat == "Select Category"  || $body == "" || $tags == "" || $author == ""

            ) {
                echo "<span class='error'>Any Field must not be empty! </span>";
            }
            if (!empty($file_temp)) {
                if ($file_size > 1048567) {
                    echo "<span class='error'>Image should be less than 1MB";
                } elseif (in_array($file_ext, $permited) == false) {
                    echo "<span class='error'>You can upload only: " . implode(', ', $permited) . "</span>";
                } else {
                    $final = move_uploaded_file($file_temp, $uploaded_image);
                }
            }
            $query = "update post set 
                cat = '$cat', 
                title = '$title', 
                body = '$body'," .
                (!empty($final) ? "image = '$uploaded_image'," : '')
                . "author = '$author',
                tags = '$tags',
                userid = '$userId'
                where id = '$postid'";
            $update = $db->update($query);
            if ($update) {
                echo "<span class='success'>Data Updated Successfully!</span>";
            } else {
                echo "<span class='error'>Data Interrupted to Update!</span>";
            }
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
                            <input type="text" name="title" value="<?php echo $pvalue['title'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="cat">
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
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $pvalue['image'] ?>" height="100px" width="200px" /><br />
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea rows="10" cols="50" name="body"><?php echo $pvalue['body'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" value="<?php echo $pvalue['tags'] ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo $pvalue['author'] ?>" class="medium" />
                            <input type="hidden" name="author" value="<?php echo Session::get("userId") ?>"
                                class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
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