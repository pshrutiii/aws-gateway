<?php

function get_data($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    //$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $response = json_decode($data, true);
    curl_close($ch);
    return $response;
}

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
	echo "---------Your data has been posted!!!--------<br/>";
	//print_r($result);	
	$currentOrderId = $result['order']["_id"];
	confirmOrder($currentOrderId, $result, $url);
}

function confirmOrder($thisOrderID, $result, $url){
	//TODO: MAKE A PRETTY UI TO REPLACE UP IN THE INDEX.PHP PAGE
	$location = $result['order']["location"];

	echo "";
	echo ("<p id='heading'>Confirm Order</p>");
	if($location === "San Francisco"){ 
 		echo ("<hr style='border:1px solid #006341;margin: 0px;'>");
 		echo ("<p>201 Powell St,<br/> San Francisco,<br/> CA 94102</p>");
 	}else if($location === "Los Angeles"){
 		echo ("<hr style='border:1px solid #006341;margin: 0px;'>");
 		echo ("<p>800 W. Olympic Blvd., 102,<br/> Los Angeles,<br/> CA 90015</p>");
 	}	
 	//print_r($result);
 	echo ("<dl>");
	if($result["order"]["_id"] === $thisOrderID){
		for($j=0;$j<count($result["order"]["items"]);$j++){
		echo ("<dt>".$result["order"]["items"][$j]["qty"]. " " .$result["order"]["items"][$j]["size"]. " " . $result["order"]["items"][0]["name"]."</dt>");
		echo ("<dd>".$result["order"]["items"][$j]["milk"]."</dd>"); //TODO: change milk to milk
    	}
    	echo ("</dl>");
		echo ("<hr style='border:1px dashed #006341;margin: 0px;'>");
		echo ("<p style='text-align: right;padding: 3% 0 8% 0; font-weight:600;'>Order Total $". $result["order"]["amount"]."</p>");
	}
 	$deleteLink = $url . $result["order"]["links"][0]["delete"];
 	$payLink = $url. $result["order"]["links"][0]["pay"];
 	echo "<div class='row'><div class='col-xs-6'><a href='".$deleteLink."' type='submit' class='btn btn-block' style='background: #006341; color: white; font-size: 15px; font-weight: 600;''>CANCEL</a></div>";
 	echo "<div class='col-xs-6'><a href='".$payLink."' type='submit' class='btn btn-block' style='background: #006341; color: white; font-size: 15px; font-weight: 600;''>PAY</a></div></div>";
 	exit();
}

//Why is my drink taking so long?
function getAllOrders(){
	$url = "http://52.53.62.62:9090/orders"; //TODO: THIS IS HARDCODED FOR 1 TENANT ONLY...NOT needed here!
 	/*
 	//TODO: based on which location user is in, filter by that!
 	//$location = ??????
 	if($location === "San Francisco"){ 
 		//hitting kong API that maps sf to 54.219.189.20:5000
 		$url = "http://52.53.140.222:8000/sf/orders"   //linking to Ashutosh 	
 	}else if ($location === "Los Angeles"){
 		//hitting kong API that maps la to X.X.X.X:3000
 		$url = "http://52.53.140.222:8000/la/orders"   //linking to Arunabh
 	}*/
 	
 	$result = get_data($url); 	//GETS all orders
	//print_r($result);

/*	GENERAL INDEX | HOW TO READ JSON DATA!
 	result["orders"] <-- ALL orders
 	result["orders"][0] <-- 1st order in the array
 	result["orders"][0]["amount"] <-- 1st order total cost*/

 	    
}

//When a user POST an order, it comes to this php and returns following response back to form-script.js
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	$order = $_REQUEST['Orderdata'];

	//getALlOrders(); //TODO: currently it's GETTING ALL ORDERS & this is NOT needed here!
	postOrder($order); //TODO: uncomment this!!

	//TODO: CLEAN THIS UP... it's only for testing!
	#$url = "http://52.53.62.62:9090/orders";
	#$result = get_data($url);
	#$thisOrderID = "92977b6d-7a84-4547-9ec1-813b6ccfdbd1";
	#confirmOrder($thisOrderID, $result);
}
 
?>