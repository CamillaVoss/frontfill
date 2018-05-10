<?php
session_start();

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
}



?>