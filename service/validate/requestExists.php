<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 8/29/2016
 * Time: 1:08 PM
 */

include '../dbconnect.php';
include 'service.php';

echo validateRequest($conn,$_POST["projectName"]);