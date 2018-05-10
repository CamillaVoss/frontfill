<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Frontfill | Dynamic content app</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="dashboard">
        	<div class="sidebar">
        		<div class="sidebar-logo"></div>
        		<div class="divider"></div>
        		<div class="section add-section">
        			<button title="Add section"><img src="gfx/add.svg" alt="Add"></button>
        			<h4>Sections</h4>
        		</div>
        		<div class="divider"></div>
        	</div>

        	<div class="content">
        		<nav class="navigation">
		        	<div class="navigation-right">
		            	<ul>
			             	<li><a href="#">API Key</a></li>
			             	<li><a href="#">Documentaion</a></li>
			             	<li><a href="#">Sign Out</a></li>
			            </ul>
		            </div>
		        </nav>
				
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

        		<div class="new-item">
        			<button name="add-item" value="add-item" class="CTA-btn filled">Add new</button>
        		</div>
        	</div>
    	</div>
    </body>
</html>