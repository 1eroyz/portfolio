<?php
session_start();
require_once ("NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a' or $_SESSION['rights']=='s' or $_SESSION['rights']=='p' or $_SESSION['rights']=='o')
{

if(isset($_GET['searchtext'])) {
	
	$searchtext = $_GET['searchtext'];
	$select = $_GET['select'];
	//$_SESSION['page'] = $_SERVER['REQUEST_URI'];
	$query = "SELECT * FROM pract
	WHERE $select LIKE '%$searchtext%'";
	$select_authors = mysqli_query($link, $query);
} else {
	$query = "SELECT * FROM pract";
	$select_authors = mysqli_query($link, $query);
}		
/////////////////DELETE//////////////////////////
	if(isset($_GET['iduser'])) {
	$user_id = $_GET['iduser'];
	$query2 = "DELETE FROM pract WHERE id_pr = $user_id";
	$res = mysqli_query($link, $query2);
	
	//if ($page == "") {
		//header( "refresh:0;url = registration.php" );
	//	header("Refresh: 1; url=$qwe");
	//}else{
	//$qwe = $_SESSION['page'];
	// header("Refresh: 1; url=$qwe");
	//}
	echo "";
	header( "refresh:0;url = pract.php" );
}

//order by id_st asc
//////////////////FORM_EDIT//////////////////
if(isset($_GET['iduser2'])) {
$iduser2 = $_GET['iduser2'];
$query4 = "SELECT * FROM pract WHERE id_pr = $iduser2";
$result2 = mysqli_query($link, $query4);
$edit_user = mysqli_fetch_array($result2);
// header( "refresh:0;url = registration.php" );
// echo "";
}

//////////////////EDIT///////////////////////
if(isset($_GET['idst'])) {
$iduser3 = $_GET['idst'];
$name = $_GET['name'];
$spec = $_GET['spec'];
$kolvo = $_GET['kolvo'];
if ($kolvo != "" and $spec !="" and $name !="") {
	$update_query = "UPDATE `pract` SET name = '$name', spec = '$spec', kolvo = '$kolvo' WHERE id_pr = $iduser3";
	$update_result = mysqli_query ($link, $update_query);
}

header( "refresh:0;url = pract.php" );
echo "";
}

?>
<html>
<head>
<meta name="robots" content="noindex, nofollow" charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="styler_pract.css" >
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<title>Практики</title>
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
		<?php if ($_SESSION['rights']=='s' or $_SESSION['rights']=='p' or $_SESSION['rights']=='o') { ?>
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
			<nav>Таблица "Практики"</nav><br>
			<nav class="add1">Изменение строки:</nav>
			<nav class="add2">Добавление строки:</nav><br>
			<!-- <a href="#" class="a1">Студент</a>
			<a href="#" class="a2">Преподователь</a>
			<a href="#" class="a3">Организация</a> -->
		</div>
		<div class="formreg">
				<form method="POST" class="ff2" action="forms/newpract.php">
					<input type="text" name="name_a" required size="20pt" maxlength="40" placeholder="Название практики" id="log" class="k1" ><br>
				    <input type="text" name="spec_a" required size="20pt" maxlength="50" placeholder="Специальность" id="log" class="k1" ><br>
				    <input type="number" name="kolvo_a" required size="20pt" maxlength="40" placeholder="Всего мест" id="log" class="k1"><br>
					<input type="submit" value="Добавить практику">
				</form>

				<form method="get" class="ff4">
					<input type="text" style="display:none;" name="idst" value="<?php echo $edit_user['id_pr'];?>">
					<input type="text" name="name" required size="20pt" maxlength="40" placeholder="Название практики" id="log" class="k1" value = "<?php echo $edit_user['name'];?>"><br>
				    <input type="text" name="spec" required size="20pt" maxlength="50" placeholder="Специальность" id="log" class="k1" value = "<?php echo $edit_user['spec'];?>"><br>
				    <input type="number" name="kolvo" required size="20pt" maxlength="40" placeholder="Всего мест" id="log" class="k1" value = "<?php echo $edit_user['kolvo'];?>"><br>
					<input type="submit" value="Редактировать практику">
				</form>
		</div>
		
		<div class="table">
			<div class="search" style="float: right; width: 100%">
				<form method="get">
					<select name="select" >
					    <option value="id_pr">Id</option>
					    <option selected value="name">Название</option>
					    <option value="spec">Специальность</option>
					    <option value="kolvo">Всего мест</option>
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
						<td>Специальность</td>
						<td width=" 150">Всего мест</td>
					</tr>
				</thead>
				<tbody>
					<?php while ($account = mysqli_fetch_array($select_authors)){ ?>
					<tr>
						<td>	
							<?php echo $account['id_pr']; ?>	
						</td>
						<td>
							<?php echo $account['name']; ?>
						</td>
						<td>
							<?php echo $account['spec']; ?>
						</td>
						<td>
							<?php echo $account['kolvo']; ?>
							<!-- <a href="edituser.php?iduser=<?php echo $authors['id']; ?>">
							Изменить</a>
							<a href="deleteuser.php?iduser=<?php echo $authors['id']; ?>">
							Удалить</a> -->
							<!-- <a href="forms/deleteuser.php?iduser=<?php echo $account['id']; ?>"><img src="img/delete.svg" class="q1"></a> -->
							<a href="?iduser=<?php echo $account['id_pr']; ?>"><img src="img/delete.svg" class="q1"></a>
							<!-- <a href=""><img src="img/edit.svg" class="q2"></a> -->
							<a href="?iduser2=<?php echo $account['id_pr']; ?>" ><img src="img/edit.svg" class="q2"></a>
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
