<?php
require "./includes/session-destroy.php";
require './includes/header.php';
require './404.php';

    require "./classes/Database.php";
    require "./classes/employees.php";

    $database = new Database;
    $conn = $database -> connect_db();
    // $employee = Employee::getById($conn);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $position = $_POST['position'];
    $office = $_POST['office'];
    $start_date = $_POST['start_date'];
    $salary = $_POST['salary'];
    Employee::createEmployee($conn,"employee.php", $name, $age, $position, $office, $start_date,$salary );

  }

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
<form class="row g-3" method="post">
  <h1 class="col-md-7"> Add new employee data</h1>
  <div class="col-md-7">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" class="form-control" id="inputName" required name="name"  value="" placeholder="Employee Name">
  </div>
  <div class="col-md-7">
    <label for="inputAge" class="form-label">age</label>
    <input type="number" class="form-control" id="inputAge" required name="age"  value="" placeholder="Employee Age">
  </div>
  <div class="col-7">
    <label for="inputPosition" class="form-label">Position</label>
    <input type="text" class="form-control" id="inputPosition" name="position" required  placeholder="Developer , Maketer , Designer etc..." value="">
  </div>
  <div class="col-7">
    <label for="inputOffice2" class="form-label">Office</label>
    <input type="text" class="form-control" id="inputOffice2"  name="office" required placeholder="Current office " value="">
  </div>
  <div class="col-md-7">
    <label for="inputStartDate" class="form-label">Start date</label>
    <input type="date" class="form-control" id="inputStartDate"  name="start_date" required  value="" placeholder="Job start date">
  </div>
  <div class="col-md-7 pb-2">
    <label for="inputSalary" class="form-label" >Salary</label>
    <input type="number" class="form-control" id="inputSalary" name="salary"  required value="" placeholder="Cureent salary">
  </div>

  <div class="col-12">
    <a href="employee.php" class="btn btn-danger" >Back</a>
    <button type="submit"  class="btn btn-primary">Create</button>
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
?>
