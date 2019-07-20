<?php
/**
 * Database, user, password, table, columns, condition
 */
function insert($tbl,$col,$val,$db = DEFAULT_DB){
	$n = 0;
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,$db);
	if($col!=''){
		$query = "insert into $tbl ($col) values ($val) ";
	}
	else{
		$query = "insert into $tbl values ($val)";
	}

	$res = mysqli_query($con,$query);

	if (!$res) {
	$error = mysqli_error($con);
		echo
<<<EOT
<script>
alert("error in query: $query \nreply from mysql: $error");
</script>
EOT;

	}
	mysqli_close($con);
}
