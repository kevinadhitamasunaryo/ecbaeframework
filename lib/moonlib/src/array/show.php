<?php
function show($arr_name,$arr,$old_data){
	/*
	$arr = getKeyAndValue($arr,$first);
	$new_data = listing($arr_name,$arr,$old_data);
	return $new_data;
	*/
	$arr1[0] = $arr;
	$new_data = listing($arr_name,$arr1,$old_data);
	return $new_data;
}
