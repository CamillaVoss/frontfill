<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Alerts -->
<script>
$(document).ready (function(){
    $("#alert").delay(3000).fadeTo(1000, 0.0);  
});
</script>


<!-- Api modal -->
<script>
for (var element of document.getElementsByClassName("api-btn")) {
	element.addEventListener("click", function(){
	    document.getElementsByClassName("apiModal")[0].style.display = "block";
	});
}

for (var element of document.getElementsByClassName("close-api")) {
	element.addEventListener("click", function(){
	    document.getElementsByClassName("apiModal")[0].style.display = "none";
	});
}
</script>


<!-- Create section modal -->
<script>
for (var element of document.getElementsByClassName("create-section-modal-btn")) {
	element.addEventListener("click", function(){
	    document.getElementsByClassName("create-section-modal")[0].style.display = "block";
	});
}

for (var element of document.getElementsByClassName("close-api")) {
	element.addEventListener("click", function(){
	    document.getElementsByClassName("close-create-section-modal")[0].style.display = "none";
	});
}
</script>


<!-- Delete section modal -->
<script>
for (var element of document.getElementsByClassName("delete-section-modal-btn")) {
	var sectionId = element.dataset.sectionId;
	element.addEventListener("click", function(){
		var modal = document.getElementsByClassName("delete-section-modal")[0];
		var sectionIdInput = modal.querySelector("input[name=sectionID]");
		sectionIdInput.value = sectionId;
	    modal.style.display = "block";
	});
}

for (var element of document.getElementsByClassName("close-delete-section-modal")) {
	element.addEventListener("click", function(){
	    document.getElementsByClassName("delete-section-modal")[0].style.display = "none";
	});
}
</script>


<!-- Delete item modal -->
<script>
for (var element of document.getElementsByClassName("delete-item-modal-btn")) {
	var itemId = element.dataset.itemId;
	element.addEventListener("click", function(){
		var modal = document.getElementsByClassName("delete-item-modal")[0];
		var itemIdInput = modal.querySelector("input[name=itemID]");
		itemIdInput.value = itemId;
	    modal.style.display = "block";
	});
}

for (var element of document.getElementsByClassName("close-delete-item-modal")) {
	element.addEventListener("click", function(){
	    document.getElementsByClassName("delete-item-modal")[0].style.display = "none";
	});
}
</script>