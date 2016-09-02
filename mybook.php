<?php
session_start();
include("service/dbconnect.php");
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
<legend style="text-align: center">My Books</legend>
<!--<div class="col-md-3 " style="text-align: center;"><div class="thumbnail">-->
<?php

if (!isset($_GET['cat'])) {

    if (!isset($_GET['subject'])) {
        global $con;
        $userId=$_SESSION['user'];
        $get_ubook = "select * from book where user_id='$userId'";

        $run_ubook = mysqli_query($con, $get_ubook);

        while ($row_ubook = mysqli_fetch_array($run_ubook)) {
            $book_id = $row_ubook['book_id'];
            $book_category = $row_ubook['book_category'];
            $book_subject = $row_ubook['book_subject'];
            $book_title = $row_ubook['book_title'];
            $book_price = $row_ubook['book_price'];
            $book_image = $row_ubook['book_image'];

            echo "
            <div class=\"col-md-3 \">                <div class=\"thumbnail\" style='text-align: center;'>
                <h3>$book_title</h3>
                <img src='admin_area/product_images/$book_image' width='100%' height='180'/>
                <b>Price : Rs: $book_price</b>
                <a class='btn btn-primary btn-block' href='detail.php?book_id=$book_id'>Details</a>

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