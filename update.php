<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'connection.php';
include_once 'product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id) && !empty($data->name) &&
!empty($data->descr) && !empty($data->img) &&
!empty($data->multipleimg) &&	!empty($data->price) &&
!empty($data->qty)){    

    $product->id = $data->id;
    $product->name = $data->name;
    $product->descr = $data->descr;
    $product->img = $data->img;
	$product->multipleimg = $data->multipleimg;
	$product->price = $data->price;
	$product->qty = $data->qty; 
	
	if($product->update()){     
		http_response_code(200);   
		echo json_encode(array("message" => "Product was updated."));
	}else{    
		http_response_code(503);     
		echo json_encode(array("message" => "Unable to update product."));
	}
	
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to update product. Data is incomplete."));
}
?>