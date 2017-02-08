<?php 
$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = '*********';
$mysql_database = 'instagram';
$mysql_port = '3306';
$mysql_charset = 'utf8';

$connect = mysqli_connect($mysql_hostname.':'.$mysql_port, $mysql_username, $mysql_password);
mysqli_select_db($connect, $mysql_database) or die('DB 선택 실패');

$id = $_POST['id'];
$pw = $_POST['pw'];

$query = "SELECT * FROM `users` WHERE `user_id` = '$id' and `user_pw` = '$pw'";
$result = mysqli_query($connect, $query);

$ishere = false;
$user = null;

while ($row = mysqli_fetch_assoc($result)) {
	$ishere = true;
	$user = $row;
}


/* if (!$connect) {
	echo '[fail] : '.mysql_error().'<br>';
	die('cannot connect to mysql I am sorry');
} else {s
	echo '[success]<br>';
}

mysqli_select_db($connect, $mysql_database) or die('DB 선택 실패');
$query = 'SELECT * FROM `post` WHERE 1';
$result = mysqli_query($connect, $query);
while ($row = mysqli_fetch_assoc($result)) {
	print_r($row);
} */
$userIdx = $user['user_idx'];

mysqli_close($connect);

if ($ishere) {
	session_start();
	$_SESSION['userId'] = $id;
	$_SESSION['userIdx'] = $userIdx;
	echo '<script>location.href="index.php"</script>';
}else {
	echo '<script>alert("회원정보가 이상합니다");</script>';
	echo '<script>location.href="login.php"</script>';
}

?>