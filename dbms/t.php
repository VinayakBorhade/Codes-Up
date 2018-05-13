<?php
// Include config file
require_once 'config.php';
 session_start();
// Define variables and initialize with empty values
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}?>
<?php
$username=$_SESSION['username'];
//$username="tushar";
$var=$_GET["reponame"];
echo $var;
if(isset($_FILES['files'])){
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }		
        $query="INSERT into upload_data (`FILE_NAME`,`FILE_SIZE`,`FILE_TYPE`,`USER_ID`,`REPO_NAME`) VALUES('$file_name','$file_size','$file_type','$username','$var');";
	$desired_dir="user_data/$username.$var";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0777);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
            }else{									//rename the file if another one exist
                $new_dir="$desired_dir/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
            if(mysqli_query($link,$query)){
			echo "PATH ADDED";}
		else{echo "PATH NOT ADDED";}			
        }else{
                print_r($errors);
        }
    }
	if(empty($error)){
		echo "Success";
		echo "<script>alert('File uploaded Successfully.');window.location.assign('r.php');</script>";
	}
}
?>