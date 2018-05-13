<?php
// Initialize the session
session_start();
$vari=$_GET["reponame"];
//echo  $vari;
 require_once 'config.php';
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
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
<div class="bs-example">
    <ul class="nav nav-pills">
        <li><a href="navBar.php#">Home</a></li>
		<li><a href="fileget.php#">Contents</a></li>
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
    
</div>
-->

	<h2 style="padding:20px;">Add New File To Repository</h2>
<div class="container">
  <form action="upload1.php" method="post">
    <div class="row">
      <div class="col-25">
        <label for="fname">File Upload Location</label>
      </div>
      <div class="col-75">
        <input type="file" id="fname" name="UploadLink" placeholder="Repository name..">
      </div>
    </div> 
    <div class="row">
		<input type="submit" value="Submit"> 
    </div>
		
  </form>
</div>
<form method="post" action="uploads2.php" enctype="multipart/form-data">
    <p>Photo:</p>
    <input type="file" name="Filename" multiple webkitdirectory> 
    <p>Description</p>
    <textarea rows="10" cols="35" name="Description"></textarea>
    <br/>
    <input TYPE="submit" name="upload" value="Add"/>
</form>


<form action="t.php?reponame=<?php echo $vari?>" method="POST" enctype="multipart/form-data">
	<input type="file" name="files[]" multiple="" />
	<input type="submit"/>
</form>
</body>
</html>
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	//$vari=$_GET["reponame"];
	//echo $vari."yguygiugiuj";
	$path=trim($_POST["UploadLink"]);/*link to the folder or file*/
	$path = str_replace("\\", "\\\\",$path);//for backslashes in the path of file
	$name=$_SESSION['username']."_".$vari."_contents_table";
	$s="SELECT * FROM demo.INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = $name";
	
	
	if (!mysqli_query($link,$s))
	{/*creating a table of contents of Repositories list for user named $name*/
	$stmt="CREATE TABLE `$name` (
	id INT(16) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(60) NOT NULL,
	file blob,
	file_ext VARCHAR(60),
	size INT UNSIGNED NOT NULL
	)";
	if(mysqli_query($link,$stmt)){
		//echo("table created\n");
	} else {
	//echo "table not created\n" . mysqli_error($link);
	}
	}//end of if
	
	//check if path is a directory or not if yes create a new table
	
	$file_info = finfo_open(FILEINFO_MIME_TYPE);
	$file_type = finfo_file($file_info, $path);
	$file_size = filesize($path);
	if(is_dir($path))
	{
		$dir_name=substr(strrchr($path, "\\"), 1);
		$newname=$_SESSION['username']."_".$vari."_".$dir_name."_contents_table";
		$stmt1="CREATE TABLE `$newname` (
	id INT(16) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(60) NOT NULL,
	file blob,
	file_ext VARCHAR(60),
	size INT UNSIGNED NOT NULL
	)";
	if(mysqli_query($link,$stmt1)){
		//echo("table created\n");
	} else {
	//echo "table not created\n" . mysqli_error($link);
	}
	$sql = "INSERT INTO $name(name,file_ext,size) VALUES(addcslashes($path),'$file_type', '$file_size'/1024)";
	if(mysqli_query($link,$sql)){
		echo("file inserted in table!");
		//************
		header("location: r.php");
	} else {
	//echo "file not inserted in table" . mysqli_error($link);
	}
	}//end of if
	else {
	$file=file_get_contents($path);
	$sql = "INSERT INTO $name(name,file,file_ext,size) VALUES('$path', '" . mysqli_real_escape_string($link, $file) . "','$file_type', '$file_size'/1024)";
	if(mysqli_query($link,$sql)){
		echo("file inserted in table!");
		//*************
		header("location: r.php");
	} else {
	echo "file not inserted in table" . mysqli_error($link);
	}
	}//end of else
	mysqli_close($link);
	
}
	?>