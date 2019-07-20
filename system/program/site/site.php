<?php
class site extends ef{
	public function init($ef){
		$this->ef = $ef;
		$this->ef['site'] = parent::grabPart(SITE_PAGE);
		$this->applySiteBuild();
		return $this->ef['site'];
	}
	public function applySiteBuild(){
		$this->ef['site']['build'] = array();
		foreach(BUILD as $build){
			foreach(BUILD_APPLICANT as $url){
				if(file_exists($url)){
					
					$match = array();
					$n = 0;
					foreach(BUILD_TYPE as $type){
						$file = file_get_contents($url);
						$regex = '/'. $build .'_'. $type .'\s*=\s*(.*?)\s*$/sim';
						if(preg_match($regex,$file)){
							preg_match($regex,$file,$match[$n]);
						}else{
							$match[$n][1] = '';
						}
						$n++;
					}
					if(!empty($this->ef['site']['build'][$build])){
						unset($this->ef['site']['build'][$build]);
					}
					$this->ef['site']['build'][$build][$match[0][1]][$match[1][1]][$match[2][1]] = '';
					
				}
			}
		}
	}
}