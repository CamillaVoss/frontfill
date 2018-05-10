<div class="items">
    <div class="item">
    	<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <div class="item-top">
                <input name="title"  placeholder="Title (must be unique)" class="item-title" required>

                <button title="Delete" type="submit" name="delete" value="delete" class="delete"><img src="gfx/trashcan-black.svg" alt="trash can"></button>
			</div>

			<div>
                <textarea placeholder="Write your content here.." class="item-content"></textarea>
			</div>
			
			<div>
            	<button type="submit" name="save" value="save" class="CTA-btn filled">Save</button>

            	<button type="submit" name="cancel" value="cancel" class="CTA-btn outlined">Cancel</button>
            </div>
    	</form> 
	</div>
</div>