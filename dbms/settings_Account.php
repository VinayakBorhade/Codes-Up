
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
$old_username=$_SESSION['username'];
$username = "";
$new_password_err="";
$RepoTableName=$_SESSION['username']."repositories_table";
$RepoHistoryTableName=$_SESSION['username']."History_Repositories_table";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" ){
	$old_password=$_POST["old_password"];
	$username=$_SESSION["username"];
	
	if(empty($_POST["old_password"])){
		echo "<script>alert('Incorrect password');</script>";
	}
	
	else{
		$sql = "SELECT password FROM users WHERE username = ?";
			
			if($stmt = mysqli_prepare($link, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);
				
				// Set parameters
				$param_username = $username;
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					// Store result
					mysqli_stmt_store_result($stmt);
					
					// Check if username exists, if yes then verify password
					if(mysqli_stmt_num_rows($stmt) == 1){                    
						// Bind result variables
						mysqli_stmt_bind_result($stmt, $hashed_password);
						if(mysqli_stmt_fetch($stmt)){
							if(password_verify($old_password, $hashed_password)){
								if(empty($_POST["new_password"])||empty($_POST["new_confirm_password"])){
									$new_password_err='Enter a New password';
								}
								
								else if($_POST["new_password"]!=$_POST["new_confirm_password"]){
									$new_password_err='New passwords are not matching';
								}
								else{
									$sql = "UPDATE users SET password= ? WHERE username= ? ";
									
									if($stmt = mysqli_prepare($link, $sql)){
										// Bind variables to the prepared statement as parameters
										mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_username);
										
										// Set parameters
										$param_username = $username;
										$param_password = password_hash($_POST["new_confirm_password"], PASSWORD_DEFAULT); // Creates a password hash
										
										// Attempt to execute the prepared statement
										if(mysqli_stmt_execute($stmt)){
											echo "<script>confirm('Password changed!');</script>";
											header("location: logout.php");
											
										}
										else{
											echo "<script>alert('Error: Password not changed!');</script>";
										}
									}
								}
							}
							else{
								
								echo "<script>alert('Incorrect password');</script>";
							}
						}
					}
				}
			}
	}
	
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
	  	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="<?php echo  htmlspecialchars("/Demo/uploads/" . $_SESSION['username'] . "_dp" . $_SESSION['dp_ext']) ; ?>" alt="User" style=" width:25px; height:25px; "> <!-- <span class="glyphicon glyphicon-user"></span><span class="caret"></span> --> </a>
        <ul class="dropdown-menu">
		  <li><a href=""><span class="glyphicon glyphicon-user"> <?php echo $_SESSION['username']; ?></span></a></li>
		  <li class="divider"></li>
          <li><a href="History_Repo.php"><span class="glyphicon glyphicon-time"></span> &nbsp;&nbsp; Recent Activites/History</a></li>
          <li><a href="settings_Profile.php"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Settings</a></li>
		  <li class="divider"></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-cog"></span> &nbsp;&nbsp; Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
  
<div style="align:100 px;margin-left:150px;">
	<div style="float:left; margin-top:20px; ">
	  <h2>Personalize Settings</h2>
	  <div class="list-group">
		<a href="settings_Profile.php" class="list-group-item"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Profile</a>
		<a class="list-group-item active"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Account</a>
		<a href="settings_Repositories.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp; Repositories</a>
		<a href="settings_DeactivateAccount.php" class="list-group-item"><span class="glyphicon glyphicon-trash"></span> &nbsp;&nbsp; DeActivate Account</a>
	  </div>
	</div>
	<div style="float:right; margin-right: 100px; width:810px; padding: 20px;">
	<h2>Change Password</h2>
	<hr>
	
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
  <div class="form-row">
    <div class="col-7">
		
      <div class="form-group mx-sm-3 mb-2">
		<h4>Old Password</h4>
		<input type="password" class="form-control" id="inputPassword" name="old_password" placeholder="Password">
	  </div>
	  <br>
	  <div class="form-group mx-sm-3 mb-2">
		<h4>New Password</h4>
		<input type="password" class="form-control" id="inputPassword2" name="new_password" placeholder="Password">
		<span class="help-block" style="color:red;"><?php echo $new_password_err; ?></span>
	  </div>
	  <br>
	  <div class="form-group mx-sm-3 mb-2">
		<h4>Confirm New Password</h4>
		<input type="password" class="form-control" id="inputPassword2" name="new_confirm_password" placeholder="Password">
		<span class="help-block" style="color:red;"><?php echo $new_password_err; ?></span>
	  </div>
	  <br>
	   <button type="submit" class="btn btn-primary mb-2">Update Password</button>
    </div>
  </div>
	</form>

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
