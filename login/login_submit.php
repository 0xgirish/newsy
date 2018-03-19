<?php
require './includes/common.php' ;
$email = mysqli_real_escape_string($con,filter_input(INPUT_POST, 'email'));
$password = mysqli_real_escape_string($con,md5(filter_input(INPUT_POST,'password')));
$query = "SELECT id, password FROM users WHERE email = '$email'";
$query_result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_array($query_result);
$num_row = mysqli_num_rows($query_result);
if($num_row != 0){
if($password == $row['password']){
    //session_destroy();
    session_start();
    $_SESSION['id'] = $row['id'];
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $row['id'];
    $pid = filter_input(INPUT_POST,'pid');
    if($pid){
        $quantity = filter_input(INPUT_POST,'quantity');
        header("location: cart-add.php?pid=$pid&quantity=$quantity");
    }else{
    header("Location: home.php");
    }
}else{
    header("Location: index.php?mode=login&error=wrong%20password");
}
}else{
    header("Location: index.php?mode=login&error=wrong email");
}
?>