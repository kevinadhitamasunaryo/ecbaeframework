<?php
/**
 * Database, user, password, table, columns, condition
 */
function update($tbl,$data,$cond,$db = DEFAULT_DB){
	$arr = array();
	$n = 0;
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,$db);
	if($cond != ''){
		$query = "update $tbl set $data where $cond";
	}
	else{
		$query = "update $tbl set $data";
	}

	$res =  mysqli_query($con,$query);
	mysqli_close($con);
	return $arr;
}
