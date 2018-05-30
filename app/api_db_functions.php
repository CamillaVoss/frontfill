<?php
function get_item_content($api_key, $section, $item) {
	$result['error'] = null;
	$result['value'] = null;

	require_once('db_con.php');

	$sql = 'SELECT userID FROM users WHERE apikey = ?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $api_key);
	$stmt->execute();
	$stmt->bind_result($userID);
	$stmt->fetch();

	if (empty($userID)) {
		$result['error'] = 'invalid-api-key';
		return $result;
	}

	$stmt->close();

	$sql = 'SELECT content
            FROM fields
            INNER JOIN items   
            ON fields.items_itemID = items.itemID
            INNER JOIN sections
            ON items.sections_sectionID = sections.sectionID
            WHERE sections.title = ?
            AND items.title = ?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ss', $section, $item);
    $stmt->execute();
    $stmt->bind_result($content);
    $stmt->fetch();

	// success
	$result['value'] = $content;
	return $result;
};


function get_section_content($api_key, $section) {
	$result['error'] = null;
	$result['value'] = null;

	require_once('db_con.php');

	$sql = 'SELECT userID FROM users WHERE apikey = ?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $api_key);
	$stmt->execute();
	$stmt->bind_result($userID);
	$stmt->fetch();

	if (empty($userID)) {
		$result['error'] = 'invalid-api-key';
		return $result;
	}

	$stmt->close();

	$sql = 'SELECT items.title
            FROM items
            INNER JOIN sections
            ON items.sections_sectionID = sections.sectionID
            WHERE sections.title = ?';
	$stmt = $con->prepare($sql);
    $stmt->bind_param('s', $section);
    $stmt->execute();
    $stmt->bind_result($item);
	$items = array();
	while ($stmt->fetch()) { 
		$items[] = $item;
	}

	$stmt->close();

	$contents = array();

	foreach ($items as $item) {
		$sql = 'SELECT content
		         FROM fields
		         INNER JOIN items   
		         ON fields.items_itemID = items.itemID
		         INNER JOIN sections
		         ON items.sections_sectionID = sections.sectionID
		         WHERE sections.title = ?
		         AND items.title = ?';
		$stmt = $con->prepare($sql);
	    $stmt->bind_param('ss', $section, $item);
	    $stmt->execute();
	    $stmt->bind_result($content);
		$stmt->fetch();

		$contents[$item] = $content;

		$stmt->close();
	}
	
	// success
	$result['value'] = $contents;
	return $result;
};


function get_user_content($api_key) {
	$result['error'] = null;
	$result['value'] = null;

	require_once('db_con.php');

	$sql = 'SELECT userID FROM users WHERE apikey = ?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $api_key);
	$stmt->execute();
	$stmt->bind_result($userID);
	$stmt->fetch();

	if (empty($userID)) {
		$result['error'] = 'invalid-api-key';
		return $result;
	}

	$stmt->close();

	$sql = 'SELECT title
            FROM sections
            WHERE users_userID = ?';
	$stmt = $con->prepare($sql);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $stmt->bind_result($section);
	$sections = array();
	while ($stmt->fetch()) { 
		$sections[] = $section;
	}

	$stmt->close();

	$items_by_section = array();

	foreach ($sections as $section) {
		$sql = 'SELECT items.title
	            FROM items
	            INNER JOIN sections
	            ON items.sections_sectionID = sections.sectionID
	            WHERE sections.title = ?';
		$stmt = $con->prepare($sql);
	    $stmt->bind_param('s', $section);
	    $stmt->execute();
	    $stmt->bind_result($item);
		while ($stmt->fetch()) { 
			$items_by_section[$section][] = $item;
		}

		$stmt->close();
	}

	$contents = array();

	foreach ($items_by_section as $section => $items) {
		$section_data = array();
		foreach ($items as $item) {
			$sql = 'SELECT content
			        FROM fields
			        INNER JOIN items   
			        ON fields.items_itemID = items.itemID
			        INNER JOIN sections
			        ON items.sections_sectionID = sections.sectionID
			        WHERE sections.title = ?
			        AND items.title = ?';
			$stmt = $con->prepare($sql);
		    $stmt->bind_param('ss', $section, $item);
		    $stmt->execute();
		    $stmt->bind_result($content);
			$stmt->fetch();

			$section_data[$item] = $content;

			$stmt->close();
		}
		$contents[$section] = $section_data;
	}
	
	// success
	$result['value'] = $contents;
	return $result;
};

?>