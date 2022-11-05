<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
if (!isset($_GET['delslide']) || $_GET['delslide'] == NULL) {
} else {
    $sliderid = $_GET['delslide'];
    $query = "select * from slider where id = $sliderid";
    $delslide = $db->select($query);
    if ($delslide) {
        while ($delimg = $delslide->fetch_assoc()) {
            $dellink = $delimg['image'];
            unlink($dellink);
        }
    }

    $delquery = "delete from slider where id = '$sliderid'";
    $deldata = $db->delete($delquery);
    if ($deldata) {
        echo "<script>alert('Slider Deleted Successfully.');</script>";
        echo "<script>window.location = 'sliderlist.php';</script>";
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "select * from slider";
                    $slider = $db->select($query);
                    $i = 0;
                    if ($slider) {
                        foreach ($slider as $value) {
                            $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['title'] ?></td>
                        <td class="images"><img src="<?php echo $value['image'] ?>" height="40px" width="60px">
                        </td>
                        <td>
                            <a href="editslider.php?slideid=<?php echo $value['id'] ?>">Edit</a> ||
                            <a onclick="return confirm('ARE YOU SURE?')"
                                href="?delslide=<?php echo $value['id'] ?>">Delete</a>
                            <?php } ?>
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