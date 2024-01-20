<!-- Header file connection over here  -->

<?php
require "./includes/session-destroy.php";
require "./includes/header.php";
require "./classes/Database.php";
require "./classes/Students.php";

$expectedUrl = 'http://localhost/control_panel/control_panel/students.php';
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



if ($currentUrl !== $expectedUrl) {
    header("Location: $expectedUrl");
    exit();
}

$database = new Database;
$conn = $database -> connect_db();
$students = Student::getAll($conn);

// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     echo "hwllo";
// }
?>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php  require "./includes/sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
           <?php
           require "./includes/navbar.php"


           ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

             
                  

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header border py-3">
                            <div class="row justify-content-around ">
                                <div class="col-12 mb-5 "> <h1 class="m-0 font-weight-bolder text-success " style="text-align: center;">Students Imformation</h1></div>
                                <div class="col-5">
                                    <a href="add-student.php" class="btn btn-success p-2 w-100">
                                    <i class="fas fa-add fa-sm text-white-50 p-1"></i>Add student</a>
                                </div>
                                <form  method="post" action="export-student.php" class="col-5  p-0">
                                    <button type="submit" class="border-0  rounded-2 text-light d-inline-block w-100 p-2" style="background-color: rgb(255, 160, 3);">
                                         <i class="fas fa-download fa-sm text-white-50 p-1"></i>Download Data
                                    </button>
                                </form>
                                <!-- <div class="col-4
                                "></div> -->

                            </div>
                           
                           
                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Class</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>edit/delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Class</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>edit/delete</th>
                                        </tr>
                                    </tfoot>
                               <tbody>
                                 <?php foreach ($students as $student) : ?>
                                    <tr>
                                    <div class="modal fade" id="modalOf<?= $student['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Want to Delete the student : <span class="fs-8 fw-bolder text-danger"> <?= "<br>". $student["name"]?> </span></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>

                                                <form action="delete-student.php?id=<?=$student["id"] ?>" method="post" class="d-inline-block">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>

                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                        <td><?= $student["name"]?></td>
                                        <td><?= $student["course"]?></td>
                                        <td><?= $student["class"]?></td>
                                        <td><?= $student["age"]?></td>
                                        <td><?= $student["start_date"]?></td>
                                        <td><?= $student["income"] . "$"?></td>
                                        <td>
                                            
                                                <button type="button" class="border-0" data-bs-toggle="modal" data-bs-target="#modalOf<?= $student['id']?>">
                                                    <i class="fa fa-trash text-danger p-2 "></i>
                                                </button>

                                            <a href="edit-student.php?id=<?=$student["id"] ?>"  class="d-inline-block"> <button type="submit" class="border-0 "><i class="fa fa-edit text-primary  p-2 "></i> </button></a> </td>
                                        </tr>

                                 <?php endforeach; ?>
                               </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Button trigger modal -->


<!-- Modal -->


  
    <!-- Logout Modal--> 
<?php
require "./includes/footer.php";
require "./includes/model.php";
require "./includes/footerlinks.php";
?>