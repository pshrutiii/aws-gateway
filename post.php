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
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,
	        array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
	$json_response = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	$response = json_decode($json_response, true);
	return $response;
}

function postOrder($currentOrder){
	$order = json_decode($currentOrder); //de-stringify
 	$location = $order[0][0]; //FILTER based on location to respective tenant

 	$url = "http://52.53.62.62:9090/orders"; //TODO: REMOVE THIS LINE AND UNCOMMENT THE STUFF BELOW AFTER ATTACHING KONG APIS
 	/*if($location === "San Francisco"){ 
 		//hitting kong API that maps sf to 54.219.189.20:5000
 		$url = "http://52.53.140.222:8000/sf/orders"   //linking to Ashutosh 	
 	}else if ($location === "Los Angeles"){
 		//hitting kong API that maps la to X.X.X.X:3000
 		$url = "http://52.53.140.222:8000/la/orders"   //linking to Arunabh
 	}*/

	$result = post_data($url, $order); 	//POSTS order
	echo "---------Your data has been posted!!!--------";
	//print_r($result);

	//$currentOrderId = $result["orders"]["_id"]; //TODO: how to get the id of the order JUST PLACED???
	confirmOrder($currentOrderId, $result);
}

function confirmOrder($thisOrderID, $result){
	//TODO: MAKE A PRETTY UI TO REPLACE UP IN THE INDEX.PHP PAGE
 	echo "";
 	echo ("<p id='heading'>Confirm Order</p>");
 	echo ("<hr style='border:1px solid #006341;margin: 0px;'>");
 	//print_r($result);
 	echo ("<dl>");
 	for($i=0; $i<count($result["orders"]); $i++){
 		if($result["orders"][$i]["order_id"] === $thisOrderID){
 			for($j=0;$j<count($result["orders"][$i]["items"]);$j++){
				echo ("<dt>".$result["orders"][$i]["items"][$j]["qty"]. " " .$result["orders"][$i]["items"][$j]["size"]. " " . $result["orders"][$i]["items"][0]["name"]."</dt>");
				echo ("<dd>".$result["orders"][$i]["items"][$j]["milk_type"]."</dd>"); //TODO: change milk_type to milk
		    }
		    echo ("</dl>");
 			echo ("<hr style='border:1px solid #006341;margin: 0px;'>");
 			echo ("<p style='text-align: right;'>Order Total $". $result["orders"][0]["amount"]."</p>");
 		}
 	}
 	echo "<button type='submit' class='btn btn-block' style='background: #006341; color: white; font-size: 15px; font-weight: 600;''>PAY</button>";

 	//if($result["orders"]["_id"])
 	//echo ("Size ====> ".$result["orders"][0]["items"][0]["size"]);
 	/*for($i=0;$i<count($result["orders"][$i]["items"]);$i++){
		echo ("<p>".$result["orders"][$i]["items"][0]["size"]. " " . $result["orders"][$i]["items"][0]["name"]."</p>");
		echo ("<p>".$result["orders"][$i]["items"][0]["milk_type"]."</p>"); //TODO: change milk_type to milk
    }
    
 	echo ("<div class='col-sm-7'>");
 	echo ("<div class='row'>");
	echo ("<div class='col-xs-12'>");
	echo ("<div class='table-responsive'>");
	echo ("<table class='table preview-table'>");
	echo ("<thead><tr><th>ID</th><th>$$</th><th>Location</th><th>Status</th><th>Mssg</th><th>Num of Items</th></tr></thead>"); 
	echo ("<tbody>");
    for($i=0;$i<count($result);$i++){
        echo "<tr><td>".$result["orders"][$i]["order_id"]. //order id TODO:our's is _id and not order_id
        	"</td><td>".$result["orders"][$i]["amount"]. //total price
            "</td><td>".$result["orders"][$i]["location"]. //pickup location
            "</td><td>".$result["orders"][$i]["status"]. //status
            "</td><td>".$result["orders"][$i]["message"]. //current message
            "</td><td>".count($result["orders"][$i]["items"]). //number of line items ordered
            "</td></tr>";
    }
    echo ("</tbody></table></div></div></div></div>");*/

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
	//postOrder($order); TODO: uncomment this!!

	//TODO: CLEAN THIS UP... it's only for testing!
	$url = "http://52.53.62.62:9090/orders";
	$result = get_data($url);
	$thisOrderID = "92977b6d-7a84-4547-9ec1-813b6ccfdbd1";
	confirmOrder($thisOrderID, $result);
}
 
?>