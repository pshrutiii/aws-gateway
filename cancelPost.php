<?php
function delete_data($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $result;
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$link = $_REQUEST['link'];
	delete_data($link);
}
?>