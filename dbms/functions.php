<?php
 require_once 'config.php';

function show_users($link){
    $users = array();
    $sql = "select id, username from users order by username";
    $result = mysqli_query($link,$sql);	
 
    while ($row = mysqli_fetch_object($result)){
        $users[$row->id] = $row->username;
    }
    return $users;
}

function following($link,$userid){
    $users = array();
 
    $sql = "select distinct user_id from following
            where follower_id = '$userid'";
    $result = mysqli_query($link,$sql);
 
    while($data = mysqli_fetch_object($result)){
        array_push($users, $data->user_id);
 
    }
 
    return $users;
 
}
function gfollowing($link,$userid){
    $users = array();
 
    $sql = "select distinct follower_id from following
            where user_id = '$userid'";
    $result = mysqli_query($link,$sql);
 
    while($data = mysqli_fetch_object($result)){
        array_push($users, $data->follower_id);
 
    }
 
    return $users;
 
}
function disfollowing($link,$userid){
	$users = array();
       $sql = "select distinct user_id,username from following
            where follower_id = '$userid'";
    $result = mysqli_query($link,$sql);
 
    while($data = mysqli_fetch_object($result)){
        $users[$row->id] = $row->username;
	}
	return $users;
}

function follow_user($link,$me,$them){
    $count = check_count($link,$me,$them);
 
    if ($count == 0){
        $sql = "insert into following (user_id, follower_id) 
                values ($them,$me)";
 
        $result = mysqli_query($link,$sql);
    }
}
 
 
function unfollow_user($link,$me,$them){
    $count = check_count($link,$me,$them);
 
    if ($count != 0){
        $sql = "delete from following 
                where user_id='$them' and follower_id='$me'
                limit 1";
 
        $result = mysqli_query($link,$sql);
    }
}

function check_count($link,$first, $second){
    $sql = "select count(*) from following 
            where user_id='$second' and follower_id='$first'";
    $result = mysqli_query($link,$sql);
 
    $row = mysqli_fetch_row($result);
    return $row[0];
 
}
?>