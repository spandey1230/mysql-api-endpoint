<?php 

require 'Application.php';

class RequestHandler extends Application
{
	protected $action = ["authenticate", "upload", "find", "store", "update", "remove", "hash", "md5"];
	protected $limit;

	function trigger($post, $get) {

		if(isset($post['action']) or isset($get['action'])) {
			if(isset($get['action'])){
				if($this->check_action($get['action'])){
					$this->get_requests($get);
				} else {
					throw new Exception("Unknown action key on request!");
				}
			}
			if(isset($post['action'])){
				if($this->check_action($post['action'])){
					$this->post_requests($post);
				} else {
					throw new Exception("Unknown action key on request!");
				}
			}
		} else {
			throw new Exception("No action key found on POST request!"); die();
		}
	}
	function check_action($action) {
		foreach ($this->action as $item) {
			if($action == $item){
				return true;
			}
		}
		return false;
	}
	function get_requests($get){
		if($get['action'] == "authenticate"){
			$this->Autheticate($get);
		}
		if($get['action'] == "find"){
			$this->Find($get);
		}
		if($get['action'] == "store"){
			$this->Store($get);
		}
		if($get['action'] == "update"){
			$this->Update($get);
		}
		if($get['action'] == "remove"){
			$this->Remove($get);
		}
		if($get['action'] == "hash"){
			$this->Hash($get);
		}
		if($get['action'] == "md5"){
			$this->Md5($get);
		}
		if($get['action'] == "upload"){
			$this->Upload($get);
		}
	}
	function post_requests($post){
		if($post['action'] == "authenticate"){
			$this->Autheticate($post);
		}
		if($post['action'] == "find"){
			$this->Find($post);
		}
		if($post['action'] == "store"){
			$this->Store($post);
		}
		if($post['action'] == "update"){
			$this->Update($post);
		}
		if($post['action'] == "remove"){
			$this->Remove($post);
		}
		if($post['action'] == "hash"){
			$this->Hash($post);
		}
		if($post['action'] == "md5"){
			$this->Md5($post);
		}
		if($post['action'] == "upload"){
			$this->Upload($post);
		}
	}
	function files_requests($files){
		
	}
}