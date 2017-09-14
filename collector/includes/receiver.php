<?php 
ob_start();
include('sqlfunctions.php');//listing of custom functions that we will be using

$link = f_sqlConnect();
/*this I believe is going to be in the sql functions file
if(isset($_POST['formID']) && isset($_POST['firstName']) && isset($_POST['lastName'])){
	$table = mysql_real_escape_string($_POST['formID']);
	$firstname = mysql_real_escape_string($connection,$_POST['firstName']);
	$lastname = mysql_real_escape_string($connection,$_POST['lastName']);
	$email = mysql_real_escape_string($connection,$_POST['email']);

	echo "you got it dude";
}
*/

$table = $_POST['formID'];
echo '<br>Destination Table: ' . $table;

$keys = implode(", ",(array_keys($_POST)));
echo '<br>keys: ' . $keys;
 $values = implode("', '", (array_values($_POST)));
  echo '<br>Parsed Values :'.$values;

$x_fields = 'ENTRY_TimeStamp, SOURCE_IP';
$x_values = date('Y-m-d H:i:s') . "', '" . f_getIP();//anything with an f_ is a custom function that will be contained within the sqlfunctions.php file
//echo 'x_values : '.$x_values;



if(!f_tableExists($link,$table,DB)){
	die('<br>table does not exist: ' . $table);
}

if(isset($_POST['rejectredirecturl'])){
	$rejectredirecturl = $_POST['rejectredirecturl'];
	echo 'reject redirect url: '. $rejectredirecturl;
}
if(isset($_POST['successredirecturl'])){
	$successredirecturl = $_POST['successredirecturl'];
	echo 'success redirect url: '. $successredirecturl;
}
$sql = "INSERT INTO $table ($keys,$x_fields) VALUES ('$values','$x_values')";
echo '<br> SQL insert query: ' . $sql;
mysqli_query($link,$sql);//executes the sql against the database

if(!mysqli_query($link,$sql)){
	echo '<br>Error: '.mysqli_error($link);
	if(!empty($rejectredirecturl)){
		header('location:  '.$rejectredirecturl); 
	}
}else if(!empty ($successredirecturl)){
	// header('location: ' . $successredirecturl); //this is setting the location header
	header("location: $successredirecturl?msg=1"); //this is just another way to write the above I prefer concatenations
	
}
	
	mysqli_close($link);

?>
