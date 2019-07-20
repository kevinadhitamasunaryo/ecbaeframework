<?php
class replace extends ef{
	public $ef;

	public function init($ef){
		$this->ef = $ef;
		/*
		$this->ce['html'] = array();
		foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator(ABS_PATH . 'html/' . DEFAULT_HTML)) as $file){
			$arr = explode('.',$file);
			if(end($arr) === 'html'){
				array_push($this->ce['html'], file_get_contents($file));
			}
		}
		$this->shortcode_replace();
		*/
		return $this->ef['content'];
		
	}
	public function shortcode_replace(){
		/*
		$content = $this->ce['content']['val'];
		preg_match_all('/\[\%(.*?)\%\]/',$content,$tags);
		$shortcode = $tags[0];
		$tags = $tags[1];
		
		$replace = array();
		foreach($tags as $tag){
			$arr = explode(' ',$tag);
			$tag = $arr[0];
			unset($arr[0]);
			$att = implode(' ', $arr);
			
			$find_tag = $this->find_tag($tag,$att,0);
			array_push($replace, "<$tag$find_tag</$tag>");
		}
		
		$content = str_replace($shortcode,$replace,$content,$count);
		$this->ce['content']['val'] = $content;
		return $this->ce['content'];
	}
	
	public function find_tag($tag,$att,$n){
		$regex = "/(?<=<$tag).*$att.*>.*(?=<\/$tag>)/smi";
		//echo $regex;
		preg_match($regex,$this->ce['html'][$n],$match);

		if(isset($match[0])){
			return $match[0];
		}
		else if($n+1 === count($this->ce['html'])){
			return '>';
		}
		else{
			return $this->find_tag($tag,$att,$n+1);
		}
		*/
	}
}