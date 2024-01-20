<?php

class Employee
{

    public static function
     getAll($conn){
       $selectAll_qry = "SELECT * FROM  employees";
       $result = mysqli_query($conn,$selectAll_qry);

       if($result){
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
       }

    }

    public static function
     deleteOne($conn, $location){
        $id = $_GET['id'];
        $delete_qry = "DELETE FROM employees WHERE id = ?";
        $stmt = mysqli_prepare($conn,$delete_qry);
        mysqli_stmt_bind_param($stmt,"i",$id);

        if(mysqli_stmt_execute($stmt)){
            header("Location: $location");
        }
    }

    public static function 
    getById($conn){

        $id = $_GET['id'];
       $selectAll_qry = "SELECT * FROM  employees WHERE id = ?";
       $stmt = mysqli_prepare($conn, $selectAll_qry);
        mysqli_stmt_bind_param($stmt,"i",$id);

       if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
       }



    }


    public static function
    createEmployee($conn,$location,$name,$position,$office,$age,$start_date,$salary){
        $insert_query = "INSERT INTO employees(name,position,office,age,start_date,salary)
         VALUES(?,?,?,?,?,?)";

         $stmt = mysqli_prepare($conn,$insert_query);
         mysqli_stmt_bind_param($stmt,"sssisi",$name,$position,$office,$age,$start_date,$salary);

         if(mysqli_stmt_execute($stmt)){

            header("location: $location");

         }
         

        
    }
    public static function 
    updateEmployee($conn,$location,$name,$position,$office,$age,$start_date,$salary){

        $id = $_GET['id'];
        $update_qry = "UPDATE  employees SET `name` = ? ,age = ?, position = ? , office = ? ,  `start_date` = ? ,
        salary = ? WHERE id =?";

        $stmt = mysqli_prepare($conn,$update_qry);
        mysqli_stmt_bind_param($stmt,"ssssssi",$name,$position,$office,$age,$start_date,$salary,$id);

        if(mysqli_stmt_execute($stmt)){
            header("Location: $location");
        }




    }

    public static function 
    insertEmployee($conn,$location,$name,$email,$position,$office,$age,$start_date,$salary,$pass,$profileImg,$gender){

        // $id = $_GET['id'];
        $insert_qry = "INSERT INTO employees (name,email ,position , office, age ,  start_date , salary,password,image,gender) 
                        VALUES (? , ? , ? , ? , ? , ?, ?, ?,?,?)";
                       
        

        $stmt = mysqli_prepare($conn,$insert_qry);
        mysqli_stmt_bind_param($stmt,"ssssisisss",$name,$email,$position,$office,$age,$start_date,$salary,$pass,$profileImg,$gender);
        
        if(mysqli_stmt_execute($stmt)){
            // $output= "$name is registered now";
            header("Location: $location");
        }




    }

    public static function 
    userExist($conn , $name){
        $userExist_qry = "SELECT * FROM employees WHERE `name` = $name";
        $result = mysqli_query($conn,$userExist_qry);
        $numExistRows = mysqli_num_rows($result);
        return $numExistRows;
    }

    public static function
    total_salary($conn){
        $total_salary_qry = "SELECT SUM(salary) AS total_salary FROM employees";

        $result = mysqli_query($conn,$total_salary_qry);
 
        if($result){
         return mysqli_fetch_assoc($result);
        }

       

    
    }

}

?>