<?php
// Initialize the session
session_start();
 require_once 'config.php';
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
	
	$RepositoryName_err="";$RepositoryName="";
	$TagsName_err="";$TagsName="";
	//$RepoTableName=$_SESSION['username']."_Repositories_table";
	$RepoTableName="repositories_table";
	$RepoHistoryTableName="history_repositories_table";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
 
		// Check if username is empty
		if(empty(trim($_POST["RepositoryName"]))){
			$RepositoryName_err = '*Please enter a RepositoryName.';
		} else{
			
			$sqlReopNameCheck = "SELECT id FROM `$RepoTableName` WHERE name = ?";
			
			if($stmt = mysqli_prepare($link, $sqlReopNameCheck)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_reponame);
				
				// Set parameters
				
				$param_reponame = trim($_POST["RepositoryName"]);
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					/* store result */
					mysqli_stmt_store_result($stmt);
					
					if(mysqli_stmt_num_rows($stmt) == 1){
						$RepositoryName_err = "This Repository is already created.";
					} else{
						$RepositoryName = trim($_POST["RepositoryName"]);
					}
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}
		}
		
		// Check if password is empty
		if(empty(trim($_POST['TagsName']))){
			$TagsName_err = '*Please enter atleast one TagName.';
		} else{
			$TagsName = trim($_POST['TagsName']);
		}
		
		// Validate credentials
		if(empty($RepositoryName_err) && empty($TagsName_err)){
			$sql1 = "INSERT INTO `$RepoTableName` (name, tags, description,username) VALUES (?, ?, ?, ?)";
			
			$temp_activity="You created a Repository ".$RepositoryName;
			$day=date("d");
			$month=date("m");
			$year=date("Y");
			$dt=$day."/".$month."/".$year;
			$sql2 = "INSERT INTO `$RepoHistoryTableName` (activity, dt,username) VALUES (?,?,?)";
			 
			if($stmt = mysqli_prepare($link, $sql1)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "ssss", $param_reponame, $param_tagsname, $param_description, $username);
				
				// Set parameters
				$param_reponame = $RepositoryName;
				$param_tagsname = $TagsName;
				$param_description=trim($_POST["description"]);
				$username=$_SESSION["username"];
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					
				} else{
					echo "error: repository creation failed: ".mysqli_error($link);
				}
			}
			if($stmt = mysqli_prepare($link, $sql2)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "sss", $param_activity, $param_dt, $username);
				
				// Set parameters
				$param_activity = "You created a Repository ".$RepositoryName;/*$temp_activity;*/
				$param_dt = $dt;
				$username=$_SESSION["username"];
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					echo "<script>alert('Repository created');</script>";
				} else{
					echo "error: repository history creation failed: ".mysqli_error($link);
				}
			}
			
		}
	}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Create a Repository</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
	.bs-example{
    	margin: 20px;
    }
    hr{
        margin: 60px 0;
    }
</style>


<style>
* {
    box-sizing: border-box;
}

input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
}

label {
    padding: 12px 12px 12px 0;
    display: inline-block;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

.col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
}

.col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
    .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
}
</style>
</head>
<body>

<!----
<div class="bs-example">
    <ul class="nav nav-pills">
        <li><a href="navBar.php#">Home</a></li>
        <li><a href="#">Repositories</a></li>
		<li><a href="teams_list.php#">Teams</a></li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Messages <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="#">Inbox</a></li>
                <li><a href="#">Drafts</a></li>
                <li><a href="#">Sent Items</a></li>
                <li class="divider"></li>
                <li><a href="#">Trash</a></li>
            </ul>
        </li>
        <li class="dropdown pull-right">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?php echo $_SESSION['username'];?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="#">Recent Activities</a></li>
                <li><a href="#">Settings</a></li>
                <li class="divider"></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>
        </li>
    </ul>
    <hr>
    
</div>----->

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header" style="padding-left: 150px;">
      <a href="r.php"><img src="/dbms/WebsiteIcon.png" alt="WebsiteIconImg" style=" margin-top:15px ;width:25px; height:25px; "> <!-- <span class="glyphicon glyphicon-user"></span><span class="caret"></span> --> </a>
	  <a class="navbar-brand" href="r.php">Code'sUp</a> 
    </div>
	
	<div class="col-sm-3 col-md-3">
        <form class="navbar-form" role="search">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="q">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
    </div>
	
    <ul class="nav navbar-nav">
      <li><a href="r.php">Repositories</a></li>
      <li><a href="displayfollowing1.php">Following</a></li>
	  <li><a href="displayfollower1.php">Followers</a></li>
	  <li><a href="table.php">View Users</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right" style="padding-right: 150px;">
	  
	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href ="#"> <img src="<?php echo  htmlspecialchars("/dbms/uploads/" . $_SESSION['username'] . "_dp" . $_SESSION['dp_ext']) ; echo header('Cache-control: no-cache');;?> " alt="User" style=" width:25px; height:25px; "> <!-- <span class="glyphicon glyphicon-user"></span><span class="caret"></span> --> </a>
        <ul class="dropdown-menu">
		  <li><a href=""> <span class="glyphicon glyphicon-user"> <?php echo $_SESSION['username']; ?></span></a></li>
		  <li class="divider"></li>
          <li><a href="History_Repo.php"><span class="glyphicon glyphicon-time"></span> &nbsp;&nbsp; Recent Activites/History</a></li>
          <li><a href="settings_Profile.php"><span class="glyphicon glyphicon-th-list"></span> &nbsp;&nbsp; Settings</a></li>
		  <li class="divider"></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-cog"></span> &nbsp;&nbsp; Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

<!--
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header" style="padding-left: 150px;">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
	
	<div class="col-sm-3 col-md-3">
        <form class="navbar-form" role="search">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="q">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
    </div>
	
    <ul class="nav navbar-nav">
      <li><a href="r.php">Repositories</a></li>
      <li><a href="#">Following</a></li>
	  <li><a href="#">Followers</a></li>
	  <li><a href="table.php">View Users</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right" style="padding-right: 150px;">
	  
	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#"><span class="glyphicon glyphicon-time"></span> &nbsp;&nbsp; Recent Activites/History</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Settings</a></li>
		  <li class="divider"></li>
          <li><a href="#"><span class="glyphicon glyphicon-cog"></span> &nbsp;&nbsp; Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
-->

<center>
	<h2 style="padding:20px;">Create New Repository</h2>
	<h4><p style="padding:20px;">Fill out the details to get started with a new Repo!</p></h4></center>
<div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="row">
      <div class="col-25">
        <label for="fname">Repository Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="fname" name="RepositoryName" placeholder="Repository name..">
		<span class="help-block" style="color:red;"><?php echo $RepositoryName_err; ?></span>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">TAGS</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="TagsName" placeholder=" (ex. Languages Used c++,java,php,..,techonlogies,javaSwing,pygame, etc..)">
		<span class="help-block" style="color:red;"><?php echo $TagsName_err; ?></span>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Description</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="description" placeholder="Write something.." style="height:100px"></textarea>
      </div>
    </div>
    <div class="row">
		<input type="submit" value="Submit"> 
    </div>
		
  </form>
</div>

</body>
</html>
