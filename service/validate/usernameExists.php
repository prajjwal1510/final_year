<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 8/29/2016
 * Time: 11:51 AM
 */

include '../dbconnect.php';
include 'service.php';

echo validateUsername($conn, $_POST["username"]);