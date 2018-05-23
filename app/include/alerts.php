<!-- Add section -->
<?php
	if (array_key_exists('add_section', $_SESSION) && $_SESSION['add_section']) { 
?>
		<div class="alert green" id="alert">
			<p>You have added a section</p>
		</div>
<?php 
	}
	$_SESSION['add_section'] = false;
?>


<!-- Delete section -->
<?php
	if (array_key_exists('delete_section', $_SESSION) && $_SESSION['delete_section']) { 
?>
		<div class="alert green" id="alert">
			<p>Section deleted</p>
		</div>
<?php 
	}
	$_SESSION['delete_section'] = false;
?>


<!-- Add Item -->
<?php
	if (array_key_exists('add_item', $_SESSION) && $_SESSION['add_item']) { 
?>
		<div class="alert green" id="alert">
			<p>Item added. </p> 
			<p><strong>Creating an item will not make it appear on you site. Contact your developer for help</strong></p>
		</div>
<?php 
	}
	$_SESSION['add_item'] = false;
?>	


<!-- Update Item -->
<?php
	if (array_key_exists('update_item', $_SESSION) && $_SESSION['update_item']) { 
?>
		<div class="alert blue" id="alert">
			<p>Item updated</p>
		</div>
<?php 
	}
	$_SESSION['update_item'] = false;
?>


<!-- Delete Item -->
<?php
	if (array_key_exists('delete_item', $_SESSION) && $_SESSION['delete_item']) { 
?>
		<div class="alert green" id="alert">
			<p>Item deleted</p>
		</div>
<?php 
	}
	$_SESSION['delete_item'] = false;
?>	


<!-- Item already exists -->
<?php
	if (array_key_exists('item_exists', $_SESSION) && $_SESSION['item_exists']) { 
?>
		<div class="alert red" id="alert">
			<p>Item title already exists. Title must be unique within section</p>
		</div>
<?php 
	}
	$_SESSION['item_exists'] = false;
?>	


<!-- Section already exists -->
<?php
	if (array_key_exists('section_exists', $_SESSION) && $_SESSION['section_exists']) { 
?>
		<div class="alert red" id="alert">
			<p>Section title already exists. The section title must be unique</p>
		</div>
<?php 
	}
	$_SESSION['section_exists'] = false;
?>		

