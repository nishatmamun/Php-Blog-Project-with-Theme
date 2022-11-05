<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
$query = "select * from contact where status = '0'";
$msg = $db->select($query);
?>

<?php
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <?php
        if (isset($_GET['seenid'])) {
            $seenid = $_GET['seenid'];
            $seenmsg = "update contact set status = '1' where id = '$seenid'";
            $seenmsg = $db->update($seenmsg);
            if ($seenmsg) {
                echo "<span class='success'> Message Sent in the Seen Box ! </span>";
            } else {
                echo "<span class='error'> Message Didn't Send ! </span>";
            }
        }

        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    if ($msg) {

                        foreach ($msg as $value) {
                            $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ?></td>
                        <td><?php echo $value['firstname'] . " " . $value['lastname'] ?></td>
                        <td><?php echo $value['email'] ?></td>
                        <td><?php echo $fm->textShorten($value['body'], 30) ?></td>
                        <td><?php echo $fm->formateDate($value['date']) ?></td>
                        <td>
                            <a href="viewmsg.php?msgid=<?php echo $value['id'] ?>">View</a> ||
                            <a href="replymsg.php?msgid=<?php echo $value['id'] ?>">Reply</a> ||
                            <a onclick="return confirm('Are you sure to Move This Message?')"
                                href="?seenid=<?php echo $value['id'] ?>">Seen</a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="box round first grid">
        <h2>Seen Message</h2>
        <?php
        if (isset($delid)) {
            $query = "delete from contact where id = '$delid'";
            $delmsg = $db->delete($query);
            if ($delmsg) {
                echo "<span class='success'> Message Deleted Successfully ! </span>";
            } else {
                echo "<span class='error'> Message Deletion Interrupted ! </span>";
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $query = "select * from contact where status = '1'";
                    $seen = $db->select($query);
                    if ($seen) {

                        foreach ($seen as $value) {
                            $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ?></td>
                        <td><?php echo $value['firstname'] . " " . $value['lastname'] ?></td>
                        <td><?php echo $value['email'] ?></td>
                        <td><?php echo $fm->textShorten($value['body'], 30) ?></td>
                        <td><?php echo $fm->formateDate($value['date']) ?></td>
                        <td>
                            <a href="viewmsg.php?msgid=<?php echo $value['id'] ?>">View</a> ||
                            <a onclick="return confirm('Are you sure to Delete This Message?')"
                                href="?delid=<?php echo $value['id'] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>