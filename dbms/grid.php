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
<html>
<head>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>

.sidenav {
    position: fixed;
    z-index: 1;
 
    background: #eee;
    overflow-x: hidden;
    padding: 8px 0;
}

.sidenav a {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    font-size: 25px;
    color: #2196F3;
    display: block;
}

.sidenav a:hover {
    color: #064579;
}
.jasgrid{padding:0;}
.box-item {
    float: left;
    opacity: 1;
    overflow: hidden;
    position: relative;
}

.box-item img {
    width: 100%;
}
.box-item a,span{color:#FFF;}

.box-item .box-post span.meta {
    font-family:  sans-serif;
    font-size: 12px;
    color: #fff;
    margin-top: 100px;
    display: block;
}

.box-item .box-post span.meta span {
    margin-right: 15px;
}

.box-item .box-post {
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0) 100%);
    padding: 30px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.box-item .box-post h1..post-title {
   font-size:10pt;
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
  
  
 <!---- 
  </div> 
  <div class="main ">
  <nav class="navbar navbar-expand-sm bg-success navbar-dark">
  <ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link" href="repositories_list.php" class="btn btn-info" role="button">Repositories  <span class="badge">5</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="displayfollower.php"class="btn btn-info" role="button">Followers  <span class="badge">5</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="displayfollowing.php"class="btn btn-info" role="button">Following  <span class="badge">5</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"class="btn btn-info" role="button">Teams  <span class="badge">5</span></a>
    </li>
  </ul>
</nav>---->



<div class="container">
    <div class="row">
		<div class="col-md-2 jasgrid">
		<div class="box-item">
                <div class="box-post">
                    <span class="label label-success">
                        <a href="#" rel="tag">Travel</a>
                    </span>
                    <h1 class="post-title">
                        <a href="#">
                            <?php echo $_GET['Other_User_name']; ?><!-- Here goes the username -->
                        </a>
                    </h1>
                    <span class="meta">
                        <span><i class="glyphicon glyphicon-comment"></i> <a href="http://wordpress.thebebel.com/showcase/newsbook/2015/01/19/meet-asias-best-destinations-for-the-summer/#respond">No Comments</a></span>
                        <span><i class="glyphicon glyphicon-time"></i> Sep 15, 2015</span>
                    </span>
                </div>
                <img src="tans.jpg" alt="Profile pic" 
                class="">        
            </div>
	
		
		</div>
		
		
		<?php
	  //execute the SQL query and return records
		$str="repositories_table";
		$name=$_SESSION["username"];
		$Other_User_name=$_GET["Other_User_name"];
		$sql = "SELECT * FROM `$str` where username='$Other_User_name' ";
		$result = mysqli_query($link, $sql);
		$var="";
		if (mysqli_num_rows($result)  > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$v=$row['username'];
				$var=$row['name'];
				$con=$_SESSION['username']."_".$var;
				//if($_SESSION["username"]==$v){?>
		
				<div class="col-md-5 jasgrid">
					<div class="box-item">
						<div class="box-post">
							<span class="label label-success">
								<a href="#" rel="tag">Travel</a>
							</span>
							<h1 class="post-title">
								<a href='repo_contentstry.php?con=<?php echo $row["name"];?>'>
												<?php echo $row["name"];?></a>
							</h1>
							 <span><p class="summary "><?php echo $row["description"]?></p></span>
							<span class="meta">
								
								<span><p class="summary "><?php echo $row["tags"]?></p></span>
							</span>
						</div>
						<img src="file1.jpg" style="width:425px;height:300px;" alt="City in the sky: world's biggest hotel to open in Mecca" 
						class="">        
					</div>
					</div>
					<?php while($row = mysqli_fetch_assoc($result)) {
							$var=$row['name'];
							$v=$row['username'];

							$con=$_SESSION['username']."_".$var;
							?>
							<div class="col-md-2 jasgrid"></div>
							<?php //if($_SESSION['username']==$v){?>
							<div class="col-md-5 jasgrid">
								<div class="box-item">
									<div class="box-post">
										<span class="label label-success">
											<a href="#" rel="tag">Travel</a>
										</span>
										<h1 class="post-title">
											<a href='repo_contents.php?con=<?php echo $con;?>'>
															<?php echo $row["name"];?></a>
										</h1>
										<span><p class="summary "><?php echo $row["description"]?></p></span>
										<span class="meta">

											<span><p class="summary "><?php echo $row["description"]?></p></span>
										</span>
									</div>
									<img src="file1.jpg" style="width:425px;height:300px;" alt="City in the sky: world's biggest hotel to open in Mecca" 
									class="">        
								</div>
								</div>
						<?php }}} else {
					echo "<h2>No repositories</h2>";
				}
			?>        
    </div></div>
	
<center>
<div class="content-footer">
					<p>
						Page © - 2018 <br>
						Powered By <a href="https://www.facebook.com/tavo.qiqe.lucero" target="_blank">Vinayak & Tushar</a>
					</p>
				</div></center>
</body>
</html>