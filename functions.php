<?
function connect($host = 'localhost', $user = 'root', $pass = '', $dbname = 'travels')
{
    $link = mysqli_connect($host, $user, $pass) or die('connection error');
    mysqli_select_db($link, $dbname) or die('DB open error');
    return $link;
}

function show_error($err, $message)
{
    if ($err) {
        echo $message . $err . '<br>';
    }
}
