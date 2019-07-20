<?php
class trigger extends ef{
	public function init($ef){
		if(isset($_FILES)){ $files = $_FILES; $this->retrieve_files($files); }
		$get = $_GET;
		$post = $_POST;

		if(isset($get['path'])){ unset($get['path']); }
		if(!empty($post)){ $this->retrieve_post($post); }
		if(!empty($get)){ $this->retrieve_get($get); }
	}
	public function retrieve_files($files){
		foreach($files as $key => $file){
			if($file['size'] > 0){
				$filename = $file['name'];
				$arr = explode(".", $filename);
				$ext = end($arr);
				$this_file = uniqid();
				$_POST[$key] = "$this_file.$ext";
				$_POST[$key . '_name'] = $filename;
				move_uploaded_file($file['tmp_name'], SITE_DIR . "asset/$this_file.$ext");
			}
		}
	}
	public function retrieve_post($post){
		/*
		if(isset($post['f'])){
			$fileloc = urldecode($post['f']);
		}
		else{
			$fileloc = URL_DIR;
		}
		$onpost_loc = $fileloc . '_onpost_.php';
		if(file_exists($onpost_loc)){
			include_once($onpost_loc);
		}
		*/
	}
	public function retrieve_get($get){
		/*
		if(isset($get['f'])){
			$fileloc = urldecode($get['f']);
		}
		else{
			$fileloc = URL_DIR;
		}
		$onget_loc = $fileloc . '_onget_.php';
		
		if(file_exists($onget_loc)){
			include_once($onget_loc);
		}
		*/
	}
}