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

$repo_id_selected= $_SESSION['EDIT_ID'];

$str="repositories_table";
$sql="SELECT * FROM `$str` where id='$repo_id_selected' ";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$old_repo_name=$row["name"];
$old_repo_tags=$row["tags"];
$old_repo_description=$row["description"];

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if username is empty
    if(empty(trim($_POST["repo_name"])) or $old_repo_name==trim($_POST["repo_name"]) ){
        $username_err = 'Please enter another Repository Name.';
		echo "<script>alert('Please enter another Repository Name.');</script>";
    } else{
		$str=$_SESSION['username']."_repositories_table";
		$repo_name=$_POST["repo_name"];
		$repo_tags=$_POST["tags"];
		$repo_description=$_POST["description"];
		$sql="select * from `$str` where name= '$repo_name' ";
		$result = mysqli_query($link,$sql);
		if(mysqli_num_rows($result)==1){
			echo "<script>alert('Please enter another Repository name.');</script>";
		}else{
			//echo "new repo_name: ".$repo_name;
			$sql1="UPDATE `$str` SET name='$repo_name' WHERE id= $repo_id_selected ";
			$sql2="UPDATE `$str` SET tags='$repo_tags' WHERE id= $repo_id_selected ";
			$sql3="UPDATE `$str` SET description='$repo_description' WHERE id= $repo_id_selected ";
			
			if(mysqli_query($link, $sql1) && mysqli_query($link, $sql2) &&mysqli_query($link, $sql3) ){
				
				
				
				$temp_activity="You changed a Repository name, from " . $old_repo_name . " to " . $repo_name . " , new tags: " . $repo_tags . " , new Description: ". $repo_description;
				
				$day=date("d");
				$month=date("m");
				$year=date("Y");
				$dt=$day."/".$month."/".$year;	
				$str= "history_repositories_table";
				$username=$_SESSION['username'];
				$sql ="insert `$str`(activity, dt) VALUES ('$temp_activity','$dt','$username')";
				mysqli_query($link, $sql);
				
				$old_repo_name=$repo_name;
				$old_repo_description=$repo_description;
				$old_repo_tags=$repo_tags;
				echo "<script>if(confirm('Repository Details Updated Successfully.')) window.location.assign('settings_Repositories.php');
								else window.location.assign('settings_Repositories.php') ;
				</script>";
				
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
      <li><a href="repositories_list.php">Repositories</a></li>
      <li><a href="displayfollowing1.php">Following</a></li>
	  <li><a href="displayfollower1.php">Followers</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right" style="padding-right: 150px;">
	 
	  
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href ="#"> <img src="<?php echo  htmlspecialchars("/Demo/uploads/" . $_SESSION['username'] . "_dp" . $_SESSION['dp_ext']) ; ?>" alt="User" style=" width:25px; height:25px; "> <!-- <span class="glyphicon glyphicon-user"></span><span class="caret"></span> --> </a>
        <ul class="dropdown-menu">
		  <li><a href=""> <span class="glyphicon glyphicon-user"> <?php echo $_SESSION['username']; ?></span></a></li>
		  <li class="divider"></li>
          <li><a href="History_Repo"><span class="glyphicon glyphicon-time"></span> &nbsp;&nbsp; Recent Activites/History</a></li>
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
		<a href="settings_Profile.php" class="list-group-item"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Profile</a>
		<a href="settings_Account.php" class="list-group-item"><span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp; Account</a>
		<a href="settings_Repositories.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;&nbsp; Repositories</a>
		<a href="settings_DeactivateAccount.php" class="list-group-item"><span class="glyphicon glyphicon-trash"></span> &nbsp;&nbsp; DeActivate Account</a>
	  </div>
	</div>
	<div style="float:right; margin-right: 100px; width:810px; padding: 20px;">
	<h2>Edit Repository</h2>
	<hr>
	
	
  <div class="form-row">
    <div class="row">
	
		<div class="col-sm-8" >
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
		   <h4>Name</h4>
		   <input type="text" class="form-control" name="repo_name" value=<?php echo $old_repo_name;/*queryed repo name */ ?> style="width:300px;">
		   <br>
		   <h4>Description</h4>
		   <textarea class="form-control" id="exampleFormControlTextarea1" name ="description" style="width:500px;" rows="3"><?php echo trim($old_repo_description) ;/*queryed description for the selected repository*/ ?>
		   </textarea>
		   <br>
		   <h4>Tags</h4>
		   <input type="text" class="form-control" name="tags" value=<?php echo $old_repo_tags ; /*queryed tags*/ ?> style="width:300px;">
		   <br>
		   <button type="submit" class="btn btn-primary mb-2">Update Repository Details</button>
		</form>
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