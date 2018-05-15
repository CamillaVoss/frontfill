<!-- API Modal -->

<?php
$userID = $_SESSION['userID'];	
require_once('include/db_con.php');
	$sql = 'SELECT apikey FROM users WHERE userID = ?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $userID);
	$stmt->execute();
	$stmt->bind_result($apikey);
	$stmt->fetch();
	$stmt->close();
?>

<div class="modal apiModal">
	<div class="modal-content">
		<h1>API-Key</h1>
		<h2><?=$apikey?></h2>
		<button class="CTA-btn filled close-api">Close</button>
	</div>
</div>


<!-- Delete Section Modal -->
<div class="modal delete-section-modal">
	<div class="modal-content">
		<h2>Are you sure you want to delete this section?</h2>
		<div class="two-buttons">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		        <button type="submit" name="deleteSection" value="deleteSection" class="CTA-btn filled">Delete</button>
				<input name="sectionID" value="" type="hidden">
	        	<button class="CTA-btn outlined close-delete-section-modal">Cancel</button>     
			</form>
        </div>
	</div>
</div>


<!-- Delete Item Modal -->
<div class="modal delete-item-modal">
	<div class="modal-content">
		<h2>Are you sure you want to delete this item?</h2>
		<div class="two-buttons">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?' . htmlspecialchars($_SERVER['QUERY_STRING']); ?>" method="POST">
		        <button type="submit" name="deleteItem" value="deleteItem" class="CTA-btn filled">Delete</button>
				<input name="itemID" value="" type="hidden">
	        	<button class="CTA-btn outlined close-delete-item-modal">Cancel</button>     
			</form>
        </div>
	</div>
</div>


<!-- Update Item Modal -->
<div class="modal update-item-modal">
	<div class="modal-content">
		<h2>Are you sure you want to update the item title?</h1>
		<p>If you change the title, the website has to be updated as well</p>
		<div class="two-buttons">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?' . htmlspecialchars($_SERVER['QUERY_STRING']); ?>" method="POST">
		        <button type="submit" name="saveItem" value="saveItem" class="CTA-btn filled">Save</button>
				<input name="itemID" value="" type="hidden">
				<input name="itemTitle" value="" type="hidden">
				<input name="itemContent" value="" type="hidden">
	        	<button class="CTA-btn outlined close-update-item-modal">Cancel</button>     
			</form>
        </div>
	</div>
</div>