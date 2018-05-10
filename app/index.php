<?php 
	include 'include/db_functions.php';

	if (empty($_SESSION['userID'])) {
		header("Location: signin.php");
	} elseif (empty($_SERVER['QUERY_STRING'])) {
		$userID = $_SESSION['userID'];

		require_once('include/db_con.php');
		$sql = 'SELECT sectionID FROM sections WHERE users_userID = ? LIMIT 1';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('i', $userID);
		$stmt->execute();
		$stmt->bind_result($sectionID);
		$stmt->fetch();
		
		header("Location: index.php?sectionID=".$sectionID);
		die('');
	}

	$secID = filter_input(INPUT_GET, 'sectionID', FILTER_VALIDATE_INT);
?>

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
        			<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        				<button type="submit" name="addSection" value="addSection"  title="Add section"><img src="gfx/add.svg" alt="Add"></button>
    				</form>
        			<h4>Sections</h4>
        		</div>
        		<div class="divider"></div>
        		<?php
        			if (!empty($_SESSION['userID'])) {
        				$count = 0;
						$userID = $_SESSION['userID'];

						require_once('include/db_con.php');
						$sql = 'SELECT title, sectionID FROM sections WHERE users_userID = ?';
						$stmt = $con->prepare($sql);
						$stmt->bind_param('i', $userID);
						$stmt->execute();
						$stmt->bind_result($title, $sectionID);
						$sections = $stmt;
						while ($stmt->fetch()) { ?>
							<div class="section delete-section">
			        			<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
			        				<button type="submit" name="deleteSection" value="deleteSection"  title="Add section"><img src="gfx/trashcan.svg" alt="Delete"></button>
			        				<input name="sectionID" value="<?=$sectionID?>" hidden>
			    				</form>
			        			<h4><a href=index.php?sectionID=<?=$sectionID?> class="<?php if ($secID == $sectionID) {echo 'active';}; ?>"><?=$title?> <?php echo ++$count; ?></a></h4>
			        		</div>
			        		<div class="divider"></div>
				<?php
						}
					}
        		?>
        	</div>

        	<div class="content <?php if (!empty($sections)) {echo 'not-empty';}; ?>">
        		<nav class="navigation">
		        	<div class="navigation-right">
		            	<ul>
			             	<li><a href="#">API Key</a></li>
			             	<li><a href="#">Documentaion</a></li>
			             	<li><a href="include/signout.php">Sign Out</a></li>
			            </ul>
		            </div>
		        </nav>

		        <div class="content-area">				
					<?php
						if (!empty($sections)) {
							include 'include/item.php';
			        		?>
			        		<div class="new-item">
			        			<form action="<?=$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>" method="POST">
			        				<button type="submit" name="addItem" value="addItem" class="CTA-btn filled">Add new item</button>
			        			</form>	
			        		</div> 
							<?php
						}
	        		?>
        		</div>
        	</div>
    	</div>
    </body>
</html>