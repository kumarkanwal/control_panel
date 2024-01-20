<?php
require './includes/header.php';
require './404.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "./classes/Database.php";
    require "./classes/Employees.php";

    $database2 = new Database;
    $conn = $database2 -> connect_db();
    $employees = Employee::deleteOne($conn,"employee.php");
}else {
    page404();
}


?>