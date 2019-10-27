<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<?php
require('connect.inc.php');

$container_name_var = $_GET['container'];		
$containers_query = "SELECT * FROM containers";
$items_query = "SELECT * FROM items WHERE container_link='$container_id_var' AND deleted=0";

$container_result = mysqli_query($con, $containers_query);
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
<form action="Processing/editLinkProcess.php" method="get">
	<header>Edit link from "<?php echo $container_header_var; ?>"</header>
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
	<div id="inputfields">
		<input id="Name" placeholder="Name" class="text" name="name" type="text">
		<input id="URL" placeholder="URL" class="text" name="url" type="url">
	</div>
	<div id="AJAXtest">
	</div>
	<div id="submit">
		<a href="../" id="cancel" class="button">Cancel</a>
		<input class="button" value="Edit" type="submit">
	</div>
</form>

<script>	
	$("#itemselect").change(function() {
		var uid = $(this).val();
		
		$("#inputfields").css({"display":"block"});
		
		$.get('databaseAJAX.php', 'val=' + uid, function(output) {
			var data = output.split("[µµ]");
			$("#Name").val(data[0]);
			$("#URL").val(data[1]);
		});
	});
</script>