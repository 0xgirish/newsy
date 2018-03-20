<?php

include "../includes/common.php";

session_start();

$userid = $_SESSION['id'];
$postid = $_POST['postid'];
$type = $_POST['type'];

// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM user_likes WHERE article_id=".$postid." and user_id=".$userid;

$result = mysqli_query($con,$query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];


if($count == 0){
    $insertquery = "INSERT INTO user_likes(user_id,article_id,like_type) values(".$userid.",".$postid.",".$type.")";
    mysqli_query($con,$insertquery);
}else {
    $updatequery = "UPDATE user_likes SET like_type=" . $type . " where user_id=" . $userid . " and article_id=" . $postid;
    mysqli_query($con,$updatequery);
}


// count numbers of like and unlike in post
$query = "SELECT COUNT(*) AS cntLike FROM user_likes WHERE like_type=1 and article_id=".$postid;
$result = mysqli_query($con,$query);
$fetchlikes = mysqli_fetch_array($result);
$totalLikes = $fetchlikes['cntLike'];

$query = "SELECT COUNT(*) AS cntUnlike FROM user_likes WHERE like_type=0 and article_id=".$postid;
$result = mysqli_query($con,$query);
$fetchunlikes = mysqli_fetch_array($result);
$totalUnlikes = $fetchunlikes['cntUnlike'];


$return_arr = array("likes"=>$totalLikes,"unlikes"=>$totalUnlikes);

echo json_encode($return_arr);