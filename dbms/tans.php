<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: "Lato", sans-serif;
}
.sidenav {
    width: 22rem;
    position: fixed;
    z-index: 1;
    top: 60px;
    left: 150px;
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

.main {
    margin-left: 400px; /* Same width as the sidebar + left position in px */
	margin-right: 150px;
    font-size: 15px; /* Increased text to enable scrolling */
    padding: 0px 10px;

}
@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
.grid-container {
  display: grid;
  grid-template-columns: auto auto;
  grid-gap: 30px;
 background-color: #FFFFFF;
 padding: 0px;
}
.grid-container > div {
  background-color: rgba(255,255,255, 1.0);
  text-align: center;
  padding: 10px;
  font-size: 30px;
    border-style: double;
}
</style>
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
      
      <li><a href="#">Following</a></li>
	  <li><a href="#">Followers</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right" style="padding-right: 150px;">
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-plus"></span><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">New Repository</a></li>
          <li><a href="#">New Group/Team</a></li>
        </ul>
      </li>
	  
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
  
  
  <div class="sidenav">
	<div class="h-card float-left" style="width: 20rem;">
  <img class="card-img-top" src="chromium.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title </h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="try.php" class="btn btn-primary">Go To link</a>
  </div>
</div>
  
  </div> 
  <div class="main">
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
</nav>
	<div class="grid-container">
		<div>1</div>
		  <div>2</div>
		  <div>3</div>  
		  <div>4</div>
		  <div>5</div>
	</div>
  
  </div>
  

</body>
</html>