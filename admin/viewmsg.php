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
    echo "<script>window.location = 'inbox.php';</script>";
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>View Message</h2>

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
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $value['email'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Date</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $fm->formateDate($value['date']) ?>"
                                class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Message</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $value['body'] ?>" class="medium" />
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Ok" />
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