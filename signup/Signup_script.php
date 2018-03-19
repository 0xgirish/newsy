<?php 
require '../includes/common.php';
$username = mysqli_real_escape_string($con,filter_input(INPUT_POST,'username'));
$email_chk = filter_input(INPUT_POST,'email');
$regex_email = "/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/";
if(!preg_match($regex_email,$email_chk)){
    header('location: signUp.php?error=Invalid Email');
}else{
    $email = mysqli_real_escape_string($con, $email_chk);
    $pass = filter_input(INPUT_POST,'pass');
    $query = "SELECT count(*) as num FROM users WHERE email = '$email'";
    $email_exist = $con->query($query) or die(include 'wentWrong.php');
    $result = $email_exist->fetch_assoc();
    if($result['num'] > 0){
        header('location: signup.php?error=Email already exist');
    }else{
        $query = "SELECT count(*) as num FROM users WHERE username = '$username'";
        $username_exist = $con->query($query);
        $result = $username_exist->fetch_assoc();
        if($result['num'] > 0){
            header('location: signup.php?error=Username already exist');
        }else{
            if(strlen($pass)< 7){
                    header('location: signup.php?error=Password Requirement Failed');
            }else{
                $password = mysqli_real_escape_string($con,md5($pass));
                $name = mysqli_real_escape_string($con,filter_input(INPUT_POST,'name'));
                if(strlen($username)<5){
                    header('location: signup.php?error=Username Requirement Failed');
                }else{
                    $insert_query = "INSERT INTO users(name,email, username, password) values('$name','$email','$username', '$password')";
                    $insert_result = mysqli_query($con, $insert_query);
                    if(!($insert_result)) echo $con->error;
                    session_start();
                    $_SESSION['email']=$email;
                    $_SESSION['id'] = mysqli_insert_id($con);
                    #header('location: home.php');
                }
            }
        }
    }
}
?> 