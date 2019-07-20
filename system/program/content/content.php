<?php
class content extends ef{
	public function init($ef){
		$this->ef = $ef;
		$this->ef['content'] = parent::grabPart(URL_DIR);

		$this->getContent();
		$this->applyBuild();
		return $this->ef['content'];
	}
	public function getContent(){
		$content_url = URL_DIR . '_content_.html';
		if(file_exists($content_url)){
			$this->content = file_get_contents($content_url);
		}
		else{
			$this->content = '';
		}
		$this->content = $this->modData($this->content,trim(URL_DIR,'/'));
		$this->ef['content']['val'] = parent::setContent('content',URL_DIR);
	}
	public function applyBuild(){
		foreach(BUILD as $build){
			$regex = $this->ef['grab']['regex']['build'][$build];
			if(preg_match($regex,$this->content)){
			preg_match_all($regex,$this->content,$matches);
				$func_locals = $matches[1];
				$matches = $matches[0];
			}
			else{
				$func_locals = array();
				$matches = array();
			}
			$this->setBuildList($build,$func_locals,$matches);
		}
	}
	public function setBuildList($build,$func_locals,$matches){

		$n = 0;
		foreach($func_locals as $func_local){
			foreach($this->ef['site']['build'][$build] as $desg => $funcs){
				foreach($funcs as $version => $val){
					$func = array_keys($funcs);
					$func = $func[0];
					$func_final = str_replace('//','/',$func . $func_local);
					if(isset($this->ef['build'][$build][$desg][$func_final])||isset($this->ef['build'][$build]['*'][$func_final])){
					if(isset($this->ef['build'][$build][$desg][$func_final])){
						$arr = $this->ef['build'][$build][$desg][$func_final];
					}
					else{
						$arr = $this->ef['build'][$build]['*'][$func_final];
					}
					$version = ($version == '') ? max(array_keys($arr)) : $version;	
					$this->ef['content']['build'][$build][$desg][$func_final][$version] = $arr[$version];
					$this->ef['content']['build_list'][$build][$n] = $arr[$version];
					
					$this->ef['content']['val'] = parent::setContent($build,$arr[$version]);
					}
					else{
						$regex = $this->ef['grab']['regex']['build'][$build];
						$this->content = preg_replace($regex,'',$this->content,1);
						echo "<script>alert('ef[build][$build][$desg][$func_final] not found')</script>";
					}
				}
			}
			$n++;
		}
	}
}