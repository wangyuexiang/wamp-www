<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
require("config.php");
 
// array for JSON response
$response = array();
 
// check for required fields
// if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {
 
    // $name = $_POST['name'];
    // $price = $_POST['price'];
    // $description = $_POST['description'];
 
 if(!empty($_POST)){
	 if(empty($_POST['name'])){
		 $response["success"]=0;
		 $response["message"]="Please Enter the Product Name.";
		 die(json_encode($response));
	 }

 
 		$query = "INSERT INTO products(name, price, description) VALUES(:name, :price, :description)";
		$query_pqrqms = array(
			':name' => $_POST['name'];
			':price' => $_POST['price'];
			':description' => $_POST['description'];
		);
		
    // include db connect class
    // require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    // $db = new DB_CONNECT();
 
    // mysql inserting a new row
    // $result = mysql_query("INSERT INTO products(name, price, description) VALUES('$name', '$price', '$description')");

		$stmt = $db->prepare($query);
		$stmt -> execute();
    $result = $stmt -> fetchAll();
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>