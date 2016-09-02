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
    $_SESSION['user_id'] = 2;
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
    <title>Title</title>
</head>
<body>

<div class="container">
    <legend style="text-align: center"><h2>Login</h2></legend>
    <form method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="uname" id="uname" aria-describedby="uname" placeholder="Enter Username">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="pass" id="password" placeholder="Enter Password">
        </div>
        <button type="submit" name="btn-login" class="btn btn-primary">Sign In</button>
        <button type="submit" class="btn btn-default"><a href="register.php">Register</a></button>
    </form>



</div>
</body>
</html>