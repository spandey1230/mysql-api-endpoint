<?php 


class QueryBuilder
{
	function qb_select($request){
		$table = $request['tbl'];

		$sql = "SELECT ";
		if(!empty($request['col'])){
			foreach ($request['col'] as $item) {
				$sql = $sql."$item, ";
			}
			$sql = rtrim($sql,", ");
		} else {
			$sql = $sql."* ";
		}
		

		$sql = $sql." FROM ";

		foreach ($request['tbl'] as $item) {
			$sql = $sql."$item, ";
		}
		$sql = rtrim($sql,", ");

		if(isset($request['cond'])){
			$sql = $sql.$this->qb_where($request);
			/*echo $sql;*/
		}

		

		if(isset($request['ordby'])){
			$sql = $sql." ORDER BY `".$request['ordby']."`";
			/*echo $sql;*/
		}

		if(isset($request['ord'])){
			$sql = $sql." ".$request['ord'];
			/*echo $sql;*/
		}

		if(isset($request['limit'])){
			$sql = $sql." LIMIT ".$request['limit'];
			/*echo $sql;*/
		}
		echo $sql."<br>";
		$sql = $sql.";";
		return $sql;
	}
	function qb_where($request)	{

		$sql = " WHERE ";

		if(isset($request['between'])){
			$sql = $sql." ".$request['between'][0]." BETWEEN ".$request['between'][1]." AND ".$request['between'][2];
			/*echo $sql;*/
		}
		$sql = rtrim($sql, "AND ");

		foreach ($request['cond'] as $key => $value) {
			$sql = $sql." $key = '$value' AND ";
		}
		$sql = rtrim($sql, "AND ");

		return $sql;
	}
	

	/* Insert into table */
	function qb_insert($request) {
		$table = $request['tbl'];

		$sql = "INSERT INTO `$table`(";

		foreach ($request['val'] as $key => $value) {
			$sql = $sql."`$key`, ";
		}
		$sql = rtrim($sql,", ");
		$sql = $sql.") VALUES (";
		foreach ($request['val'] as $key => $value) {
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
		$table = $request['tbl'];

		$sql = "UPDATE `$table` SET ";

		foreach ($request['col'] as $key => $value) {
			$sql = $sql."`$key`='$value', ";
		}
		$sql = rtrim($sql,", ");
		$sql = $sql." WHERE ";
		foreach ($request["cond"] as $key => $value) {
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
		$table = $request['tbl'];

		$sql = "DELETE FROM `$table` WHERE ";

		foreach ($request["cond"] as $key => $value) {
			$sql = $sql."`$key`='$value' AND ";
		}
		$sql = rtrim($sql,"AND ");
		$sql = $sql.";";
		# echo $sql;
		return $sql;
	}
	/* end Update table */	
}