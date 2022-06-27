<?php
session_start();
require_once ("NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a' or $_SESSION['rights']=='s' or $_SESSION['rights']=='p')
{

if(isset($_GET['searchtext'])) {
	
	$searchtext = $_GET['searchtext'];
	$select = $_GET['select'];
	//$_SESSION['page'] = $_SERVER['REQUEST_URI'];
	$query = "SELECT * FROM `group`
	WHERE $select LIKE '%$searchtext%'";
	$select_authors3 = mysqli_query($link, $query);
} else {
	$query = "SELECT * FROM `group`";
	$select_authors3 = mysqli_query($link, $query);
}		
/////////////////DELETE//////////////////////////
	if(isset($_GET['iduser'])) {
	$user_id = $_GET['iduser'];
	$query2 = "DELETE FROM `group` WHERE id_gr = $user_id";
	$res = mysqli_query($link, $query2);
	
	//if ($page == "") {
		//header( "refresh:0;url = registration.php" );
	//	header("Refresh: 1; url=$qwe");
	//}else{
	//$qwe = $_SESSION['page'];
	// header("Refresh: 1; url=$qwe");
	//}
	echo "";
	header( "refresh:0;url = group.php" );
}

//order by id_st asc
//////////////////FORM_EDIT//////////////////
if(isset($_GET['iduser2'])) {
$iduser2 = $_GET['iduser2'];
$query4 = "SELECT * FROM `group` WHERE id_gr = $iduser2";
$result2 = mysqli_query($link, $query4);
$edit_user = mysqli_fetch_array($result2);
// header( "refresh:0;url = registration.php" );
// echo "";
}

//////////////////EDIT///////////////////////
if(isset($_GET['idst'])) {
$iduser3 = $_GET['idst'];
$gr = $_GET['gr'];
if ($gr != "") {
	$update_query = "UPDATE `group` SET gr = '$gr' WHERE id_gr = $iduser3";
	$update_result = mysqli_query ($link, $update_query);
}

header( "refresh:0;url = group.php" );
echo "";
}

?>
<html>
<head>
<meta name="robots" content="noindex, nofollow" charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="styler_group.css" >
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<title>Группы</title>
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
		});
	</script>
	<script type="text/javascript">
		$(function(){
		<?php if(isset($_GET['iduser2'])) { ?>
                $('.ff2').addClass('display');
                $('.ff4').removeClass('display');
                $('.add1').removeClass('display');
				$('.add2').addClass('display');
                
		<?php }else{ ?>
				$('.ff2').removeClass('display');
                $('.ff4').addClass('display');
            	$('.add1').addClass('display');
				$('.add2').removeClass('display');
		<?php } ?>	
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
			<nav>Таблица "Группы"</nav><br>
			<nav class="add1">Изменение строки:</nav>
			<nav class="add2">Добавление строки:</nav><br>
			<!-- <a href="#" class="a1">Студент</a>
			<a href="#" class="a2">Преподователь</a>
			<a href="#" class="a3">Организация</a> -->
		</div>
		<div class="formreg">
				<form method="POST" class="ff2" action="forms/newgroup.php">
				    <input type="text" name="gr_a" required size="20pt" maxlength="40" placeholder="Название группы" id="log" class="k1"><br>
					<input type="submit" value="Добавить группу">
				</form>

				<form method="get" class="ff4">
					<input type="text" style="display:none;" name="idst" value="<?php echo $edit_user['id_gr'];?>">
					<input type="text" name="gr" required size="20pt" maxlength="40" placeholder="ФИО" id="log" class="k1" value = "<?php echo $edit_user['gr'];?>"><br>
					<input type="submit" value="Редактировать группу">
				</form>
		</div>
		
		<div class="table">
			<div class="search" style="float: right; width: 100%">
				<form method="get">
					<select name="select" >
					    <option value="id_gr">Id</option>
					    <option selected value="gr">Название</option>
				    </select>
					<input name="searchtext" type="text" placeholder="Введите запрос" id="searcht" style="width:61%;">
					<input type="submit" id="searchb" value="Поиск">
				</form>
			</div>
			<table style="float: right; width: 100%;">
				<thead>
					<tr>
						<td width="50">Id</td>
						<td width=" 150">Группа</td>
					</tr>
				</thead>
				<tbody>
					<?php while ($account = mysqli_fetch_array($select_authors3)){ ?>
					<tr>
						<td>	
							<?php echo $account['id_gr']; ?>	
						</td>
						<td>
							<?php echo $account['gr']; ?>
							<!-- <a href="edituser.php?iduser=<?php echo $authors['id']; ?>">
							Изменить</a>
							<a href="deleteuser.php?iduser=<?php echo $authors['id']; ?>">
							Удалить</a> -->
							<!-- <a href="forms/deleteuser.php?iduser=<?php echo $account['id']; ?>"><img src="img/delete.svg" class="q1"></a> -->
							<a href="?iduser=<?php echo $account['id_gr']; ?>"><img src="img/delete.svg" class="q1"></a>
							<!-- <a href=""><img src="img/edit.svg" class="q2"></a> -->
							<a href="?iduser2=<?php echo $account['id_gr']; ?>" ><img src="img/edit.svg" class="q2"></a>
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
