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

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['delete_repo_button']) ){
		/* ********** delete all the coressponding record for your username */
		$username=$_SESSION['username'];
		$userid=$_SESSION['userid'];
		$sql1="DELETE FROM upload_data WHERE user_id='$username' ";
		$sql2="DELETE FROM repositories_table WHERE username='$username' ";
		$sql3="DELETE FROM history_repositories_table WHERE username='$username' ";
		$sql4="DELETE FROM following WHERE user_id='$userid' or follower_id='$userid' ";
		$sql5="DELETE FROM users WHERE username='$username' ";
		
		if (mysqli_query($link, $sql1)) {
			if(mysqli_query($link,$sql2) ){
				if(mysqli_query($link,$sql3) ){
					if(mysqli_query($link,$sql4) ){
						if(mysqli_query($link,$sql5) ){
							echo "<script>if(confirm('Your Account Deactivated Successfully.')) window.location.assign('logout.php');
								else window.location.assign('logout.php') ;
								</script>";
						} else {
							echo "Error deleting record: " . mysqli_error($link);
						}
					} else {
						echo "Error deleting record: " . mysqli_error($link);
					}
				} else {
					echo "Error deleting record: " . mysqli_error($link);
				}
			} else {
				echo "Error deleting record: " . mysqli_error($link);
			}
		} else {
			echo "Error deleting record: " . mysqli_error($link);
		}

		mysqli_close($link);
		
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
      <li><a href="repositories_list.php">Repositories</a></li>
      <li><a href="displayfollowing1.php">Following</a></li>
	  <li><a href="displayfollower1.php">Followers</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right" style="padding-right: 150px;">
	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href ="#"> <img src="<?php echo  htmlspecialchars("/Demo/uploads/" . $_SESSION['username'] . "_dp" . $_SESSION['dp_ext']) ; ?>" alt="User" style=" width:25px; height:25px; "> <!-- <span class="glyphicon glyphicon-user"></span><span class="caret"></span> --> </a>
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
  
<div style="align:100 px;margin-left:150px; ">
	<div style="float:left;  margin-top:20px;">
	  <h2>Personalize Settings</h2>
	  <div class="list-group">
		<a href="settings_Profile.php" class="list-group-item"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Profile</a>
		<a href="settings_Account.php" class="list-group-item"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Account</a>
		<a href="settings_Repositories.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp; Repositories</a>
		<a class="list-group-item active"><span class="glyphicon glyphicon-trash"></span> &nbsp;&nbsp; DeActivate Account</a>
	  </div>
	</div>
	<div style="float:right; margin-right: 100px; width:810px; padding: 20px;">
	<h2> DeActivating Your Account, <strong><?php echo $_SESSION['username']; ?></strong></h2>
	<hr>
	
	
  <div class="form-row">
    <div class="row">
	
		<div class="col-sm-8" >
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
		   <div class="alert alert-danger">
			<strong>Danger!</strong> You are about to Delete this Account <a data-target="#myModal" data-toggle="modal" href="#myModal" class="alert-link"><strong>READ THIS MESSAGE</strong></a>.
			</div>
		   <button type="submit" name="delete_repo_button" class="btn btn-primary mb-2">DELETE YOUR ACCOUNT!</button>
		</form>
	    </div>
		
		
    </div>
  </div>
  
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><div class="alert alert-danger"> Warning! </div></h4>
        </div>
        <div class="modal-body">
          <p>
          	<strong>Deleting this Account will erase all your Repositories, their files in those repositories and you might lose the data forever.</strong>
          </p>
          <p><strong><?php echo $_SESSION['username']; ?>, make sure you have complete and proper backup Before proceeding to delete your Account</strong></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- Modal ends here -->
  
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