<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
    echo "<script>window.location = 'userlist.php' </script>";
} else {
    $userid = $_GET['userid'];
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User Details</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<script>window.location = 'userlist.php' </script>";
        }
        ?>
        <div class="block">
            <?php
            $query = "select * from user where id='$userid'";
            $user = $db->select($query);
            if ($user) {
                foreach ($user as $value) {
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input readonly type="text" name="name" value="<?php echo $value['name'] ?>"
                                class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input readonly type="text" name="username" value="<?php echo $value['username'] ?>"
                                class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input readonly type="email" name="email" value="<?php echo $value['email'] ?>"
                                class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea readonly rows="15" cols="70" class="tinymce"
                                name="details"><?php echo $value['details'] ?></textarea>
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
            }
            ?>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>