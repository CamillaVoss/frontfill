<?php
session_start();
$exists = false;
$login_failure = false;

//////////////////////////
//     Sign up          //
//////////////////////////

if (filter_input(INPUT_POST, 'signup')) {

	$email = filter_input(INPUT_POST,'email')
		or die('You must enter a valid email');

	$password = filter_input(INPUT_POST,'password')
		or die('You must enter a valid password');

	require_once('db_con.php');
	$sql = 'SELECT userID FROM users WHERE email = ?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$stmt->bind_result($userID);
	while ($stmt->fetch()) {}


	if (!empty($userID)) {
		$exists = true;
	} else {
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$sql = 'INSERT INTO users (email, hpassword) VALUES (?, ?)';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ss', $email, $hashed_password);
		$stmt->execute();

		$userID = $stmt->insert_id;

		do {		
			$apikey = uniqid();

			$sql = 'SELECT apikey FROM users WHERE apikey = ?';
			$stmt = $con->prepare($sql);
			$stmt->bind_param('s', $apikey);
			$stmt->execute();
			$stmt->bind_result($newapikey);
			$apikeys = array();
			while ($stmt->fetch()) {
				array_push($apikeys, $newapikey);
			}

		} while (!empty($apikeys));

		if (!empty($apikeys)) {
			$apikeys = $newapikey;
		};

		$sql = 'UPDATE users
				SET apikey = ?
				WHERE userID = ?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('si', $apikey, $userID);
		$stmt->execute();

		$_SESSION['create_succes'] = true;
		header("Location: signin.php");
		die();
	}
}


//////////////////////////
//     Sign in          //
//////////////////////////

if (filter_input(INPUT_POST, 'signin')) {

	$email = filter_input(INPUT_POST,'email')
		or die('You must enter a valid username');

	$password = filter_input(INPUT_POST,'password')
		or die('You must enter a valid password');

	require_once('db_con.php');	
	$sql = 'SELECT userID, hpassword 
			FROM users 
			WHERE email = ?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$stmt->bind_result($userID, $hashed_password);

	while ($stmt->fetch()) {
		
	}

	if (password_verify($password, $hashed_password)) {
		$_SESSION['userID'] = $userID;
		header("Location: index.php");
		die();
	} else {
		$login_failure = true;
	}				
}


//////////////////////////
//     Add Section      //
//////////////////////////

if (filter_input(INPUT_POST, 'addSection')) { 

	$title = filter_input(INPUT_POST,'title');

	$userID = $_SESSION['userID'];

	require_once('db_con.php');

	$sql = 'SELECT sectionID 
			FROM sections 
			WHERE title = ?
			AND users_userID = ?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('si', $title, $userID);
	$stmt->execute();
	$stmt->bind_result($sectionID);
	while ($stmt->fetch()) {}

	if (empty($sectionID)) {
		$sql = 'INSERT INTO sections (title, users_userID) VALUES (?, ?)';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('si', $title, $userID);
		$stmt->execute();

		$_SESSION['add_section'] = true;

		$sectionID = $stmt->insert_id;

		header("Location: index.php?sectionID=".$sectionID);
		die('');

	} else {
		$_SESSION['section_exists'] = true;
	}
}


//////////////////////////
//    Delete Section    //
//////////////////////////

if (filter_input(INPUT_POST, 'deleteSection')) {

	$sectionID = filter_input(INPUT_POST, 'sectionID');

	require_once('db_con.php');
	$con->autocommit(FALSE);
    $con->begin_transaction();

    $sql = 'DELETE fields.*
    		FROM fields
			INNER JOIN items
			ON items_itemID = itemID
			WHERE sections_sectionID = ?';
    $stmt = $con->prepare($sql);
    $stmt-> bind_param('i', $sectionID);

    if (!$stmt->execute()) {
        $con->rollback();
        die('field delete failed');
    };

    $sql = 'DELETE FROM items
    		WHERE sections_sectionID = ?';
    $stmt = $con->prepare($sql);
    $stmt-> bind_param('i', $sectionID);

    if (!$stmt->execute()) {
        $con->rollback();
        die('Item delete failed');
    };

    $sql = 'DELETE FROM sections
    		WHERE sectionID = ?';
    $stmt = $con->prepare($sql);
    $stmt-> bind_param('i', $sectionID);

    if (!$stmt->execute()) {
        $con->rollback();
        die('Section delete failed');
    };

    $con->commit();

    header("Location: index.php");
	die('');
}


//////////////////////////
//      Add Item        //
//////////////////////////

if (filter_input(INPUT_POST, 'addItem')) { 

	$sectionID = $_GET['sectionID'];
	$type = 0;
	$numbOfCol = 1;

	$row = 1;
	$col = 1;

	require_once('db_con.php');
	$sql = 'INSERT INTO items (sections_sectionID, type, numbOfCol) VALUES (?, ?, ?)';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('iii', $sectionID, $type, $numbOfCol);
	if (!$stmt->execute()) {
		printf("Error message: %s\n", $con->error);
		die();
	}

	$itemID = $stmt->insert_id;

	$sql = 'INSERT INTO fields (row, col, items_itemID) VALUES (?, ?, ?)';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('iii', $row, $col, $itemID);
	if (!$stmt->execute()) {
		printf("Error message: %s\n", $con->error);
		die();
	}

	$_SESSION['add_item'] = true;

	header("Location: index.php?sectionID=".$sectionID);
	die('');
}


//////////////////////////
//    Update Item       //
//////////////////////////

if (filter_input(INPUT_POST, 'saveItem')) {
	
	$sectionID = $_GET['sectionID'];
	$itemID = filter_input(INPUT_POST,'itemID');
	$title = filter_input(INPUT_POST,'title');
	$content = filter_input(INPUT_POST,'content');	

	require_once('db_con.php');

	$sql = 'SELECT itemID 
			FROM items 
			WHERE title = ?
			AND sections_sectionID = ?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('si', $title, $sectionID);
	$stmt->execute();
	$stmt->bind_result($itemIDs);
	while ($stmt->fetch()) {}

	if (empty($itemIDs)) {

		$con->autocommit(FALSE);
	    $con->begin_transaction();

	    if (!empty($title)) {
	    	$sql = 'UPDATE items
					SET title = ?
					WHERE itemID = ?';
			$stmt = $con->prepare($sql);
			$stmt-> bind_param('si', $title, $itemID);

			if (!$stmt->execute()) {
			    $con->rollback();
			    die('Item update failed');
			};
	    }

	    $sql = 'UPDATE fields
	    		SET content = ?
	    		WHERE items_itemID = ?';
	    $stmt = $con->prepare($sql);
	    $stmt-> bind_param('si', $content, $itemID);

	    if (!$stmt->execute()) {
	        $con->rollback();
	        die('Item update failed');
	    };

	    $con->commit();

	    $_SESSION['update_item'] = true;

	} else {
		$_SESSION['item_exists'] = true;
	}

	header("Location: index.php?sectionID=".$sectionID);
	die('');
}


//////////////////////////
//    Delete Item       //
//////////////////////////

if (filter_input(INPUT_POST, 'deleteItem')) {
	
	$sectionID = $_GET['sectionID'];
	$itemID = filter_input(INPUT_POST,'itemID');

	require_once('db_con.php');

	$con->autocommit(FALSE);
    $con->begin_transaction();

    $sql = 'DELETE FROM fields
    		WHERE items_itemID = ?';
    $stmt = $con->prepare($sql);
    $stmt-> bind_param('i', $itemID);

    if (!$stmt->execute()) {
        $con->rollback();
        die('Item delete failed');
    };

    $sql = 'DELETE FROM items
    		WHERE itemID = ?';
    $stmt = $con->prepare($sql);
    $stmt-> bind_param('i', $itemID);

    if (!$stmt->execute()) {
        $con->rollback();
        die('Item delete failed');
    };

    $con->commit();

    $_SESSION['delete_item'] = true;

    header("Location: index.php?sectionID=".$sectionID);
	die('');
}



?>