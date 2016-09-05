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
    <title>Insert Book</title>
</head>
<body>
<?php include 'design/layout/_header.php'; ?>
<div class="container">
    <legend style="text-align: center"><h2>Insert Request</h2></legend>
    <form method="post" action="insert_request.php" enctype="multipart/form-data" style="margin:0 auto;width: 40%; border-radius: 5px;box-shadow: 2px 2px 2px 2px black;padding:10px;">
        <div class="form-group">
            <label>Book Title</label>
            <input type="text" class="form-control" name="book_title" id="title" aria-describedby="booktitle" placeholder="Enter Book Name">
        </div>
        <div class="form-group">
            <label>Book Author</label>
            <input type="text" class="form-control" name="book_author" id="author" placeholder="Enter Book Title">
        </div>
        <div class="form-group">
            <label>Book Details</label>
            <textarea class="form-control" id="detail" name="book_desc" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Book Image</label>
            <input type="file" class="form-control-file" name="book_img" id="image" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">Insert latest book image.</small>
        </div>
        <button type="submit" name="insert_post" value="Insert Now" class="btn btn-primary">Submit</button>
    </form>



</div>
</body>
</html>

<?php

if(isset($_POST['insert_post'])){
    $req_title = $_POST['req_title'];
    $req_author=$_POST['req_author'];
    $req_desc = $_POST['req_desc'];
    $req_image = $_FILES['req_image']['name'];

    $req_image_tmp = $_FILES['req_image']['tmp_name'];

    move_uploaded_file($req_image_tmp,"admin_area/req_images/$req_image");

    $userId=$_SESSION['user'];
    $insert_request = "insert into request(user_id,book_title,book_author,img) values ('$userId','$req_title','$req_author','$req_image')";



    $insert_pro = mysqli_query($con,$insert_request);


    if($insert_pro){
        echo "<script>alert('Request has been inserted!')</script>";
        echo "<script>window.open('home.php')</script>";
    }


}

?>