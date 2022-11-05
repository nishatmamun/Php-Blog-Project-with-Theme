<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php
        if (isset($_GET['delcat'])) {
            $id = $_GET['delcat'];
            $query = "delete from category where id = '$id'";
            $delcat = $db->delete($query);
            if ($delcat) {
                echo "<span class='success'> Category Deleted Successfully ! </span>";
            } else {
                echo "<span class='error'> Category Deletion Interrupted ! </span>";
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "select * from category";
                    $cat = $db->select($query);
                    $i = 0;
                    foreach ($cat as $value) {
                        $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><a href="editcat.php?catid=<?php echo $value['id'] ?>">Edit</a> ||
                            <a onclick="return confirm('ARE YOU SURE?')"
                                href="?delcat=<?php echo $value['id'] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php
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