<?php
require_once 'config.php';
 session_start();
// Define variables and initialize with empty values
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
// include ImageManipulator class
require_once('ImageManipulator.php');
 if ($_FILES['fileToUpload']['error'] > 0) {
    echo "Error: " . $_FILES['fileToUpload']['error'] . "<br />";
} else {
    // array of valid extensions
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
    // get extension of the uploaded file
    $fileExtension = strrchr($_FILES['fileToUpload']['name'], ".");
    // check if file Extension is on the list of allowed ones
    if (in_array($fileExtension, $validExtensions)) {
        // we are renaming the file so we can upload files with the same name
        // we simply put current timestamp in fron of the file name
        $newName = $_SESSION['username'] . '_dp' . $fileExtension;
        $destination = 'uploads/' . $newName;
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $destination)) {
            echo "<script>
				if(confirm('Picture updated successfully')){
					window.location.assign('settings_Profile.php');
				}
				else{
					window.location.assign('settings_Profile.php');
				}
			</script>";
		$temp_username=$_SESSION['username'];
		$sql="update users set dp_ext = '$fileExtension' where username = '$temp_username' ";
		mysqli_query($link, $sql);
        }
    } else {
        echo "<script>
			if(confirm('Picture updated successfully')){
				window.location.assign('settings_Profile.php');
			}
			else{
				window.location.assign('settings_Profile.php');
			}</script>";
    }
}