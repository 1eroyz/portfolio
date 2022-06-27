<?php
session_start();
require_once ("NikiforovDB.php");
if ($_SESSION['rights']=='a' or $_SESSION['rights']=='gl_a' or $_SESSION['rights']=='s' or $_SESSION['rights']=='o' or $_SESSION['rights']=='p')
{

$queryss = "SELECT * FROM `group`";
$select_group = mysqli_query($link, $queryss);

$queryss2 = "SELECT * FROM `group`";
$select_group2 = mysqli_query($link, $queryss2);

if(isset($_GET['searchtext'])) {
	
	$searchtext = $_GET['searchtext'];
	$select = $_GET['select'];
	//$_SESSION['page'] = $_SERVER['REQUEST_URI'];
	$query = "SELECT * FROM student
	WHERE $select LIKE '%$searchtext%'";
	$select_authors = mysqli_query($link, $query);
} else {
	$query = "SELECT * FROM student";
	$select_authors = mysqli_query($link, $query);
}		
/////////////////DELETE//////////////////////////
	if(isset($_GET['iduser'])) {
	$user_id = $_GET['iduser'];
	$query2 = "DELETE FROM student WHERE id_st = $user_id";
	$res = mysqli_query($link, $query2);
	
	//if ($page == "") {
		//header( "refresh:0;url = registration.php" );
	//	header("Refresh: 1; url=$qwe");
	//}else{
	//$qwe = $_SESSION['page'];
	// header("Refresh: 1; url=$qwe");
	//}
	echo "";
	header( "refresh:0;url = student.php" );
}

//order by id_st asc
//////////////////FORM_EDIT//////////////////
if(isset($_GET['iduser2'])) {
$iduser2 = $_GET['iduser2'];
$query4 = "SELECT * FROM student WHERE id_st = $iduser2";
$result2 = mysqli_query($link, $query4);
$edit_user = mysqli_fetch_array($result2);
// header( "refresh:0;url = registration.php" );
// echo "";
}

//////////////////EDIT///////////////////////
if(isset($_GET['idst'])) {
$iduser3 = $_GET['idst'];
$fio = $_GET['fio'];
$id_gr = $_GET['id_gr'];
$adress = $_GET['adress'];
$srball = $_GET['srball'];
if ($fio != "" and $id_gr !="" and $adress !="" and $srball !="") {
	$update_query = "UPDATE `student` SET fio = '$fio', id_gr = '$id_gr', adress = '$adress', srball = '$srball' WHERE id_st = $iduser3";
	$update_result = mysqli_query ($link, $update_query);
}

header( "refresh:0;url = student.php" );
echo "";
}

?>
<html>
<head>
<meta name="robots" content="noindex, nofollow" charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="styler_student.css" >
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<title>Студенты</title>
<style type="text/css">
.table .q1
{
  margin: 0 0 0 15;
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

                
		<?php }else{ ?>


            
		<?php } ?>	
		<?php if ($_SESSION['rights']=='p' or $_SESSION['rights']=='o') {?>
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
			<nav>Таблица "Студенты"</nav><br>
			<?php if ($_SESSION['rights']=='gl_a' or $_SESSION['rights']=='a' or $_SESSION['rights']=='s' ) { ?>
			<nav class="add1">Изменение строки:</nav>
			<!-- <a href="#" class="a1">Студент</a>
			<a href="#" class="a2">Преподователь</a>
			<a href="#" class="a3">Организация</a> -->
			<?php } ?>
		</div>
		<div class="formreg">
				<form method="get" class="ff4">
					<input type="text" style="display:none;" name="idst" value="<?php echo $edit_user['id_st'];?>">
					<input type="text" name="fio" required size="20pt" maxlength="40" placeholder="ФИО" id="log" class="k1" value = "<?php echo $edit_user['fio'];?>"><br>
					
					<select name="id_gr" id="log" >
						<option>Выберите группу</option>
						<?php while ($groupp = mysqli_fetch_array($select_group)){ ?>
					    <option <?php 
					    if ($groupp['id_gr'] == $edit_user['id_gr']) {
					    	echo 'selected';
					    } else { if ($_SESSION['rights'] == 's') echo "disabled";}
					    ?> value = "<?php echo $groupp['id_gr'];?>"><?php echo $groupp['gr']; ?></option>
					    <?php } ?>  
				    </select><br>
				    <input type="text" name="adress" required size="20pt" maxlength="40" placeholder="Адрес" id="log" class="k1" value = "<?php echo $edit_user['adress'];?>"><br>
				    <input type="text" name="srball" required size="20pt" maxlength="19" placeholder="Средний балл" id="log" class="k1" value = "<?php echo $edit_user['srball'];?>"><br>
					<input type="submit" value="Редактировать строку">
				</form>
		</div>
		
		<div class="table">
			<div class="search" style="float: right; width: 100%">
				<form method="get">
					<select name="select" >
					    <option value="id_st">Id</option>
					    <option selected value="fio">ФИО</option>
					    <option value="id_gr">Группа</option>
					    <option value="adress">Адрес</option>
					    <option value="srball">Средний балл</option>
					    <option value="id_a">Аккаунт</option>
				    </select>
					<input name="searchtext" type="text" placeholder="Введите запрос" id="searcht" style="width:61%;">
					<input type="submit" id="searchb" value="Поиск">
				</form>
			</div>
			<table style="float: right; width: 100%;">
				<thead>
					<tr>
						<td>Id</td>
						<td >ФИО</td>
						<td width="80">Группа</td>
						<td>Адрес</td>
						<td >Cредний балл</td>
						<td >Аккаунт</td>
					</tr>
				</thead>
				<tbody>
					<?php while ($account = mysqli_fetch_array($select_authors)){ ?>
					<tr>
						<td>	
							<?php echo $account['id_st']; ?>	
						</td>
						<td>
							<?php echo $account['fio']; ?>
						</td>
						<td>
							<?php 
							$search_id = $account['id_gr'] ;
							$studentid = "SELECT * FROM `group` WHERE id_gr = $search_id";
							$resultstudent = mysqli_query($link, $studentid);
							$accountstudent = mysqli_fetch_array($resultstudent);
							echo $accountstudent['gr']; 
							?>
						</td>
						<td>
							<?php echo $account['adress']; ?>
						</td>
						<td>
							<?php echo $account['srball']; ?>
						</td>
						<td>
							<?php echo $account['id_a']; ?>
							<?php if ($_SESSION['rights']=='s' and $_SESSION['id'] == $account['id_a']) { ?>
								<a href="?iduser2=<?php echo $account['id_st']; ?>" ><img src="img/edit.svg" class="q2"></a>
							<?php } else if ($_SESSION['rights']!='s') { ?>
							<a href="?iduser2=<?php echo $account['id_st']; ?>" ><img src="img/edit.svg" class="q2"></a>
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
