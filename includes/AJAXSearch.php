<?php

require('connect.inc.php');

$search = $_GET['data'];
$sql = "SELECT * FROM items WHERE item_name LIKE '%$search%'";

if($result = mysqli_query($con, $sql)) {
	while($row = mysqli_fetch_assoc($result)) {
		echo '<a class="searchitem" href="'.$row["item_href"].'">'.$row["item_name"].'</a>';
	}
} else {
	echo "failed";
}

?>