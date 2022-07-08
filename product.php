<?php
include_once 'connection.php';


class Product{
    

function read(){	
	if($this->id) {
		$stmt = $this->conn->prepare("SELECT * FROM ".$this->product_table." WHERE id = ?");
		$stmt->bind_param("i", $this->id);					
	} else {
		$stmt = $this->conn->prepare("SELECT * FROM ".$this->product_table);		
	}		
	$stmt->execute();			
	$result = $stmt->get_result();		
	return $result;	
}

public function create(){
		
	$stmt = $this->conn->prepare("INSERT INTO ".$this->product_table."(id, name, descr, img, multipleimg, price, qty)
		VALUES(?,?,?,?,?,?,?)");
	
	$this->id = htmlspecialchars(strip_tags($this->id));
	$this->name = htmlspecialchars(strip_tags($this->name));
	$this->descr = htmlspecialchars(strip_tags($this->descr));
	$this->img = htmlspecialchars(strip_tags($this->img));
	$this->multipleimg = htmlspecialchars(strip_tags($this->multipleimg));
	$this->price = htmlspecialchars(strip_tags($this->price));
	$this->qty = htmlspecialchars(strip_tags($this->qty));

	
	$stmt->bind_param('sisssss', $this->id, $this->name, $this->price, $this->descr, $this->img, $this->qty, $this->multipleimg);
	
	if($stmt->execute()){
		return true;
	}
 
	return false;		 
}
public function update(){
    $stmt = $this->conn->prepare("UPDATE".$this->product_table."SET id= ?, name = ?, desc = ?, img = ?, multipleimg = ?, price = ?, qty = ?");
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->descr = htmlspecialchars(strip_tags($this->descr));
        $this->img = htmlspecialchars(strip_tags($this->img));
        $this->multipleimg = htmlspecialchars(strip_tags($this->multipleimg));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->qty = htmlspecialchars(strip_tags($this->qty));
    
        
        $stmt->bind_param('sisssss', $this->id, $this->name, $this->price, $this->descr, $this->img, $this->qty, $this->multipleimg);
	if($stmt->execute()){
		return true;
	}
 
	return false;
}
function delete(){
	
	$stmt = $this->conn->prepare("DELETE FROM ".$this->productTable." WHERE id = ?");
		
	$this->id = htmlspecialchars(strip_tags($this->id));
 
	$stmt->bind_param("i", $this->id);
 
	if($stmt->execute()){
		return true;
	}
 
	return false;		 
}
	
}
?>