<?php  
class database{

	//DB Params
	private $dns = "mysql:host=bkjwkzrx3hols4hf37li-mysql.services.clever-cloud.com;dbname=bkjwkzrx3hols4hf37li";
	private $username = "uhbvrnllxdbu8m7i";
	private $password = "o3J1LyWxMUtMxNevG3gA";
	private $conn;

	//DB Connect
	public function connect(){
		$this->conn = null;
		try{
			$this->conn = new PDO($this->dns,$this->username,$this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}catch(PDOException $e){
			echo "Connection failed: ".$e->getMessage();
		}

		return $this->conn;
	}
}
?>

