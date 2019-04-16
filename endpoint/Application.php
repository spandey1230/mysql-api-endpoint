<?php 

require 'Query.php';

class Application extends Query
{
	
	function Autheticate($request)
	{
		$table_name = $request['tbl'];
		$username = $request['username'];
		$password = $request['password'];

		if ($this->q_Check_table($table_name)) {
			foreach($this->q_auth_Select($table_name, $username) as $item){
				if(password_verify($password, $item["password"])){
					echo json_encode($item); die();
				}
			}
			echo 404; die();
		} else {
			echo 500; die();
		}
	}
	function Hash($request)
	{
		$key = $request['key'];
		echo password_hash($key, PASSWORD_DEFAULT);
	}
	function Md5($request)
	{
		$key = $request['key'];
		echo md5($key);
	}
	function Find($request) {

		$table_name = $request['tbl'];

		if ($this->q_Check_table($table_name)) {
			$array = array();
			foreach ($this->q_Select($request) as $key => $value) {
				$array[$key] = $value;
			}
			echo(json_encode($this->q_Select($request))); die();
		} else {
			echo 500; die();
		}
	}
	function Store($request) {

		$table_name = $request['tbl'];

		if ($this->q_Check_table($table_name)) {
			if ($this->q_Insert($request)) {
				echo 200; die();
			} else {
				echo 500; die();
			}
		} else {
			echo 500; die();
		}
	}
	function Update($request) {

		$table_name = $request['tbl'];

		if ($this->q_Check_table($table_name)) {
			if ($this->q_Update($request)) {
				echo 200; die();
			} else {
				echo 500; die();
			}
		} else {
			echo 500; die();
		}
	}
	function Upload($request) {

		$array = [];
		if($request['multiple'] == 'true'){
			foreach($_FILES as $key => $value){

				$file_name = $_FILES[$key]['name'];
				$file_type = $_FILES[$key]['type'];
				$file_error = $_FILES[$key]['error'];
				$file_size = $_FILES[$key]['size'];
				$file_tmp_name = $_FILES[$key]['tmp_name'];

				$arrKey = [];
				for ($i=0; $i < count($file_name); $i++) {
					if(move_uploaded_file($file_tmp_name[$i], '../resources/uploads/'.time().$file_name[$i])){
						$array[$key][] = ['name' => time().$file_name[$i], 'type' => $file_type[$i], 'size' => $file_size[$i]];
					}
				}
			}
			echo json_encode($array); die();
		} else {
			foreach($_FILES as $key => $value){
				$file_name = $_FILES[$key]['name'];
				$file_type = $_FILES[$key]['type'];
				$file_error = $_FILES[$key]['error'];
				$file_size = $_FILES[$key]['size'];
				$file_tmp_name = $_FILES[$key]['tmp_name'];

				if(move_uploaded_file($file_tmp_name, '../resources/uploads/'.time().$file_name)){
					$array[] = ['name' => time().$file_name, 'type' => $file_type, 'size' => $file_size];
				}
			}
			echo json_encode($array); die();
		}
	}
	function Remove($request) {

		$table_name = $request['tbl'];

		if ($this->q_Check_table($table_name)) {
			if ($this->q_Delete($request)) {
				echo 200; die();
			} else {
				echo 500; die();
			}
		} else {
			echo 500; die();
		}
	}
}