<?php
require "./includes/session-destroy.php";
require './includes/header.php';
require './404.php';

    require "./classes/Database.php";
    require "./classes/students.php";

    $database = new Database;
    $conn = $database -> connect_db();

    if(isset($_GET['id']) && is_numeric($_GET['id'])){

    $student = Student::getById($conn);

    if($student !== NULL ){
  
?>




<body id="page-top">

   <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php require "./includes/sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
       <?php require "./includes/navbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <form class="row g-3">
                  <div class="col-md-7 ">
                  <h1 class="col-md-12">Profile of <?= $student['name'] ?> (student)</h1> 
                <div class="col-md-12">
                  <label for="inputName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="inputName" readonly value="<?= $student['name'] ?>">
                </div>
                <div class="col-md-12">
                  <label for="inputAge" class="form-label">age</label>
                  <input type="number" class="form-control" id="inputAge" readonly value="<?= $student['age'] ?>">
                </div>
                <div class="col-12">
                  <label for="inputPosition" class="form-label">Course</label>
                  <input type="text" class="form-control" id="inputPosition" readonly placeholder="web developer, Marketer, Designer....etc" value="<?= $student['course'] ?>">
                </div>
                <div class="col-12">
                  <label for="inputOffice2" class="form-label">Class</label>
                  <input type="text" class="form-control" id="inputOffice2" readonly placeholder="Current enrolled class" value="<?= $student['class'] ?>">
                </div>
                <div class="col-md-12">
                  <label for="inputStartDate" class="form-label">Start date</label>
                  <input type="text" class="form-control" id="inputStartDate" readonly value="<?= $student['start_date'] ?>">
                </div>
                <div class="col-md-12 pb-2">
                  <label for="inputSalary" class="form-label" >Salary</label>
                  <input type="text" class="form-control" id="inputSalary" readonly value="<?= $student['income'] ?>">
                </div>


              
                <div class="col-12">
                  <a href="update-employee.php?id=<?= $student["id"] ?>" class="btn btn-primary">Edit</a>
                  <a href="employee.php" class="btn btn-danger" >Back</a>

                </div>

                </div>
                <div class="col-md-5 border d-flex ">
                <img class="img-profile rounded-circle" style="width:300px; height: 300px;"
                                    src="./uploads/<?= $_SESSION['image'] ?>">
                </div>
              </form>
              </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

</div>
    <!-- End of Page Wrapper -->
    <?php
require "./includes/model.php";
require "./includes/footer.php";
require "./includes/footerlinks.php";

}else{
  echo  "No data in employees ";
}

}


else{
  echo  "Data not found ";
}
?>
