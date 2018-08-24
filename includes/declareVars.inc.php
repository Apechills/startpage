<?php
$container_name_var = $_GET['container'];		
$containers_query = "SELECT container_id, container_name, container_header FROM containers";
		
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
		die("No entries");
	}
}
?>