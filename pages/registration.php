<?
function register($name, $pass, $email)
{
    $name = trim(htmlspecialchars($name));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));
    if ($name == "" || $pass == "" || $email == "") {
        echo "<h3/><span style='color:red;'>Fill All Required Fields!</span><h3/>";
        return false;
    }
    if (strlen($name) < 3 || strlen($name) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
        echo "<h3/><span style='color:red;'>Values Length Must Be Between 3 And 30! </span><h3/>";
        return false;
    }
    $ins = 'insert into users (login,pass,email,roleid)
    values("' . $name . '","' . md5($pass) . '","' . $email . '",2)';
    $link = connect();
    mysqli_query($link, $ins);
    $err = mysqli_errno($link);
    if ($err) {
        if ($err == 1062)
            echo "<h3/><span style='color:red;'> This Login Is Already Taken! </span><h3/>";
        else
            echo "<h3/><span style='color:red;'> Error code:" . $err . "!</span><h3/>";
        return false;
    }
    return true;
}