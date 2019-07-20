<?php
/**
 * Database, user, password, table, columns, condition
 */
function getKeyAndValue($arr,$type){
	$count = count($arr);
	if($count > 0) {
	  $keys = array_keys($arr);
	  $firstKey = $keys[0];
	  $lastKey = $keys[$count - 1];
	  $firstValue = $array[$firstKey];
	  $lastValue = $array[$lastKey];
	}
	$res = array();
	if($type='first'){
		$res[$firstKey] = $firstValue;
	}
	if($type='last'){
		$res[$lastKey] = $lastValue;
	}
	return $res;
}
