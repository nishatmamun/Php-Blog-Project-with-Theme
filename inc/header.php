<?php
include 'lib/db.php';
include 'helpers/format.php';
include 'config/config.php';
$db = new DB();
$fm = new format();
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    include "scripts/meta.php";
    include "scripts/css.php";
    include "scripts/js.php";
    ?>
</head>

<body>
    <div class="headersection templete clear">
        <a href="index.php">
            <div class="logo">
                <?php
                $query = "select * from title_slogan where id = '1'";
                $titleslogan = $db->select($query);
                if ($titleslogan) {
                    while ($value = $titleslogan->fetch_assoc()) {
                ?>
                <img src="admin/<?php echo $value['logo'] ?>" alt="Logo" />
                <h2><?php echo $value['title'] ?></h2>
                <p><?php echo $value['slogan'] ?></p>
                <?php
                    }
                }
                ?>
            </div>
        </a>
        <div class="social clear">
            <?php
            $query = "select * from social_media where id = '1'";
            $result = $db->select($query);
            if ($result) {
                while ($value = $result->fetch_assoc()) {
            ?>
            <div class="icon clear">
                <a href="<?php echo $value['fb'] ?>" target="_blank"> <i class="fa fa-facebook"></i></a>
                <a href="<?php echo $value['tw'] ?>" target="_blank"> <i class="fa fa-twitter"></i></a>
                <a href="<?php echo $value['ln'] ?>" target="_blank"> <i class="fa fa-linkedin"></i></a>
                <a href="<?php echo $value['gp'] ?>" target="_blank"> <i class="fa fa-google-plus"></i></a>
            </div>
            <?php
                }
            }
            ?>
            <div class="searchbtn clear">
                <form action="search.php" method="get">
                    <input type="text" name="search" placeholder="Search keyword..." />
                    <input type="submit" name="submit" value="Search" />
                </form>
            </div>
        </div>
    </div>
    <div class="navsection templete">
        <ul>
            <li><a <?php
                    if ($fm->title() == 'Home') {
                        echo 'id="active"';
                    }
                    ?> href="index.php">Home</a></li>
            <?php
            $query = "select * from page";
            $pages = $db->select($query);
            if ($pages) {
                while ($result = $pages->fetch_assoc()) {
            ?>
            <li><a <?php
                            if (isset($_GET['pageid']) && $_GET['pageid'] == $result['id']) {
                                echo 'id="active"';
                            }
                            ?> href="page.php?pageid=<?php echo $result['id'] ?>"><?php echo $result['name'] ?></a>
            </li>
            <?php
                }
            }
            ?>
            <li><a <?php
                    if ($fm->title() == 'Contact') {
                        echo 'id="active"';
                    }
                    ?> href="contact.php">Contact</a></li>
        </ul>
    </div>