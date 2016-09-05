<?php
session_start();

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
<div class="container">
    <!-- Latest Books -->
    <legend style="text-align: center">Latest Books</legend>

            <?php getBook();?>
            <?php getCatbook();?>
            <?php getSubjectBook();?>



    <!-- /Request -->
    <legend style="text-align: center">Request</legend>
        <?php getRequest();?>
</div>
</body>
</html>