<?php

class Database
{

    public function connect_db(){

        $host = "localhost";
        $db_name ="management_system";
        $username = "root";
        $pass = "";

       return mysqli_connect($host,$username,$pass,$db_name);

    }

}


?>