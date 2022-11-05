<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
if (!isset($_GET['delpost']) || $_GET['delpost'] == NULL) {
} else {
    $postid = $_GET['delpost'];
    $query = "select * from post where id = $postid";
    $delpost = $db->select($query);
    if ($delpost) {
        while ($delimg = $delpost->fetch_assoc()) {
            $dellink = $delimg['image'];
            unlink($dellink);
        }
    }

    $delquery = "delete from post where id = '$postid'";
    $deldata = $db->delete($delquery);
    if ($deldata) {
        echo "<script>alert('Data Deleted Successfully.');</script>";
        echo "<script>window.location = 'postlist.php';</script>";
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Post Title</th>
                        <th width="30%">Description</th>
                        <th width="10%">Category</th>
                        <th width="10%">Image</th>
                        <th width="10%">Author</th>
                        <th width="5%">Tags</th>
                        <th width="10%">Date</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "select post.*, category.name from post inner join category on post.cat = category.id order by post.title ASC";
                    $post = $db->select($query);
                    $i = 0;
                    if ($post) {
                        foreach ($post as $value) {
                            $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['title'] ?></td>
                        <td><?php echo $fm->textShorten($value['body'], 150) ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td class="images"><img src="<?php echo $value['image'] ?>" height="40px" width="60px">
                        </td>
                        <td><?php echo $value['author'] ?></td>
                        <td><?php echo $value['tags'] ?></td>
                        <td><?php echo $fm->formateDate($value['date']) ?></td>
                        <td>
                            <a href="viewpost.php?viewid=<?php echo $value['id'] ?>">View</a>
                            <?php
                                    if (Session::get('userId') == $value['userid'] || $userRole == 0) { ?>
                            || <a href="editpost.php?editid=<?php echo $value['id'] ?>">Edit</a> ||
                            <a onclick="return confirm('ARE YOU SURE?')"
                                href="?delpost=<?php echo $value['id'] ?>">Delete</a>
                            <?php } ?>
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