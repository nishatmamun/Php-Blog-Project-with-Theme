<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <?php
        if (isset($_GET['deluser'])) {
            $id = $_GET['deluser'];
            $query = "delete from user where id = '$id'";
            $deluser = $db->delete($query);
            if ($deluser) {
                echo "<span class='success'> User Deleted Successfully ! </span>";
            } else {
                echo "<span class='error'> User Deletion Interrupted ! </span>";
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "select * from user";
                    $user = $db->select($query);
                    if ($user) {
                        $i = 0;
                        foreach ($user as $value) {
                            $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['username']; ?></td>
                        <td><?php echo $value['email']; ?></td>
                        <td><?php echo $fm->textShorten($value['details']); ?></td>
                        <td><?php
                                    if ($value['role'] == 0) {
                                        echo "Admin";
                                    } elseif ($value['role'] == 1) {
                                        echo "Author";
                                    } else {
                                        echo "Editor";
                                    }
                                    ?></td>
                        <td><a href="viewuser.php?userid=<?php echo $value['id'] ?>">View</a>
                            <?php
                                    if ($userRole == 0) { ?>
                            || <a onclick="return confirm('ARE YOU SURE?')"
                                href="?deluser=<?php echo $value['id'] ?>">Delete</a>
                            <?php
                                    }
                                    ?>

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