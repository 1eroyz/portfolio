<?php
session_start();
require_once ("NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a')
{

$queryss22 = "SELECT * FROM `group`";
$select_group22 = mysqli_query($link, $queryss22);

if(isset($_GET['searchtext'])) {
	
	$searchtext = $_GET['searchtext'];
	$select = $_GET['select'];
	//$_SESSION['page'] = $_SERVER['REQUEST_URI'];
	$query = "SELECT * FROM account
	WHERE $select LIKE '%$searchtext%'";
	$select_authors = mysqli_query($link, $query);
} else {
	$query = "SELECT * FROM account order by id asc";
	$select_authors = mysqli_query($link, $query);
}		

//////////////////DELETE/////////////////////
	if(isset($_GET['iduser'])) {
	$user_id = $_GET['iduser'];
	$rights = $_GET['rights'];
if ($rights == 'gl_a' or $rights == 'a') 
	{
	header( "refresh:0;url = registration.php" );
	echo "";
	}
else
	{
	$query2 = "DELETE FROM `organization` WHERE id_a = $user_id";
	$res = mysqli_query($link, $query2);
	$query3 = "DELETE FROM `prepod` WHERE id_a = $user_id";
	$res2 = mysqli_query($link, $query3);
	$query = "DELETE FROM `account` WHERE id = $user_id";
	$res3 = mysqli_query($link, $query);
	
	//if ($page == "") {
		//header( "refresh:0;url = registration.php" );
	//	header("Refresh: 1; url=$qwe");
	//}else{
	//$qwe = $_SESSION['page'];
	// header("Refresh: 1; url=$qwe");
	//}
	echo "";
	header( "refresh:0;url = registration.php" );
	}
}

//////////////////FORM_EDIT//////////////////
if(isset($_GET['iduser2'])) {
$iduser2 = $_GET['iduser2'];
$query4 = "SELECT * FROM account WHERE id = $iduser2";
$result2 = mysqli_query($link, $query4);
$edit_user = mysqli_fetch_array($result2);
// header( "refresh:0;url = registration.php" );
// echo "";
}

//////////////////EDIT///////////////////////
if(isset($_GET['iduser3'])) {
$iduser3 = $_GET['iduser3'];
$login = $_GET['login_e'];
$password = $_GET['password_e'];
if ($login != "" and $password !="") {
	$update_query = "UPDATE account SET login = '$login', password = '$password' WHERE id = $iduser3";
	$update_result = mysqli_query ($link, $update_query);
}

header( "refresh:0;url = registration.php" );
echo "";
}

?>
<html>
<head>
<meta name="robots" content="noindex, nofollow" charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="stylereg.css" >
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<title>Регистрация</title>
<style type="text/css">
.table .q1
{
  margin: 0 24 0 20;
  float: right;
  width: 1.2em;
}
.table .q2
{
  float: right;
  width: 1.2em;
}

</style>
</head>
<body>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	 <script type="text/javascript">
		$(document).ready(function(){
		$('#menunav').click(function(){
		$(this).parent().children('#menunav2').slideToggle({duration:250, easing:"linear"});
		$('#str').toggleClass('flip');
		return false;
		});
		});
	</script>
	<script type="text/javascript">
		$(function(){
		<?php if(isset($_GET['iduser2'])) { ?>
				$('.ff1').addClass('display');
                $('.ff2').addClass('display');
                $('.ff3').addClass('display');

                $('.a1').addClass('color2');
                $('.a2').addClass('color2');
                $('.a3').addClass('color2');
		<?php }else{ ?>
				$('.ff1').removeClass('display');
                $('.ff2').addClass('display');
                $('.ff3').addClass('display');
                $('.ff4').addClass('display');
                $('.a1').addClass('color1');
                $('.a2').addClass('color2');
                $('.a3').addClass('color2');
            $('.a1').click(function(){
                $('.ff1').removeClass('display');
                $('.ff2').addClass('display');
                $('.ff3').addClass('display');
                $('.ff4').addClass('display');

                $('.a1').removeClass('color1, color2');
                $('.a2').removeClass('color1, color2');
                $('.a3').removeClass('color1, color2');

                $('.a1').addClass('color1');
                $('.a2').addClass('color2');
                $('.a3').addClass('color2');
                return false;
            });
            $('.a2').click(function(){
                $('.ff1').addClass('display');
                $('.ff2').removeClass('display');
                $('.ff3').addClass('display');
                $('.ff4').addClass('display');
                $('.a1').removeClass('color1, color2');
                $('.a2').removeClass('color1, color2');
                $('.a3').removeClass('color1, color2');
                $('.a1').addClass('color2');
                $('.a2').addClass('color1');
                $('.a3').addClass('color2');
                return false;
            });
            $('.a3').click(function(){
                $('.ff1').addClass('display');
                $('.ff2').addClass('display');
                $('.ff3').removeClass('display');
                $('.ff4').addClass('display');
                $('.a1').removeClass('color1, color2');
                $('.a2').removeClass('color1, color2');
                $('.a3').removeClass('color1, color2');
                $('.a1').addClass('color2');
                $('.a2').addClass('color2');
                $('.a3').addClass('color1');
                return false;
            });
		<?php } ?>
		
				
        });
	</script>
	<div class="content1">
		<div class="nav1" id="menu">
			<div class="logo">
				<div class="square"></div>
				<a href="index.php" style="color:black;">
					<div class="text-logo">
						Сайт-база данных
					</div>
				</a>
			</div>
				<!-- <div class="nav3"><a href="login.html">Войти</a></div> -->
				<!-- <div class="nav4"><a href="index.php">Главная</a></div> -->
				<nav id="menunav">
				<div class="loginon" >
						<div class="circle">
							<?php if ($_SESSION['rights'] =='a') { ?>
							<img src="img/adm.png" width="100%" align="100%">
							<?php } else if ($_SESSION['rights'] =='gl_a') { ?>
							<img src="img/admin.png" width="100%" align="100%">
							<?php } else if ($_SESSION['rights'] =='o') { ?>
								<img src="img/or.png" width="100%" align="100%">
							<?php } else if ($_SESSION['rights'] =='s') { ?>
								<img src="img/st.png" width="100%" align="100%">
							<?php } else if ($_SESSION['rights'] =='p') { ?>
								<img src="img/pr.png" width="100%" align="100%">
							<?php } ?>
						</div>
						<div class="namelog">
							<?php echo $_SESSION['login']; ?>
							<!-- Администратор -->
						</div>
						<div class="menulog">
							<img src="path.png" width="100%" id="str">
						</div>
				</div>
			</nav> 
			<div id="menunav2">
				<ul>
					<li id="profile"><a href="index.php#2">Таблицы</a></li>
					<li id="amxmenu"><a href="registration.php">Панель администратора</a></li>
					<li id="out"><a href="logout.php">Выход</a></li>
				</ul>
			</div>
		</div>
		<div class="buttons">
			<nav>Панель администратора</nav><br>
			<nav class="add">Добавление аккаунта:</nav><br>
			<a href="#" class="a1">Студент</a>
			<a href="#" class="a2">Преподователь</a>
			<a href="#" class="a3">Организация</a>
		</div>
		<div class="formreg">

				<form method="POST" class="ff1" action="forms/newuserstudent.php">
					<input type="text" name="fio_a" required size="20pt" maxlength="40" placeholder="Фамилия Имя Отчество" id="log" class="k1" ><br>
					<select name="id_gr_a" id="log" >
						<?php while ($groupp = mysqli_fetch_array($select_group22)){ ?>
					    <option selected value = "<?php echo $groupp['id_gr'];?>"><?php echo $groupp['gr']; ?></option>
					    <?php } ?>  
				    </select><br>
				    <input type="text" name="adress_a" required size="20pt" maxlength="40" placeholder="Адрес" id="log" class="k1" ><br>
				    <input type="text" name="srball_a" required size="20pt" maxlength="40" placeholder="Средний балл" id="log" class="k1"><br>
					<input type="text" name="login_s" required size="20pt" maxlength="19" placeholder="Логин" id="log" class="k1" value="<?php echo $qwe ?>"><br>
					<input type="text" name="password_s" required size="20pt" maxlength="15" placeholder="Пароль" id="pas"><br>
					
					<input type="submit" value="Добавить аккаунт">
				</form>
				<form method="POST" class="ff2" action="forms/newuserprepod.php">
					<input type="text" name="fio_p" required size="20pt" maxlength="19" placeholder="Фамилия Имя Отчество" id="log" class="k1"><br>
					<input type="text" name="number_p" required size="20pt" maxlength="19" placeholder="Номер телефона" id="log" class="k1"><br>
					<input type="text" name="login_p" required size="20pt" maxlength="19" placeholder="Логин" id="log" class="k1"><br>
					<input type="text" name="password_p" required size="20pt" maxlength="15" placeholder="Пароль" id="pas"><br>
					<input type="submit" value="Добавить аккаунт">
				</form>
				<form method="POST" class="ff3" action="forms/newuserorganization.php">
					<input type="text" name="name_o" required size="20pt" maxlength="19" placeholder="Название организации" id="log" class="k1"><br>
					<input type="text" name="number_o" required size="20pt" maxlength="19" placeholder="Номер телефона" id="log" class="k1"><br>
					<input type="text" name="adress_o" required size="20pt" maxlength="50" placeholder="Адрес" id="log" class="k1"><br>
					<input type="text" name="login_o" required size="20pt" maxlength="19" placeholder="Логин" id="log" class="k1"><br>
					<input type="text" name="password_o" required size="20pt" maxlength="15" placeholder="Пароль" id="pas"><br>
					<input type="submit" value="Добавить аккаунт">
				</form>
				<form method="get" class="ff4">
					<input type="text" style="display:none;" name="iduser3" value="<?php echo $edit_user['id'];?>">
					<input type="text" name="login_e" required size="20pt" maxlength="19" placeholder="Логин" id="log" class="k1" value = "<?php echo $edit_user['login'];?>"><br>
					<input type="text" name="password_e" required size="20pt" maxlength="15" placeholder="Пароль" id="pas" value = "<?php echo $edit_user['password'];?>"><br>
					<input type="submit" value="Редактировать аккаунт">
				</form>
		</div>
		
		<div class="table">
			<div class="search" style="float: right;">
				<form method="get">
					<select name="select" >
					    <option class="opt" value="id">Id</option>
					    <option class="opt" selected value="login">Login</option>
					    <option class="opt" value="password">Password</option>
					    <option class="opt" value="rights">Rights</option>
				    </select>
					<input name="searchtext" type="text" placeholder="Введите запрос" id="searcht">
					<input type="submit" id="searchb" value="Поиск">
				</form>
			</div>
			<table>
				<thead>
					<tr>
						<td width="63">Id</td>
						<td width="240">Login</td>
						<td width="210">Password</td>
						<td width="203">Rights</td>
					</tr>
				</thead>
				<tbody>
					<?php while ($account = mysqli_fetch_array($select_authors)){ ?>
					<tr>
						<td>	
							<?php echo $account['id']; ?>	
						</td>
						<td>
							<?php echo $account['login']; ?>
						</td>
						<td>
							<?php echo $account['password']; ?>
						</td>
						<td>
							<?php echo $account['rights']; ?>
							<!-- <a href="edituser.php?iduser=<?php echo $authors['id']; ?>">
							Изменить</a>
							<a href="deleteuser.php?iduser=<?php echo $authors['id']; ?>">
							Удалить</a> -->
							<!-- <a href="forms/deleteuser.php?iduser=<?php echo $account['id']; ?>"><img src="img/delete.svg" class="q1"></a> -->
							<a href="?iduser=<?php echo $account['id'];?>&rights=<?php echo $account['rights'];?>" ><img src="img/delete.svg" class="q1"></a>
							<!-- <a href=""><img src="img/edit.svg" class="q2"></a> -->
							<a href="?iduser2=<?php echo $account['id']; ?>" ><img src="img/edit.svg" class="q2"></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
<?php 
}
else
{
	header( "refresh:1;url = index.php" );
	echo 'Доступ воспрещен!';	
}




?>
