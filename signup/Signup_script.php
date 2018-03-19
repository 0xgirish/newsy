<?php 
require './includes/common.php';
$name = mysqli_real_escape_string($con,filter_input(INPUT_POST,'name'));
$email_chk = filter_input(INPUT_POST,'email');
$regex_email = "/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/";
if(!preg_match($regex_email,$email_chk)){
    header('location: signUp.php?error=Invalid Email');
}else{
$email = mysqli_real_escape_string($con,$email_chk);
$pass = filter_input(INPUT_POST,'pass');
if(strlen($pass)<7){
        header('location: signUp.php?error=Password Requirement Failed');
}else{
$password = mysqli_real_escape_string($con,md5($pass));
$contact = mysqli_real_escape_string($con,filter_input(INPUT_POST,'contact'));
$regex_idNum = "/^[0-9]{12}$/";
$regex_contact = "/^[2-9]{1}[0-9]{9}$/";
$id_num = filter_input(INPUT_POST,'id_num');
if(strlen($contact)<10){
    header('location: signUp.php?error=Contact Requirement Failed');
}else if(!preg_match($regex_idNum, $id_num)){
    header('location: signUp.php?error=ID Number Requirement Failed');
}else if(!preg_match($regex_contact, $contact)){
    header('location: signUp.php?error=Contact Number Requirement Failed');
}else{
$father_name = mysqli_real_escape_string($con,strtolower(filter_input(INPUT_POST,'father-name')));
$address = mysqli_real_escape_string($con,filter_input(INPUT_POST,'address'));
$insert_query = "INSERT INTO users(name,email,password,contact,Address,id_number,father_name) values('$name','$email','$password','$contact','$address','$id_num','$father_name')";
$insert_result = mysqli_query($con, $insert_query) or die(include 'wentWrong.php');
session_start();
$_SESSION['email']=$email;
$_SESSION['id'] = mysqli_insert_id($con);
header('location: home.php');
}
}
}
?>