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

?>