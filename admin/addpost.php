<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
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
                $title == "" || $cat == "" || $cat == "Select Category" || $body == "" || $tags == "" || $author == "" ||
                $file_name == ""
            ) {
                echo "<span class='error'> Field must not be empty! </span>";
            } elseif ($file_size > 1048567) {
                echo "<span class='error'>Image should not be less than 1MB";
            } elseif (in_array($file_ext, $permited) == false) {
                echo "<span class='error'>You can upload only: " . implode(', ', $permitted) . "</span>";
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "insert into post(cat, title, body, image, author, tags, userid) values('$cat', '$title', '$body',  '$uploaded_image', '$author', '$tags', '$userId')";
                $insert = $db->insert($query);
                if ($insert) {
                    echo "<span class='success'>Data Inserted Successfully!</span>";
                } else {
                    echo "<span class='error'>Data Interrupted to Insert!</span>";
                }
            }
        }
        ?>
        <div class="block">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
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
                                <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" placeholder="Enter Tags..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" readonly name="author" value="<?php echo Session::get("username") ?>"
                                class="medium" />
                            <input type="hidden" readonly name="userId" value="<?php echo Session::get("userId") ?>"
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
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>