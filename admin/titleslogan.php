<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $fm->validation($_POST['title']);
    $slogan = $fm->validation($_POST['slogan']);
    $title = mysqli_real_escape_string($db->link, $title);
    $slogan = mysqli_real_escape_string($db->link, $slogan);

    $permited  = array('png');
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp = $_FILES['logo']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "upload/" . $unique_image;

    if (
        $title == "" || $slogan == ""
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
            $query = "update title_slogan set 
                title = '$title', 
                slogan = '$slogan' " .
                (!empty($final) ? ",logo = '$uploaded_image'" : '');
            "where id = '1'";
            $update = $db->update($query);
            if ($update) {
                echo "<span class='success'>Data Updated Successfully!</span>";
            } else {
                echo "<span class='error'>Data Interrupted to Update!</span>";
            }
        }
    }
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <?php
        $query = "select * from title_slogan where id = '1'";
        $blog_title = $db->select($query);
        if ($blog_title) {
            while ($result = $blog_title->fetch_assoc()) {
        ?>
        <div class="block sloginblock">
            <form method="POST" action="" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Website Title</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['title'] ?>" name="title" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Website Slogan</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['slogan'] ?>" name="slogan" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Logo</label>
                        </td>
                        <td>
                            <input type="file" name="logo" /><br>
                            <img width="150px" height="100px" src="<?php echo $result['logo'] ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>
<?php
include 'inc/footer.php';
?>