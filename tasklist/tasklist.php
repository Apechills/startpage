<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Tasklist</title>
<link href="../css/main.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
	require('includes/connect.inc.php');
	?>
	<ul id="tasklist" class="container">
		<a href="php/editContainer.php?container=',$name,'"class="addLinkElement"><img id="containerPencil" src="img/pencilbutton.png"></a>
		<header>Tasklist<a href="php/editContainer.php?container='.$name.'"class="addLinkElement"><img id="containerPencil" src="img/pencilbutton.png"></a></header>
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