<?php
require './includes/header.php';
require './404.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "./classes/Database.php";
    require "./classes/Students.php";

    $database2 = new Database;
    $conn = $database2 -> connect_db();
    $employees = Student::deleteOne($conn,"students.php");
}else {
    page404();
}


?>