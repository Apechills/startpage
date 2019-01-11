<?php $errorMessage = $_GET['errormsg']; ?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
		<!--SEARCH-->
			<div class"searchContainer">
				<form class="searchBar" action="https://www.google.com/search" method="get">
					<div class="inputContainer">
						<input type="text" id="search" name="q" placeholder="Search">
						<div id="searchResult" class="searchResult">
							<ul id="searchUl">
							</ul>
						</div>
					</div>
				</form>
			</div>
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
		
		<!-- JAVASCRIPT -->
		<script type="text/javascript">
		
		//SEARCH

		$('#search').keyup(function(){
			var data = $('#search').val();
			
			$.get('includes/AJAXSearch.php', 'data=' + data, function(result) {
				$('#searchUl').html(result);
			});
			
			if($('#search').val()) {
				$('#searchResult').css('display', 'block');
			} else {
				$('#searchResult').css('display', 'none');
			};
		});
			
		//EDIT CHECKBOX	
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
