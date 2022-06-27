<html>
<head>
<meta name="robots" content="noindex, nofollow" charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="style_log.css" >
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<title>Авторизация</title>
<style type="text/css">

  </style>
</head>
<body>
	<div class="content1">
		
		<div class="nav1" id="menu">
			<a href="index.php" style="color:black;">
			<div class="logo">
				<div class="square"></div>
				
					<div class="text-logo">
						Сайт-база данных
					</div>
				
			</div>
			</a>
				<!-- <div class="nav3"><a href="login.html">Войти</a></div> -->
				<!-- <div class="nav4"><a href="index.php">Главная</a></div> -->
		</div>
		<div class="logomain">
			<img src="logomain2.svg">
		</div>
		<div class="form">
			<div class="title">
				Авторизация
			</div>
			<div class="formreg">
				<form method="POST" class="ff" action="authorize.php">
					<input type="text" name="login" required size="20pt" maxlength="20" placeholder="Логин" id="log"><br>
					<input type="password" name="password" required size="20pt" maxlength="20" placeholder="Пароль" id="pas"><br>
					<input type="submit" value="Войти в аккаунт">
				</form>
			</div>
		</div>
	</div>
</body>
</html>

