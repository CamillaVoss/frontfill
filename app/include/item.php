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
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?' . htmlspecialchars($_SERVER['QUERY_STRING']); ?>" method="POST"> 
                    <div class="item-top">
                        <button title="Delete item" class="delete-item-modal-btn delete" data-item-id="<?=$itemID?>"><img src="gfx/trashcan-black.svg" alt="Delete"></button> 
                        <?php if (empty($title)) { ?>
                            <input name="title"  placeholder="Title (Must be unique within section)" class="item-title">
                        <?php } else {?>
                            <h3><?=$title?></h3>
                        <?php } ?>
                    </div>

                    <div>
                        <textarea name="content" placeholder="<?php if (empty($content)) {echo 'Write your content here';}; ?>"  class="item-content"><?php if (!empty($content)) {echo htmlspecialchars($content);};?></textarea>
                    </div>
                        
                    <div>
                        <input name="itemID" value="<?=$itemID?>" type="hidden">
                        <button type="submit" name="saveItem" value="saveItem" class="CTA-btn filled">Save</button>

                        <a class="CTA-btn outlined" href="<?=$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>">Cancel</a>
                    </div>
                </form> 
                </div>
<?php
        }
    }
?>

</div>
