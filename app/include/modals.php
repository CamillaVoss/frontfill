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


<!-- Create Section Modal -->
<div class="modal create-section-modal">
	<div class="modal-content">
		<h2>Create section</h1>
		<p>Creating a section will not make it appear on you site. Contact your developer for help</p>	
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?' . htmlspecialchars($_SERVER['QUERY_STRING']); ?>" method="POST">
			<input name="title"  placeholder="Section Title (must be unique)" class="section-title" autofocus>
			<div class="two-buttons">
			    <button type="submit" name="addSection" value="addSection" class="CTA-btn filled">Save</button>
	        	<button class="CTA-btn outlined close-create-section-modal">Cancel</button>     
	        </div>
        </form>
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