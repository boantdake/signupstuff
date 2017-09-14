<?php 
include('sqlfunctions.php');
include('header.php');
$link = f_sqlconnect();

$table = 'optin';

if(!f_tableExists($link,$table,DB)){
	die('<br> Destination table does not exist: ' . $table);
}
$sql = "SELECT * FROM $table";

if($result = mysqli_query($link,$sql)){
	echo "<table border='1' class='table table-inverse'>";
	echo "<thead><tr>
			<th>ID</th>
			<th>formID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Date</th>
			<th>Source IP</th>
			<th>SuccessUrl</th>
			<th>FailedUrl</th>
		</tr></thead>";
	//finish the table
	while ($row = mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>{$row[0]}</td>";
		echo "<td>{$row[1]}</td>";
		echo "<td>{$row[2]}</td>";
		echo "<td>{$row[3]}</td>";
		echo "<td>{$row[4]}</td>";
		echo "<td>{$row[5]}</td>";
		echo "<td>{$row[6]}</td>";
		echo "<td>{$row[7]}</td>";
		echo "<td>{$row[8]}</td>";
		echo "</tr>";
	}
	echo "</table>";


}
	mysqli_free_result($result);
	mysqli_close($link);

include('footer.php');
 ?>