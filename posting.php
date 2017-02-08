<?php 

move_uploaded_file($_FILES['myimage']['tmp_name'], "uploads/".$_FILES['myimage']['name']);

$path = "uploads/".$_FILES['myimage']['name'];
$content = $_POST["mytext"];
session_start();
$userId = $_SESSION['userId'];
$userIdx = $_SESSION['userIdx'];

$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = '*********';
$mysql_database = 'instagram';
$mysql_port = '3306';
$mysql_charset = 'utf8';

$connect = mysqli_connect($mysql_hostname.':'.$mysql_port, $mysql_username, $mysql_password);
mysqli_select_db($connect, $mysql_database) or die('DB 선택 실패');

$query = "INSERT INTO `instagram`.`post` (`post_idx`, `user_idx`, `img_src`, `content`, `like_cnt`, `reg_date`) VALUES (NULL, '$userIdx', '$path', '$content', '0', now());";
mysqli_query("set names utf8;");
$result = mysqli_query($connect, $query);

mysqli_close($connect);

if ($result) {
	echo '<script>location.href="index.php"</script>';
}

?>