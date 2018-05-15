<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Alerts -->
<script>
$(document).ready (function(){
    $("#alert").delay(2000).fadeTo(1000, 0.0);  
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


<!-- Update item modal -->
<script>
for (var element of document.getElementsByClassName("update-item-modal-btn")) {
	var itemId = element.dataset.itemId;
	var itemTitle = element.dataset.itemTitle;
	var itemContent = element.dataset.itemContent;
	element.addEventListener("click", function(){
		var modal = document.getElementsByClassName("update-item-modal")[0];
		var itemIdInput = modal.querySelector("input[name=itemID]");
		itemIdInput.value = itemId;

		var itemTitleInput = modal.querySelector("input[name=itemTitle]");
		itemTitleInput.value = itemTitle;

		var itemContentInput = modal.querySelector("input[name=itemContent]");
		itemContentInput.value = itemContent;
		
	    modal.style.display = "block";
	});
}

for (var element of document.getElementsByClassName("close-update-item-modal")) {
	element.addEventListener("click", function(){
	    document.getElementsByClassName("update-item-modal")[0].style.display = "none";
	});
}
</script>