<?php

function Createdb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "trainingschool";

    // create connection
    $con = mysqli_connect($servername, $username, $password, $dbname);

    // Check Connection
    if (!$con){
        die("Connection Failed : " . mysqli_connect_error());
    }

    // create Database
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if(mysqli_query($con, $sql)){
        $con = mysqli_connect($servername, $username, $password, $dbname);

        $sql = "
                        CREATE TABLE IF NOT EXISTS students(
                            id INT(10) NOT NULL ,
                            employee_name VARCHAR (25) NOT NULL,
                            reg_code INT(20) NOT NULL,
                            mobile_number INT(10) NOT NULL,
                            address_ VARCHAR (50) NOT NULL,
                            station_ VARCHAR (20) NOT NULL,
                            division_ VARCHAR (20) NOT NULL,
                            course_name VARCHAR (15) NOT NULL
                        );
        ";

        if(mysqli_query($con, $sql)){
            return $con;
        }else{
            echo "Cannot Create table...!";
        }

    }else{
        echo "Error while creating database ". mysqli_error($con);
    }

}
