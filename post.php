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

function postOrder($order2DArray){
	$orders = json_decode($order2DArray); //de-stringify
 	$location = $orders[0][0]; //FILTER based on location to respective tenant

 	$url = "http://52.53.62.62:9090/orders"; //TODO: REMOVE THIS LINE AND UNCOMMENT THE STUFF BELOW AFTER ATTACHING KONG APIS
 	/*if($location === "San Francisco"){ 
 		//hitting kong API that maps sf to 54.219.189.20:5000
 		$url = "http://52.53.140.222:8000/sf/orders"   //linking to Ashutosh 	
 	}else if ($location === "Los Angeles"){
 		//hitting kong API that maps la to X.X.X.X:3000
 		$url = "http://52.53.140.222:8000/la/orders"   //linking to Arunabh
 	}*/
 	
 	$result = get_data($url); 	
	//print_r($result);

	//TODO: MAKE A PRETTY UI TO REPLACE UP IN THE INDEX.PHP PAGE
 	echo "";
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
    echo ("</tbody></table></div></div></div></div>");


/*	GENERAL INDEX | HOW TO READ JSON DATA!
 	result["orders"] <-- ALL orders
 	result["orders"][0] <-- 1st order in the array
 	result["orders"][0]["amount"] <-- 1st order total cost*/

 	    
}

//When a user POST an order, it comes to this php and returns following response back to form-script.js
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	$order = $_REQUEST['Orderdata'];
	postOrder($order); //TODO: currently it's GETTING ALL ORDERS as i didn't have LIVE link to work with!
}
 
?>