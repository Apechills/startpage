function editCheck() {
	var checkbox = document.getElementById("editPageCheckbox");
	var text = document.getElementById("editPageElement");
	
	if(checkbox.checked == true) {
		text.style.display = "block";
	} else {
		text.style.display = "none";
	}
}