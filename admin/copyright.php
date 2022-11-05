<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $footer = $fm->validation($_POST['note']);
    $footer = mysqli_real_escape_string($db->link, $footer);

    if ($footer == "") {
        echo "<span class='error'>Field must not be empty! </span>";
    } else {
        $query = "update footer set 
                note = '$footer'
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

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock">
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <?php
                        $query = "select * from footer where id = '1'";
                        $result = $db->select($query);
                        if ($result) {
                            while ($value = $result->fetch_assoc()) {
                        ?>
                        <td>
                            <input type="text" value="<?php echo $value['note'] ?>" name="note" class="large" />
                        </td>
                        <?php
                            }
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