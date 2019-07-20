<?php
/**
 * Database, user, password, table, columns, condition
 */
function select($fetch,$tbl,$col,$cond = '',$db = DEFAULT_DB){
	$arr = array();
	$n = 0;
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,$db);
	if($cond !== ''){
		$query = "select $col from $tbl where $cond";
	}
	else{
		$query = "select $col from $tbl";
	}
	
	$mysqli_fetch = "mysqli_$fetch";
	$res =  mysqli_query($con,$query);
	if ( $res === false ){
		$query = "select $col from $tbl $cond";
		$res = mysqli_query($con,$query);
	}
	if($fetch !== 'num_rows'){
		while($row = $mysqli_fetch($res)){
			$arr[$n] = $row;
			$n++;
		}
	}
	else{
		$arr = $mysqli_fetch($res);
	}
	
	/**
	if(isset($arr[0])){
		foreach($arr[0] as $key => $val){
			$arr[$key] = $val;
		}
	}
	**/
	
	mysqli_close($con);
	return $arr;
}