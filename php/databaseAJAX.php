<?php
require('../includes/connect.inc.php');
$uid = $_GET['val'];

$sql = "SELECT * FROM items WHERE item_id=".$uid.";";

if($result = mysql_query($sql)) {
	while($row = mysql_fetch_assoc($result)) {
		echo($row['item_name']);
		echo "[µµ]";
		echo($row['item_href']);
	}
}
exit();
/*
echo "<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Age</th>
<th>Hometown</th>
<th>Job</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['FirstName'] . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "<td>" . $row['Age'] . "</td>";
    echo "<td>" . $row['Hometown'] . "</td>";
    echo "<td>" . $row['Job'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);*/
?>