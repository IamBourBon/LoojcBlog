<?php  
class subscriber{

	//DB Stuff
	private $conn;
	private $table = "blog_subscriber";

	//Blog Categories Properties
	public $n_sub_id;
	public $v_sub_email;
	public $d_date_created;
	public $d_time_created;
	public $f_sub_status;
	

	//Constructor with DB
	public function __construct($db){
		$this->conn = $db;
	}

	
	public function read(){
		$sql = "SELECT * FROM $this->table";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	}


	
	public function create(){
		//Create query
		$query = "INSERT INTO $this->table
		          SET v_sub_email = :email,  
		          	  d_date_created = :date_created,
		          	  d_time_created = :time_created,
                      f_sub_status = :stt";		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->v_sub_email = htmlspecialchars(strip_tags($this->v_sub_email));

		//Bind data
		$stmt->bindParam(':email',$this->v_sub_email);
		$stmt->bindParam(':date_created',$this->d_date_created);
		$stmt->bindParam(':time_created',$this->d_time_created);
		$stmt->bindParam(':stt',$this->f_sub_status);

		//Execute query
		if($stmt->execute()){
			return true;
		}
		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;
	}

	

	public function delete(){

		//Create query
		$query = "DELETE FROM $this->table
		          WHERE n_sub_id = :sub_id";
		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->n_sub_id = htmlspecialchars(strip_tags($this->n_sub_id));

		//Bind data
		$stmt->bindParam(':sub_id',$this->n_sub_id);

		//Execute query
		if($stmt->execute()){
			return true;
		}

		//Print error if something goes wrong
		printf("Error: %s. \n", $stmt->error);
		return false;

	}
}
?>

