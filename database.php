<?php
require_once("config.php");


class Database {
	public $connection;
	
function __construct(){
	$this->open_db_connection();
}
public function open_db_connection(){
	$this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//$this->connection = new mysqli();   //creating instance for mysqli


//$this->connection->connect_errno    	//using instance of mysqli
if(mysqli_connect_errno()){
	 die("database connection failed badly" . mysqli_error());
		}
	}
	
	
public function query($sql){
	
	$result = mysqli_query($this->connection, $sql);
	return $result;
	
	}
	private function confirm_query($result){	//
		if(!$result) {
			die("query faild");
			echo "YOUR QUERY IS nOT EXECUTED";
		}
	}
	public function escape_string(){
		$escaped_string = mysqli_real_escape_string($this->connection, $string);	
		return $escaped_string;
	}
}
$database = new Database();
?>