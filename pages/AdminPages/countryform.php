<?
include_once("functions.php");
$link = connect();
if (isset($_POST['addcountry'])) {
    $country = trim(htmlspecialchars($_POST['country']));
    if ($country == "") exit();
    $ins = 'insert into countries(country)
    values("' . $country . '")';
    mysqli_query($link, $ins);
    echo "<script>";
    echo "window.location=document.URL;";
    echo "</script>";
}
if (isset($_POST['delcountry'])) {
    foreach ($_POST as $k => $v) {
        if (substr($k, 0, 2) == "cb") {
            $idc = substr($k, 2);
            $del = 'DELETE FROM countries WHERE  Id=' . $idc;
            mysqli_query($link, $del);
        }
    }
    echo "<script>";
    echo "window.location=document.URL;";
    echo "</script>";
}
$sel = 'select * from countries';
$res = mysqli_query($link, $sel);
echo '<form action="index.php?page=4" method="post" class="input-group" id="formcountry">';
echo '<table class="table table-striped">';
while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
    echo '<tr>';
    echo '<td>' . $row[0] . '</td>';
    echo '<td>' . $row[1] . '</td>';
    echo '<td><input type="checkbox" name="cb' . $row[0] . '"></td>';
    echo '</tr>';
}
echo '</table>';
mysqli_free_result($res);
echo '<input type="text" name="country" placeholder="Country">';
echo '<input type="submit" name="addcountry" value="Add" class="btn btn-sm btn-info">';
echo '<input type="submit" name="delcountry" value="Delete" class="btn btn-sm btn-warning">';
echo '</form>';
