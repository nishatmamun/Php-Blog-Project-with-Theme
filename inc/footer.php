<div class="footersection templete clear">
    <div class="footermenu clear">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Privacy</a></li>
        </ul>
    </div>
    <?php
    $query = "select * from footer where id = '1'";
    $result = $db->select($query);
    if ($result) {
        while ($value = $result->fetch_assoc()) {
    ?>
    <p>&copy; <?php echo $value['note'] ?></p>
    <?php
        }
    }
    ?>
</div>
<?php
$query = "select * from social_media where id = '1'";
$result = $db->select($query);
if ($result) {
    while ($value = $result->fetch_assoc()) {
?>
<div class="fixedicon clear">
    <a href="<?php echo $value['fb'] ?>" target="_blank"> <img src="images/fb.png" alt="Facebook" /></a>
    <a href="<?php echo $value['tw'] ?>" target="_blank"> <img src="images/tw.png" alt="Twitter" /></a>
    <a href="<?php echo $value['ln'] ?>" target="_blank"> <img src="images/in.png" alt="LinkedIn" /></a>
    <a href="<?php echo $value['gp'] ?>" target="_blank"> <img src="images/gl.png" alt="GooglePlus" /></a>
</div>
<?php
    }
}
?>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>

</html>