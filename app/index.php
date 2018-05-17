<?php 
	include 'include/db_functions.php';

	if (empty($_SESSION['userID'])) {
		header("Location: signin.php");
	} else {
		$userID = $_SESSION['userID'];
	}


	require_once('include/db_con.php');
	$sql = 'SELECT sectionID FROM sections WHERE users_userID = ? LIMIT 1';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $userID);
	$stmt->execute();
	$stmt->bind_result($sectionID);
	$sectionIDs = array();
	while ($stmt->fetch()) { 
		array_push($sectionIDs, $sectionID);
	}

	if (empty($_SERVER['QUERY_STRING'])) {
		header("Location: index.php?sectionID=".$sectionIDs[0]);
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
        <meta property="og:site_name" content="Frontfill"/>
        <meta property="og:title" content="Dynamic content app"/>
        <meta property="og:description" content="It is time to make your static site dynamic!"/>
		<meta property="og:image" content="gfx/share.png">
		<meta property="og:url" content="http://frontfill.com/">
        <title>Frontfill | Dynamic content app</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" 
      		  type="image/png" 
      		  href="gfx/favicon.png">

    </head>
    <body>
        <div class="dashboard">
            <?php include 'include/modals.php'; ?>
        	<div class="sidebar">
        		<div class="sidebar-logo"></div>
        		<div class="divider"></div>
        		<div class="section add-section">
    				<button title="Add section" class="create-section-modal-btn"><img src="gfx/add.svg" alt="Add"></button>
        			<h4>Sections</h4>
        		</div>
        		<div class="divider"></div>
        		<?php
        			if (!empty($_SESSION['userID'])) {
						$userID = $_SESSION['userID'];

						require_once('include/db_con.php');
						$sql = 'SELECT title, sectionID FROM sections WHERE users_userID = ?';
						$stmt = $con->prepare($sql);
						$stmt->bind_param('i', $userID);
						$stmt->execute();
						$stmt->bind_result($title, $sectionID);
						$sections = array();
						while ($stmt->fetch()) { 
							array_push($sections, $sectionID);?>
							<div class="section delete-section">
			        				<button title="Delete section" class="delete-section-modal-btn" data-section-id="<?=$sectionID?>"><img src="gfx/trashcan.svg" alt="Delete"></button>
			        			<h4><a href=index.php?sectionID=<?=$sectionID?> class="<?php if ($secID == $sectionID) {echo 'active';}; ?>"><?=$title?></a></h4>
			        		</div>
			        		<div class="divider"></div>
				<?php
						}
					}
        		?>
        	</div>

        	<div class="content <?php if (!empty($sections)) {echo 'not-empty';}; ?>">
        		<nav class="navigation">
        			<div class="navigation-left">
        				<button class="menu">&#9776;</button>
        			</div>
		        	<div class="navigation-right">
		            	<ul>
			             	<li><a href="documentation.php">Documentaion</a></li>
			             	<li><a href="include/signout.php">Sign Out</a></li>
			            </ul>
		            </div>
		        </nav>

		        <div class="content-area">	
		        	<?php include 'include/alerts.php';?>	
					<?php
						if (!empty($sections)) {
							include 'include/item.php';
			        		?>
			        		<div class="new-item">
			        			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?' . htmlspecialchars($_SERVER['QUERY_STRING']); ?>" method="POST">
			        				<button type="submit" name="addItem" value="addItem" class="CTA-btn filled">Add new item</button>
			        			</form>	
			        		</div> 
							<?php
						}
	        		?>
        		</div>
        	</div>
    	</div>

		<?php include 'include/scripts.php';?>

    </body>
</html>