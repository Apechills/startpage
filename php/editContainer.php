<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="../css/main.css" rel="stylesheet" type="text/css">
<link href="../css/editcontainerform.css" rel="stylesheet" type="text/css">
<link href="../css/tabs.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="favicon.ico"/>
<link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
<title>Edit Container</title>
</head>

<body>
	
	<!-- Tab links -->
	<div class="tab">		
		<button class="tablinks" onClick="openTab(event, 'addLink')" id="defaultOpen">Add link</button>
		<button class="tablinks" onClick="openTab(event, 'editLink')">Edit link</button>
		<button class="tablinks" onClick="openTab(event, 'removeLink')">Remove link</button>
	</div>
	
	<!-- Tab content -->
	<div id="addLink" class="tabcontent">
		<?php 
		include(__DIR__.'../../includes/addLink.inc.php');
		?>
	</div>

	<div id="editLink" class="tabcontent">
		<?php 
		include(__DIR__.'../../includes/editLink.inc.php');
		?>
	</div>

	<div id="removeLink" class="tabcontent">
		<?php
		include(__DIR__.'../../includes/removeLink.inc.php');
		?>
	</div>

	<script>
	document.getElementById("defaultOpen").click();
	
	function openTab(evt, tabName) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(tabName).style.display = "block";
		evt.currentTarget.className += " active";
	}
	</script>
	
</body>
</html>