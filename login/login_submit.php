<?php
require '../includes/common.php' ;
$username = mysqli_real_escape_string($con, filter_input(INPUT_POST, 'username'));
$password = mysqli_real_escape_string($con, md5(filter_input(INPUT_POST,'password')));
$query = "SELECT id, password FROM users WHERE username = '$username'";
$query_result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_array($query_result);
$num_row = mysqli_num_rows($query_result);
if($num_row != 0){
    if($password == $row['password']){
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $username;
    }else{
        header("Location: index.php?mode=login&error=wrong%20password");
    }
}else{
    header("Location: index.php?mode=login&error=username does not exist");
}
?>