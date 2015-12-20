<?php
	// Following code will list all the products
	require('config.php');
 
	// array for JSON response
	$response = array();
	 
	// get all products from products table
	$query = "SELECT * FROM products";
	try{
		$stmt = $db->prepare($query); 
		$stmt->execute();
	}
	catch(PDOException $ex){
		$response["success"] = 0;
		$response["message"] = "Database Error.";
		die(json_encode($response));
	}

	// set the resulting array to associative
	$result = $stmt->fetchAll(); 
		
	// check for empty result
	if ($result) {
		// looping through all results
		// products node
		$response["products"] = array();
 
		foreach ($result as $row) {
			// temp user array
			$product = array();
			$product["pid"] = $row["pid"];
			$product["name"] = $row["name"];
			$product["price"] = $row["price"];
			$product["created_at"] = $row["created_at"];
			$product["updated_at"] = $row["updated_at"];
 
			// push single product into final response array
			array_push($response["products"], $product);
		}
		// success
		$response["success"] = 1;
	 
		// echoing JSON response
		echo json_encode($response);
	} else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "No products found";
 
		// echo no users JSON
		echo json_encode($response);
	}
	?>