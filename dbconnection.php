<?php 

$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = '*********';
$mysql_database = 'instagram';
$mysql_port = '3306';
$mysql_charset = 'utf8';

$connect = mysqli_connect($mysql_hostname.':'.$mysql_port, $mysql_username, $mysql_password);

if (!$connect) {
	echo '[fail] : '.mysql_error().'<br>';
	die('cannot connect to mysql I am sorry');
} else {
	echo '[success]<br>';
}

mysqli_select_db($connect, $mysql_database) or die('DB 선택 실패');
$query = 'SELECT * FROM `post` WHERE 1';
$result = mysqli_query($connect, $query);
while ($row = mysqli_fetch_assoc($result)) {
	print_r($row);
}

mysqli_close($connect);

?>