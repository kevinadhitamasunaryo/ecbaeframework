<?php
/**
 * Database, user, password, table, columns, condition
 */
function swapArrIndex($array){
	$new_array = array();
	foreach($array as $i=>$element){
		foreach($element as $j=>$sub_element){
			$new_array[$j][$i] = $sub_element;
		}
	}
	return $new_array;
}