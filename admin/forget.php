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
    <title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
    <div class="container">
        <section id="content">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $fm->validation($_POST['email']);
                $email = mysqli_real_escape_string($db->link, $email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<span style='color:red;font-size:18px;'>Invalid Email Address !</span>";
                } else {


                    $mailquery = "Select * from user where email = '$email' limit 1";
                    $mailcheck = $db->select($mailquery);

                    if ($mailcheck != false) {
                        while ($value = $mailcheck->fetch_assoc()) {
                            $userid = $value['id'];
                            $username = $value['username'];
                        }
                        $text = substr($email, 0, 3);
                        $rand = rand(10000, 99999);
                        $newpass = "$text$rand";
                        $password = md5($newpass);

                        $query = "update user set
                              password= '$password' 
                              where id = '$userid' ";
                        $upquery = $db->update($query);

                        $to = "$email";
                        $from = "nishatmamun@gmail.com";
                        $header = "From: $from\n.";
                        $header = 'MIME-Version: 1.0.';
                        $header = 'Content-type: text/html; charset=iso-8859-1';
                        $subject = "Your Password";
                        $message = "Your Username is " . $username . " and Password is " . $newpass . " Please visit website to login.";

                        $sendmail = mail($to, $from, $message, $header);

                        if ($sendmail) {
                            echo "<span style='color:red;font-size:18px;'>Please Check Your Email for New Password!!!</span>";
                        } else {
                            echo "<span style='color:red;font-size:18px;'>Email Not Sent!!!</span>";
                        }
                    } else {
                        echo "<span style='color:red;font-size:18px;'>Email Not Exist!!!</span>";
                    }
                }
            }
            ?>
            <form action="" method="post">
                <h1>Password Recovery</h1>
                <div>
                    <input type="text" placeholder="Enter Valid Email..." required="" name="email" />
                </div>
                <div>
                    <input type="submit" value="Send Mail" />
                </div>
            </form><!-- form -->
            <div class="button">
                <a href="login.php">Login</a>
            </div>
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>