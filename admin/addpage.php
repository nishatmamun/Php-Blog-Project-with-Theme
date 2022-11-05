<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Page</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);

            if ($name == "" || $body == "") {
                echo "<span class='error'> Field must not be empty! </span>";
            } else {
                $query = "insert into page(name, body) values('$name', '$body')";
                $insert = $db->insert($query);
                if ($insert) {
                    echo "<span class='success'>Page Created Successfully!</span>";
                } else {
                    echo "<span class='error'>Page Interrupted to Create!</span>";
                }
            }
        }
        ?>
        <div class="block">
            <form action="" method="POST">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea rows="15" cols="70" class="tinymce" name="body"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Create" />
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