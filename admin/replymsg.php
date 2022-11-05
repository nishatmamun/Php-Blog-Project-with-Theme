<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
    header("Location: inbox.php");
} else {
    $msgid = $_GET['msgid'];
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $to = $fm->validation($_POST['toEmail']);
    $from = $fm->validation($_POST['fromEmail']);
    $subject = $fm->validation($_POST['subject']);
    $message = $fm->validation($_POST['message']);
    $sendmail = mail($to, $subject, $message);
    if ($sendmail) {
        echo "<span class='success'>Message Sent Successfully!</span>";
    } else {
        echo "<span class='error'>Message Didn't Send!</span>";
    }
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Reply Message</h2>

        <div class="block">
            <form action="" method="POST">
                <table class="form">
                    <?php
                    $query = "select * from contact where id = '$msgid'";
                    $msg = $db->select($query);
                    if ($msg) {
                        while ($value = $msg->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" readonly
                                value="<?php echo $value['firstname'] . " " . $value['lastname'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>To</label>
                        </td>
                        <td>
                            <input type="text" readonly name="toEmail" value="<?php echo $value['email'] ?>"
                                class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input type="text" name="fromEmail" placeholder="Please Enter Your Email Address..."
                                class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input type="text" name="subject" placeholder="Please Enter Your Subject..."
                                class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea name="message" id="" cols="70" rows="15"></textarea>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Send" />
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