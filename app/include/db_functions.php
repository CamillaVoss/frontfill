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

	$title = 'Section';

	$userID = $_SESSION['userID'];

	require_once('db_con.php');
	$sql = 'INSERT INTO sections (title, users_userID) VALUES (?, ?)';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('si', $title, $userID);
	$stmt->execute();

	$_SESSION['add_section'] = true;
}


//////////////////////////
//    Delete Section    //
//////////////////////////

if (filter_input(INPUT_POST, 'deleteSection')) {

	$sectionID = filter_input(INPUT_POST, 'sectionID');

	require_once('db_con.php');
	$sql = 'DELETE FROM sections WHERE sectionID = ?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $sectionID);
	$stmt->execute();

	$_SESSION['delete_section'] = true;
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
	$stmt->execute();

	$itemID = $stmt->insert_id;

	$sql = 'INSERT INTO fields (row, col, items_itemID) VALUES (?, ?, ?)';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('iii', $row, $col, $itemID);
	$stmt->execute();

	$_SESSION['add_item'] = true;
}


//////////////////////////
//    Update Item       //
//////////////////////////

if (filter_input(INPUT_POST, 'saveItem')) {
	
	$itemID = filter_input(INPUT_POST,'itemID');
	$title = filter_input(INPUT_POST,'itemTitle');
	$content = filter_input(INPUT_POST,'itemContent');

	echo $itemID;
	echo "lel";
	echo $title;
	echo "lol";
	echo $content;	

	require_once('db_con.php');

	$con->autocommit(FALSE);
    $con->begin_transaction();

    $sql = 'UPDATE items
    		SET title = ?
    		WHERE itemID = ?';
    $stmt = $con->prepare($sql);
    $stmt-> bind_param('si', $title, $itemID);

    if (!$stmt->execute()) {
        $con->rollback();
        die('Item update failed');
    };

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
}


//////////////////////////
//    Delete Item       //
//////////////////////////

if (filter_input(INPUT_POST, 'deleteItem')) {
	
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
}



?>