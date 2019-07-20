<?php
function replaceTag($data,$from,$to){
	if(is_array($from)){
		$forms = $from;
		foreach($forms as $key => $from){
			$replacement = replaceTag2($data,$from,$to[$key]);
		}
	}
	else{
		$replacement = replaceTag2($data,$from,$to[$key]);
	}
	return $replacement;
}
function replaceTag2($data,$from,$to){
	$first_space = firstSpace($from);
	$tag_ori = $first_space[0];
	$att_ori = $first_space[1];
	
	$first_space = firstSpace($to);
	$tag_rep = $first_space[0];
	$att_rep = $first_space[1];
	$regex = "/<$tag_ori(.*?)$att_ori(.*?)>/smi";
	$replace = "<$tag_rep" . '${1}${2}' . " $att_rep>";
	$replacement = preg_replace($regex, $replace, $data);

	return $replacement;
}