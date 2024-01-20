<?php require "./includes/header.php";



session_start();

$expectedUrl = 'http://localhost/control_panel/control_panel/login.php';
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



if ($currentUrl !== $expectedUrl) {
    header("Location: $expectedUrl");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "./classes/Database.php";
require "./classes/Employees.php";
$database = new Database;
$conn = $database -> connect_db();




$name = $_POST["name"];
$pass = $_POST["pass"];


if($conn){

    // echo "hello";
    $employees = Employee::getAll($conn);
    // var_dump($employees);

    // extract one by one data using foreach 
    foreach($employees as $employee){
        if($employee['name'] == $name && password_verify($pass , $employee['password'])){
        $_SESSION['login'] = true ;
        $_SESSION['name'] = $employee['name'];
        $_SESSION['image'] = $employee['image'];
        $_SESSION['id'] = $employee['id'];
            header('Location:index.php');

        }else{
            $error = 'invalid password and username';
        }

    }


}
}
?>



<body class="" style="background: -webkit-linear-gradient(left, #3931af, #00c6ff);">

    <div class="container">


                          

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block border">

                            <div class="col-md-3 register-left " style="min-width: 100%;">

                            <img src="img/rocket3.png" style="width: 100px;" alt=""/>   

                            <h3 class="text-dark">Welcome to <br> SASS <sup>pro</sup></h3>
                            <p class="text-dark">Empowering Excellence, Connecting Futures.</p>

                            <a type="submit" href="register.php" name="" value="Login" class="text-dark"> Register</a>    
                            <a type="submit" name="" value="Apply for job"  class="text-dark"> Apply for job</a>

                            </div>

   


                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php if(!empty($error)){ echo $error; } ?>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter username" name="name">
                                        </div>
                                        <div class="form-group password-div">
                                            <input type="password" class="form-control form-control-user password-input"
                                                id="exampleInputPassword" placeholder="Password" name="pass">
                                                <i class="fa-solid fa-eye repeat-password-eye-icon eye-icon" style="margin-top: 5px;"></i>
                                        </div>

                                        
                                <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small ">

                                                <input type="checkbox" class="custom-control-input" id="customCheck" onchange="togglePassword()">
                                               -->

                                                <!-- <label class="custom-control-label" for="customCheck" >Show password
                                                </label> -->
                                            <!-- </div> -->
                                        <!-- </div> -->

                                      
      
                                    
                                        <button class="btn btn-primary btn-user btn-block" type="submit" style="background-color: #0062cc;">
                                            Login
                                        </button>
                                    
                                      
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    
                                <!-- password visibale js code  -->

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("exampleInputPassword");
            var checkbox = document.getElementById("customCheck");

            if (checkbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }


 </script>
 <script src=".//js//myjs//show-password.js"></script>

  <?php require "./includes/footerlinks.php"   ?>