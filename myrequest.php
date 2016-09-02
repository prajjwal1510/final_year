<?php
session_start();
include_once("service/dbconnect.php");
include("service/functions.php");
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

<?php include 'design/layout/_header.php'; ?>
<!-- Latest Books -->
<legend style="text-align: center">My Requests</legend>

<?php

if (!isset($_GET['cat'])) {

    if (!isset($_GET['subject'])) {
        global $con;
        $get_ureq = "select * from request where user_id='$user_id'";

        $run_ureq = mysqli_query($con, $get_ureq);

        while ($row_ureq = mysqli_fetch_array($run_ureq)) {
            $book_id = $row_ureq['book_id'];
            $book_title = $row_ureq['book_title'];
            $req_image = $row_ureq['img'];

            echo "
            <div class=\"col-md-3 \">                <div class=\"thumbnail\" style='text-align: center;'>
                <h3>$book_title</h3>
                <img src='admin_area/req_images/$req_image' width='100%' height='180'/>
                <p><b>Author : $book_author</b></p>

</div>
            </div>
        ";
        }
    }
}
?>




<!-- /Request -->
<!--<legend style="text-align: center">Request</legend>
<div class="col-md-3 " style="text-align: center;"><div class="thumbnail"><?php /*getRequest();*/?></div></div>
<div class="col-md-3"  style="text-align: center;"><div class="thumbnail">Book1</div></div>
<div class="col-md-3" style="text-align: center;"><div class="thumbnail">Book2</div></div>
<div class="col-md-3" style="text-align: center;"><div class="thumbnail">Book3</div></div>-->
</div>
</body>
</html>