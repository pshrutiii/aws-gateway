<?php
function get_data($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $result;
}

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
	$link = $_REQUEST['link'];
	$result = get_data($link);
	$json_arr = json_decode($result, true);
	echo count($json_arr['orders']); //TODO: make it return only the count!!
}
?>