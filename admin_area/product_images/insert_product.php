<!DOCTYPE>

<?php
include("includes/db.php");
?>

<html>

<head>
    <title>Inserting Book</title>

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

</head>

<body bgcolor="aqua">

<form method="post" action="insert_product.php" enctype="multipart/form-data">
    <table align="center" width="700" border="2" bgcolor="orange">
        <tr align="center">
            <td colspan="7"><h2>Insert New Book Here</h2></td>
        </tr>
        <tr>
            <td align="right"><b>Book Title:</b></td>
            <td><input type="text" name="book_title" size="60" required/></td>
        </tr>
        <tr>
            <td align="right"><b>Book Category:</b></td>
            <td>
                <select name="book_cat">
                    <option>Select a Category</option>

                    <?php
                    $get_cats = "select * from categories";

                    $run_cats = mysqli_query($con, $get_cats);

                    while ($row_cats = mysqli_fetch_array($run_cats)) {
                        $cat_id = $row_cats['cat_id'];
                        $cat_title = $row_cats['cat_title'];

                        echo "<option value='$cat_id'>$cat_title</option>";
                    }
                    ?>

                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><b>Book Subject:</b></td>
            <td>
                <select name = "book_subject">
                    <option>Select a Subject</option>
                    <?php
                    $get_subjects = "select * from subject";

                    $run_subjects = mysqli_query($con, $get_subjects);

                    while ($row_subjects = mysqli_fetch_array($run_subjects)){
                        $subject_id= $row_subjects['sub_id'];
                        $subject_title = $row_subjects['sub_name'];

                        echo "<option value='$subject_id'>$subject_title</option>";
                    }
                    ?>

                </select>


            </td>
        </tr>
        <tr>
            <td align="right"><b>Book Image:</b></td>
            <td><input type="file" name="book_image" required/></td>
        </tr>
        <tr>
            <td align="right"><b>Book Author:</b></td>
            <td><input type="text" name="book_author" required/></td>
        </tr>
        <tr>
            <td align="right"><b>Book Price:</b></td>
            <td><input type="text" name="book_price" required/></td>
        </tr>
        <tr>
            <td align="right"><b>Book Description:</b></td>
            <td><textarea name="book_desc" cols = "21" rows="10"></textarea></td>
        </tr>
        <tr>
            <td align="right"><b>Book Keywords:</b></td>
            <td><input type="text" name="book_keywords" size="60" required/></td>
        </tr>
        <tr align="center">
            <td colspan="7"><input type="submit" name="insert_post" value="Insert Now"/></td>
        </tr>
    </table>
</form>
</body>
</html>

<?php

if(isset($_POST['insert_post'])){
    $book_title = $_POST['book_title'];
    $book_category = $_POST['book_cat'];
    $book_subject = $_POST['book_subject'];
    $book_author=$_POST['book_author'];
    $book_price = $_POST['book_price'];
    $book_desc = $_POST['book_desc'];
    $book_keywords = $_POST['book_keywords'];

    $book_image = $_FILES['book_image']['name'];
    $book_image_tmp = $_FILES['book_image']['tmp_name'];

    move_uploaded_file($book_image_tmp,"product_images/$book_image");

    $insert_product = "insert into book(book_title,book_subject,book_category,book_author,book_desc,book_price,book_keyword,book_image) values ('$book_title','$book_subject','$book_category','$book_author','$book_desc','$book_price','$book_keywords','$book_image')";

    $insert_pro = mysqli_query($con,$insert_product);

    if($insert_pro){
        echo "<script>alert('Product has been inserted!')</script>";
        echo "<script>window.open('insert_product.php','_self')</script>";
    }

}

?>