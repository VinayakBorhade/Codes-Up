<?php
// Initialize the session
session_start();
 require_once 'config.php';
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
$str="repositories_table";
$username=$_SESSION['username'];
$sql="SELECT * FROM `$str` where username='$username' ";
$result = mysqli_query($link,$sql);
$map=array();
$i=(int)1;
if(mysqli_num_rows($result)>0 ){
	while($row = mysqli_fetch_assoc($result)) {
		$map[ $row["id"] ]=$i;
		$i+=1;
	}
}

if($_SERVER["REQUEST_METHOD"] == "POST" ){
	echo "<script> alert('inside isset');</script> ";
	if(isset($_POST['search_button']) ){
		echo "<script> alert('inside isset');</script> ";
		$_SESSION['search']=$_POST['search'];
		header("location: search_Result.php");
	}
	$repo_id_after_post=0;
	
	$k=(int)1;
	$j=(int)0;
	for($k=1; $k<$i; $k+=1){
		$j=$k;
		if(isset($_POST[$j]) ){
			$repo_id_after_post=(array_keys($map,$k))[0];
			break;
		}
		$j=-$k;
		if(isset($_POST[$j]) ){
			$repo_id_after_post=array_keys($map,$k)[0];
			break;
		} 
	}
	//echo "repo_id: ".$repo_id_after_post;
	$_SESSION['EDIT_ID']=$repo_id_after_post;
	if($j>0){
		header("location: Edit_Repo.php");
	}
	else if($j<0){
		header("location: Delete_Repo.php");
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

<div style="align:100 px;margin-left:150px;">
<div style="float:left; margin-top:20px;">
	  <h2>Personalize Settings</h2>
	  <div class="list-group">
		<a href="settings_Profile.php" class="list-group-item"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Profile</a>
		<a href="settings_Account.php" class="list-group-item"><span class="glyphicon glyphicon-lock"></span> &nbsp;&nbsp; Account</a>
		<a class="list-group-item active"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp; Repositories</a>
		<a href="settings_DeactivateAccount.php" class="list-group-item"><span class="glyphicon glyphicon-trash"></span> &nbsp;&nbsp; DeActivate Account</a>
	  </div>
	</div>
<div  style="float:right; margin-right: 100px; width:810px; padding: 20px;" >
  <h2>Repositories</h2>
  <hr>
  <div class="table-responsive">
  <table class="table" >
    <thead>
      <tr>
        <th>Names</th>
        <th>Repositories</th>
      </tr>
    </thead>
    <tbody>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
	<!-- Php script begins -->
	<?php 
	$str="repositories_table";
	$username=$_SESSION['username'];
	$sql="SELECT * FROM `$str` where username='$username' ";
	$result = mysqli_query($link,$sql);
	
	if(mysqli_num_rows($result)>0 ){
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr> <td>" . $row["name"] . "</td> <td><input type=" . "submit" . " class= " . "btn btn-primary" . " name= ". $map[ $row["id"] ] . " value= ". "Edit Details" . "> </input></td> ";
       
			echo "<td><input type=". "submit" . " class= " . "btn btn-danger" . " name= " . -$map[ $row["id"]] . " value= " . "Delete This Repository" . "> </input></td>
			</tr>";
			
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

