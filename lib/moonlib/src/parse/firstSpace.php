<?php
function firstSpace($data){
	$res = array();
	$arr = explode(' ',$data);
	$res[0] = $arr[0];
	unset($arr[0]);
	$res[1] = implode(' ', $arr);
	return $res;
}