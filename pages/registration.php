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

// if (isset($_POST['login'], $_POST['password'], $_POST['confPassword'], $_POST['email']))
//     if ($_POST['password'] == $_POST['confPassword'])
//         register($_POST['login'], $_POST['password'], $_POST['email']);
//     else
//         echo "<h3>password is not confirmed !!!</h3>";
// 
?>
<!--  <form action="index.php?page=Registration" method="POST">
     <div class="mb-3">
         <label for="formGroupExampleInput" class="form-label">Login</label>
         <input type="text" class="form-control" id="formGroupExampleInput" name="login">
     </div>
     <div class="mb-3">
         <label for="formGroupExampleInput2" class="form-label">Password</label>
         <input type="password" class="form-control" id="formGroupExampleInput2" name="password">
     </div>
     <div class="mb-3">
         <label for="formGroupExampleInput" class="form-label">Confirm Password</label>
         <input type="password" class="form-control" id="formGroupExampleInput" name="confPassword">
     </div>
     <div class="mb-3">
         <label for="formGroupExampleInput2" class="form-label">Email address:</label>
         <input type="email" class="form-control" id="formGroupExampleInput2" name="email">
     </div>
     <input type="submit" class="btn btn-primary" value="Sig Up">
 </form> -->