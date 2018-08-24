<?php
require('connect.inc.php');
$container_name_var = $_GET['container'];		
$containers_query = "SELECT * FROM containers";

$result = mysql_query($containers_query);

if (mysql_num_rows($result) > 0) {
	while($row = mysql_fetch_assoc($result)) {				
		if($row['container_name'] == $container_name_var) {
			$container_name_var = $row['container_name'];
			$container_id_var = $row['container_id'];
			$container_header_var = $row['container_header'];

			$checkName = true;
			break;
		}
	}
	if($container_id_var == "") {
		die("ERROR: No entries found, please specify valid container. Current container: <b><i>$container_name_var</i></b>");
	}
}
?>
<form action="Processing/addLinkProcess.php" method="post">
	<header>Add link to "<?php echo $container_header_var; ?>"</header>
	<input placeholder="Name" class="text" name="name" type="text">
	<input placeholder="URL" class="text" name="url" type="url">
	<input name="idvar" type="hidden" value="<?php echo "$container_id_var"; ?>">
	<div id="submit">
		<a href="../" id="cancel" class="button">Cancel</a>
		<input class="button" value="Submit" type="submit">
	</div>	
</form>