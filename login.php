

<!DOCTYPE HTML>
<head>
	<title>INSTAGRAM</title>
	<link rel="stylesheet" href="styles/style.css" />
	<meta charset="utf-8">
</head>
<body>
	<div class="main-container">
		<div class="main-body">
			<div class="container">
				<form class="login-form" action="login_check.php" method="post">
					<img src="imgs/logo.png" style="width: 100%;"/>
					<div class="input-group">
						<div class="input-label">아이디 :</div>
						<input type="text" name="id"/>
					</div>
					<div class="input-group">
						<div class="input-label">비밀번호 :</div>
						<input type="password" name="pw"/>						
					</div>
					<input class="submit-btn" type="submit"/>
					<div class="reg-link">
						<a href="register.php">회원가입</a>
					</div>
				</form>
			</div>
		</div>
		
	</div>
</body>