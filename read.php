<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include "connection.php";
include "product.php";
$conn= new mysqli('localhost','root','','productapi');

$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);

$product->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $product->read();

if($result->num_rows > 0){    
    $products_arr=array();
    $products_arr["records"]=array(); 
	while ($row = $result->fetch_assoc()) { 	
        extract($row); 
        $product_item=array(
            "id" => $id,
            "name" => $name,
            "descr" => $descr,
			"img" => $img,
            "multipleimg" => $multipleimg,
            "price" => $price,
            "qty" => $qty		
        ); 
       array_push($products_arr["records"], $product_item);
    }    
    http_response_code(200);     
    echo json_encode($products_arr);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No products found.")
    );
} 