<?php



$con = mysqli_connect("localhost", "root", "", "ecommerce");

if (mysqli_connect_errno()) {
    echo "The connection was not established: " . mysqli_connect_errno();
}

function getIp()
{
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}

function dbconnect()
{
    global $con;
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    if (!mysql_connect("localhost", "root", "", "ecommerce")) {
        die('oops connection problem ! --> ' . mysql_error());
    }
    if (!mysql_select_db("dbtest")) {
        die('oops database selection problem ! --> ' . mysql_error());
    }
}

function cart()
{
    if (isset($_GET['add_cart'])) {

        global $con;
        $ip = getIp();
        $pro_id = $_GET['add_cart'];
        $check_pro = "select * from cart where ip_add='$ip' AND p_id = '$pro_id'";

        $run_check = mysqli_query($con, $check_pro);

        if (mysqli_num_rows($run_check) > 0) {
            echo "";
        } else {
            $insert_pro = "insert into cart(p_id,ip_add) values ('$pro_id','$ip')";

            $run_query = mysqli_query($con, $insert_pro);

            echo "<script>window.open('index.php','_self')</script>";
        }

    }
}

function total_items()
{
    if (isset($_GET['add_cart'])) {
        global $con;

        $ip = getIp();

        $get_items = "select * from cart where ip_add='$ip'";
        $run_items = mysqli_query($con, $get_items);

        $count_items = mysqli_num_rows($run_items);
    } else {
        global $con;

        $ip = getIp();

        $get_items = "select * from cart where ip_add='$ip'";
        $run_items = mysqli_query($con, $get_items);

        $count_items = mysqli_num_rows($run_items);
    }

    echo $count_items;

}

function total_price()
{
    $total = 0;

    global $con;
    $ip = getIp();

    $sel_price = "select * from cart where ip_add='$ip'";

    $run_price = mysqli_query($con, $sel_price);

    while ($p_price = mysqli_fetch_array($run_price)) {
        $pro_id = $p_price['p_id'];
        $pro_price = "select * from products where product_id='$pro_id'";
        $run_pro_price = mysqli_query($con, $pro_price);

        while ($pp_price = mysqli_fetch_array($run_pro_price)) {
            $product_price = array($pp_price['product_price']);
            $values = array_sum($product_price);

            $total += $values;
        }
    }

    echo "$" . $total;

}


function getCats()
{
    global $con;

    $get_cats = "select * from categories LIMIT 10";

    $run_cats = mysqli_query($con, $get_cats);

    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];

        echo "<li><a href='home.php?cat=$cat_id'>$cat_title</a></li>";
    }

}

function getBrands()
{
    global $con;

    $get_brands = "select * from brands LIMIT 12";

    $run_brands = mysqli_query($con, $get_brands);

    while ($row_brands = mysqli_fetch_array($run_brands)) {
        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];

        echo "<li><a href='home.php?brand=$brand_id'>$brand_title</a></li>";
    }

}

function getSubjects()
{
    global $con;

    $get_subjects = "select * from subject LIMIT 12";

    $run_subjects = mysqli_query($con, $get_subjects);

    while ($row_subjects = mysqli_fetch_array($run_subjects)) {
        $sub_id = $row_subjects['sub_id'];
        $sub_title = $row_subjects['sub_name'];

        echo "<li><a href='home.php?subject=$sub_id'>$sub_title</a></li>";
    }

}

function getBook()
{

    if (!isset($_GET['cat'])) {

        if (!isset($_GET['subject'])) {
            global $con;

            $get_book = "select * from book LIMIT 0,4";

            $run_book = mysqli_query($con, $get_book);

            while ($row_book = mysqli_fetch_array($run_book)) {
                $book_id = $row_book['book_id'];
                $book_category = $row_book['book_category'];
                $book_subject = $row_book['book_subject'];
                $book_title = $row_book['book_title'];
                $book_price = $row_book['book_price'];
                $book_image = $row_book['book_image'];
                echo "

                <div class='col-md-3'>
                <div class='card'>
                        <img class='card-img-top' src='admin_area/product_images/$book_image' height='267' width='100%' alt='Book'>
                        <div class='card-block'>
                         <h4 class='card-title'>$book_title</h4>
                        <p class='card-text'>Price : Rs. $book_price </p>
                         <a href='detail.php?book_id=$book_id' class='btn btn-primary'>View Details</a>
                </div>
            </div>
            </div>
           <!-- <div id = 'single_product'>
                <h3>$book_title</h3>
                <img src='admin_area/product_images/$book_image' width='100%' height='267'/>
                <b>Price : Rs. $book_price</b>
                <a class='btn btn-primary btn-block' href='detail.php?book_id=$book_id'>Details</a>

                </div>
                </div>-->

                ";

            }
        }
    }
}

function getRequest()
{
    if (!isset($_GET['cat'])) {

        if (!isset($_GET['subject'])) {
            global $con;

            $get_req = "select * from request order by 'book_id' DESC LIMIT 0,4";

            $run_req = mysqli_query($con, $get_req);

            while ($row_req = mysqli_fetch_array($run_req)) {
                $book_id = $row_req['book_id'];
                $book_title = $row_req['book_title'];
                $book_author = $row_req['book_author'];
                $req_image = $row_req['img'];

                echo "
                <div class=\"col-md-3 \">
                <div class=\"thumbnail\" style='text-align: center;'>
            <div id = 'single_product'>
			
			<p><h3>Request</h3></p>
			<img src='admin_area/req_images/$req_image' width='100%' height='180'/>

			<b>$book_title</b>

			<p><b>Author : $book_author</b></p>

            </div>
            </div>
            </div>
        ";

            }
        }
    }
}

function getCatbook()
{

    if (isset($_GET['cat'])) {

        $cat_id = $_GET['cat'];

        global $con;

        $get_cat_book = "select * from book where book_category='$cat_id'";

        $run_cat_book = mysqli_query($con, $get_cat_book);

        $count_cats = mysqli_num_rows($run_cat_book);

        if ($count_cats == 0) {
            echo "<h2 class='text-center text-danger'>There is no book in this category.</h2>";
        }

        while ($row_cat_book = mysqli_fetch_array($run_cat_book)) {
            $book_id = $row_cat_book['book_id'];
            $book_cat = $row_cat_book['book_category'];
            $book_subject = $row_cat_book['book_subject'];
            $book_title = $row_cat_book['book_title'];
            $book_price = $row_cat_book['book_price'];
            $book_image = $row_cat_book['book_image'];

            echo "
            <div class=\"col-md-3 \">
                <div class=\"thumbnail\" style='text-align: center;'>
                <h3>$book_title</h3>
                <img src='admin_area/product_images/$book_image' width='100%' height='180'/>
                <p><b>Price : Rs.  $book_price</b></p>

                <a href='detail.php?book_id=$book_id' style='float: left;'>Details</a>
           </div>

            </div>
        ";

        }
    }
}


function getSubjectBook()
{

    if (isset($_GET['subject'])) {

        $subject_id = $_GET['subject'];

        global $con;

        $get_subject_book = "select * from book where book_subject='$subject_id'";

        $run_subject_book = mysqli_query($con, $get_subject_book);

        $count_subjects = mysqli_num_rows($run_subject_book);

        if ($count_subjects == 0) {
            echo "<h2 style='padding: 20px;'>There is no Books of this Subject.</h2>";
        }

        while ($row_subject_book = mysqli_fetch_array($run_subject_book)) {
            $book_id = $row_subject_book['book_id'];
            $book_cat = $row_subject_book['book_category'];
            $book_brand = $row_subject_book['book_subject'];
            $book_title = $row_subject_book['book_title'];
            $book_price = $row_subject_book['book_price'];
            $book_image = $row_subject_book['book_image'];

            echo "
            <div class=\"col-md-3 \">
                <div class=\"thumbnail\" style='text-align: center;'>
                <h3>$book_title</h3>
                <img src='admin_area/product_images/$book_image' width='100%' height='180'/>
                <p><b>Price : Rs. $book_price</b></p>

                <a href='detail.php?book_id=$book_id' style='float: left;'>Details</a>

            </div>
            </div>
        ";

        }
    }

}

function getUbook()
{
    if (!isset($_GET['cat'])) {

        if (!isset($_GET['subject'])) {
            global $con;
            $user_id = $_SESSION['user_id'];
            $get_ubook = "select * from book where user_id = $user_id";

            $run_ubook = mysqli_query($con, $get_ubook);

            while ($row_ubook = mysqli_fetch_array($run_ubook)) {
                $book_id = $row_ubook['book_id'];
                $book_category = $row_ubook['book_category'];
                $book_subject = $row_ubook['book_subject'];
                $book_title = $row_ubook['book_title'];
                $book_price = $row_ubook['book_price'];
                $book_image = $row_ubook['book_image'];

                echo "
            <div class=\"col-md-3 \">
                <div class=\"thumbnail\" style='text-align: center;'>
                <h3>$book_title</h3>
                <img src='admin_area/product_images/$book_image' width='100%' height='180'/>

                <p><b>Price : Rs. $book_price</b></p>

                <a href='detail.php?book_id=$book_id' style='float: left;'>Details</a>
</div>

            </div>
        ";

            }
        }
    }


}

function getUreq()
{
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
            <div class=\"col-md-3 \">
                <div class=\"thumbnail\" style='text-align: center;'>
                <h3>$book_title</h3>
                <img src='admin_area/req_images/$req_image' width='100%' height='180'/>

        </div>




            </div>
        ";

            }
        }
    }


}

?>