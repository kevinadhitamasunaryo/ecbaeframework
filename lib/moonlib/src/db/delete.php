<?php
/**
 * Database, user, password, table, columns, condition
 */
function delete($tbl,$cond,$db = DEFAULT_DB){
	$arr = array();
	$n = 0;
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,$db);
	$query = "delete from $tbl where $cond";
	$res =  mysqli_query($con,$query);
	mysqli_close($con);
	return $arr;
}
