<?php

require(__DIR__.'/../../includes/connect.inc.php');

$emptyError = "Missing input, add link failed.";
		
$formUrl = $_POST['url'];
$formHeader = $_POST['name'];
$formName = $_POST['name'];
$container_id_var = $_POST['idvar'];
		
$sqlinsert = "INSERT INTO `items` (`item_id`, `container_link`, `item_name`, `item_href`) VALUES (NULL, '$container_id_var', '$formName', '$formUrl')";

if (!empty($formUrl) && !empty($formHeader)) {
	mysqli_query($con, $sqlinsert);
	header('Location: ../../');
} else {
	header('Location: ../../index.php?errordisplay=1&errormsg='.$emptyError);
}
		
?>