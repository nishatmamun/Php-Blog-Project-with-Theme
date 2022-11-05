<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Slider</h2>
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
                echo "<span class='error'> Field must not be empty! </span>";
            } elseif ($file_size > 1048567) {
                echo "<span class='error'>Image should be less than 1MB";
            } elseif (in_array($file_ext, $permited) == false) {
                echo "<span class='error'>You can upload only: " . implode(', ', $permitted) . "</span>";
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "insert into slider(title, image) values('$title', '$uploaded_image')";
                $insert = $db->insert($query);
                if ($insert) {
                    echo "<span class='success'>Slider Inserted Successfully!</span>";
                } else {
                    echo "<span class='error'>Slider Interrupted to Insert!</span>";
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
                            <label>Upload Image</label>
                        </td>
                        <td>
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
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>