<?php
// Initialize the session
session_start();
 require_once 'config.php';
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
//echo $_SESSION['username'];
$search_text=$_GET['search'];
if( empty(trim($search_text)) ){	
	echo "<script>
		if(confirm('Please enter a username to search')){
			history.go(-1);
		}
		else{
			history.go(-1);
		}
	</script>";
	
}

//echo $search_text;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>#linkforname {
    cursor: pointer;
}</style>
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
		<form class="navbar-form" action="search_Result.php" method="get" >
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="search" value=""> </input>
            <div class="input-group-btn">
                <input type="submit" class="btn btn-default" name="search_button" value="Search" ></input>
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
          <li><a href="History_Repo.php"><span class="glyphicon glyphicon-time"></span> &nbsp;&nbsp; Recent Activites/History</a></li>
          <li><a href="settings_Profile.php"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Settings</a></li>
		  <li class="divider"></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-cog"></span> &nbsp;&nbsp; Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

<div style="margin:100px;">
<h2>Results</h2>
  <hr>
  <div class="table-responsive">
  <table class="table" >
    <thead>
      <tr>
        <th>Names</th>
      </tr>
    </thead>
    <tbody>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
	<?php 
		$search_text="%".$search_text."%";
	$sql="SELECT * FROM users where username like '$search_text' ";
	$result = mysqli_query($link,$sql);
	$userid=$_SESSION['username'];
	if(mysqli_num_rows($result)>0 ){
		while($row = mysqli_fetch_assoc($result)) {
			if($row["username"]==$userid) continue;
			
			echo "<tr><td><a href='grid.php?Other_User_name=".$row["username"]."'>" . $row["username"]. "</a></td></tr>";
		}
	}
	?>
	</form>
    </tbody>
  </table>
  </div>

</div>
<center>
<div class="content-footer">
					<p>
						Page © - 2018 <br>
						Powered By <a href="https://www.facebook.com/tavo.qiqe.lucero" target="_blank">Vinayak & Tushar</a>
					</p>
				</div></center>
</body>
</html>