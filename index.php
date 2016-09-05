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
    <link rel="stylesheet" href="design/css/style.css">
    <title>Log In</title>
</head>
<body style="background-image: url('design/img/bg.jpg')">

<!--<div class="container">
   <!-- <div class="customForm" style="margin: 0 auto;width:30%;border:2px solid #3573a3;position:relative;top:157px;border-radius:5px;box-shadow: 2px 2px 2px 2px #3c763d;padding:10px">
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

</div>-->
<!--//validation-->
<div id="custom-Bar">
    <div id="custom-Frame">
        <div id="logo"> <a href="#">Second Hand Book Portal </a> </div>
        <div id="header-main-right">
            <div id="header-main-right-nav">
                <form method="post" id="login_form" name="login_form">
                    <table border="0" style="border:none">
                        <tr>
                            <td ><input type="text" id="username" placeholder="Username" aria-describedby="uname" name="uname" class="inputtext radius1" required="" </td>
                            <td ><input type="password"  id="password" placeholder="Password" name="pass" class="inputtext radius1" required=""></td>
                            <td ><input type="submit" class="loginbutton" name="btn-login   " value="Login" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- header ends here -->

<div class="loginbox radius">
    <h2 class="text-center text-success">Sign Up Here</h2>
    <div class="loginboxinner radius">


        <div class="loginform">

            <form id="login" action="" method="post">
                <p>
                    <input class="radius" type="text" name="uname" placeholder="Username" id="username" onchange="checkUsername();" required="">
                </p>
                <p>
                    <input class="radius" type="email" name="email" placeholder="Email Address" id="email" required>
                </p>
                <p>
                    <input class="radius" type="text" name="fname" placeholder="Full Name" id="fname" required>
                </p>
                <p>
                    <input class="radius" type="tel" name="contact" placeholder="Contact Number"  id="tel" required>
                </p>
                 <p>
                   <input class="radius" type="password" name="pass" placeholder="Password" id="password" required>
                </p>
                <p>
                    <input class="radius" type="text" name="address" placeholder="Address" id="address" required>
                </p>

                <p>
                    <button type="submit" name="btn-signup" id="registerButton" class="radius title">Sign Up</button>

                </p>
            </form>
        </div><!--loginform-->
    </div><!--loginboxinner-->
</div><!--loginbox-->

</body>
</html>