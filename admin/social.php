<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fb = $fm->validation($_POST['fb']);
    $tw = $fm->validation($_POST['tw']);
    $ln = $fm->validation($_POST['ln']);
    $gp = $fm->validation($_POST['gp']);
    $fb = mysqli_real_escape_string($db->link, $fb);
    $tw = mysqli_real_escape_string($db->link, $tw);
    $ln = mysqli_real_escape_string($db->link, $ln);
    $gp = mysqli_real_escape_string($db->link, $gp);

    if (
        $fb == "" || $tw == "" || $ln == "" || $gp == ""
    ) {
        echo "<span class='error'>Any Field must not be empty! </span>";
    } else {
        $query = "update social_media set 
                fb = '$fb', 
                tw = '$tw',
                ln = '$ln',
                gp = '$gp'
                where id = '1'";
        $update = $db->update($query);
        if ($update) {
            echo "<span class='success'>Data Updated Successfully!</span>";
        } else {
            echo "<span class='error'>Data Interrupted to Update!</span>";
        }
    }
}

?>
<div class="grid_10">
    <?php
    $query = "select * from social_media where id = '1'";
    $result = $db->select($query);
    if ($result) {
        while ($value = $result->fetch_assoc()) {
    ?>
    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label>Facebook</label>
                        </td>
                        <td>
                            <input type="text" name="fb" value="<?php echo $value['fb'] ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Twitter</label>
                        </td>
                        <td>
                            <input type="text" name="tw" value="<?php echo $value['tw'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>LinkedIn</label>
                        </td>
                        <td>
                            <input type="text" name="ln" value="<?php echo $value['ln'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Google Plus</label>
                        </td>
                        <td>
                            <input type="text" name="gp" value="<?php echo $value['gp'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php }
    } ?>
</div>

<?php
include 'inc/footer.php';
?>