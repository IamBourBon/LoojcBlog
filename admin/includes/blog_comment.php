<?php  
class blog_comment{

	//DB Stuff
	private $conn;
	private $table = "blog_comment";

	//Blog Properties
	public $n_blog_comment_id;
	public $n_blog_comment_parent_id;
	public $n_blog_post_id;
	public $v_comment_author;
	public $v_comment_author_email;
	public $v_comment;
	public $v_main_image_url;
	public $d_date_created;
	public $d_time_created;


	//Constructor with DB
	public function __construct($db){
		$this->conn = $db;
	}

	//Read multi records
	public function read(){
		$sql = "SELECT * FROM $this->table";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt;
	}

	public function read_in_blog(){
		$sql = "SELECT * FROM $this->table WHERE n_blog_post_id = :blog_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':blog_id',$this->n_blog_post_id);
		$stmt->execute();

		return $stmt;
	}


	//Read one record
	public function read_single(){
		$sql = "SELECT * FROM $this->table 
				WHERE n_blog_comment_id = :get_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':get_id',$this->n_blog_comment_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//Set Properties
		$this->n_blog_comment_id = $row['n_blog_comment_id'];
		$this->n_blog_comment_parent_id=$row['n_blog_comment_parent_id'];
		$this->n_blog_post_id=$row['n_blog_post_id'];
		$this->v_comment_author=$row['v_comment_author'];
		$this->v_comment_author_email=$row['v_comment_author_email'];
		$this->v_comment=$row['v_comment'];
		$this->v_main_image_url=$row['v_main_image_url'];
		$this->d_date_created=$row['d_date_created'];
		$this->d_time_created=$row['d_time_created'];

				
	}

	public function reply_comment(){
		
		$query = "SELECT * FROM blog_comment WHERE n_blog_post_id = :blog_id 
				  AND n_blog_comment_parent_id = :parent_id";		
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':parent_id',$this->n_blog_comment_parent_id);
		$stmt->bindParam(':blog_id',$this->n_blog_post_id);

		
		if($stmt->execute()){
			return $stmt;
		}
		
		printf("Error: %s. \n", $stmt->error);
		return false;
	}

	public function create(){
		
		$query = "INSERT INTO $this->table
		          SET n_blog_comment_parent_id = :comment_parent_id,
				  	  n_blog_post_id = :blog_post_id,
		          	  v_comment_author = :comment_author,
		          	  v_comment_author_email = :comment_author_email,
		          	  v_comment = :comment,
		          	  d_date_created = :date_created,
		          	  d_time_created = :time_created";		
		
		$stmt = $this->conn->prepare($query);

		
		$this->v_comment_author = htmlspecialchars(strip_tags($this->v_comment_author));
		$this->v_comment_author_email = htmlspecialchars(strip_tags($this->v_comment_author_email));
		$this->v_comment = htmlspecialchars(strip_tags($this->v_comment));


		
		$stmt->bindParam(':comment_parent_id',$this->n_blog_comment_parent_id);
		$stmt->bindParam(':blog_post_id',$this->n_blog_post_id);
		$stmt->bindParam(':comment_author',$this->v_comment_author);
		$stmt->bindParam(':comment_author_email',$this->v_comment_author_email);
		$stmt->bindParam(':comment',$this->v_comment);
		$stmt->bindParam(':date_created',$this->d_date_created);
		$stmt->bindParam(':time_created',$this->d_time_created);

		
		if($stmt->execute()){
			return true;
		}
		
		printf("Error: %s. \n", $stmt->error);
		return false;
	}

	
	public function update(){
		
		$query = "UPDATE $this->table
		          SET 	n_blog_comment_parent_id = :comment_parent_id,
                        n_blog_post_id = :blog_post_id,
						v_comment_author = :comment_author,
						v_comment_author_email = :comment_author_email,
						v_comment = :comment,
						v_main_image_url = :main_image_url,
						d_date_created = :date_created,
						d_time_created = :time_created
		          WHERE 
                        n_blog_comment_id = :comment_id";

		
		$stmt = $this->conn->prepare($query);

		
		$this->n_blog_post_id = htmlspecialchars(strip_tags($this->n_blog_post_id));
		$this->v_comment_author_email = htmlspecialchars(strip_tags($this->v_comment_author_email));
		$this->v_comment_author = htmlspecialchars(strip_tags($this->v_comment_author));
		$this->v_comment = htmlspecialchars(strip_tags($this->v_comment));


		
		$stmt->bindParam(':get_id',$this->n_blog_post_id);
		$stmt->bindParam(':category_id',$this->n_category_id);
		$stmt->bindParam(':post_title',$this->v_post_title);
		$stmt->bindParam(':post_meta_title',$this->v_post_meta_title);
		$stmt->bindParam(':post_path',$this->v_post_path);
		$stmt->bindParam(':post_summary',$this->v_post_summary);
		$stmt->bindParam(':main_image_url',$this->v_main_image_url);
		$stmt->bindParam(':date_created',$this->d_date_created);
		$stmt->bindParam(':time_created',$this->d_time_created);
		
		
		if($stmt->execute()){
			return true;

		}
		
		printf("Error: %s. \n", $stmt->error);
		return false;

	}

	
	public function delete(){

		
		$query = "DELETE FROM $this->table
		          WHERE n_blog_comment_id = :get_id";
		
		//Prepare statement
		$stmt = $this->conn->prepare($query);

		//Clean data
		$this->n_blog_comment_id = htmlspecialchars(strip_tags($this->n_blog_comment_id));

		//Bind data
		$stmt->bindParam(':get_id',$this->n_blog_comment_id);

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

