<?php

class format{
	public function formatDate($date){
		return date('F j, Y, g:i a', strtotime($date)); 
	}
	
	public function readmore($body, $limit=400){
		$body= $body."";
		$body=substr($body, 0, $limit);
		$body=substr($body, 0, strrpos($body, ' '));
		$body=$body.".......";
		return $body;
	}
	
	public function validation($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data); 
		return $data;
	}
	
	public function title(){
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($path, '.php');
		if($title == 'index'){
			$title = 'home';
		}elseif($title == 'contact'){
			$title = 'contact';
		}
		return $title = ucwords($title);
	}
}


?>