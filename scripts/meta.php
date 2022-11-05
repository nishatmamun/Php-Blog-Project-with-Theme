<?php
if (isset($_GET['pageid'])) {
    $pageid = $_GET['pageid'];
    $query = "select * from page where id = '$pageid'";
    $pages = $db->select($query);
    if ($pages) {
        while ($value = $pages->fetch_assoc()) {
?>
<title><?php echo $value['name'] . " - " . TITLE ?></title>
<?php
        }
    }
} else {
    ?>
<title><?php echo $fm->title() . " - " . TITLE ?></title>
<?php

} ?>
<meta name="language" content="English">
<meta name="description" content="It is a website about education">
<?php
if (isset($_GET['id'])) {
    $keyid = $_GET['id'];
    $query = "select * from post where id = '$keyid'";
    $keyword = $db->select($query);
    if ($keyword) {
        while ($result = $keyword->fetch_assoc()) { ?>
<meta name="keywords" content="<?php echo $result['tags'] ?>">

<?php  }
    }
} else { ?>
<meta name="keywords" content="<?php echo KEYWORDS ?>">
<?php    }

?>

<meta name="author" content="Nishat">