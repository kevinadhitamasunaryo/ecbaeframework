<?php
class ef{
	public $ef = array();
	public function launch(){		
		// include moonlib
		foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator(ABS_PATH . "lib/moonlib/src")) as $file){
			$arr = explode('.',$file);
			if(end($arr) === 'php'){
				require_once($file);
			}
		}
		// Include sandbox test
		foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator(ABS_PATH . "test")) as $file){
			$arr = explode('.',$file);
			if(end($arr) === 'php'){
				require_once($file);
			}
		}
		// include class
		foreach(glob(ABS_PATH . "launcher/class/*.php") as $class){
			require_once $class;
		}
		// include program
		foreach(glob(ABS_PATH . "launcher/program/*.php") as $program){
			if($program != str_replace('\\','/', __FILE__ )){
				require_once $program;
			}
		}
		// include paths
		foreach($launchers as $launcher){
			new $launcher;
		}
		
	}
	public function get(){}
	public function set(){}
	public function run_sys($sys_arr){
		$arr = array();
		$this->get();
		foreach($sys_arr as $sys){
			$class_sys = new $sys();
			$res = $class_sys->init($this->ef);
			$this->ef[$sys] = $res;
		}
		$this->set();
	}
	public function loadData($data,$regex,$url,$build){
		
		if(!preg_match($regex,$data)){
			$data = $this->modData($data,$url,false);
			return $data;
		}
		else{
			preg_match($regex,$data,$match);
			if($build === 'content'){
				$url = $url . $match[1];
			}
			$content_url = $url . '/_content_.html';
			
			if(file_exists($content_url)){
				
				$content = file_get_contents($content_url);
				$content = $this->modData($content,$url);
				$data = str_replace($match[0], $content, $data,$count);
			}
			else{
				$content = str_replace($match[0], '', $data,$count);
				$content = $this->modData($content,$url);
				$data = $content;
			}
			$data = $this->modData($data,$url);
			
			$regex_var = $this->ef['grab']['regex']['var'];
			preg_match_all($regex_var,$data,$var_matches);
			foreach($var_matches[1] as $key => $match){
				if(isset($$match)){
					$replace = $$match;
					$data = str_replace($var_matches[0][$key],$replace,$data);
				}
				else if(isset($GLOBALS[$match])){
					$replace = $GLOBALS[$match];
					$content = str_replace($var_matches[0][$key],$replace,$content);
				}
			}
			
			if($build === 'content'){
				$this->loadData($data,$regex,$url,$build);
			}
			else{
				$this->content = $data;
				return $data;
			}
		}
		return $data;
	}
	public function modData($content,$url,$is_content = true){

		$url = trim($url,'/');
		$grab_regex = $this->ef['grab']['regex'];
		$replace_from = $this->ef['grab']['form']['from'];
		$replace_to = $this->ef['grab']['form']['to'];
		$content = replaceTag($content,$replace_from,$replace_to);
		$added_datas = $this->ef['grab']['form']['add'];
		foreach($added_datas as $key => $added_data){
			$add_in = $added_data['in'];
			$data_added = $added_data['this'];
			$add_method = $added_data['method'];			
			$content = addTag($content,$add_in,$data_added,$add_method);
		}
		$content = preg_replace($grab_regex['fileloc'],urlencode($url),$content);
		$content = preg_replace($grab_regex['uniqid'],uniqid(),$content);
			
			preg_match_all('/#.*?\(.*?\)#|#.*?\(.*?\){.*?}#|#.*?\{.*?\}#/',$content,$check);
			$included = str_replace('\\','/',get_included_files());
			if(file_exists($url . '/_onpost_.php') && !empty($_POST)){ include_once $url . '/_onpost_.php';}
			if(isset($global_inc) && $global_inc===1){$GLOBALS = array_merge($GLOBALS, get_defined_vars());unset($global_inc);}
			if(file_exists($url . '/_onget_.php') && !empty($_GET)){ include_once $url . '/_onget_.php';}
			if(isset($global_inc) && $global_inc===1){$GLOBALS = array_merge($GLOBALS, get_defined_vars());unset($global_inc);}
			if(file_exists($url . '/_onload_.php')){ include_once $url . '/_onload_.php'; }
			if(isset($global_inc) && $global_inc===1){$GLOBALS = array_merge($GLOBALS, get_defined_vars());unset($global_inc);}
			
			$regex_var = $this->ef['grab']['regex']['var'];
			preg_match_all($regex_var,$content,$var_matches);
			
			foreach($var_matches[1] as $key => $match){
				if(isset($$match)){
					$replace = $$match;
					$content = str_replace($var_matches[0][$key],$replace,$content);
				}
				else if(isset($GLOBALS[$match])){
					$replace = $GLOBALS[$match];
					$content = str_replace($var_matches[0][$key],$replace,$content);
				}
			}
			
			preg_match_all($grab_regex['listing'],$content,$listing_matches);
			
			$listing_matches = swapArrIndex($listing_matches);
			foreach($listing_matches as $key => $listing_match){
				
				if(trim($listing_match[1]) == 'listing'){
					
					$rows = trim($listing_match[2],')');
					
					$data = $listing_match[3];
					if(!empty($$rows)){
						$listing_data = listing($rows,$$rows,$data);
					}
					else if(!empty($GLOBALS[$rows])){
						$$rows = $GLOBALS[$rows];
						$listing_data = listing($rows,$$rows,$data);
					}
					else{
						$listing_data = '';
					}
					$pos = strpos($content, $data);
					
					if ($pos !== false) {
						preg_replace($grab_regex['listing'],'${3}',$listing_data,1);
						$content = substr_replace($content, $listing_data, $pos, strlen($data));
						$content = preg_replace($grab_regex['listing'],'${3}',$content,1);
					}
				}
			}
			
		
		return $content;
	}
	public function setContent($build,$url){
		if(isset($_GET['path'])){ unset($_GET['path']); }
		$url = str_replace('//','/',$url);
		$regex = $this->ef['grab']['regex']['build'][$build];

		$data = $this->loadData($this->content,$regex,$url,$build);
		return $data;
	}
	public function grabPart($url){
		$parts = array('top','middle','bottom');

		foreach($parts as $part){
			$loc = $url . "/_$part" . '_/';
			$this->content = file_exists($loc . '_content_.html') ? file_get_contents($loc . '_content_.html') : '';
			$res[$part] = $this->setContent('content',$loc);
			
		}
		$html_parts = array('html','head','body');
		foreach($html_parts as $html_part){
			$loc = $url . "_$html_part" . 'Att_.html';
			$res[$html_part . 'Att'] = (file_exists($loc)) ? file_get_contents($loc) : '';
		}

		return $res;
	}
}