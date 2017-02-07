<?php
session_start();
$loggedin = array_key_exists('userId',$_SESSION);
if (!$loggedin) {
	echo '<script>location.href="login.php"</script>';
}


$mysql_hostname = 'localhost';
$mysql_username = 'root';
$mysql_password = 'whtpehd6298!';
$mysql_database = 'instagram';
$mysql_port = '3306';
$mysql_charset = 'utf8';

$connect = mysqli_connect($mysql_hostname.':'.$mysql_port, $mysql_username, $mysql_password);
mysqli_select_db($connect, $mysql_database) or die('DB 선택 실패');

$query = "SELECT * FROM `post` INNER JOIN `users` ON `post`.`user_idx` = `users`.`user_idx` WHERE 1 order by `reg_date` desc";
$result = mysqli_query($connect, $query);

while ($row = mysqli_fetch_assoc($result)) {
	$posts[] = $row;
}

?>
<!DOCTYPE HTML>
<head>
	<title>INSTAGRAM</title>
	<link rel="stylesheet" href="styles/style.css" />
</head>
<body>
	<div class="main-container">
		<div class="header">
			<div class="header-container">
				<div class="header-ele logo">
					<img src="imgs/logo.png" />
				</div>
				<div class="header-ele search">
					<input type="text" placeholder="검색하세요" />
				</div>
				<div class="header-ele setting">
					<span>
					<?php
					if($loggedin) {
						echo $_SESSION["userId"];
					}
					?>
					<a href="logout.php">Log-Out</a>
					</span>				
				</div>
			</div>
		</div>
		<div class="main-body">
			<div class="container">
				<div class="posting-form">
					<form action="posting.php" method="post" enctype="multipart/form-data">
						<div class="input-outer">
							<div class="label">사진</div>
							<input type="file" name="myimage">
						</div>
						<div class="input-outer">
							<div class="label">글</div>
							<textarea name="mytext"></textarea>
						</div>
						<div class="input-outer" style="text-align: center;">
							<input style="float: none; width: 50px;" type="submit">
						</div>
					</form>
				</div>
				<?php foreach ($posts as $post) {?>
				<div class="post">
					<div class="post-header">
						<img src="imgs/img.jpg" />
						<div class="author-id"><?php echo $post['user_id']?></div>
						<div class="post-reg-time"><?php echo $post['reg_date']?></div>
					</div>
					<div class="post-body">
						<img src="<?php echo $post['img_src']?>" />
					</div>
					<div class="post-footer">
						<div class="like">좋아요 <?php echo $post['like_cnt']?>개</div>
						<div class="num-of-comment">댓글 231개 더 보기</div>
						<div class="comment-list">
							<?php
							$connect = mysqli_connect($mysql_hostname.':'.$mysql_port, $mysql_username, $mysql_password);
							mysqli_select_db($connect, $mysql_database) or die('DB 선택 실패');
							$postIdx = $post['post_idx'];
							$query = "SELECT * FROM `comment` INNER JOIN `users` ON `comment`.`comment_user` = `users`.`user_idx`";
							$query .= "WHERE `comment`.`comment_post` = $postIdx order by `comment_reg_date` asc";
							$result = mysqli_query($connect, $query);
							while($row = mysqli_fetch_assoc($result)){
								$comments[] = $row;
							}
							
							
							mysqli_close($connect);
							foreach ($comments as $comment){
								
								
							?>
							<div class="each-comment">
								<div class="userId"><?php echo $comment['user_id'];?></div>
								<div class="comment"><?php echo $comment['comment_content'];?></div>
								<div class="regDate"><?php echo $comment['comment_reg_date'];?></div>
							</div>
							<?php 
							
							echo $postIdx;
							echo $comment['comment_post'];
							
							
							}
							$comments=null;
							?>							
						</div>
						<div class="comment-form">
							<div class="heart-mark">
								<img src="imgs/heart.png"/>
							</div>
							<div class="comment-input">
								<input type="text" class="comment-text" data-postidx="<?php echo $post['post_idx'];?>" placeholder="5글자 이상 입력해 주세요."/>
							</div>
							<div class="comment-etc">***</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
		<div class="footer">
			<div class="footer-container">
				<ul>
					<li>About US</li>
					<li>CEOS 지원하기</li>
					<li>우리의 작품들</li>
				</ul>
			</div>
		</div>
	</div>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
	$(document).ready(function(){
		$('.comment-text').keypress(function(e){
			var text = $(this).val();
			var postIdx = $(this).data('postidx');
			var target = $(this).parents().eq(2).find(".comment-list");

			if(e.which == 13){
				if(text.length >= 5){
					$(this).val("");
					$.ajax({
						url:'ajax_comment.php',
						method:"POST",
						data:{text:text,postIdx:postIdx},
						success:function(view){
							target.append(view);
						}
					});
				}else {
					alert("댓글이 너무 짧아요.");
				}
			}
		});
	});
</script>
</body>





