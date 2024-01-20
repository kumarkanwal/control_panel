<!-- <link rel="stylesheet" href="./css/login-register.css"> -->

<?php  


require "./includes/header.php";
require "./classes/Database.php";
require "./classes/Employees.php";
require "./classes/Students.php";
require './includes/sanitize.php';
$output = " ";
$database = new Database;
$conn = $database -> connect_db();

$expectedUrl = 'http://localhost/control_panel/control_panel/register.php';
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



if ($currentUrl !== $expectedUrl) {
    header("Location: $expectedUrl");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$registerbutton = $_POST['register-btn'];

if($registerbutton == 'Register Employee'){
    $name = $_POST['fname'];
    $sanitizedName = sanitize('fname');
    $email = $_POST['email'];
    $position = $_POST['position'];


    $sanitizedPosition = sanitize('position');

    $age = $_POST['age'];
    $office = $_POST['office'];
    $sanitizedOffice= sanitize('office');


    $start_date = $_POST['start_date'];
    $salary = $_POST['salary'];
    $pass = $_POST['pass'];
    $ConfirmPass = $_POST['con_pass'];
    $ProfileImg = $_FILES['profileImg']['name'];
    $gender = $_POST['gender'];


    // echo ($name.$salary.$email. $position. $office.$ProfileImg. $pass.$ConfirmPass.$gender);

    // var_dump($_FILES['profileImg']);


    $currentLocation = $_FILES['profileImg']['tmp_name'];
    // echo $ProfileImg;
    $newLocation = "uploads/". $_FILES['profileImg']['name'];
    move_uploaded_file($currentLocation , $newLocation);

    if($pass == $ConfirmPass){

        if( $name == $sanitizedName  && $position == $sanitizedPosition && $office == $sanitizedOffice){
        if($conn){
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
            $register = Employee::insertEmployee($conn,"login.php",$name,$email,$position,$office,$age,$start_date,$salary,$hashedPassword,$ProfileImg,$gender);
        }
    }else{
        echo "The data contains some malacious code or special characters";
    }
        }else{
            echo"The password and confirm password does not match";
        }
}


else if($registerbutton == 'Register Student'){

    $name = $_POST['fname'];
    $sanitizedName = sanitize('fname');

    $email = $_POST['email'];

    $course = $_POST['course'];
    $sanitizedCourse = sanitize('course');

    $age = $_POST['age'];
    $class = $_POST['class'];
    $sanitizedClass= sanitize('class');


    $start_date = $_POST['start_date'];
    $income = $_POST['income'];
    $pass = $_POST['pass'];
    $ConfirmPass = $_POST['con_pass'];
    $profileImg = $_FILES['profileImg']['name'];
    // var_dump($profileImg);
    $gender = $_POST['gender'];

    // $course = $_POST['course'];



    // echo ($name.$salary.$email. $position. $office.$ProfileImg. $pass.$ConfirmPass.$gender);

    // var_dump($_FILES['profileImg']);


    $currentLocation = $_FILES['profileImg']['tmp_name'];
    // echo $ProfileImg;
    $newLocation = "uploads/". $_FILES['profileImg']['name'];
    move_uploaded_file($currentLocation , $newLocation);

    if($pass == $ConfirmPass){

        if( $name == $sanitizedName  && $course == $sanitizedCourse && $class == $sanitizedClass){
            if($conn){
                $data = [
                    "name" => $name,
                    "email" => $email,
                    "course" => $course,
                    "class" => $class,
                    "age" => $age,
                    "start_date" => $start_date,
                    "password" => $pass,
                    "income" => $income,
                    "profile_img" => $profileImg,
                    "gender" => $gender,
                ];
                $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
                $register = Student::insertStudent($conn,"login.php",$data);
            }
        }else{
            echo "The data contains some malacious code or special characters";
        }
    }else{
        echo"The password and confirm password does not match";
    }


}




// $userExist = Employee::userExist($conn,$name);
// // var_dump($userExist);

// $existSql = "SELECT * from `employees` where WHERE name = 'John Doe'";
// $result = mysqli_query($conn,$existSql);
// $numsExistRows = mysqli_num_rows($result);
// if($numsExistRows > 0 ){
// echo $numsExistRows;
//     echo 'user exist';
// }else{

//     echo "user does not exist";
// }




    

// if($pass == $ConfirmPass){

//     if( $name == $sanitizedName  && $position == $sanitizedPosition && $office == $sanitizedOffice){
//     if($conn){
//         $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
//         $register = Employee::insertEmployee($conn,"login.php",$name,$email,$position,$office,$age,$start_date,$salary,$hashedPassword,$ProfileImg,$gender);
//     }
// }else{
//     echo "The data contains some malacious code or special characters";
// }
//     }else{
//         echo"The password and confirm password does not match";
//     }
}
?>
<body class="">

<div class="container-fluid register">
    <div class="row">
 <!-- left side bar of the page  -->
    <div class="col-md-3 register-left">

        <img src="img/rocket3.png" style="width: 100px;" alt=""/>   

        <h3>Welcome to <br> SASS <sup>pro</sup></h3>
        <p>Empowering Excellence, Connecting Futures.</p>

        <a type="submit" href="login.php" name="" value="Login" class="text-dark"> Login</a>    
        <a type="submit" name="" value="Apply for job"  class="text-dark"> Apply for job</a>
        
    </div>

    <!-- start of the right form side component  -->
    <div class="col-md-9 register-right">

    <!-- student to employee form and employee to student shift toggle  -->

        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">

            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Employee</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Student</a>
            </li>

        </ul>
                        


        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show " id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3 class="register-heading">Apply as a Employee</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row register-form">                   
                        <div class="col-md-6">
                                      
 <!-- inputs that are left side of the form -->
                        <div class="form-group">
                            <input type="text" id="fullName" name="fname" class="form-control" placeholder="Name *" value=""   />
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="position" placeholder="Position *" value=""  />
                        </div>

                        <div class="form-group">
                            <input type="date" name="start_date" class="form-control"  placeholder="Start_date *" value=""  />
                        </div>

                        <div class="form-group">
                            <input type="number" name="salary" class="form-control" placeholder="Salary *" value=""   />
                        </div>
                        <div class="form-group password-div">
                            <input type="password" name="pass" class="form-control password-input" id="e-password" placeholder="Password *" value=""   />
                            <i class="fa-solid fa-eye password-eye-icon eye-icon"></i>
                        </div>


                        <!-- male and female toggle button start here  -->

                         <!-- <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="e-customCheck" onchange="etogglePassword()">
                                    <input type="checkbox">
                                    <label class="custom-control-label" for="e-customCheck" >Show password</label>
                                        
                                </div>
                         </div> -->

                            <!-- show and hide password toggle for employee  -->
                        <script>
                            function etogglePassword() {
                                                    var epasswordInput = document.getElementById("e-password");
                                                    var epasswordInputrepeat = document.getElementById("e-repeat-password");
                                                    var echeckbox = document.getElementById("e-customCheck");

                                                    if (echeckbox.checked) {
                                                        epasswordInput.type = "text";
                                                        epasswordInputrepeat.type = "text";
                                                    } else {
                                                        epasswordInput.type = "password";
                                                        epasswordInputrepeat.type = "password";
                                                    }
                        }
                        </script>


                                      
            </div>


<!-- inputs that are right side of the form-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="email" id="email" name="email" class="form-control" placeholder=" Email *" value="@gmail.com"  />
                        </div>

                        <div class="form-group">
                            <input type="text" name="office" class="form-control" placeholder="Office *" value=""  />
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" id="age" name="age" placeholder="Age *" value="" />
                        </div>

                        <div class="form-group">
                            <input type="file" class="form-control"  placeholder="Iamge *" id="profileImg" name="profileImg" />
                        </div>

                        <div class="form-group password-div">
                            <input type="password" name="con_pass" class="form-control repeat-password-input" id="e-repeat-password" placeholder="Confirm Password *" value="" />
                            <i class="fa-solid fa-eye repeat-password-eye-icon eye-icon"></i>
                        </div>
                        
                        <!-- male and female redio buttons  -->
                        <div class="form-group">
                            <div class="maxl">
                                <label class="radio inline"> 
                                    <input type="radio" name="gender" value="male" checked>
                                    <span> Male </span> 
                                </label>
                                <label class="radio inline"> 
                                    <input type="radio" name="gender" value="female">
                                    <span>Female </span> 
                                </label>
                            </div>
                        </div>

                        <input type="submit" class="btnRegister" name="register-btn"  value="Register Employee"/>
                        
                    </div>                                 
              </div>
      </form>
</div>










<!-- student form starts from here -->
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">Apply as a Student</h3>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row register-form">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                    <input type="text" id="fullName" name="fname" class="form-control" placeholder="Name *" value="" />
                                            </div>

                                            <div class="form-group">
                                                <input type="text" name="class" class="form-control" placeholder="Class*" value="" />
                                            </div>
                                            
                                            <div class="form-group">
                                                <input type="date" name="start_date" class="form-control" placeholder="Start_date *" value="" />
                                            </div>

                                            <div class="form-group">
                                                <input type="number" name="income" class="form-control" placeholder="income *" value="" />
                                            </div>

                                            <div class="form-group password-div">
                                                <input type="password" class="form-control" id="password" name="pass" placeholder="Password *" value="" />
                                                <i class="fa-solid fa-eye repeat-password-eye-icon eye-icon"></i>
                                            </div>
                                            
                                            <!-- <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck" onchange="togglePassword()">
                                                    <label class="custom-control-label" for="customCheck" >Show password
                                                        </label>
                                            </div> -->
                                        </div>

                                                                    

                                                                        
                                                                        


                                                                    
                                                                    <div class="col-md-6">
                                                                    <div class="form-group">
                                                                            <input type="email" id="email" name="email" class="form-control" placeholder=" Email *" value="@gmail.com" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" name="course" class="form-control" placeholder="Course *" value="" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="number" id="age" name="age" class="form-control" placeholder="Age *" value="" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="file" class="form-control" name="profileImg" placeholder="Iamge *" id="profileImg"  />
                                                                        </div>
                                                                        <div class="form-group password-div">
                                                                            <input type="password"  id="repeat-password" class="form-control" 
                                                                            name="con_pass"  placeholder="Confirm Password *" value="" />
                                                                            <i class="fa-solid fa-eye repeat-password-eye-icon eye-icon"></i>
                                                                        </div>
                                                                            <div class="form-group">
                                                                            <div class="maxl">
                                                                                <label class="radio inline"> 
                                                                                    <input type="radio" name="gender" value="male" checked>
                                                                                    <span> Male </span> 
                                                                                </label>
                                                                                <label class="radio inline"> 
                                                                                    <input type="radio" name="gender" value="female">
                                                                                    <span>Female </span> 
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <input type="submit" class="btnRegister" name="register-btn" value="Register Student"/>
                                                                    </div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            
<!-- employee to student and student to employee shift js code  -->
<script>
document.addEventListener('DOMContentLoaded', function ()
{

    var employeeTab = document.getElementById('home-tab');
    var studentTab = document.getElementById('profile-tab');

    var employeeForm = document.getElementById('home');
    var studentForm = document.getElementById('profile');


    showForm('employee');// Show the employee form by default

    employeeTab.addEventListener('click', function () {
        showForm('employee');
    });

    studentTab.addEventListener('click', function () {
        showForm('student');
    });

    function showForm(formType) {
        if (formType === 'employee') {
            employeeForm.classList.add('show', 'active');
            studentForm.classList.remove('show', 'active');

            employeeTab.classList.add('active');
            studentTab.classList.remove('active');
        } else if (formType === 'student') {
            employeeForm.classList.remove('show', 'active');
            studentForm.classList.add('show', 'active');

            employeeTab.classList.remove('active');
            studentTab.classList.add('active');
        }
    }
});



// function togglePassword() {
//                             var passwordInput = document.getElementById("e-password");
//                             var passwordInputrepeat = document.getElementById("e-repeat-password");
//                             var checkbox = document.getElementById("e-customCheck");

//                             if (checkbox.checked) {
//                                 passwordInput.type = "text";
//                                 passwordInputrepeat.type = "text";
//                             } else {
//                                 passwordInput.type = "password";
//                                 passwordInputrepeat.type = "password";
//                             }
// }
// this toggle is working for student 
function togglePassword() {
                            var passwordInput = document.getElementById("password");
                            var passwordInputrepeat = document.getElementById("repeat-password");
                            var checkbox = document.getElementById("customCheck");

                            if (checkbox.checked) {
                                passwordInput.type = "text";
                                passwordInputrepeat.type = "text";
                            } else {
                                passwordInput.type = "password";
                                passwordInputrepeat.type = "password";
                            }
}
</script>

<script src="./js//myjs//show-password.js"></script>
    
 <?php
require "./includes/footerlinks.php";
?>
<!-- helload -->

</body>
</html>