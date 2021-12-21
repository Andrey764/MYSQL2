<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hotel Info</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/info.css">
</head>

<body>
    <?php
    include_once("functions.php");
    if (isset($_GET['hotel'])) {
        $hotel = $_GET['hotel'];
        $link = connect();
        $sel = 'select * f rom hotels where id=' . $hotel;
        $res = mysqli_query($link, $sel);
        $row = mysqli_fetch_array($res, MYSQLI_NUM);
        $hname = $row[1];
        $hstars = $row[4];
        $hcost = $row[5];
        $hinfo = $row[6];
        mysqli_free_result($res);
        echo '<h2 class="text-uppercase textcenter">' . $hname . '</h2>';
        echo '<div class="row"><div class="colmd-6 textcenter">';
        $link2 = connect();
        $sel = 'select imagepath from images where ho telid=' . $hotel;
        $res = mysqli_query($link2, $sel);
        echo '<span class="label label-info">Watch our pictures</span>';
        echo '<ul id="gallery">';
        $i = 0;
        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo ' <li><img src="../' . $row[0] . '"></li>';
        }
        mysqli_free_result($res);
        echo ' </ul>';
    }
    ?>