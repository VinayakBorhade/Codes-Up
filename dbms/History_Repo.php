<?php
// Initialize the session
session_start();
 require_once 'config.php';
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
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
	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="<?php echo  htmlspecialchars("/dbms/uploads/" . $_SESSION['username'] . "_dp" . $_SESSION['dp_ext']) ; ?>" alt="User" style=" width:25px; height:25px; "> <!-- <span class="glyphicon glyphicon-user"></span><span class="caret"></span> --> </a>
        <ul class="dropdown-menu">
		  <li><a href=""><span class="glyphicon glyphicon-user"> <?php echo $_SESSION['username']; ?></span></a></li>
		  <li class="divider"></li>
          <li><a href="#"><span class="glyphicon glyphicon-time"></span> &nbsp;&nbsp; Recent Activites/History</a></li>
          <li><a href="settings_Profile.php"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Settings</a></li>
		  <li class="divider"></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-cog"></span> &nbsp;&nbsp; Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

<div style="align:100 px;margin-left:150px;">
<div style="float:left; ">
	  <h2>Personalize Settings</h2>
	  <div class="list-group">
		<a href="settings_Profile.php" class="list-group-item"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Profile</a>
		<a href="settings_Account.php" class="list-group-item"><span class="glyphicon glyphicon-lock"></span> &nbsp;&nbsp; Account</a>
		<a href="settings_Repositories.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp; Repositories</a>
		<a href="settings_Follow.php" class="list-group-item"><span class="glyphicon glyphicon-resize-horizontal"></span> &nbsp;&nbsp; Followers/Following</a>
		<a href="settings_DeactivateAccount.php" class="list-group-item"><span class="glyphicon glyphicon-trash"></span> &nbsp;&nbsp; DeActivate Account</a>
	  </div>
	</div>
<div  style="float:right; margin-right: 100px; width:810px; padding: 20px;" >
  <h2>Activites/History</h2>
  <hr>
  <div class="table-responsive">
  <table class="table" >
    <thead>
      <tr>
        <th>Date</th>
        <th>Activity</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
	<!-- Php script begins -->
	<?php 
	$str="history_repositories_table";
	$sql="SELECT * FROM `$str` ";
	$result = mysqli_query($link,$sql);
	
	if(mysqli_num_rows($result)>0 ){
		while($row = mysqli_fetch_assoc($result)) {
			$v=$row["username"];
			if($_SESSION['username']==$v){
			echo "<tr> <td>" . $row["dt"] . "</td> <td> " . $row["activity"] . " </td> ";			
		}
		}
	}

	?>
	<!-- Php script ends -->
	</form>
    </tbody>
  </table>
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

