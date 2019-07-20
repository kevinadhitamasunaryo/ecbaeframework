<?php
echo "Membuat database...";
$db_host = $_POST['db_host'];
$db_user = $_POST['db_user'];
$db_pass = $_POST['db_pass'];
$db_name = $_POST['db_name'];
$admin_name = $_POST['admin_name'];
$admin_pass = md5($_POST['admin_pass']);

$data = 
"<?php
define( 'DB_HOST'			, '$db_host'			);
define( 'DB_USER'			, '$db_user'			);
define( 'DB_PASS'			, '$db_pass'			);
define( 'DEFAULT_DB'		, '$db_name'			);
";
file_put_contents('db_config.php',$data);

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass);
// Check connection
if ($conn->connect_error) {
    die("<br>Koneksi host gagal: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conn->query($sql) === TRUE) {
    echo "<br>Database berhasil dibuat";
	echo "
<Br>Membuat tabel...
";
} else {
    echo "<br>Database gagal dibuat: " . $conn->error;
	exit;
}

$conn->close();

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// Check connection
if ($conn->connect_error) {
    die("<br>Koneksi database gagal: " . $conn->connect_error);
} 

// sql to create table
$sql = file_get_contents('db.sql');
$sql = str_replace('[admin_name]',$admin_name,$sql);
$sql = str_replace('[admin_pass]',$admin_pass,$sql);

if ($conn->multi_query($sql) === TRUE) {
    echo "<br>Tabel berhasil dibuat";
} else {
    echo "<br>Tabel gagal dibuat:" . $conn->error;
}

$conn->close();

echo "<br>Menyiapkan htaccess...<script>
function redirect(){
window.location='fix.php';
}
setTimeout(function(){ redirect(); }, 2000);
</script>";
exit;

