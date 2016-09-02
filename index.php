<?php
session_start();
include_once 'service/dbconnect.php';

if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}

if(isset($_POST['btn-login']))
{
    $uname = mysql_real_escape_string($_POST['uname']);
    $upass = mysql_real_escape_string($_POST['pass']);

    $uname = trim($uname);
    $upass = trim($upass);

    $res=mysql_query("SELECT user_id, user_name, user_pass FROM users WHERE user_name='$uname'");
    $row=mysql_fetch_array($res);

    $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

    if($count == 1 && $row['user_pass']==md5($upass))
    {
        $_SESSION['user'] = $row['user_id'];
        header("Location: home.php");
    }
    else
    {
        ?>
        <script>alert('Username / Password Seems Wrong !');</script>
        <?php
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="design/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script type="text/javascript" src="design/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="sytle.css">
    <title>Log In</title>
</head>
<body style="background-color: #dbdbdb">

<div class="container">
    <div class="customForm" style="margin: 0 auto;width:30%;border:2px solid #3573a3;position:relative;top:157px;border-radius:5px;box-shadow: 2px 2px 2px 2px #3c763d;padding:10px">
    <legend style="text-align: center"><h2>Login</h2></legend>
    <form method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="uname" id="username" aria-describedby="uname" placeholder="Enter Username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="pass" id="password" placeholder="Enter Password" required>
        </div>
        <button type="submit" name="btn-login" class="btn btn-primary">Sign In</button>
        <button type="submit" class="btn btn-default"><a href="register.php">Register</a></button><br><br>
    </form>

</div>

</div>
<!--//validation-->
</body>
</html>