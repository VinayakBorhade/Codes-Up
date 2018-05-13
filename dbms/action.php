<?php
session_start();
include_once("config.php");
include_once("functions.php");
 
$id = $_GET['id'];
$do = $_GET['do'];
 
switch ($do){
    case "follow":
        follow_user($link,$_SESSION['userid'],$id);
        $msg = "You have followed a user!";
    break;
 
    case "unfollow":
        unfollow_user($link,$_SESSION['userid'],$id);
        $msg = "You have unfollowed a user!";
    break;
 
}
$_SESSION['message'] = $msg;
 
 echo "<script>history.go(-1)</script>";
//header("Location:table.php");
?>