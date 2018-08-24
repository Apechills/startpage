<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Tasklist</title>
<link href="../css/main.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
	require('../includes/connect.inc.php');
	?>
	<ul id="tasklist" class="container">
		<header>Tasklist</header>
		<?php
			$tasksquery = "SELECT * FROM tasks";
			if($tasksqueryrun = mysql_query($tasksquery)) {
				while($taskrow = mysql_fetch_assoc($tasksqueryrun)) {
					$task = $taskrow['task'];
					
					echo '<li class="task">'.$task.'</li>';
				}
			}
		?>
	</ul>
</body>
</html>