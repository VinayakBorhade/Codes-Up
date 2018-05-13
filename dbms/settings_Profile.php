<?php
// Include config file
require_once 'config.php';
 session_start();
// Define variables and initialize with empty values
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}

$temp_username=$_SESSION['username'];
$sql="select * from users where username= '$temp_username' ";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);
$ext=$row["dp_ext"];
$_SESSION["dp_ext"]=$ext;

$old_username=$_SESSION['username'];
$username = "";
$username_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if username is empty
    if(empty(trim($_POST["username"])) or $old_username==trim($_POST["username"]) ){
        $username_err = 'Please enter another username.';
		echo "<script>alert('Please enter another username.');</script>";
    } else{
		$username=$_POST["username"];
		$sql="select * from users where username= '$username'";
		$result = mysqli_query($link,$sql);
		if(mysqli_num_rows($result)==1){
			echo "<script>alert('Please enter another username.');</script>";
		}else{
			$sql="select * from users where username= '$old_username'";
			$result = mysqli_query($link,$sql);
			$row = mysqli_fetch_assoc($result);
			$id=$row["id"];
			$sql="UPDATE users SET username='$username' WHERE username= '$old_username'";
			if(mysqli_query($link, $sql) ){
				$_SESSION['username']=$username;
				echo "<script>alert('Profile Updated Successfully.');</script>";
			}
		}
		
		
    }
    // Close connection
    mysqli_close($link);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
  
<div style="align:100 px;margin-left:150px;">
	<div style="float:left;  margin-top:20px;">
	  <h2>Personalize Settings</h2>
	  <div class="list-group">
		<a class="list-group-item active"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Profile</a>
		<a href="settings_Account.php" class="list-group-item"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Account</a>
		<a href="settings_Repositories.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp; Repositories</a>
		<a href="settings_DeactivateAccount.php" class="list-group-item"><span class="glyphicon glyphicon-trash"></span> &nbsp;&nbsp; DeActivate Account</a>
	  </div>
	</div>
	<div style="float:right; margin-right: 100px; width:810px; padding: 20px;">
	<h2>Public Profile</h2>
	<hr>
	
	
  <div class="form-row">
    <div class="row">
	
		<div class="col-sm-8" >
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
		   <h4>Name</h4>
		   <input type="text" class="form-control" name="username" value=<?php echo $_SESSION['username']; ?> style="width:300px;">
		   <br>
		   <h4>Your Bio</h4>
		   <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Something about yourself..." style="width:500px;" rows="3"></textarea>
		   <br>
		   <button type="submit" class="btn btn-primary mb-2">Update Profile</button>
		</form>
	    </div>
		<div class="col-sm-4"  >
		<img src="<?php echo  htmlspecialchars("/dbms/uploads/" . $_SESSION['username'] . "_dp" . $_SESSION['dp_ext']) ; ?>" alt="User" style=" width:200px; height:200px; margin-left:20px; ">
		<hr>
		<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal" >Update Profile picture</button>
		<!-- The Modal -->
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Picture</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
			<form enctype="multipart/form-data" method="post" action="upload1.php">
				<div class="row">
				  <label for="fileToUpload">Select a File to Upload</label><br />
				  <input type="file" name="fileToUpload" id="fileToUpload" />
				</div>
				<div class="row">
				  <input type="submit" value="Upload" />
				</div>
			</form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
		</div>
		
    </div>
  </div>

	</div>
	
	
	
</div>
<center>
<div class="content-footer" style="margin-top:500px;">
					<p>
						Page © - 2018 <br>
						Powered By <a href="https://www.facebook.com/tavo.qiqe.lucero" target="_blank">Vinayak & Tushar</a>
					</p>
				</div></center>
</body>
</html>
