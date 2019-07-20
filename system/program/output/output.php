<?php
class output extends content{
	public function init($ef){
		$this->ef = $ef;
		$this->getOutputPart();
		$this->combineContent();
		$this->replaceRegex();
		$this->replaceDollar();
		$this->replaceVar();
		$this->printOutput();
	}
	public function getOutputPart(){
		$parts = array('top','middle','bottom','htmlAtt','headAtt','bodyAtt');
		foreach($parts as $part){
			if($this->ef['content'][$part] != ''){
				$this->ef['output'][$part] = $this->ef['content'][$part];
			}
			else if($this->ef['page'][$part] != ''){
				$this->ef['output'][$part] = $this->ef['page'][$part];
			}
			else{
				$this->ef['output'][$part] = $this->ef['site'][$part];
			}
		}
	}
	public function combineContent(){
		$this->ef['output']['content'] = 
			'<!DOCTYPE html>' . PHP_EOL .
			'<html ' . $this->ef['output']['htmlAtt'] . '>' . PHP_EOL .
			'<head ' . $this->ef['output']['headAtt'] . '>' . PHP_EOL .
			$this->ef['output']['top'] . PHP_EOL . 
			'</head>' . PHP_EOL .
			'<body ' . $this->ef['output']['bodyAtt'] . '>' . PHP_EOL .
			$this->ef['output']['middle'] . PHP_EOL .
			$this->ef['content']['val'] . PHP_EOL . 
			$this->ef['output']['bottom'] . PHP_EOL .
			'</body>' . PHP_EOL .
			'</html>';
	}
	public function replaceRegex(){
		$vars = $this->ef['grab']['output'];
		foreach($vars['search'] as $key => $regex){
			$this->ef['output']['content'] = preg_replace($regex,$vars['replace'][$key],$this->ef['output']['content']);
		}
		$regex_rule = $this->ef['grab']['regex']['rule'];
		preg_match_all($regex_rule,$this->ef['output']['content'],$rules);
		$fulltexts = $rules[0];
		$terms = $rules[1];
		$texts = $rules[2];

		foreach($terms as $key => $term){
			$test = eval('return '.$term.';');
			if($test != 1){
				$this->ef['output']['content'] = str_replace($fulltexts[$key],'',$this->ef['output']['content']);
			}
			else{
				$this->ef['output']['content'] = str_replace($fulltexts[$key],$texts[$key],$this->ef['output']['content']);
			}
		}
		
	}
	public function replaceDollar(){
		$regex = $this->ef['grab']['regex']['rp'];
		preg_match_all($regex,$this->ef['output']['content'],$matches);
		foreach($matches[1] as $match){
			$match = trim($match);
			if(is_numeric($match)){
			$str = 'Rp. ' . number_format($match, 2, ',', '.');
			}
			else{
			$str = $match;
			}
			$this->ef['output']['content'] = preg_replace($regex,$str,$this->ef['output']['content'],1);
		}
		if(preg_match($regex,$this->ef['output']['content'])){
			$this->replaceDollar();
		}
	}
	
	public function replaceVar(){
		$regex_var = $this->ef['grab']['regex']['var'];
		preg_match_all($regex_var,$this->ef['output']['content'],$var_matches);
		foreach($var_matches[1] as $key => $match){
			$replace = (isset($$match)) ? $$match : '';
			$this->ef['output']['content'] = str_replace($var_matches[0][$key],$replace,$this->ef['output']['content']);
		}
	}
	public function printOutput(){
	
	print_r(preg_replace("/\xEF\xBB\xBF/", "", $this->ef['output']['content']));
	}
}