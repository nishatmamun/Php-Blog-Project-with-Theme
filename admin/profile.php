<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Profile</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $username = mysqli_real_escape_string($db->link, $_POST['username']);
            $email = mysqli_real_escape_string($db->link, $_POST['email']);
            $details = mysqli_real_escape_string($db->link, $_POST['details']);

            if (
                $name == "" || $username == "" || $email == ""  || $details == ""

            ) {
                echo "<span class='error'>Any Field must not be empty! </span>";
            } else {
                $query = "update user set 
                name = '$name', 
                username = '$username', 
                email = '$email',
                details = '$details'
                where id = '$userid'";
                $update = $db->update($query);
                if ($update) {
                    echo "<span class='success'>Profile Updated Successfully!</span>";
                } else {
                    echo "<span class='error'>Profile Interrupted to Update!</span>";
                }
            }
        }
        ?>
        <div class="block">
            <?php
            $query = "select * from user where id='$userid' AND role ='$userRole'";
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
                            <input type="text" name="name" value="<?php echo $value['name'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" name="username" value="<?php echo $value['username'] ?>"
                                class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="email" name="email" value="<?php echo $value['email'] ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea rows="15" cols="70" class="tinymce"
                                name="details"><?php echo $value['details'] ?></textarea>
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