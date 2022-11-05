<?php
include '../lib/db.php';
include '../lib/session.php';
include '../helpers/format.php';
include '../config/config.php';
$db = new DB();
$fm = new format();
session::checkLogin();
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
    <div class="container">
        <section id="content">
            <?php
            if (session::get('login') == false) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = $fm->validation($_POST['username']);
                    $password = $fm->validation(md5($_POST['password']));

                    $username = mysqli_real_escape_string($db->link, $username);
                    $password = mysqli_real_escape_string($db->link, $password);

                    $query = "select * from user where username = '$username' AND password = '$password' ";
                    $result = $db->select($query);
                    if ($result != false) {
                        $value = $result->fetch_assoc();
                        session::set("login", true);
                        session::set("username", $value['username']);
                        session::set("userId", $value['id']);
                        session::set("userRole", $value['role']);
                        header("Location: index.php");
                    } else {
                        echo "<span style='color:red;font-size:18px;'>Username or Password Did Not Match!!!</span>";
                    }
                }
            }
            ?>
            <form action="login.php" method="post">
                <h1>Admin Login</h1>
                <div>
                    <input type="text" placeholder="Username" required="" name="username" />
                </div>
                <div>
                    <input type="password" placeholder="Password" required="" name="password" />
                </div>
                <div>
                    <input type="submit" value="Log in" />
                </div>
            </form><!-- form -->
            <div class="button">
                <a href="forget.php">Forgot Password?</a>
            </div>
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>