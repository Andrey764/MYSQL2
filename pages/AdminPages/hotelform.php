<?

//SELECT ho.id, ho.hotel, co.country, ci.city, ho.stars, ho.cost, ho.info from hotels ho, countries co, cities ci 
//WHERE ho.countryid = co.id AND ho.cityid = ci.id

include_once("functions.phP");
$link = connect();
echo '<form action="index.php?page=4" method="post" class="input-group" id="formcity">';
$sel = 'SELECT ho.id, ho.hotel, co.country, ci.city, ho.stars, ho.cost from 
hotels ho, countries co, cities ci WHERE ho.countryid = co.id AND ho.cityid = ci.id';
$res = mysqli_query($link, $sel);
echo '<table class="table table-striped">';
while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
    echo '<tr>';
    echo '<td>' . $row[0] . '</td>';
    echo '<td>' . $row[1] . '</td>';
    echo '<td>' . $row[2] . '</td>';
    echo '<td>' . $row[3] . '</td>';
    echo '<td>' . $row[4] . '*</td>';
    echo '<td>' . $row[5] . '$</td>';
    echo '<td><input type="checkbox" name="ho' . $row[0] . '"></td>';
    echo '</tr>';
}
echo '</table>';
mysqli_free_result($res);


$res = mysqli_query($link, 'SELECT co.id, co.country FROM hotels ho, countries co WHERE ho.countryid = co.id');
echo '<select name="countryname" class="formcontrol">';
while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
    echo '<option value="' . $row[0] . '">' .
        $row[1] . '</option>';
}
echo '</select>';

$res = mysqli_query($link, 'SELECT ci.id, ci.city FROM hotels ho, cities ci WHERE ho.cityid = ci.id');
echo '<select name="cityname" class="formcontrol">';
while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
    echo '<option value="' . $row[0] . '">' .
        $row[1] . '</option>';
}
echo '</select>';
echo '<input type="nuber" name="star" placeholder="stars">';
echo '<input type="nuber" name="cost" placeholder="price">';
echo '<input type="text" name="hotel" placeholder="Hotel">';
echo '<input type="text" name="info" placeholder="Enter description">';
echo '<input type="submit" name="addhotel" value="Add" class="btn btn-sm btn-info">';
echo '<input type="submit" name="delhotel" value="Delete" class="btn btn-sm btn-warning">';
echo '</form>';
if (isset($_POST['addhotel'])) {
    $hotel = trim(htmlspecialchars($_POST['hotel']));
    if ($hotel == "") exit();
    $star = $_POST['star'];
    if ($star == "") exit();
    $cost = $_POST['cost'];
    if ($cost == "") exit();
    $info = $_POST['info'];
    if ($info == "") exit();
    $countryid = $_POST['countryname'];
    $cityid = $_POST['cityname'];
    $ins = "INSERT INTO  hotels(`hotel`, `countryid`, `cityid`,`stars`,`cost`,`info`) VALUES ('$hotel',$countryid,$cityid,$star,$cost,'$info')";
    mysqli_query($link, $ins);
    $err = mysqli_errno($link);
    if ($err) {
        echo 'Error code:' . $err . '<br>';
        exit();
    }
    echo "<script>";
    echo "window.location=document.URL;";
    echo "</script>";
}
if (isset($_POST['delhotel'])) {
    foreach ($_POST as $k => $v) {
        if (substr($k, 0, 2) == "ho") {
            $idc = substr($k, 2);
            echo $idc;
            $del = 'DELETE FROM hotels WHERE Id=' . $idc;
            mysqli_query($link, $del);
        }
    }
    echo "<script>";
    echo "window.location=document.URL;";
    echo "</script>";
}
