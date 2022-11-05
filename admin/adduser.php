<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
if (!$userRole == 0) {
    echo "<script>window.location = 'index.php';</script>";
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $fm->validation($_POST['username']);
                $password = $fm->validation(md5($_POST['password']));
                $role = $fm->validation($_POST['role']);
                $email = $fm->validation($_POST['email']);

                $username = mysqli_real_escape_string($db->link, $username);
                $password = mysqli_real_escape_string($db->link, $password);
                $role = mysqli_real_escape_string($db->link, $role);
                $email = mysqli_real_escape_string($db->link, $email);
                if (empty($username) || empty($password) || empty($role) || empty($email)) {
                    echo "<span class='error'> Field Must not be empty! </span>";
                } else {
                    $mailquery = "Select * from user where email = '$email' limit 1";
                    $mailcheck = $db->select($mailquery);
                    if ($mailcheck != false) {
                        echo "<span class='error'>Email Already Exist !</span>";
                    } else {
                        $query = "insert into user(username, password, email, role) values('$username','$password','$email','$role')";
                        $insertuser = $db->insert($query);
                        if ($insertuser) {
                            echo "<span class='success'> User Added Successfully ! </span>";
                        } else {
                            echo "<span class='error'> User Not Created ! </span>";
                        }
                    }
                }
            }
            ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Password</label>
                        </td>
                        <td>
                            <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="email" name="email" placeholder="Enter Valid Email..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>User Role</label>
                        </td>
                        <td>
                            <select name="role" id="select">
                                <option>Select User Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <br>
                            <input type="submit" name="submit" Value="Create" />
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