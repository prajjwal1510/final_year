<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 8/29/2016
 * Time: 4:27 PM
 */

session_start();
$username = $_SESSION['username'];
include '../db.php';
include 'service.php';

$user_id = getUserID($username, $conn);

echo validateRequest($conn, $_POST["project_id"], $user_id);