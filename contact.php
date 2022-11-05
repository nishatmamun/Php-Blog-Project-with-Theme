<?php include 'inc/header.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $fm->validation($_POST['firstname']);
    $lastname = $fm->validation($_POST['lastname']);
    $email = $fm->validation($_POST['email']);
    $body = $fm->validation($_POST['body']);

    $firstname = mysqli_real_escape_string($db->link, $firstname);
    $lastname = mysqli_real_escape_string($db->link, $lastname);
    $email = mysqli_real_escape_string($db->link, $email);
    $body = mysqli_real_escape_string($db->link, $body);

    $error = "";
    if (empty($firstname) || empty($lastname) || empty($email) || empty($body)) {
        $error = "Any Field Must not be Empty!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid Email Address !";
    } else {
        $query = "insert into contact(firstname, lastname, email, body) values('$firstname', '$lastname', '$email', '$body')";
        $insert = $db->insert($query);
        if ($insert) {
            $msg = "<span style='color:green;'>Message Sent Successfully !</span>";
        } else {
            $msg = "<span style='color:red;'>Message Interrupted to Sent!</span>";
        }
    }
}
?>
<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <h2>Contact us</h2>
            <?php
            if (isset($error)) {
                echo "<span style='color:red;'>$error</span>";
            }

            if (isset($msg)) {
                echo "<span style='color:green;'>$msg</span>";
            }
            ?>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>Your First Name:</td>
                        <td>
                            <input type="text" name="firstname" placeholder="Enter first name" />
                        </td>
                    </tr>
                    <tr>
                        <td>Your Last Name:</td>
                        <td>
                            <input type="text" name="lastname" placeholder="Enter Last name" />
                        </td>
                    </tr>

                    <tr>
                        <td>Your Email Address:</td>
                        <td>
                            <input type="email" name="email" placeholder="Enter Email Address" />
                        </td>
                    </tr>
                    <tr>
                        <td>Your Message:</td>
                        <td>
                            <textarea name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="Send" />
                        </td>
                    </tr>
                </table>
                <form>
        </div>

    </div>
    <?php include 'inc/sidebar.php'; ?>
</div>
<?php include 'inc/footer.php'; ?>