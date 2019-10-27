<?php
require('connect.inc.php');

$container_name_var = $_GET['container'];		
$containers_query = "SELECT * FROM containers";
$items_query = "SELECT * FROM items WHERE container_link='$container_id_var' AND deleted=0";

$container_result = mysqli_query($con ,$containers_query);
$items_result = mysqli_query($con, $items_query);

if (mysqli_num_rows($container_result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {				
		if($row['container_name'] == $container_name_var) {
			$container_name_var = $row['container_name'];
			$container_id_var = $row['container_id'];
			$container_header_var = $row['container_header'];

			break;
		}
	}
	if($container_id_var == "") {
		die("ERROR: No entries found, please specify valid container. Current container: <b><i>$container_name_var</i></b>");
	}
}


?>
<form action="Processing/removeLinkProcess.php" method="get">
	<header>Remove link from "<?php echo $container_header_var; ?>"</header>
	<select name="link" id="itemselect">
		<option value="" selected hidden><em>Select item</em></option>
		<?php
			while($row = mysqli_fetch_assoc($items_result)) {
				$item_name = $row['item_name'];
				$item_id = $row['item_id'];
				
				echo '<option value="'.$item_id.'">'.$item_name.'</option>';
			}
		?>
	</select>
	<div id="submit">
		<a href="../" id="cancel" class="button">Cancel</a>
		<input class="button" value="Remove" type="submit">
	</div>	
</form>