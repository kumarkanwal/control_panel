<?php
require "./includes/session-destroy.php";

// session_start();

// if((!$_SESSION['is_logged_in'])){
//     header('Location:sign-in.php');
// }

// if(($_SESSION['role'] == 'project')) {
//     header('Location:profile.php');
//     die('you are not authorized user');
// }

require 'classes/Database.php';
require 'classes/Students.php';

// Create  a new instance of the Employee class 
// Get all the data from the database using the getALL() method 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $database = new Database;
    $conn = $database -> connect_db();
$data = Student::getAll($conn);

set_time_limit(0);
ini_set('memory_limit', '-1');

function sanitize($data){
    return str_replace(array('\r','\n','\t'), '',$data);
}
// $create file handle for csv file 
$fh = fopen('php://temp', 'w');

if(!empty($data)){
// Get the column names from the first row of the data

    $columns = array_keys($data[0]);
    // Sanitize the column names
    $columns = array_map("sanitize", $columns);

    // write the column names to the csv file
    fputcsv($fh, $columns);
};

    // loop through the data and add each new row to the csv file 

    foreach($data as $row) {
        $row = array_map("sanitize", $row);
    fputcsv($fh, $row);

    }
    // Set the headers for the csv file download with a dynamic file name
    $timestamp = date("Ymd_His");

    // Generate a unique file name with the timestamp
    $filename = "studentRecord_" . $timestamp . ".csv";


//     // Set the headers for the csv file download with a dynamic file name
    header('Content-Type: application/csv');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header('Pragma: no-cache');

//     // send the csv file to the user and exit

    rewind($fh);
    fpassthru($fh);
    exit;
    header("Location: students.php");

// echo "yes";




};


?>