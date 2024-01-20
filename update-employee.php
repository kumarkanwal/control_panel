<?php
require "./includes/session-destroy.php";

require './includes/header.php';
require './404.php';

    require "./classes/Database.php";
    require "./classes/employees.php";
 

    $database = new Database;
    $conn = $database -> connect_db();

    if(isset($_GET['id']) && is_numeric($_GET['id'])){

      $employee = Employee::getById($conn);
    // echo  ;

    if($employee !== NULL ){

        
      if($_SERVER['REQUEST_METHOD'] == 'POST'  ){
          
        $name = $_POST['name'];
        $sanitizedName = filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);
        $age = $_POST['age'];
        $position = $_POST['position'];
        $sanitizedPosition = filter_input(INPUT_POST,"position",FILTER_SANITIZE_SPECIAL_CHARS);

        $office = $_POST['office'];
        $sanitizedOffice = filter_input(INPUT_POST,"office",FILTER_SANITIZE_SPECIAL_CHARS);
        
        $start_date = $_POST['start_date'];
        $sanitizedStart_date = filter_input(INPUT_POST,"start_date",FILTER_SANITIZE_SPECIAL_CHARS);

        $salary = $_POST['salary'];
        
        if($sanitizedName == $name  &&  $sanitizedPosition == $position  && $sanitizedOffice == $office &&   $sanitizedStart_date == $start_date){
        Employee::updateEmployee($conn,"employee.php", $name, $age, $position, $office, $start_date,$salary );
        }else{
          echo("special characters are not allowed to use");
        }

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
        <h1 class="col-md-7"> Update data of <?= $employee['name']   ?></h1>
        <div class="col-md-7">
          <label for="inputName" class="form-label">Name</label>
          <input type="text" class="form-control" id="inputName" required name="name"  value="<?= $employee['name'] ?> ">
        </div>
        <div class="col-md-7">
          <label for="inputAge" class="form-label">age</label>
          <input type="number" class="form-control" id="inputAge" required name="age"  value="<?= $employee['age'] ?>">
        </div>
        <div class="col-7">
          <label for="inputPosition" class="form-label">Position</label>
          <input type="text" class="form-control" id="inputPosition" name="position" required  placeholder="web dev...." value="<?= $employee['position'] ?>">
        </div>
        <div class="col-7">
          <label for="inputOffice2" class="form-label">Office</label>
          <input type="text" class="form-control" id="inputOffice2"  name="office" required placeholder="Office belong from" value="<?= $employee['office'] ?>">
        </div>
        <div class="col-md-7">
          <label for="inputStartDate" class="form-label">Start date</label>
          <input type="text" class="form-control" id="inputStartDate"  name="start_date" required  value="<?= $employee['start_date'] ?>">
        </div>
        <div class="col-md-7 pb-2">
          <label for="inputSalary" class="form-label" >Salary</label>
          <input type="number" class="form-control" id="inputSalary" name="salary"  required value="<?= $employee['salary'] ?>">
        </div>

        <div class="col-12">
          <a href="edit-employee.php?id=<?= $employee['id'] ?>" class="btn btn-danger" >Back</a>
          <button type="submit"  class="btn btn-primary">Update</button>
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
