<?php 


$text = $_POST['text'];
$postIdx = $_POST['postIdx'];
session_start();
$userIdx = $_SESSION['userIdx'];
$userId = $_SESSION['userId'];

$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'whtpehd6298!';
$mysql_database = 'instagram';
$mysql_port = '3306';
$mysql_charset = 'utf8';
$connect = mysqli_connect($mysql_hostname.':'.$mysql_port, $mysql_username, $mysql_password);
mysqli_select_db($connect, $mysql_database) or die('DB 선택 실패');

$query = "INSERT INTO `instagram`.`comment` (`comment_idx`,`comment_user`,`comment_post`,`comment_content`,`comment_reg_date`)
		VALUES (NULL,'$userIdx','$postIdx','$text',now());";
mysqli_query($connect, "set names utf-8");
$result = mysqli_query($connect, $query);

mysqli_close($connect);
?>

<div class="each-comment">
	<div class="userId"><?php echo $userId;?></div>
	<div class="comment"><?php echo $text;?></div>
	<div class="regDate"><?php echo date("Y-m-d H:i:s");?></div>
</div>