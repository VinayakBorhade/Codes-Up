<?php
// Initialize the session
session_start();
 require_once 'config.php';
   require_once 'functions.php';
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
<?php
//This is the directory where images will be saved
echo $_FILES["Filename"]["tmp_name"];
echo $_FILES["Filename"]["type"];
//echo $handle;
//echo $handle;
$dir=dirname( $_FILES['Filename']['name']).PHP_EOL;
echo "\n$dir";
$target = "pics/";
$target = $target . basename( $_FILES['Filename']['name']);

//This gets all the other information from the form
$Filename=basename( $_FILES['Filename']['name']);
$Description=$_POST['Description'];


//Writes the Filename to the server
if(move_uploaded_file($_FILES['Filename']['tmp_name'], $target)) {
    //Tells you if its all ok
    echo "The file ". basename( $_FILES['Filename']['name']). " has been uploaded, and your information has been added to the directory";
    // Connects to your Database
    //mysql_connect("localhost", "root", "") or die(mysql_error()) ;
    //mysql_select_db("altabotanikk") or die(mysql_error()) ;

    //Writes the information to the database
    mysql_query("INSERT INTO picture (Filename,Description)
    VALUES ('$Filename', '$Description')") ;
} else {
    //Gives and error if its not
    echo "Sorry, there was a problem uploading your file.";
}
?>
