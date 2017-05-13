<?php

function post_data($url, $order){
	$content = json_encode($order);
	$url = $url . "/orders";
	$curl = curl_init($url);
	curl_setopt_array($curl, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => $content
    ));
	$json_response = curl_exec($curl);
	//$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	$response = json_decode($json_response, true);
	curl_close($curl);
	return $response;
}

function postOrder($currentOrder){
	$order = json_decode($currentOrder, true); //de-stringify
 	$location = $order["location"]; //FILTER based on location to respective tenant
 	$url = "";
 	
 	if($location === "San Francisco"){ 
 		//hitting kong API that maps sf to 54.183.148.110:5000
 		$url = "http://52.53.140.222:8000/sf";   //linking to Ashutosh 	
 	}else if ($location === "Los Angeles"){
 		//hitting kong API that maps la to 13.56.47.200:3000
 		$url = "http://52.53.140.222:8000/la";   //linking to Arunabh
 	}

	$result = post_data($url, $order); 	//POSTS order
	//print_r($result);	
	$currentOrderId = $result['order']["_id"];
	confirmOrder($currentOrderId, $result, $url);
}

function confirmOrder($thisOrderID, $result, $url){
	$location = $result['order']["location"];

	echo "";
	echo ("<p id='heading'>Confirm Order</p>");
	if($location === "San Francisco"){ 
 		echo ("<hr style='border:1px solid #006341;margin: 0px;'>");
 		echo ("<p>201 Powell St, San Francisco, CA 94102</p>");
 	}else if($location === "Los Angeles"){
 		echo ("<hr style='border:1px solid #006341;margin: 0px;'>");
 		echo ("<p>800 W. Olympic Blvd., 102, Los Angeles, CA 90015</p>");
 	}	
 	//print_r($result);
 	echo ("<dl>");
	if($result["order"]["_id"] === $thisOrderID){
		for($j=0;$j<count($result["order"]["items"]);$j++){
		echo ("<dt>".$result["order"]["items"][$j]["qty"]. " " .$result["order"]["items"][$j]["size"]. " " . $result["order"]["items"][0]["name"]."</dt>");
		echo ("<dd>".$result["order"]["items"][$j]["milk"]."</dd>"); 
    	}
    	echo ("</dl>");
		echo ("<hr style='border:1px dashed #006341;margin: 0px;'>");
		echo ("<p style='text-align: right;padding: 3% 0 8% 0; font-weight:600;'>Order Total $". $result["order"]["amount"]."</p>");
	}
 	$deleteLink = $url . $result["order"]["links"][0]["delete"];
 	$payLink = $url. $result["order"]["links"][0]["pay"];
 	$getLink = $url. "/orders";
 	echo "<div class='row'><div class='col-xs-4'><button id='cancelBtn' onclick='test()' href= '".$deleteLink."' class='btn btn-block' style='background: #006341; color: white; font-size: 15px; font-weight: 600;'>CANCEL</button></div>";
 	echo "<div class='col-xs-3'><button id='payBtn' href= '".$payLink."' onclick='test()' class='btn btn-block' style='background: #006341; color: white; font-size: 15px; font-weight: 600;'>PAY</button></div>";
 	echo "<div class='col-xs-5'><button id='showAllBtn' href= '".$getLink."' onclick='test()' class='btn btn-block' style='background: #006341; color: white; font-size: 15px; font-weight: 600;'>Current Orders</button></div></div>";
    
 	exit();
}

//When a user POST an order, it comes to this php and returns following response back to form-script.js
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$order = $_REQUEST['Orderdata'];
	postOrder($order); 
}
 
?>