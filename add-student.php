<?php
require "./includes/session-destroy.php";
require './includes/header.php';
require './404.php';

    require "./classes/Database.php";
    require "./classes/students.php";

    $database = new Database;
    $conn = $database -> connect_db();
    // $employee = Employee::getById($conn);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $course = $_POST['course'];
    $class = $_POST['class'];
    $start_date = $_POST['start_date'];
    $income = $_POST['income'];
    Student::createStudent($conn,"students.php", $name, $age, $course, $class, $start_date,$income);

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
  <h1 class="col-md-7"> Add new Student data</h1>
  <div class="col-md-7">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" class="form-control" id="inputName" required name="name"  value="" placeholder="Full name">
  </div>
  <div class="col-md-7">
    <label for="inputAge" class="form-label">Age</label>
    <input type="number" class="form-control" id="inputAge" required name="age"  value="" placeholder="Student age">
  </div>
  <div class="col-7">
    <label for="inputPosition" class="form-label">Course</label>
    <input type="text" class="form-control" id="inputPosition" name="course" required  placeholder="Enrolled course" value="">
  </div>
  <div class="col-7">
    <label for="inputOffice2" class="form-label">Class</label>
    <input type="text" class="form-control" id="inputOffice2"  name="class" required placeholder="Cureent class" value="">
  </div>
  <div class="col-md-7">
    <label for="inputStartDate" class="form-label">Start date</label>
    <input type="date" class="form-control" id="inputStartDate"  name="start_date" placeholder="Course Start Date" required  value="">
  </div>
  <div class="col-md-7 pb-2">
    <label for="inputSalary" class="form-label" >Income</label>
    <input type="number" class="form-control" id="inputIncome" name="income"  required value="" placeholder="Income you generate from skill">
  </div>

  <div class="col-12">
    <a href="students.php" class="btn btn-danger" >Back</a>
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
