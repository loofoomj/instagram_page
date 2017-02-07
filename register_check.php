<?php 
$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'whtpehd6298!';
$mysql_database = 'instagram';
$mysql_port = '3306';
$mysql_charset = 'utf8';

$connect = mysqli_connect($mysql_hostname.':'.$mysql_port, $mysql_username, $mysql_password);
mysqli_select_db($connect, $mysql_database) or die('DB 선택 실패');

$id = $_POST['id'];
$pw = $_POST['pw'];
$repw = $_POST['repw'];


if ($pw != $repw) {
	mysqli_close($connect);
	echo '<script>alert("비밀번호가 다릅니다.");</script>';
	echo '<script>location.href="register.php"</script>';
}

$query = "SELECT * FROM `users` WHERE `user_id` = '$id'";
$result = mysqli_query($connect, $query);

$isduplicated = false;

while ($row = mysqli_fetch_assoc($result)) {
	$isduplicated = true;	
}


if ($isduplicated) {
	mysqli_close($connect);
	echo '<script>alert("중복된 아이디가 있습니다.");</script>';
	echo '<script>location.href="register.php"</script>';
}

$query = "INSERT INTO `instagram`.`users` (`user_id`, `user_pw`, `user_reg_date`) VALUES ('$id', '$pw', now());";
$result = mysqli_query($connect, $query);
mysqli_close($connect);
if ($result) {
	echo '<script>alert("가입완료.");</script>';
	echo '<script>location.href="index.php"</script>';
}else {
	echo '<script>alert("문제있어.");</script>';
	echo '<script>location.href="register.php"</script>';
}

?>