<?php 

class QueryBuilder
{
	function qb_select($request){
		$table = $request['tbl'];
		/*$this->qb_escape_string($conn, );*/
		$sql = "SELECT ";
		if(!empty($request['col'])){
			foreach ($request['col'] as $item) {
				$item = $this->qb_escape_string($item);
				$sql = $sql."$item, ";
			}
			$sql = rtrim($sql,", ");
		} else {
			$sql = $sql."* ";
		}
		

		$sql = $sql." FROM ";

		foreach ($request['tbl'] as $item) {
			$item = $this->qb_escape_string($item);
			$sql = $sql."$item, ";
		}
		$sql = rtrim($sql,", ");

		if(isset($request['cond'])){
			$sql = $sql.$this->qb_where($request);
			/*echo $sql;*/
		}

		

		if(isset($request['ordby'])){
			$sql = $sql." ORDER BY `".$this->qb_escape_string($request['ordby'])."`";
			/*echo $sql;*/
		}

		if(isset($request['ord'])){
			$sql = $sql." ".$this->qb_escape_string($request['ord']);
			/*echo $sql;*/
		}

		if(isset($request['limit'])){
			$sql = $sql." LIMIT ".$this->qb_escape_string($request['limit']);
			/*echo $sql;*/
		}
		#echo $sql."<br>";
		$sql = $sql.";";
		return $sql;
	}
	function qb_where($request)	{

		$sql = " WHERE ";

		if(isset($request['between'])){
			$sql = $sql." ".$this->qb_escape_string($request['between'][0])." BETWEEN ".$this->qb_escape_string($request['between'][1])." AND ".$this->qb_escape_string($request['between'][2]);
			/*echo $sql;*/
		}
		$sql = rtrim($sql, "AND ");

		foreach ($request['cond'] as $key => $value) {
			$key = $this->qb_escape_string($key);
			$value = $this->qb_escape_string($value);
			$sql = $sql." $key = '$value' AND ";
		}
		$sql = rtrim($sql, "AND ");

		return $sql;
	}
	

	/* Insert into table */
	function qb_insert($request) {
		$table = $this->qb_escape_string($request['tbl']);

		$sql = "INSERT INTO `$table`(";

		foreach ($request['val'] as $key => $value) {
			$key = $this->qb_escape_string($key);
			$value = $this->qb_escape_string($value);
			$sql = $sql."`$key`, ";
		}
		$sql = rtrim($sql,", ");
		$sql = $sql.") VALUES (";
		foreach ($request['val'] as $key => $value) {
			$key = $this->qb_escape_string($key);
			$value = $this->qb_escape_string($value);
			$sql = $sql."'$value',";
		}
		$sql = rtrim($sql,",");
		$sql = $sql.");";
		# echo $sql;
		return $sql;
	}
	/* end Insert into table */	

	/* Update table */
	function qb_update($request) {
		$table = $this->qb_escape_string($request['tbl']);

		$sql = "UPDATE `$table` SET ";

		foreach ($request['col'] as $key => $value) {
			$key = $this->qb_escape_string($key);
			$value = $this->qb_escape_string($value);

			$sql = $sql."`$key`='$value', ";
		}
		$sql = rtrim($sql,", ");
		$sql = $sql." WHERE ";
		foreach ($request["cond"] as $key => $value) {
			$key = $this->qb_escape_string($key);
			$value = $this->qb_escape_string($value);

			$sql = $sql."`$key`='$value' AND ";
		}
		$sql = rtrim($sql,"AND ");
		$sql = $sql.";";
		# echo $sql;
		return $sql;
	}
	/* end Update table */	

	/* Update table */
	function qb_delete($request) {
		$table = $this->qb_escape_string($request['tbl']);

		$sql = "DELETE FROM `$table` WHERE ";

		foreach ($request["cond"] as $key => $value) {
			$key = $this->qb_escape_string($key);
			$value = $this->qb_escape_string($value);
			
			$sql = $sql."`$key`='$value' AND ";
		}
		$sql = rtrim($sql,"AND ");
		$sql = $sql.";";
		# echo $sql;
		return $sql;
	}
	/* end Update table */

	/* escape string */
	function qb_escape_string($string) {
		require("../config.php");
		
		$username = $config['db']['username'];
		$password = $config['db']['password'];
		$host = $config['db']['host'];
		$port = $config['db']['port'];
		$database = $config['db']['database'];

		$conn = new PDO("mysql:host=$host;dbname=$database;port=$port;", $username, $password);

		$str = $conn->quote($string);
		$str = rtrim($str, "'");
		$str = substr($str, 1);
		return $str;
	}
	/* end escape string */
}