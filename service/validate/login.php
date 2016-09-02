<?php
session_start();
if (isset($_POST['submit'])) {
    include("../dbconnect.php");

    $username = $_POST["username"];
    $password = $_POST["password"];

    $selectpassword = "select password, role from user where username = '$username'";
    $storedPassword = null;

    $result = $conn->query($selectpassword);
    while ($row = $result->fetch_assoc()) {
        $storedPassword = $row['password'];
        $role = $row['role'];
    }

    if ($password == $storedPassword) {
        if ($role == "manager") {
            $_SESSION['username'] = $username;
            header("Location: view/managerView/managerLanding.php");
        } else {
            $_SESSION['username'] = $username;
            header("Location: view/memberView/memberView.php");
        }
    } else {
        echo "user not found";
    }

}
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/stylesheet.css"/>
    <link type="text/css" href="bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
    <script type="application/javascript" src="dataTable/jquery.js"></script>
    <title>Log Keeper</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h2>Log Keeper</h2>
            <hr/>

        </div>
        <div class="col-lg-4">
            <h3>Login</h3>

            <form action="" method="post">
                <div class="form-group">
                    <lable>Username:</lable>
                    <input class="form-control" name="username" type="text" required="">
                </div>
                <div class="form-group">
                    <lable>Password:</lable>
                    <input class="form-control" name="password" type="password" required="">
                </div>
                <input name="submit" type="submit" value="login"/>
            </form>
        </div>
        <div class="col-lg-4">
            <h3>Register</h3>

            <form action="register.php" method="post" style="margin-top: 10px;">
                <div class="form-group">
                    <label>First name: </label>
                    <input type="text" class="form-control" name="fName" required="">
                </div>

                <div class="form-group">
                    <label>Last name: </label>
                    <input type="text" class="form-control" name="lName" required="">
                </div>

                <div class="form-group">
                    <label>Username: </label>
                    <input type="text" class="form-control" name="username" id="username" required="" onChange="checkUsername();">
                    <div class="error username">Username already exists</div>
                </div>

                <div class="form-group">
                    <label>Password: </label>
                    <input type="password" class="form-control" name="password" id="password" required="">
                </div>

                <div class="form-group">
                    <label>Confirm Password: </label>
                    <input type="password" class="form-control" name="password1" id="conformPassword" required="" onChange="checkPassword();">
                    <div class="error">&nbsp;Password does not match&nbsp;</div>
                </div>

                <div class="form-group">
                    <label>Role: </label>
                    <select name="role" class="form-control" required="">
                        <option value="manager">Manager</option>
                        <option value="member">Member</option>
                    </select>
                </div>
                <button class="btn btn-default" type="submit" id = "registerButton">Register</button>
            </form>
        </div>
    </div>
</div>

<script>


    function checkUsername(){
        var username = document.getElementById('username').value;

        $.ajax({
            type:'POST',
            url:'service/usernameExists.php',
            data:'username='+username,
            success:function(data){

                var jsonData = JSON.parse(data);
                //alert(jsonData);
                if(jsonData.message == "fail"){

                    $("#username").attr('style', 'border: 1px solid blue');
                    $(".username").attr('style', 'display: none;');
                    $("#registerButton").prop('disabled', false);
                }else{

                    $("#username").attr('style', 'border: 2px solid red');
                    $(".username").attr('style', 'display: block;');
                    $("#registerButton").prop('disabled', true);
                }
            }
        })
    }



    function checkPassword(){
        var p1 = document.getElementById('password').value;
        var p2 = document.getElementById('conformPassword').value;

        if(p1 != p2){
            $(".error").attr('style', 'display: block;');
            $("#password").attr('style', 'border: 2px solid red');
            $("#conformPassword").attr('style', 'border: 2px solid red');
            $("#registerButton").prop('disabled', true);
        }
        else{
            $(".error").attr('style', 'display: none;');
            $("#password").attr('style', 'border: 1px solid blue');
            $("#conformPassword").attr('style', 'border: 1px solid blue');
            $("#registerButton").prop('disabled', false);
        }
    }
</script>

</body>
</html>