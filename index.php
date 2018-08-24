<?php $errorMessage = $_GET['errormsg']; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Startpage</title>
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<link href="css/redditTop.css" rel="stylesheet" type="text/css">
	<link href="css/pageEditing.css" rel="stylesheet" type="text/css">
	<link href="css/alertbox.css" rel="stylesheet" type="text/css"> 
	<link rel="shortcut icon" type="image/png" href="favicon.ico"/>
	<link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
	<!-- <link href="addElement.js" type="text/javascript"> -->
</head>
	<body>
		<!-- ALERT BOX -->
		<div class="alert" style="display: <?php if($_GET['errordisplay'] == "1"){echo "block";}else{echo "none";} ?>;">
			<span class="closebtn" onClick="this.parentElement.style.display='none';">&times;</span>
			<?php echo($errorMessage); ?>
		</div>
			 
		<!-- EDIT PAGE BOX -->
		<div id="editPage">
			<input type="checkbox" id="editPageCheckbox" onClick="editCheck()"><span id="editPageText">Edit page</span>
		</div>
		
		<!-- HEADER -->
		<div id="topContainer">
			<h1>Startpage</h1>
			<form class="searchBar" action="https://www.google.com/search" method="get">
				<input type="text" name="q" placeholder="Google Search">
			</form>
		</div>
		
		<!-- CONTENT -->
		<div class="content">
			<?php
				require(__DIR__.'/includes/contentManager.inc.php');
			?>
		</div>
		<div id="redditTop">
		<!-- <script src="https://www.reddit.com/hot/.embed?limit=5&t=all" type="text/javascript"></script> -->
		</div>
		
		<!-- TASKLIST -->
		<?php
		 include('tasklist/tasklist.php');
		?>
		
		<!-- JAVASCRIPT -->
		<script type="text/javascript">
		function editCheck() {
			var checkbox = document.getElementById("editPageCheckbox");
			var plus = document.getElementsByClassName("addLinkElement");
			if(checkbox.checked == true) {
				for (var i = 0; i < plus.length; i++) {
  					plus[i].style.display = 'inline-block';
				}
			} else {
				for (var i = 0; i < plus.length; i++) {
  					plus[i].style.display = 'none';
				}
			}
		}			
			
		window.onload = editCheck;
		</script>
	</body>
</html>
