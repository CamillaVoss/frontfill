<?php
header("Content-Type:application/json");
include 'include/api_db_functions.php';

if (!empty($_GET['api-key']) && !empty($_GET['section']) && !empty($_GET['item'])) {

	$api_key = $_GET['api-key'];
	$section = $_GET['section'];
	$item = $_GET['item'];

	$content_result = get_item_content($api_key, $section, $item);
	$content = $content_result['value'];

	if ($content_result['error'] === 'invalid-api-key') {

		response(404, "Invalid API", NULL);

	} else if (empty($content_result['error'])) {

		response(404, "Content not found", NULL);

	} else {

		response(200, "Content found", $content);

	};

} else {
	response(400, "Invalid request", NULL);
}


function response($status_code, $status_message, $content) {
	header("HTTP/1.1 ".$status_code);

	$response['status-code'] = $status_code;
	$response['status-message'] = $status_message;
	$response['content'] = $content;
	
	$response_json = json_encode($response);
	echo $response_json;
};

?>