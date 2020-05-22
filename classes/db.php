<?php 

	include './config/config.php';

	class Database
	{	
		public $servername = HOST;
		public $username = USER;
		public $password = PASSWORD;
		public $dbname = DATABASE;

		public $con;

		public function __construct()
		{
			$this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

			if (!$this->con) {
				die("Connection failed: " . $this->con->connect_error);
				return false;
			}
		}	

		// Create function
		public function create($query)
		{
			$insert = $this->con->query($query);
			if ($insert) {
				return $this->con->insert_id;
			}
			else{
				die("Error " . $this->con->error);
			}
		}

		// Select Function
		public function select($query)
		{
			$result = $this->con->query($query);
			if ($result && $result->num_rows > 0 ) {
				return $result;
			}
			else{
				return false;
			}
		}

		// Update function
		public function update($query)
		{
			$update = $this->con->query($query);
			if ($update) {
				// header("Location: index.php?msg=" . urlencode('Data Updated Successfully'));
				return $update;
			}
			else{
				die("Error " . $this->con->error);
			}
		}

		// Delete function
		public function delete($query)
		{
			$delete = $this->con->query($query);
			if ($delete) {
				// header("Location: index.php?msg=" . urlencode('Data Deleted Successfully'));
				return $delete;
			}
			else{
				die("Error " . $this->con->error);
			}
		}

	}


?>