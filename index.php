<?php $errorMessage = $_GET['errormsg']; ?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Startpage</title>
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<link href="css/settings.css" rel="stylesheet" type="text/css">
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
		
		<div id="settingsbox">
			<!-- EDIT PAGE BOX -->
				<span class="settingstext">
					<input type="checkbox" id="editPageCheckbox"><span id="editPageText">Edit page</span>
					<span> | </span>
					<a id="settingslink" href="">Settings</a>	
				</span>
			</div>
		</div>
		
		<!-- HEADER -->
		<div id="topContainer">
			<h1>Startpage</h1>
		<!--SEARCH-->
			<div class="searchContainer">
				<form class="searchBar">
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
		$("#search").focus();
				
		//SEARCH

		$('#search').keyup(function(e){
			var data = $('#search').val();

			if(e.which != 40 && e.which != 38) {
				$.get('includes/AJAXSearch.php', 'data=' + data, function(result) {
					$('#searchUl').html(result);
				});
				
				if($('#search').val()) {
					$('#searchResult').css('display', 'block');
				} else {
					$('#searchResult').css('display', 'none');
				};
				
			}
		});
			
		$(".searchContainer").keyup(function(e) {
			if(e.which == 40 || e.which == 38) {
				if($("#search").val()) {
					if($(".searchitem:focus").length == 0) {
						$(".searchitem:first").focus();
					}else if(e.which == 40) {
						$(".searchitem:focus").next().focus();
					}else if(e.which == 38) {
						$(".searchitem:focus").prev().focus();
					}				
				}
			}
		})
	
		//EDIT CHECKBOX
		function editContainerCheck() {
			if($("#editPageCheckbox").prop("checked") == true) {
				$(".addLinkElement").show();
			} else {
				$(".addLinkElement").hide();
			}
		}
		
		
		editContainerCheck();
		
			
		$("#editPageCheckbox").on("click", function() {
			editContainerCheck();
		})
		</script>
	</body>
</html>
