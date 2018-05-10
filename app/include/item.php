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
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                        <div class="item-top">
                            <input name="title"  placeholder="<?php if (!empty($title)) {echo $title;}; ?>Title (must be unique)" class="item-title" required>

                            <button title="Delete" type="submit" name="delete" value="delete" class="delete"><img src="gfx/trashcan-black.svg" alt="trash can"></button>
                            <input name="sectionID" value="<?=$sectionID?>" hidden>
                        </div>

                        <div>
                            <textarea placeholder="<?php if (!empty($title)) {echo $title;}; ?>Write your content here.." class="item-content"></textarea>
                        </div>
                        
                        <div>
                            <button type="submit" name="save" value="save" class="CTA-btn filled">Save</button>

                            <button type="submit" name="cancel" value="cancel" class="CTA-btn outlined">Cancel</button>
                        </div>
                    </form> 
                </div>
<?php
        }
    }
?>

</div>
