<?php

require_once ("db.php");
require_once ("component.php");

$con = Createdb();

// create button click
if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    UpdateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}

if(isset($_POST['deleteall'])){
    deleteAll();

}

function createData(){
    $employeename = textboxValue("employee_name");
    $registrationcode = textboxValue("reg_code");
    $mobilenumber = textboxValue("mobile_number");
    $address = textboxvalue("address_");
    $station = textboxvalue("station_");
    $division = textboxvalue("division_");
    $coursename = textboxvalue("course_name");

    if($employeename && $registrationcode && $mobilenumber && $address && $station && $division && $coursename){

        $sql = "INSERT INTO students (employee_name, reg_code, mobile_number, address_, station_, division_, course_name) 
                        VALUES ('$employeename','$registrationcode','$mobilenumber','$address','$station','$division','$coursename')";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Record Successfully Inserted...!");
        }else{
            echo "Error";
        }

    }else{
        TextNode("error", "Provide Data in the Textbox");
    }
}

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}


// messages
function TextNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}


// get data from mysql database
function getData(){
    $sql = "SELECT * FROM students";

    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

// update dat
function UpdateData(){
    $id = textboxValue("id");
    $employeename = textboxValue("employee_name");
    $registrationcode = textboxValue("reg_code");
    $mobilenumber = textboxValue("mobile_number");
    $address = textboxValue("address_");
    $station = textboxValue("station_");
    $division = textboxValue("division_");
    $coursename = textboxValue("course_name");

    if($employeename && $registrationcode && $mobilenumber && $addess && $station && $division && $coursename){
        $sql = "
                    UPDATE students SET employee_name='$employeename', reg_code = '$registrationcode', mobile_number = '$mobilenumber', address_ = '$address', station_ = '$station', division_ = '$division', course_name = '$coursename' WHERE employee_id='$id';                    
        ";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Data Successfully Updated");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Select Data Using Edit Icon");
    }


}


function deleteRecord(){
    $id = (int)textboxValue("id");

    $sql = "DELETE FROM students WHERE id=$id";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }else{
        TextNode("error","Enable to Delete Record...!");
    }

}


function deleteBtn(){
    $result = getData();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement("btn-deleteall", "btn btn-danger" ,"<i class='fas fa-trash'></i> Delete All", "deleteall", "");
                return;
            }
        }
    }
}


function deleteAll(){
    $sql = "DROP TABLE students";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","All Record deleted Successfully...!");
        Createdb();
    }else{
        TextNode("error","Something Went Wrong Record cannot deleted...!");
    }
}


// set id to textbox
function setID(){
    $getid = getData();
    $id = 0;
    if($getid){
        while ($row = mysqli_fetch_assoc($getid)){
            $id = $row['id'];
        }
    }
    return ($id + 1);
}