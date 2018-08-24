<?php
require(__DIR__.'/../../includes/connect.inc.php');

$item_id = $_GET['link'];
$removequery = "DELETE FROM items WHERE item_id='$item_id'";

$noselectError = "No item selected, deletion failed.";
$deleteError = "Error deleting record.";

if(!empty($item_id)){
	if(mysql_query($removequery)) {
		echo "Record deleted.";
		header('Location: ../../');
	} else {
		header('Location: ../../index.php?errordisplay=1&errormsg='.$deleteError);
	}
} else {
	header('Location: ../../index.php?errordisplay=1&errormsg='.$noselectError);
}
?>