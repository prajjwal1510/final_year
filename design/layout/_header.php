<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://localhost:90/Final_Finalyear_project/design/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="http://localhost:90/Final_Finalyear_project/design/bootstrap-3.3.6-dist/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://localhost:90/Final_Finalyear_project/design/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="sytle.css">
    <title>Title</title>
</head>
<body>
<nav class="navbar navbar-default main-nav"  role="navigation" style="color: white">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style="color:white" href="../../index.php">Used Book Portal</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <div class="col-sm-3 col-md-3" >
            <form method="get" action="result.php"enctype=" multipart/form-data" class="navbar-form"  role="search">
                <div class="input-group">
                    <input type="text" name="user_query" class="form-control" placeholder="Search" name="q">
                    <div class="input-group-btn">
                        <button class="btn btn-default" name="search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php?logout" style="color:white">Log out</a></li>
       <!--     <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </li>
       --> </ul>
    </div><!-- /.navbar-collapse -->
</nav>
<div class="container">
    <nav class="navbar navbar-default sec-nav">
        <div class="container-fluid" style="margin-left: auto; margin-right: auto">

            <ul class="nav navbar-nav" >
                <li><a style="color:white" href="index.php">Home</a></li>
                <li><a style="color:white" href="all_product.php">All Books</a></li>
                <li><a style="color:white" href="insert%20book.php">Sell My Book</a></li>
                <li><a style="color:white" href="insert_request.php">Request Book</a></li>
                <li><a style="color:white" href="mybook.php">My Books</a></li>
                <li><a style="color:white" href="myrequest.php">My Requests</a></li>
            </ul>
        </div>
    </nav>



</div>


<script type="text/javascript" src="http://localhost:90/Final_Finalyear_project/design/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
</body>
</html>