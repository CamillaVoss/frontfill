<div class="items">
<?php
    if (!empty($_GET['sectionID'])) {

        $sectionID = $_GET['sectionID'];

        require_once('include/db_con.php');
        $sql = 'SELECT content, title, itemID
                FROM fields
                INNER JOIN items   
                ON fields.items_itemID = items.itemID
                WHERE items.sections_sectionID = ?';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('i', $sectionID);
        $stmt->execute();
        $stmt->bind_result($content, $title, $itemID);

        while ($stmt->fetch()) { ?>            
                <div class="item">
                    <div class="item-top">
                        <button title="Delete item" class="delete-item-modal-btn delete" data-item-id="<?=$itemID?>"><img src="gfx/trashcan-black.svg" alt="Delete"></button>

                        <input name="title"  placeholder="<?php if (empty($title)) {echo 'Title (Must be unique within section)';}; ?>" <?php if (!empty($title)) {echo htmlspecialchars("value='".$title."'");};?> class="item-title">
                    </div>

                    <div>
                        <textarea name="content" placeholder="<?php if (empty($content)) {echo 'Write your content here';}; ?>"  class="item-content"><?php if (!empty($content)) {echo htmlspecialchars($content);};?></textarea>
                    </div>
                    
                    <div>
                        <button type="submit" name="saveItem" data-item-id="<?=$itemID?>" data-item-title="<?=$title?>" data-item-content="<?=$content?>" value="saveItem" class="CTA-btn filled update-item-modal-btn">Save</button>

                        <a href="<?=$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>"><button type="submit" name="cancel" value="cancel" class="CTA-btn outlined">Cancel</button></a>
                    </div>
                </div>
<?php
        }
    }
?>

</div>
