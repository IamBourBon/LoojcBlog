<?php  
class contact{

	//DB Stuff
	private $conn;
	private $table = "blog_contact";

	//Blog Categories Properties
	public $n_contact_id;
	public $v_fullname;
	public $v_email;
	public $v_favorite;
	public $v_message;
	public $d_date_created;
	public $d_time_created;
    public $f_contact_status;

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

	
	public function read_single(){
		$sql = "SELECT * FROM $this->table WHERE n_contact_id = :contact_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':contact_id',$this->n_contact_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//Set Properties
		$this->n_contact_id = $row['n_contact_id'];
		$this->v_fullname = $row['v_fullname'];
		$this->v_email = $row['v_email'];
		$this->v_favorite = $row['v_favorite'];
		$this->v_message = $row['v_message'];
		$this->d_date_created = $row['d_date_created'];
		$this->d_time_created = $row['d_time_created'];
		$this->f_contact_status = $row['f_contact_status'];
		
	}

	
	public function create(){
		//Create query
		$query = "INSERT INTO $this->table
		          SET v_fullname = :fullname,
                      v_email = :email,
                      v_favorite = :favorite,
                      v_message = :mess,
		          	  d_date_created = :date_created,
		          	  d_time_created = :time_created,
                      f_contact_status = :stt";		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->v_fullname = htmlspecialchars(strip_tags($this->v_fullname));
		$this->v_email = htmlspecialchars(strip_tags($this->v_email));
		$this->v_favorite = htmlspecialchars(strip_tags($this->v_favorite));
		$this->v_message = htmlspecialchars(strip_tags($this->v_message));

		//Bind data
		$stmt->bindParam(':fullname',$this->v_fullname);
		$stmt->bindParam(':email',$this->v_email);
		$stmt->bindParam(':favorite',$this->v_favorite);
		$stmt->bindParam(':mess',$this->v_message);
		$stmt->bindParam(':date_created',$this->d_date_created);
		$stmt->bindParam(':time_created',$this->d_time_created);
		$stmt->bindParam(':stt',$this->f_contact_status);

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
		          WHERE n_contact_id = :contact_id";
		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->n_contact_id = htmlspecialchars(strip_tags($this->n_contact_id));

		//Bind data
		$stmt->bindParam(':contact_id',$this->n_contact_id);

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

