<?php 
function get_data($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

$shruti_url = "http://52.53.140.222:8000/example/orders ";
$shruti_result = get_data($shruti_url);
$shruti_rows = json_decode($shruti_result);

echo $shruti_result
?>