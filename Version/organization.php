<?php
session_start();
require_once ("NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a' or $_SESSION['rights']=='s' or $_SESSION['rights']=='p' or $_SESSION['rights']=='o')
{



if(isset($_GET['searchtext'])) {
	
	$searchtext = $_GET['searchtext'];
	$select = $_GET['select'];
	//$_SESSION['page'] = $_SERVER['REQUEST_URI'];
	$query = "SELECT * FROM organization
	WHERE $select LIKE '%$searchtext%'";
	$select_authors = mysqli_query($link, $query);
} else {
	$query = "SELECT * FROM organization";
	$select_authors = mysqli_query($link, $query);
}		

//order by id_st asc
//////////////////FORM_EDIT//////////////////
if(isset($_GET['iduser2'])) {
$iduser2 = $_GET['iduser2'];
$query4 = "SELECT * FROM organization WHERE id_org = $iduser2";
$result2 = mysqli_query($link, $query4);
$edit_user = mysqli_fetch_array($result2);
// header( "refresh:0;url = registration.php" );
// echo "";
}

//////////////////EDIT///////////////////////
if(isset($_GET['idst'])) {
$iduser3 = $_GET['idst'];
$name = $_GET['name'];
$adress = $_GET['adress'];
$number = $_GET['number'];
if ($name != "" and $number !="" and $adress !="") {
	$update_query = "UPDATE organization SET name = '$name', number = '$number', adress = '$adress' WHERE id_org = $iduser3";
	$update_result = mysqli_query ($link, $update_query);
}

header( "refresh:0;url = organization.php" );
echo "";
}

?>
<html>
<head>
<meta name="robots" content="noindex, nofollow" charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="styler_organization.css" >
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<title>Преподователи</title>
<style type="text/css">
.table .q1
{
  margin: 0 15 0 20;
  float: right;
  width: 1.2em;
}
.table .q2
{
  float: right;
  width: 1.2em;
}
.floatl{
  margin-left: -250; 
}
.floatr{
  margin-left: 240; 
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
		<?php if ($_SESSION['rights']=='s' or $_SESSION['rights']=='p') { ?>
				$('.formreg').addClass('display');
				$('.table').addClass('floatl');
				$('.buttons').addClass('floatr');
				$('.q1').addClass('display');
				$('.q2').addClass('display');
				$('.add1').addClass('display');
				$('.add2').addClass('display');
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
			<nav>Таблица "Организации"</nav><br>
			<nav class="add1">Изменение строки:</nav><br>
			<!-- <a href="#" class="a1">Студент</a>
			<a href="#" class="a2">Преподователь</a>
			<a href="#" class="a3">Организация</a> -->
		</div>
		<div class="formreg">
				<form method="get" class="ff4">
					<input type="text" style="display:none;" name="idst" value="<?php echo $edit_user['id_org'];?>">
					<input type="text" name="name" required size="20pt" maxlength="40" placeholder="Название" id="log" class="k1" value = "<?php echo $edit_user['name'];?>"><br>
					<input type="text" name="adress" required size="20pt" maxlength="40" placeholder="Адрес" id="log" class="k1" value = "<?php echo $edit_user['adress'];?>"><br>
				    <input type="text" name="number" required size="20pt" maxlength="40" placeholder="Номер телефона" id="log" class="k1" value = "<?php echo $edit_user['number'];?>"><br>
					<input type="submit" value="Редактировать организацию">
				</form>
		</div>
		
		<div class="table">
			<div class="search" style="float: right; width: 100%">
				<form method="get">
					<select name="select" >
					    <option value="id_org">Id</option>
					    <option selected value="name">Название</option>
					    <option  value="adress">Адрес</option>
					    <option value="number">Номер телефона</option>
					    <option value="id_a">Аккаунт</option>
				    </select>
					<input name="searchtext" type="text" placeholder="Введите запрос" id="searcht" style="width:59%;">
					<input type="submit" id="searchb" value="Поиск">
				</form>
			</div>
			<table style="float: right; width: 100%;">
				<thead>
					<tr>
						<td width="50">Id</td>
						<td>Название</td>
						<td>Адрес</td>
						<td>Номер телефона</td>
						<td>Аккаунт</td>
					</tr>
				</thead>
				<tbody>
					<?php while ($account = mysqli_fetch_array($select_authors)){ ?>
					<tr>
						<td>	
							<?php echo $account['id_org']; ?>	
						</td>
						<td>
							<?php echo $account['name']; ?>
						</td>
						<td>
							<?php echo $account['adress']; ?>
						</td>
						<td>
							<?php echo $account['number']; ?>
						</td>
						<td>
							<?php echo $account['id_a']; ?>
							<!-- <a href="edituser.php?iduser=<?php echo $authors['id']; ?>">
							Изменить</a>
							<a href="deleteuser.php?iduser=<?php echo $authors['id']; ?>">
							Удалить</a> -->
							<!-- <a href="forms/deleteuser.php?iduser=<?php echo $account['id']; ?>"><img src="img/delete.svg" class="q1"></a> -->
							<!-- <a href=""><img src="img/edit.svg" class="q2"></a> -->
							<?php if ($_SESSION['rights']=='o') { 
								if ($_SESSION['id']==$account['id_a']) {
								?>
							<a href="?iduser2=<?php echo $account['id_org']; ?>" ><img src="img/edit.svg" class="q2"></a>
						<?php }} ?>
						<?php if ($_SESSION['rights']!='o') {  ?>
							<a href="?iduser2=<?php echo $account['id_org']; ?>" ><img src="img/edit.svg" class="q2"></a>
						<?php } ?>
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
