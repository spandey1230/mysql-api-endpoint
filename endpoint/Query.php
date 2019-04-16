<?php 

require 'QueryBuilder.php';

class Query extends QueryBuilder
{
	
	function db()
	{
		require("../config.php");
		
		$username = $config['db']['username'];
		$password = $config['db']['password'];
		$host = $config['db']['host'];
		$port = $config['db']['port'];
		$database = $config['db']['database'];

		$conn = new PDO("mysql:host=$host;dbname=$database;port=$port;", $username, $password);
		return $conn;
	}

	function q_Check_table($table){
		$sql = "";
		if($this->db() AND !empty($table)){
			$sql = $sql."SELECT * FROM ";

			if(is_array($table)){
				foreach ($table as $item) {
					$sql = $sql."$item, ";
				}
				$sql = rtrim($sql,", ");
			} elseif(is_string($table)) {
				$sql = $sql."$table ";
			}
			$sql = rtrim($sql, " ");
			$sql = $sql.";";

			$conn = $this->db();
			# echo $sql;
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			if($stmt) {
				return true;
			}
			return false;
		}
	}

	function q_auth_Select($table_name, $username) {
		/*print_r($request);*/
		
		if($this->db()) {
			$conn = $this->db();
			$sql = "SELECT * FROM $table_name WHERE username = '$username';";
			
			# echo $sql;
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			return $stmt;
		}
	}

	function q_Select($request) {
		/*print_r($request);*/
		
		if($this->db()) {
			$conn = $this->db();
			$sql = $this->qb_select($request);
			
			# echo $sql;
			$stmt = $conn->query($sql);
			$array = [];
			$fetch = $stmt->fetch();
			while($fetch){
				$array[] = $fetch;
				$fetch = $stmt->fetch();
			}
			return $array;
		}
	}
	
	function q_Insert($request) {
		/*print_r($request);*/
		
		if ($this->db()) {
			$conn = $this->db();
			$sql = $this->qb_insert($request);
			
			# echo $sql;
			$stmt = $conn->prepare($sql);
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
	}

	function q_Update($request) {
		/*print_r($request);*/
		
		if ($this->db()) {
			$conn = $this->db();
			$sql = $this->qb_update($request);
			
			# echo $sql;
			$stmt = $conn->prepare($sql);
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
	}

	function q_Delete($request) {
		/*print_r($request);*/
		
		if ($this->db()) {
			$conn = $this->db();
			$sql = $this->qb_delete($request);
			
			# echo $sql;
			$stmt = $conn->prepare($sql);
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
	}
}