<?php
function addTag($data,$add_in,$add,$add_method){
	if(is_array($add)){
		$res = $data;
		for($i = count($add)-1; $i > -1; $i--){
			$res = addTag2($res,$add_in,$add[$i],$add_method);
		}
	}
	else{
		$res = addTag2($data,$add_in,$add,$add_method);
	}
	return $res;
}
function addTag2($data,$add_in,$add,$add_method){
	$first_space = firstSpace($add_in);
	$tag = $first_space[0];
	$att = $first_space[1];
	
	$regex = "/<$tag(.*?)$att(.*?)>/smi";

	if($add_method === 'after'){
		$replace = '${0}' . PHP_EOL . $add;
	}
	else if($add_method === 'before'){
		$replace = $add . PHP_EOL . '${0}';
	}

	$res = preg_replace($regex, $replace, $data);

	return $res;
}