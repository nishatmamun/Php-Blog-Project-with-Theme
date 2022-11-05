<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
if (!isset($_GET['slideid']) || $_GET['slideid'] == NULL) {
    header("Location: sliderlist.php");
} else {
    $slideid = $_GET['slideid'];
    $query = "select * from slider where id = $slideid";
    $slider = $db->select($query);
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Slider</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);

            $permited  = array('jpg', 'jpeg', 'png');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/slider/" . $unique_image;

            if (
                $title == ""

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
            $query = "update slider set 
                title = '$title'" .
                (!empty($final) ? ",image = '$uploaded_image'" : '') .
                "where id = '$slideid'";
            $update = $db->update($query);
            if ($update) {
                echo "<span class='success'>Slider Updated Successfully!</span>";
            } else {
                echo "<span class='error'>Slider Interrupted to Update!</span>";
            }
        }
        ?>
        <div class="block">
            <?php
            foreach ($slider as $pvalue) {
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
                        <td style="vertical-align: middle;">
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $pvalue['image'] ?>" height="100px" width="200px" /><br />
                            <input type="file" name="image" />
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