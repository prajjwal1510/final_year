<?php
session_start();
if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}
include_once 'service/dbconnect.php';



if(isset($_POST['btn-signup']))
{
$uname = mysql_real_escape_string($_POST['uname']);
$email = mysql_real_escape_string($_POST['email']);
$upass = md5(mysql_real_escape_string($_POST['pass']));
$add = mysql_real_escape_string($_POST['address']);
$contact = mysql_real_escape_string($_POST['contact']);
    $fname= mysql_real_escape_string($_POST['fname']);


$uname = trim($uname);
$email = trim($email);
$upass = trim($upass);
$add = trim($add);
$contact = trim($contact);
    $fname=trim($fname);
// email exist or not
$query = "SELECT user_email FROM users WHERE user_email='$email'";
$result = mysql_query($query);

$count = mysql_num_rows($result); // if email not found then register

if($count == 0){

    if(mysql_query("INSERT INTO users(user_name,user_email,user_pass,fname,address,contact) VALUES('$uname','$email','$upass','$fname','$add','$contact')"))
    {
        ?>
        <script>alert('successfully registered ');</script>
        <?php
    }
    else
    {
        ?>
        <script>alert('error while registering you...');</script>
        <?php
    }
}
else{
?>
<script>
    alert('Sorry Email ID already taken ...');</script>
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
    <title>Register to Used Book</title>
</head>
<body style="background-color: #dbdbdb">

<div class="container">
    <div class="customForm" style="margin: 0 auto;width:40%;border:2px solid #3573a3;border-radius:5px;box-shadow: 2px 2px 2px 2px #3c763d;padding:10px">
    <legend style="text-align: center"><h2>Register To The Site</h2></legend>
    <form method="post">
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Username</label>
            <div class="col-xs-10">
                <input class="form-control" type="text" name="uname" placeholder="Username" id="username" onchange="checkUsername();" required="">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Email</label>
            <div class="col-xs-10">
                <input class="form-control" type="email" name="email" placeholder="example@email.com" id="email" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Full Name</label>
            <div class="col-xs-10">
                <input class="form-control" type="text" name="fname" placeholder="Full Name" id="fname" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Contact Number</label>
            <div class="col-xs-10">
                <input class="form-control" type="tel" name="contact" value="1-(555)-555-5555" id="tel" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Password</label>
            <div class="col-xs-10">
                <input class="form-control" type="password" name="pass" placeholder="Password" id="password" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Address</label>
            <div class="col-xs-10">
                <input class="form-control" type="text" name="address" placeholder="Address" id="address" required>
            </div>
        </div>
        <button type="submit" name="btn-signup" id="registerButton" class="btn btn-primary">Submit</button>



</div>
    </div>
<!--validatation-->
<script type="text/javascript">
    function checkUsername() {

        alert('test'); // fail

    }

//        var username = document.getElementById('username').value;
//        alert ("username");

//        $.ajax({
//            type:'POST',
//            url:'service/validate/usernameExists.php',
//            data:'username='+username,
//            success:function(data){
//
//                var jsonData = JSON.parse(data);
//                //alert(jsonData);
//                if(jsonData.message == "fail"){
//
//                    $("#username").attr('style', 'border: 1px solid blue');
//                    $(".username").attr('style', 'display: none;');
//                    $("#registerButton").prop('disabled', false);
//                }else{
//
//                    $("#username").attr('style', 'border: 2px solid red');
//                    $(".username").attr('style', 'display: block;');
//                    $("#registerButton").prop('disabled', true);
//                }
//            }
//        })
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